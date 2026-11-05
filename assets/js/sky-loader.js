(function () {
    'use strict';
    var loader = document.querySelector('.sky-loader');
    if (!loader || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    var started = performance.now();
    var finished = false;
    loader.classList.add('sky-loader--visible');
    function finish() {
        if (finished) return;
        finished = true;
        window.setTimeout(function () {
            loader.classList.remove('sky-loader--visible');
            window.setTimeout(function () { loader.remove(); }, 300);
        }, Math.max(0, 3000 - (performance.now() - started)));
    }
    if (document.readyState === 'complete') finish();
    else window.addEventListener('load', finish, { once: true });
    window.setTimeout(finish, 3000);
    window.addEventListener('pageshow', function (event) {
        if (event.persisted) loader.remove();
    });
}());
