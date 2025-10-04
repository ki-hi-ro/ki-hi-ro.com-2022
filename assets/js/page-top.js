var page_top = jQuery(".page-top");
var page_top_link = jQuery(".page-top__link.--not-single-sp");
var page_top_link_single = jQuery(".single .page-top__link");

function PageTopAnime() {
  var scroll = jQuery(window).scrollTop();
  var windowHeight = jQuery(window).height();
  var docHeight = jQuery(document).height();
  var halfScroll = (docHeight - windowHeight) / 2;

  if (scroll < halfScroll) {
    // 上半分にいるとき → 矢印を↓に
    page_top_link.text("↓");
    page_top_link_single.text("↓");
    page_top_link.data("mode", "bottom");
    page_top_link_single.data("mode", "bottom");
  } else {
    // 下半分にいるとき → 矢印を↑に
    page_top_link.text("↑");
    page_top_link_single.text("↑");
    page_top_link.data("mode", "top");
    page_top_link_single.data("mode", "top");
  }
}

jQuery(window).scroll(function () {
  PageTopAnime();
});

function click_motion($triggar) {
  $triggar.click(function () {
    var mode = $triggar.data("mode");
    if (mode === "bottom") {
      // 一番下へ移動
      var docHeight = jQuery(document).height();
      jQuery("body,html").animate({ scrollTop: docHeight }, 500);
    } else {
      // 一番上へ移動
      jQuery("body,html").animate({ scrollTop: 0 }, 500);
    }
    return false;
  });
}
click_motion(page_top_link);
click_motion(page_top_link_single);

// 初期表示時にも矢印を設定
PageTopAnime();