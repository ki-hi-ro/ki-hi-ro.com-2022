const topBlogTag_skill = document.querySelectorAll(".top-skill-blog__tag-li");
const topBlogTagContent_skill = document.querySelectorAll(".blog-list-scroll__link");

window.addEventListener(
  "load",
  function () {
    topBlogTag_skill.forEach(function (tag) {
      tag_contentid = tag.getAttribute('contentid');
      if (tag_contentid == 'html-css') {
        tag.classList.add('active');
      }
    });

    topBlogTagContent_skill.forEach(function (article) {
      if (!article.classList.contains('html-css')) {
        article.classList.add('notShowMe');
      }
    });
  },
  false
);