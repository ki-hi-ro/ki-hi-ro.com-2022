window.addEventListener(
  "load",
  function () {
    addTabMotion();
  },
  false
);

var addTabMotion = function () {
  var tabs = document.querySelectorAll(".blog-tab__item");
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].addEventListener(
      "click",
      function () {
        tabOptionAllHidden();
        tabAllHidden();
        var id = this.getAttribute("contentId");
        var content = document.getElementById(id);
        content.className = content.className.replace(/ notShowMe/g, "");
        this.classList.add("current-tab");
      },
      false
    );
  }
};

var tabAllHidden = function () {
  var contents = document.querySelectorAll(".blog-tab-content");
  for (var i = 0; i < contents.length; i++) {
    contents[i].className += " notShowMea";
  }
};

var tabOptionAllHidden = function () {
  var tabs = document.querySelectorAll(".blog-tab__item");
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].classList.remove("current-tab");
  }
};