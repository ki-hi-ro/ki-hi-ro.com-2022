jQuery(function ($) {
  var $header = $("#header");
  var $nav_link = $(".header-nav-link");

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

  $nav_link.on('click', function () {
    var elmHash = $(this).attr("href");
    var pos = Math.round($(elmHash).offset().top - 200);
    $("body,html").animate({ scrollTop: pos }, 1000);
    return false;
  });
})