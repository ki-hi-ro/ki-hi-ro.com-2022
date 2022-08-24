const blogTabItem_skill = document.querySelectorAll(".blog-tab__item--skill");
const blogContents_skill = document.querySelectorAll(".blog-tab-content--skill");

window.addEventListener(
  "load",
  function () {
    addTabMotion(blogTabItem_skill, blogContents_skill);
  },
  false
);

var addTabMotion = function (blogTabItem_skill, blogContents_skill) {
  var tabs = blogTabItem_skill;
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].addEventListener(
      "click",
      function () {
        tabOptionAllHidden();
        tabAllHidden(blogContents_skill);
        var id = this.getAttribute("contentId");
        var content = document.getElementById(id);
        content.className = content.className.replace(/ notShowMe/g, "");
        this.classList.add("current-tab");
      },
      false
    );
  }
};

var tabAllHidden = function (blogContents_skill) {
  var contents = blogContents_skill;
  for (var i = 0; i < contents.length; i++) {
    contents[i].className = contents[i].className.replace(/ notShowMe/g, "");
    contents[i].className += " notShowMe";
  }
};

var tabOptionAllHidden = function () {
  var tabs = blogTabItem_skill;
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].classList.remove("current-tab");
  }
};