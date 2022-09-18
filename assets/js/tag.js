const whatidid_tag = document.querySelectorAll(".top-what-i-did__tag-li");
const whatidid_article = document.querySelectorAll(
  ".blog-list-scroll__link--what-i-did"
);
const skill_tag = document.querySelectorAll(".top-skill-blog__tag-li");
const skill_article = document.querySelectorAll(
  ".blog-list-scroll__link--skill-blog"
);
const study_tag = document.querySelectorAll(".top-study-blog__tag-li");
const study_article = document.querySelectorAll(
  ".blog-list-scroll__link--study-blog"
);
const random_tag = document.querySelectorAll(".top-random-blog__tag-li");
const random_article = document.querySelectorAll(
  ".blog-list-scroll__link--random-blog"
);

tag_motion(whatidid_tag, whatidid_article);
tag_motion(skill_tag, skill_article);
tag_motion(study_tag, study_article);
tag_motion(random_tag, random_article);

function tag_motion(tag_list, article_list) {
  tag_list.forEach(function (tag) {
    tag.addEventListener("click", function () {
      tag_all_reset(tag_list);
      tag.classList.add("active");
      tagslug = tag.getAttribute("tagslug");
      article_list.forEach(function (article) {
        article.classList.remove("notShowMe");
        if (!article.classList.contains(tagslug)) {
          article.classList.add("notShowMe");
        }
      });
    });
  });
}

function tag_all_reset(tag_list) {
  tag_list.forEach(function (tag) {
    tag.classList.remove("active");
  });
}
