var page_top = jQuery(".page-top");
var class_down = "--down-move";
var class_up = "--up-move";
var page_top_link = jQuery(".page-top__link");

function PageTopAnime() {
  var scroll = jQuery(window).scrollTop();
  if (scroll >= 200) {
    page_top.removeClass(class_down);
    page_top.addClass(class_up);
  } else {
    if (page_top.hasClass(class_up)) {
      page_top.removeClass(class_up);
      page_top.addClass(class_down);
    }
  }
}

jQuery(window).scroll(function () {
  PageTopAnime();
});

var $toc = jQuery("#ez-toc-container").offset().top;

page_top_link.click(function () {
  jQuery("body,html").animate({ scrollTop: $toc - 70 }, 500);
  return false;
});