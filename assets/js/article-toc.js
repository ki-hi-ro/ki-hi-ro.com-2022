(function () {
    'use strict';

    var main = document.querySelector('.journal-app--single');
    var content = main && main.querySelector('.db-single__content');
    if (!content) return;
    var article = main.querySelector('.journal-panel--single');
    var title = main.querySelector('.article-detail-heading');
    var visual = main.querySelector('.article-main-visual');
    var narrow = window.matchMedia('(max-width: 1099px)');
    function placeTitle() {
        if (!title || !article) return;
        if (narrow.matches) main.insertBefore(title, visual || article);
        else article.insertBefore(title, article.firstChild);
    }
    placeTitle();
    narrow.addEventListener('change', placeTitle);
    // 表示中の本文だけを対象にし、既存の目次プラグインが作った見出しは除外する。
    // DB本文を更新せず、現在のブラウザーDOMへIDとナビゲーションを追加する。
    var headings = Array.from(content.querySelectorAll('h2, h3')).filter(function (heading) {
        return heading.textContent.trim() && !heading.closest('#ez-toc-container, .ez-toc-widget-container');
    });
    if (!headings.length) return;

    var aside = main.querySelector('.article-toc');
    if (!aside) return;
    var nav = document.createElement('nav');
    nav.setAttribute('aria-label', 'この記事の目次');
    var list = document.createElement('ul');
    var links = headings.map(function (heading, index) {
        if (!heading.id) {
            var id = 'article-section-' + (index + 1);
            while (document.getElementById(id)) id += '-heading';
            heading.id = id;
        }
        heading.classList.add('article-toc-target');
        var item = document.createElement('li');
        if (heading.tagName === 'H3') item.className = 'article-toc__subheading';
        var link = document.createElement('a');
        link.href = '#' + encodeURIComponent(heading.id);
        link.textContent = heading.textContent.trim();
        link.addEventListener('click', function (event) {
            // 通常の目次操作ではURLと履歴を変えず、見出しへの移動だけ行う。
            // 別タブで開く操作は通常のリンクとして扱う。
            if (event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
            event.preventDefault();
            heading.scrollIntoView({ block: 'start' });
            // Keep keyboard navigation at the destination after closing the menu.
            if (!heading.hasAttribute('tabindex')) heading.setAttribute('tabindex', '-1');
            heading.focus({ preventScroll: true });
        });
        item.appendChild(link);
        list.appendChild(item);
        return link;
    });
    nav.appendChild(list);
    aside.appendChild(nav);

    var queued = false;
    var activeIndex = -1;
    function updateCurrent() {
        queued = false;
        var current = 0;
        headings.forEach(function (heading, index) {
            if (heading.getBoundingClientRect().top <= 120) current = index;
        });
        if (current === activeIndex) return;
        activeIndex = current;
        links.forEach(function (link, index) {
            if (index === current) link.setAttribute('aria-current', 'location');
            else link.removeAttribute('aria-current');
        });
        var link = links[current];
        if (nav.clientHeight < nav.scrollHeight) {
            nav.scrollTop += link.getBoundingClientRect().top - nav.getBoundingClientRect().top - nav.clientHeight / 2 + link.offsetHeight / 2;
        }
    }
    function scheduleUpdate() {
        if (queued) return;
        queued = true;
        window.requestAnimationFrame(updateCurrent);
    }
    window.addEventListener('scroll', scheduleUpdate, { passive: true });
    window.addEventListener('resize', scheduleUpdate);
    window.addEventListener('load', scheduleUpdate);
    updateCurrent();
}());
