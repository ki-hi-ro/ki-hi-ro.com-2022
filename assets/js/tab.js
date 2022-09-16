const blogTabItem_skill = document.querySelectorAll(".blog-tab__item--skill");
const blogContents_skill = document.querySelectorAll(".blog-tab-content--skill");
const blogTabItem_study = document.querySelectorAll(".blog-tab__item--study");
const blogContents_study = document.querySelectorAll(".blog-tab-content--study");
const blogTabItem_random = document.querySelectorAll(".blog-tab__item--random");
const blogContents_random = document.querySelectorAll(".blog-tab-content--random");

const topBlogTag_skill = document.querySelectorAll(".top-skill-blog__tag-li");
const topBlogTagContent_skill = document.querySelectorAll(".blog-list-scroll__link");

window.addEventListener(
  "load",
  function () {
    addTabMotion(blogTabItem_skill, blogContents_skill);
    addTabMotion(blogTabItem_study, blogContents_study);
    addTabMotion(blogTabItem_random, blogContents_random);
    addTabMotion(topBlogTag_skill, topBlogTagContent_skill);
  },
  false
);

var addTabMotion = function (tabItem, tabContents) {
  var tabs = tabItem;
  defaultShow(tabContents);
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].addEventListener(
      "click",
      function () {
        tabOptionAllHidden(tabItem);
        defaultShow(tabContents);
        var include = this.getAttribute("contentId");
        var content = document.getElementsByClassName(include);
        // content.className = content.className.replace(/ notShowMe/g, "");
        // this.classList.add("current-tab");
      },
      false
    );
  }
};

var defaultShow = function (tabContents) {
  var contents = tabContents;
  for (var i = 0; i < contents.length; i++) {
    contents[i].className = contents[i].className.replace(/ notShowMe/g, "");
    contents[i].className += " notShowMe";
  }
  const default_show = document.getElementsByClassName("html-css");
  // content.className = content.className.replace(/ notShowMe/g, "");
  default_show.classList.remove("notShowMe");
};

var tabOptionAllHidden = function (tabItem) {
  var tabs = tabItem;
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].classList.remove("current-tab");
  }
};