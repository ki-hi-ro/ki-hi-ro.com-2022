(function () {
    'use strict';
    var menu = document.querySelector('.journal-menu');
    if (!menu) return;
    var summary = menu.querySelector('summary');
    var hover = window.matchMedia('(hover: hover) and (pointer: fine)');
    var closeTimer;
    // マウスではホバー、タッチとキーボードではdetails標準の開閉を使う。
    menu.addEventListener('pointerenter', function () {
        clearTimeout(closeTimer);
        if (hover.matches) menu.open = true;
    });
    menu.addEventListener('pointerleave', function () {
        if (!hover.matches) return;
        closeTimer = setTimeout(function () {
            if (!menu.contains(document.activeElement)) menu.open = false;
        }, 150);
    });
    document.addEventListener('pointerdown', function (event) {
        if (!menu.contains(event.target)) menu.open = false;
    });
    menu.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            clearTimeout(closeTimer);
            menu.open = false;
            summary.focus();
        }
    });
    menu.addEventListener('focusout', function (event) {
        if (!menu.contains(event.relatedTarget)) menu.open = false;
    });
}());
