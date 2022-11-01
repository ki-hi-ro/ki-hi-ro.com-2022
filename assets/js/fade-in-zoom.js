//画像の設定

var windowwidth =
  window.innerWidth || document.documentElement.clientWidth || 0;
var responsiveImage = [
  //PC用の画像
  {
    src: "https://ki-hi-ro.com/ki-hi-ro.com-2022/wp-content/themes/ki-hi-ro.com-2022/assets/img/fade-in-zoom/dainagoya.jpg",
  },
  {
    src: "https://ki-hi-ro.com/ki-hi-ro.com-2022/wp-content/themes/ki-hi-ro.com-2022/assets/img/fade-in-zoom/midland.jpg",
  },
];

//Vegas全体の設定

jQuery("#slider").vegas({
  overlay: true,
  transition: "fade",
  transitionDuration: 3000,
  delay: 5000,
  animationDuration: 60000,
  animation: "kenburns",
  slides: responsiveImage,
  timer: false,
  shuffle: true,
});

// 動きのきっかけとなるアニメーションの名前を定義
function fadeAnime($trigger) {
  //ふわっと動くきっかけのクラス名と動きのクラス名の設定
  jQuery($trigger).each(function () {
    //fadeInUpTriggerというクラス名が
    var elemPos = jQuery(this).offset().top; //要素より、50px上の
    var scroll = jQuery(window).scrollTop();
    var windowHeight = jQuery(window).height();
    if (scroll >= elemPos - windowHeight) {
      jQuery(this).addClass("--fadeIn"); // 画面内に入ったらfadeInというクラス名を追記
    } else {
      jQuery(this).removeClass("--fadeIn"); // 画面外に出たらfadeInというクラス名を外す
    }
  });
} //ここまでふわっと動くきっかけのクラス名と動きのクラス名の設定

// 画面をスクロールをしたら動かしたい場合の記述
jQuery(window).scroll(function () {
  fadeAnime(".--fadeInTrigger"); /* アニメーション用の関数を呼ぶ*/
  fadeAnime(".--fadeInTrigger-sp"); /* アニメーション用の関数を呼ぶ*/
}); // ここまで画面をスクロールをしたら動かしたい場合の記述
