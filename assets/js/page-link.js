window.addEventListener("DOMContentLoaded", () => {
  const anchorLinks = document.querySelectorAll('a[href^="#"]');
  const anchorLinksArr = Array.prototype.slice.call(anchorLinks);

  anchorLinksArr.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      var humburger_lines = document.querySelectorAll('.header__open-btn-line');
      humburger_lines.forEach(function (humburger_line) {
        humburger_line.classList.remove('active');
      })
      const targetId = link.hash;
      const targetElement = document.querySelector(targetId);
      var targetOffsetTop = window.pageYOffset + targetElement.getBoundingClientRect().top;
      const href = link.getAttribute('href');
      var scroll_adjust = 100;
      if (href == "#author") {
        var scroll_adjust = 130;
      } else if (href == "#contact") {
        var scroll_adjust = 50;
      }
      var targetOffsetTop = targetOffsetTop - scroll_adjust;
      window.scrollTo({
        top: targetOffsetTop,
        behavior: "smooth",
      });
    });
  });
});
