const topBlogTag_skill = document.querySelectorAll(".top-skill-blog__tag-li");
const topBlogTagContent_skill = document.querySelectorAll(".blog-list-scroll__link");

window.addEventListener(
  "load",
  function () {
    topBlogTagContent_skill.forEach(function (article) {
      if (!article.classList.contains('html-css')) {
        article.classList.add('notShowMe');
      }
    });
  },
  false
);