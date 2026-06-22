(() => {
  "use strict";

  const viewport = document.querySelector('meta[name="viewport"]');
  const pageTopLinks = document.querySelectorAll(".page-top__link");
  const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");
  let ticking = false;

  function updateViewport() {
    if (!viewport) return;

    viewport.content =
      window.innerWidth <= 375
        ? "width=375, initial-scale=1"
        : "width=device-width, initial-scale=1";
  }

  function updatePageLinks() {
    const scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
    const pointsToBottom = window.scrollY < scrollableHeight / 2;

    pageTopLinks.forEach((link) => {
      link.textContent = pointsToBottom ? "↓" : "↑";
      link.dataset.mode = pointsToBottom ? "bottom" : "top";
      link.setAttribute(
        "aria-label",
        pointsToBottom ? "ページの一番下へ移動" : "ページの一番上へ移動"
      );
    });

    ticking = false;
  }

  function requestPageLinkUpdate() {
    if (!ticking) {
      window.requestAnimationFrame(updatePageLinks);
      ticking = true;
    }
  }

  function setupArticleToc() {
    const tocLists = document.querySelectorAll("[data-article-toc-list]");
    const headings = Array.from(
      document.querySelectorAll(".post > #first-ttl, .post__content h2, .post__content h3")
    );

    if (!tocLists.length || !headings.length) {
      document.querySelectorAll(".article-toc").forEach((toc) => {
        toc.hidden = true;
      });
      return;
    }

    const usedIds = new Set();
    headings.forEach((heading, index) => {
      let headingId = heading.id || `article-section-${index + 1}`;
      while (usedIds.has(headingId)) headingId += "-section";
      heading.id = headingId;
      usedIds.add(headingId);
    });

    tocLists.forEach((list) => {
      const fragment = document.createDocumentFragment();
      headings.forEach((heading) => {
        const item = document.createElement("li");
        const link = document.createElement("a");
        item.className = `article-toc__item article-toc__item--${heading.tagName.toLowerCase()}`;
        link.href = `#${heading.id}`;
        link.textContent = heading.textContent.trim();
        link.dataset.tocTarget = heading.id;
        item.appendChild(link);
        fragment.appendChild(item);
      });
      list.appendChild(fragment);
    });

    if ("IntersectionObserver" in window) {
      const observer = new IntersectionObserver(
        (entries) => {
          const visible = entries.find((entry) => entry.isIntersecting);
          if (!visible) return;
          document.querySelectorAll("[data-toc-target]").forEach((link) => {
            const isCurrent = link.dataset.tocTarget === visible.target.id;
            link.classList.toggle("is-current", isCurrent);
            if (isCurrent) link.setAttribute("aria-current", "location");
            else link.removeAttribute("aria-current");
          });
        },
        { rootMargin: "-8% 0px -86% 0px" }
      );
      headings.forEach((heading) => observer.observe(heading));
    }

  }

  function setupMobileArticleLimit() {
    const articleList = document.querySelector(".article-list");
    if (!articleList) return;

    const items = Array.from(articleList.children).filter((item) =>
      item.classList.contains("all-article__link")
    );
    if (items.length <= 5) return;

    const media = window.matchMedia("(max-width: 767px)");
    const button = document.createElement("button");
    let visibleCount = 5;
    button.type = "button";
    button.className = "article-list__more";
    articleList.insertAdjacentElement("afterend", button);

    function render() {
      items.forEach((item, index) => {
        item.classList.toggle("is-mobile-hidden", media.matches && index >= visibleCount);
      });
      button.hidden = !media.matches || visibleCount >= items.length;
      button.textContent = `さらに${Math.min(5, items.length - visibleCount)}件を見る`;
    }

    button.addEventListener("click", () => {
      visibleCount += 5;
      render();
    });
    media.addEventListener?.("change", () => {
      visibleCount = 5;
      render();
    });
    render();
  }

  pageTopLinks.forEach((link) => {
    link.addEventListener("click", (event) => {
      event.preventDefault();

      window.scrollTo({
        top:
          link.dataset.mode === "bottom"
            ? document.documentElement.scrollHeight
            : 0,
        behavior: reducedMotion.matches ? "auto" : "smooth",
      });
    });
  });

  updateViewport();
  updatePageLinks();
  window.addEventListener("resize", updateViewport, { passive: true });
  window.addEventListener("resize", requestPageLinkUpdate, { passive: true });
  window.addEventListener("scroll", requestPageLinkUpdate, { passive: true });
  setupArticleToc();
  setupMobileArticleLimit();
})();
