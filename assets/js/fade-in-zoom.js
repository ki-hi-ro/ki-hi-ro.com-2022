//画像の設定

var windowwidth =
  window.innerWidth || document.documentElement.clientWidth || 0;
if (windowwidth > 768) {
  var responsiveImage = [
    //PC用の画像
    { src: "https://ki-hi-ro.com/ki-hi-ro.com-2022/wp-content/themes/ki-hi-ro.com-2022/assets/img/fade-in-zoom/dainagoya.jpg" },
    { src: "https://ki-hi-ro.com/ki-hi-ro.com-2022/wp-content/themes/ki-hi-ro.com-2022/assets/img/fade-in-zoom/midland.jpg" }    
  ];
// } else {
//   var responsiveImage = [
//     //タブレットサイズ（768px）以下用の画像
//     { src: "./img/img_sp_01.jpg" },
//     { src: "./img/img_sp_02.jpg" },
//     { src: "./img/img_sp_03.jpg" },
//   ];
}

//Vegas全体の設定

jQuery("#slider").vegas({
  overlay: false, 
  transition: "fade", 
  transitionDuration: 3000, 
  delay: 5000,
  animationDuration: 60000,
  animation: "kenburns", 
  slides: responsiveImage, 
  timer:false,
  shuffle:true,
});
