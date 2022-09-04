jQuery(function ($) {
    var open_triggar = $(".header__open-btn");
    var header_nav_sp = $(".header__nav-sp");

    open_triggar.on('click', function () {
        $(this).find('.header__open-btn-line').toggleClass('active');
        header_nav_sp.toggleClass('active');
    });

    $(".sp-nav a").on('click', function () {
        open_triggar.removeClass('active');
        header_nav_sp.removeClass('active');
    });
})