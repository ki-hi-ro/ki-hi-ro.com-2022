(function () {
    'use strict';
    var hero = document.querySelector('.work-hero[data-scene]');
    if (!hero) return;
    function updateScene() {
        // Japan Standard Time is UTC+9, regardless of the visitor's timezone.
        var hour = (new Date().getUTCHours() + 9) % 24;
        var scene = hour < 5 || hour >= 19 ? 'night' : hour < 10 ? 'dawn' : hour < 17 ? 'day' : 'dusk';
        if (hero.getAttribute('data-scene') !== scene) hero.setAttribute('data-scene', scene);
    }
    updateScene();
    window.setInterval(updateScene, 60000);
    document.addEventListener('visibilitychange', function () {
        if (!document.hidden) updateScene();
    });
}());
