jQuery(function ($) {
  var headerH = $("#header").outerHeight(true);

  function FixedAnime() {
    var scroll = $(window).scrollTop();
    if (scroll >= headerH) {
      $("#header").addClass("HeightMin");
    } else {
      $("#header").removeClass("HeightMin");
    }
  }

  $(window).scroll(function () {
    FixedAnime();
  });
});
