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
})();
