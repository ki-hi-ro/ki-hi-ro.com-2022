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
