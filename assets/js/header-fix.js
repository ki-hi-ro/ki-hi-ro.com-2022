jQuery(function ($) {
  var $header = $("#header");

  function FixedAnime() {
    var headerH = $header.outerHeight(true);
    var scroll = $(window).scrollTop();
    if (scroll >= headerH) {
      $header.addClass("fixed");
    } else {
      $header.removeClass("fixed");
    }
  }

  $(window).on('scroll', function () {
    FixedAnime();
  });
})