const tag_list_skil = document.querySelectorAll(".top-skill-blog__tag-li");
const article_list_skil = document.querySelectorAll(".blog-list-scroll__link--skill-blog");
const tag_list_study = document.querySelectorAll(".top-study-blog__tag-li");
const article_list_study = document.querySelectorAll(".blog-list-scroll__link--study-blog");
const tag_list_random = document.querySelectorAll(".top-random-blog__tag-li");
const article_list_random = document.querySelectorAll(".blog-list-scroll__link--random-blog");

tag_motion(tag_list_skil, article_list_skil, "html-css");
tag_motion(tag_list_study, article_list_study, "typescript");
tag_motion(tag_list_random, article_list_random, "music");

function tag_motion(tag_list, article_list, default_article) {
  window.addEventListener(
    "load",
    function () {
      tag_list.forEach(function (tag) {
        tag_contentid = tag.getAttribute("contentid");
        if (tag_contentid == default_article) {
          tag.classList.add("active");
        }
      });

      article_list.forEach(function (article) {
        if (!article.classList.contains(default_article)) {
          article.classList.add("notShowMe");
        }
      });
    },
    false
  );

  tag_list.forEach(function (tag) {
    tag.addEventListener("click", function () {
      tag_list.forEach(function (all_tag) {
        all_tag.classList.remove("active");
      })
      tag.classList.add("active");
      tag_contentid = tag.getAttribute("contentid");
      article_list.forEach(function (article) {
        article.classList.remove("notShowMe");
        if (!article.classList.contains(tag_contentid)) {
          article.classList.add("notShowMe");
        }
      });
    });
  });
}