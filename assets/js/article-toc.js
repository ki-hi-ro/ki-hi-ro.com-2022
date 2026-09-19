(function () {
    'use strict';

    var main = document.querySelector('.journal-app--single');
    var content = main && main.querySelector('.db-single__content');
    if (!content) return;
    var headings = Array.from(content.querySelectorAll('h2, h3')).filter(function (heading) {
        return heading.textContent.trim() && !heading.closest('#ez-toc-container, .ez-toc-widget-container');
    });
    if (!headings.length) return;

    var aside = document.createElement('aside');
    aside.className = 'article-toc';
    var details = document.createElement('details');
    var summary = document.createElement('summary');
    summary.textContent = '目次';
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
        link.addEventListener('click', function () {
            if (!desktop.matches) details.open = false;
            // Keep keyboard navigation at the destination after closing the menu.
            if (!heading.hasAttribute('tabindex')) heading.setAttribute('tabindex', '-1');
            heading.focus({ preventScroll: true });
        });
        item.appendChild(link);
        list.appendChild(item);
        return link;
    });
    nav.appendChild(list);
    details.append(summary, nav);
    aside.appendChild(details);
    main.appendChild(aside);
    main.classList.add('has-article-toc');

    var desktop = window.matchMedia('(min-width: 1100px)');
    function syncLayout() { details.open = desktop.matches; }
    syncLayout();
    desktop.addEventListener('change', syncLayout);
    details.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !desktop.matches) {
            details.open = false;
            summary.focus();
        }
    });

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
        if (details.open) {
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
