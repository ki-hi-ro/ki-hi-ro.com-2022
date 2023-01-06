var page_top = jQuery(".page-top");
var class_down = "--down-move";
var class_up = "--up-move";
var page_top_link = jQuery(".page-top__link.--not-single-sp");
var page_top_link_single = jQuery(".single .page-top__link");

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

function click_motion($triggar) {
  $triggar.click(function () {
    if($triggar == page_top_link_single) {
      var $toc = jQuery("#ez-toc-container").offset().top;
      jQuery("body,html").animate({ scrollTop: $toc - 70 }, 500);
    } else {
      jQuery("body,html").animate({ scrollTop: 0 }, 500);
    }
    return false;
  });
}
click_motion(page_top_link);
click_motion(page_top_link_single);
