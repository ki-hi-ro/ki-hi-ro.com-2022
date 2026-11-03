(function () {
    'use strict';
    var main = document.querySelector('.article-detail-layout');
    if (!main) return;
    var article = main.querySelector('.journal-panel--single');
    var title = main.querySelector('.article-detail-heading');
    var visual = main.querySelector('.article-main-visual');
    if (!title || !article) return;
    // Keep the full-width introduction above the article and contents columns.
    if (visual) main.insertBefore(visual, article);
    main.insertBefore(title, visual || article);
}());
