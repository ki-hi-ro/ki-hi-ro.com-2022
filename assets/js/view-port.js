jQuery(function ($) {
  $(window).on("load", function () {
    var w = $(window).width();
    var meta_view = $("meta[name=viewport]");
    if (w <= 375) {
      meta_view.attr("content", "width=375");
    } else {
      meta_view.attr("content", "width=device-width");
    }
  });
});
