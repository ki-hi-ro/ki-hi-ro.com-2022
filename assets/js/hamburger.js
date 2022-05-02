jQuery(function ($) {
    $(".openbtn1").click(function () {
    $(this).toggleClass('active');
        $(".sp-nav").toggleClass('panelactive');
    });

    $(".sp-nav a").click(function () {
        $(".openbtn1").removeClass('active');
        $(".sp-nav").removeClass('panelactive');
    });
})