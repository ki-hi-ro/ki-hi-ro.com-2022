const blogTabItem = document.querySelectorAll(".blog-tab__item");
const blogContents = document.querySelectorAll(".blog-tab-content");

window.addEventListener(
  "load",
  function () {
    addTabMotion(blogTabItem);
  },
  false
);

var addTabMotion = function (blogTabItem) {
  var tabs = blogTabItem;
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].addEventListener(
      "click",
      function () {
        tabOptionAllHidden();
        tabAllHidden(blogContents);
        var id = this.getAttribute("contentId");
        var content = document.getElementById(id);
        content.className = content.className.replace(/ notShowMe/g, "");
        this.classList.add("current-tab");
      },
      false
    );
  }
};

var tabAllHidden = function (blogContents) {
  var contents = blogContents;
  for (var i = 0; i < contents.length; i++) {
    contents[i].className = contents[i].className.replace(/ notShowMe/g, "");
    contents[i].className += " notShowMe";
  }
};

var tabOptionAllHidden = function () {
  var tabs = blogTabItem;
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].classList.remove("current-tab");
  }
};