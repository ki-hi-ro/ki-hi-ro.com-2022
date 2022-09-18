const tag_list_whatidid = document.querySelectorAll(".top-what-i-did__tag-li");
const article_list_whatidid = document.querySelectorAll(
  ".blog-list-scroll__link--what-i-did"
);
const tag_list_skill = document.querySelectorAll(".top-skill-blog__tag-li");
const article_list_skill = document.querySelectorAll(
  ".blog-list-scroll__link--skill-blog"
);
const tag_list_study = document.querySelectorAll(".top-study-blog__tag-li");
const article_list_study = document.querySelectorAll(
  ".blog-list-scroll__link--study-blog"
);
const tag_list_random = document.querySelectorAll(".top-random-blog__tag-li");
const article_list_random = document.querySelectorAll(
  ".blog-list-scroll__link--random-blog"
);

tag_motion(tag_list_whatidid, article_list_whatidid);
tag_motion(tag_list_skill, article_list_skill);
tag_motion(tag_list_study, article_list_study);
tag_motion(tag_list_random, article_list_random);

function tag_motion(tag_list, article_list, default_article) {
  tag_list.forEach(function (tag) {
    tag.addEventListener("click", function () {
      tag_list.forEach(function (all_tag) {
        all_tag.classList.remove("active");
      });
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
