const blogTabItem_skill = document.querySelectorAll(".blog-tab__item--skill");
const blogContents_skill = document.querySelectorAll(".blog-tab-content--skill");
const blogTabItem_study = document.querySelectorAll(".blog-tab__item--study");
const blogContents_study = document.querySelectorAll(".blog-tab-content--study");

window.addEventListener(
  "load",
  function () {
    addTabMotion(blogTabItem_skill, blogContents_skill);
    addTabMotion(blogTabItem_study, blogContents_study);
  },
  false
);

var addTabMotion = function (tabItem, tabContents) {
  var tabs = tabItem;
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].addEventListener(
      "click",
      function () {
        tabOptionAllHidden();
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