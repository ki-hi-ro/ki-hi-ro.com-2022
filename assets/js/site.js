(() => {
  "use strict";

  const viewport = document.querySelector('meta[name="viewport"]');
  const pageTopLinks = document.querySelectorAll(".page-top__link");
  const menuToggle = document.querySelector(".site-menu-toggle");
  const menuClose = document.querySelector(".site-menu-close");
  const menuPanel = document.querySelector("#site-menu-panel");
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

  function setMenu(open) {
    if (!menuToggle || !menuPanel) return;

    menuPanel.hidden = !open;
    menuToggle.classList.toggle("is-active", open);
    menuToggle.setAttribute("aria-expanded", open ? "true" : "false");
    document.body.classList.toggle("menu-is-open", open);
  }

  function setupMenu() {
    if (!menuToggle || !menuPanel) return;

    menuToggle.addEventListener("click", () => {
      setMenu(menuPanel.hidden);
    });

    menuClose?.addEventListener("click", () => {
      setMenu(false);
      menuToggle.focus();
    });

    menuPanel.addEventListener("click", (event) => {
      const link = event.target.closest("a");
      if (link) setMenu(false);
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape" && !menuPanel.hidden) {
        setMenu(false);
        menuToggle.focus();
      }
    });
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

  function setupLogbookFilter() {
    const filter = document.querySelector("[data-logbook-filter]");
    const articleList = document.querySelector(".article-list");
    if (!filter || !articleList) return;

    const buttons = Array.from(filter.querySelectorAll("[data-filter-tag]"));
    const rows = Array.from(articleList.children).filter((item) =>
      item.classList.contains("all-article__link")
    );
    if (!buttons.length || !rows.length) return;

    const overview = document.querySelector(".logbook-overview");
    const countNumber = overview?.querySelector(".logbook-overview__count span");
    const activityDays = Array.from(
      document.querySelectorAll(".logbook-activity__day")
    );
    const numberFormatter = new Intl.NumberFormat(
      document.documentElement.lang || navigator.language || "ja-JP"
    );
    const activityLevelClasses = Array.from({ length: 5 }, (_, level) =>
      `logbook-activity__day--level-${level}`
    );

    const status = document.createElement("p");
    status.className = "logbook-filter__status";
    status.setAttribute("aria-live", "polite");
    filter.appendChild(status);

    function setActivityLevel(day, count) {
      const level = Math.min(4, Math.max(0, Number(count) || 0));
      day.classList.remove(...activityLevelClasses);
      day.classList.add(`logbook-activity__day--level-${level}`);
    }

    function setActivityLabel(day, label) {
      if (!label) return;
      day.setAttribute("title", label);
      const readerText = day.querySelector(".screen-reader-text");
      if (readerText) readerText.textContent = label;
    }

    function updateOverview(tag, visibleCount, visibleRows) {
      if (countNumber) {
        countNumber.textContent = numberFormatter.format(visibleCount);
      }

      if (!activityDays.length) return;

      if (tag === "all") {
        activityDays.forEach((day) => {
          setActivityLevel(day, day.dataset.logbookLevel);
          setActivityLabel(day, day.dataset.logbookLabel);
        });
        return;
      }

      const countsByDate = new Map();
      visibleRows.forEach((row) => {
        const article = row.querySelector("[data-logbook-item]");
        const date =
          article?.dataset.logbookDate ||
          article?.querySelector("time")?.getAttribute("datetime")?.slice(0, 10);
        if (!date) return;
        countsByDate.set(date, (countsByDate.get(date) || 0) + 1);
      });

      activityDays.forEach((day) => {
        const count = countsByDate.get(day.dataset.logbookDate) || 0;
        const labelDate = (day.dataset.logbookDate || "").replaceAll("-", ".");
        const label = labelDate
          ? `${labelDate}: ${numberFormatter.format(count)}件`
          : "";
        setActivityLevel(day, count);
        setActivityLabel(day, label);
      });
    }

    function applyFilter(tag) {
      let visibleCount = 0;
      const visibleRows = [];

      rows.forEach((row) => {
        const article = row.querySelector("[data-logbook-item]");
        const tags = article?.dataset.logbookTags?.split(" ").filter(Boolean) || [];
        const isVisible = tag === "all" || tags.includes(tag);
        row.hidden = !isVisible;
        row.style.display = isVisible ? "" : "none";
        row.classList.toggle("is-filter-hidden", !isVisible);
        if (isVisible) {
          visibleCount += 1;
          visibleRows.push(row);
        }
      });

      buttons.forEach((button) => {
        const isActive = button.dataset.filterTag === tag;
        button.classList.toggle("is-active", isActive);
        button.setAttribute("aria-pressed", isActive ? "true" : "false");
      });

      status.textContent = `${visibleCount}件を表示`;
      updateOverview(tag, visibleCount, visibleRows);
    }

    buttons.forEach((button) => {
      button.addEventListener("click", () => {
        const tag = button.dataset.filterTag || "all";
        applyFilter(tag);

        if (tag !== "all") {
          window.requestAnimationFrame(() => {
            articleList.scrollIntoView({
              block: "start",
              behavior: reducedMotion.matches ? "auto" : "smooth",
            });
          });
        }
      });
    });

    applyFilter("all");
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
  setupMenu();
  setupArticleToc();
  setupLogbookFilter();
})();
