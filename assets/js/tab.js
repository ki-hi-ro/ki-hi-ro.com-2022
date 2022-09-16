const blogTabItem_skill = document.querySelectorAll(".blog-tab__item--skill");
const blogContents_skill = document.querySelectorAll(".blog-tab-content--skill");
const blogTabItem_study = document.querySelectorAll(".blog-tab__item--study");
const blogContents_study = document.querySelectorAll(".blog-tab-content--study");
const blogTabItem_random = document.querySelectorAll(".blog-tab__item--random");
const blogContents_random = document.querySelectorAll(".blog-tab-content--random");

const topBlogTag_skill = document.querySelectorAll(".top-skill-blog__tag-li");
const topBlogTagContent_skill = document.querySelectorAll(
  ".blog-list-scroll--skill"
);

window.addEventListener(
  "load",
  function () {
    addTabMotion(blogTabItem_skill, blogContents_skill);
    addTabMotion(blogTabItem_study, blogContents_study);
    addTabMotion(blogTabItem_random, blogContents_random);
  },
  false
);

var addTabMotion = function (tabItem, tabContents) {
  var tabs = tabItem;
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].addEventListener(
      "click",
      function () {
        tabOptionAllHidden(tabItem);
        tabAllHidden(tabContents);
        var id = this.getAttribute("contentId");
        var content = document.getElementById(id);
        content.className = content.className.replace(/ notShowMe/g, "");
        this.classList.add("current-tab");
      },
      false
    );
  }
};

var tabAllHidden = function (tabContents) {
  var contents = tabContents;
  for (var i = 0; i < contents.length; i++) {
    contents[i].className = contents[i].className.replace(/ notShowMe/g, "");
    contents[i].className += " notShowMe";
  }
};

var tabOptionAllHidden = function (tabItem) {
  var tabs = tabItem;
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].classList.remove("current-tab");
  }
};