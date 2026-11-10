(function () {
    'use strict';
    var root = document.documentElement;
    var hero = document.querySelector('.work-hero[data-scene]');
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    var timer;
    // Palette anchors are interpolated over the actual 24-hour day, not sped up.
    var keys = ['top', 'middle', 'horizon', 'far', 'ridge', 'near', 'paper', 'panel', 'ink', 'muted', 'line', 'accent'];
    var night = ['#101c36','#202d4a','#263451','#536285','#304768','#1b3557','#edf1f8','#dce5f0','#23334d','#52627b','#c5d1e1','#4b648c'];
    var frames = [
        [0, night], [4, night],
        [5, ['#879fc8','#c5b9d1','#f5d4bf','#929bc2','#7f9fc7','#557ea9','#f3f1f5','#e7e5f0','#273347','#566078','#c6cbd9','#45678d']],
        [7, ['#c4e0fb','#f9e9ed','#fff4e8','#a0bce8','#95b9e2','#5499d4','#fcf9f7','#f0eff5','#263448','#596579','#d7dee8','#416b98']],
        [12, ['#9dcef5','#dcedfb','#edf8ff','#8eadd8','#729ecb','#398ac7','#f6faff','#e9f2fb','#23354b','#52667e','#cdddeb','#356a98']],
        [16, ['#b8d7ee','#e7e7f2','#fff1e5','#a5b2d6','#91a5cd','#678fbc','#fbf9f7','#eeedf5','#2c354a','#61677a','#d8d9e5','#596d96']],
        [18, ['#979ac5','#e9b5c7','#ffcfac','#9d92b9','#8e83b3','#626b9c','#fff6f0','#f3e6ed','#3f3048','#745e76','#e5cdd9','#855772']],
        [20, night], [24, night]
    ];
    function mix(a, b, t) {
        var ca = a.match(/[a-f\d]{2}/gi).map(function (v) { return parseInt(v, 16); });
        var cb = b.match(/[a-f\d]{2}/gi).map(function (v) { return parseInt(v, 16); });
        return '#' + ca.map(function (v, i) { return Math.round(v + (cb[i] - v) * t).toString(16).padStart(2, '0'); }).join('');
    }
    function luminance(hex) {
        var values = hex.match(/[a-f\d]{2}/gi).map(function (v) {
            var c = parseInt(v, 16) / 255;
            return c <= .04045 ? c / 12.92 : Math.pow((c + .055) / 1.055, 2.4);
        });
        return values[0] * .2126 + values[1] * .7152 + values[2] * .0722;
    }
    function contrast(a, b) {
        var x = luminance(a), y = luminance(b);
        return (Math.max(x, y) + .05) / (Math.min(x, y) + .05);
    }
    function updateSky() {
        var now = new Date();
        var hour = (now.getUTCHours() + 9) % 24 + now.getUTCMinutes() / 60 + now.getUTCSeconds() / 3600;
        var index = 0;
        while (index < frames.length - 2 && hour >= frames[index + 1][0]) index++;
        var from = frames[index], to = frames[index + 1];
        var t = (hour - from[0]) / (to[0] - from[0]);
        // Ease the joins to avoid abrupt changes in the rate of colour movement.
        t = t * t * (3 - 2 * t);
        var colors = keys.map(function (key, i) {
            var color = mix(from[1][i], to[1][i], t);
            root.style.setProperty('--sky-' + key, color);
            return color;
        });
        var lightInk = '#f6f7fc', darkInk = '#23334b';
        var lightScore = Math.min.apply(null, colors.slice(0, 3).map(function (color) { return contrast(color, lightInk); }));
        var darkScore = Math.min.apply(null, colors.slice(0, 3).map(function (color) { return contrast(color, darkInk); }));
        var useLight = lightScore > darkScore;
        var heroInk = useLight ? lightInk : darkInk;
        var veilColor = useLight ? '#101c36' : '#ffffff';
        var veil = 0;
        while (veil < .8 && Math.min.apply(null, colors.slice(0, 3).map(function (color) { return contrast(mix(color, veilColor, veil), heroInk); })) < 4.5) veil += .02;
        root.style.setProperty('--sky-hero-ink', heroInk);
        root.style.setProperty('--sky-button-ink', useLight ? darkInk : '#ffffff');
        root.style.setProperty('--sky-text-veil', (useLight ? 'rgba(16,28,54,' : 'rgba(255,255,255,') + veil.toFixed(2) + ')');
        var daylight = Math.max(0, Math.min(1, (hour - 5) / 14));
        var sunOpacity = Math.min(1, Math.max(0, (hour - 5) * 2), Math.max(0, (19 - hour) * 2));
        var darkness = hour < 5 ? 1 : hour < 7 ? (7 - hour) / 2 : hour < 18 ? 0 : Math.min(1, (hour - 18) / 2);
        root.style.setProperty('--sky-sun-opacity', sunOpacity.toFixed(4));
        root.style.setProperty('--sky-night-opacity', darkness.toFixed(4));
        root.setAttribute('data-sky', 'active');
        var cursorScene = hour >= 5 && hour < 19 ? 'sun' : 'moon';
        if (root.getAttribute('data-sky-cursor') !== cursorScene) root.setAttribute('data-sky-cursor', cursorScene);
        var scene = hour < 5 || hour >= 19 ? 'night' : hour < 10 ? 'dawn' : hour < 17 ? 'day' : 'dusk';
        if (root.getAttribute('data-sky-scene') !== scene) root.setAttribute('data-sky-scene', scene);
        if (hero) hero.setAttribute('data-scene', scene);
        {
            var nightProgress = ((hour + 5) % 24) / 10;
            document.querySelectorAll('.concept-landscape').forEach(function (svg) {
                var mobile = svg.classList.contains('concept-landscape--mobile');
                var width = mobile ? 900 : 1600;
                var sun = svg.querySelector('.concept-sun');
                var moon = svg.querySelector('.concept-moon');
                sun.setAttribute('cx', (width * (.62 + .32 * daylight)).toFixed(2));
                sun.setAttribute('cy', ((mobile ? 705 : 430) - Math.sin(Math.PI * daylight) * (mobile ? 180 : 235)).toFixed(2));
                moon.setAttribute('cx', (width * (.65 + .25 * Math.min(1, nightProgress))).toFixed(2));
                moon.setAttribute('cy', ((mobile ? 640 : 370) - Math.sin(Math.PI * Math.min(1, nightProgress)) * (mobile ? 130 : 170)).toFixed(2));
            });
        }
    }
    function start() {
        window.clearInterval(timer);
        updateSky();
        if (!document.hidden) timer = window.setInterval(updateSky, reduceMotion.matches ? 60000 : 1000);
    }
    document.addEventListener('visibilitychange', start);
    reduceMotion.addEventListener('change', start);
    start();
}());
