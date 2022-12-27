jQuery(function ($) {
    var open_triggar = $(".header__hamburger");
    var header_nav_sp = $(".header__ul");

    open_triggar.on('click', function () {
        $(this).toggleClass('active');
        header_nav_sp.toggleClass('active');
        $("body").toggleClass('fixed');
    });

    $(".sp-nav a").on('click', function () {
        open_triggar.removeClass('active');
        header_nav_sp.removeClass('active');
    });
})