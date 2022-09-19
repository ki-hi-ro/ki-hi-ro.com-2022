window.addEventListener("DOMContentLoaded", () => {
  const anchorLinks = document.querySelectorAll('a[href^="#"]');
  const anchorLinksArr = Array.prototype.slice.call(anchorLinks);

  anchorLinksArr.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const targetId = link.hash;
      const targetElement = document.querySelector(targetId);
      var targetOffsetTop = window.pageYOffset + targetElement.getBoundingClientRect().top;
      const href = link.getAttribute('href');
      if (href == '#author') {
        var targetOffsetTop = targetOffsetTop - 130;
      }
      window.scrollTo({
        top: targetOffsetTop,
        behavior: "smooth",
      });
    });
  });
});
