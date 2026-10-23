(function () {
    'use strict';

    // 公開パネルと公開完了通知は後から描画されるため、追加時にも確認する。
    function syncViewLinks() {
        document.querySelectorAll('.post-publish-panel__postpublish a[target="_blank"], .components-snackbar a[target="_blank"]').forEach(function (link) {
            var url = new URL(link.href, window.location.href);
            if (url.origin !== window.location.origin || url.pathname.indexOf('/wp-admin/') !== -1) return;
            link.removeAttribute('target');
            // 同じタブで開くので、外部リンクのアイコンと別タブの説明も取り除く。
            link.querySelectorAll('svg, .components-visually-hidden').forEach(function (node) { node.remove(); });
        });
    }

    function init() {
        syncViewLinks();
        new MutationObserver(syncViewLinks).observe(document.body, { childList: true, subtree: true, attributes: true, attributeFilter: ['target'] });
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
    else init();
}());
