(function () {
    'use strict';
    var main = document.querySelector('.article-detail-layout');
    if (!main) return;
    var article = main.querySelector('.journal-panel--single');
    var title = main.querySelector('.article-detail-heading');
    var visual = main.querySelector('.article-main-visual');
    var actions = main.querySelector('.article-edit--actions');
    var narrow = window.matchMedia('(max-width: 1099px)');
    function placeTitle() {
        if (!title || !article) return;
        if (narrow.matches) {
            if (visual) main.insertBefore(visual, article);
            if (actions) main.insertBefore(actions, visual || article);
            main.insertBefore(title, actions || visual || article);
        } else {
            article.insertBefore(title, article.firstChild);
            if (actions) article.insertBefore(actions, title.nextSibling);
            if (visual) article.insertBefore(visual, actions ? actions.nextSibling : title.nextSibling);
        }
    }
    placeTitle();
    narrow.addEventListener('change', placeTitle);
}());
