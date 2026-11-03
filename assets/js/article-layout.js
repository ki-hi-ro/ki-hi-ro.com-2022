(function () {
    'use strict';
    var main = document.querySelector('.article-detail-layout');
    if (!main) return;
    var article = main.querySelector('.journal-panel--single');
    var title = main.querySelector('.article-detail-heading');
    var visual = main.querySelector('.article-main-visual');
    var narrow = window.matchMedia('(max-width: 1099px)');
    function placeTitle() {
        if (!title || !article) return;
        if (narrow.matches) {
            if (visual) main.insertBefore(visual, article);
            main.insertBefore(title, visual || article);
        } else {
            article.insertBefore(title, article.firstChild);
            if (visual) article.insertBefore(visual, title.nextSibling);
        }
    }
    placeTitle();
    narrow.addEventListener('change', placeTitle);
}());
