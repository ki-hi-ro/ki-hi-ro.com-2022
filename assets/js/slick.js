jQuery(".slick").slick({
  arrows: true,
});

jQuery(function ($) {
  var drink_comparison_record_slide =  ".single-article__drink-comparison-record-slide";

  /*--- 連動サムネイル（ドット）設定 -----------------------*/
  // スライダー初期化時
  $(drink_comparison_record_slide).on(
    "init",
    function (event, slick, currentSlide, nextSlide) {
      // スライドアイテム取得
      slideItem = $(`${drink_comparison_record_slide} .slick-slide`);
      // スライドの数だけループ
      for (var i = 0; i < slick.slideCount; i++) {
		  // ループ回数をキーにn番目のスライドを取得
		  var slideImg = slideItem
          .filter(function () {
			  return $(this).data("slick-index") === i;
			})
			.clone();
			console.log(slideImg);
			// n番目のドットを取得
			var dot = $(".thumbs_list").find("li").eq(i);
			// n番目のスライド画像のURLを取得
			var src = slideImg.attr("src");
        // n番目のドットにn番目のスライド画像を背景に当て込み
        dot.css("background", "url(".concat(src, ")"));
        // 背景の表示の仕方を指定
        dot.css("background-size", "cover");
      }
    }
  );

  $(drink_comparison_record_slide).slick({
    arrows: false, // 前・次のボタンを表示しない
    dots: true, // ドットナビゲーションを表示する
    dotsClass: "thumbs_list", // ドットのクラス名を変更
    appendDots: $(".thumbs_dots"), // ドットの生成位置を変更
    customPaging: function (slick, index) {
      // ドットの中身を空にする
      return "";
    },
    fade: true, // スライド切り替えをフェード
    autoplay: false, //自動再生させない
    slidesToShow: 1, // 表示させるスライド数
  });
});
