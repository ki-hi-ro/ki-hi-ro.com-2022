const topBlogTag_skill = document.querySelectorAll(".top-skill-blog__tag-li");
const topBlogTagContent_skill = document.querySelectorAll(
  ".blog-list-scroll__link"
);

window.addEventListener(
  "load",
  function () {
    topBlogTag_skill.forEach(function (tag) {
      tag_contentid = tag.getAttribute("contentid");
      if (tag_contentid == "html-css") {
        tag.classList.add("active");
      }
    });

    topBlogTagContent_skill.forEach(function (article) {
      if (!article.classList.contains("html-css")) {
        article.classList.add("notShowMe");
      }
    });
  },
  false
);

topBlogTag_skill.forEach(function (tag) {
  tag.addEventListener("click", function () {
    const allTag = document.querySelectorAll(".top-skill-blog__tag-li");
    allTag.forEach(function (oneTag) {
      oneTag.classList.remove("active");
    });
    tag.classList.add("active");

    tag_contentid = tag.getAttribute("contentid");
    topBlogTagContent_skill.forEach(function (article) {
      article.classList.remove("notShowMe");
      if (!article.classList.contains(tag_contentid)) {
        article.classList.add("notShowMe");
      }
    });
  });
});
