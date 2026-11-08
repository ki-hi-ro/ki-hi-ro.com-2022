(function () {
    'use strict';
    var header = document.querySelector('.site-header');
    if (!header) return;
    document.querySelectorAll('a[href="#page-top"]').forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            header.classList.remove('site-header--scroll-hidden');
            window.scrollTo({
                top: 0,
                behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'instant' : 'smooth'
            });
        });
    });
    if (document.querySelector('.article-detail-layout')) return;
    var previous = Math.max(0, window.scrollY);
    var scheduled = false;
    header.classList.add('site-header--scroll-aware');
    function update() {
        scheduled = false;
        var current = Math.max(0, window.scrollY);
        if (current <= header.offsetHeight || header.classList.contains('site-header--menu-open') || header.contains(document.activeElement)) {
            header.classList.remove('site-header--scroll-hidden');
            previous = current;
        } else if (Math.abs(current - previous) >= 8) {
            header.classList.toggle('site-header--scroll-hidden', current > previous);
            previous = current;
        }
    }
    window.addEventListener('scroll', function () {
        if (!scheduled) { scheduled = true; window.requestAnimationFrame(update); }
    }, { passive: true });
    header.addEventListener('focusin', function () { header.classList.remove('site-header--scroll-hidden'); });
    window.addEventListener('pageshow', update);
    update();
}());
