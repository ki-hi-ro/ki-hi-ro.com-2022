/* Keep the horizontal category position when following a category link. */
(() => {
  document.querySelectorAll('.article-filters__categories').forEach((list) => {
    // 一覧ごとに保存先を分け、記事カテゴリーと開発事例の位置を混ぜない。
    const key = 'kihiro-category-scroll:' + window.location.pathname;
    const current = list.querySelector('[aria-current]');
    let saved = null;
    try { saved = JSON.parse(sessionStorage.getItem(key)); } catch (_) { /* Storage is optional. */ }
    if (saved && saved.url === window.location.href && Number.isFinite(saved.left)) {
      list.scrollLeft = saved.left;
    }
    // 直接URLを開いたときも、選択中のカテゴリーが隠れたままにならないようにする。
    if (current && list.scrollWidth > list.clientWidth) {
      const item = current.getBoundingClientRect();
      const bounds = list.getBoundingClientRect();
      if (item.left < bounds.left) list.scrollLeft -= bounds.left - item.left;
      if (item.right > bounds.right) list.scrollLeft += item.right - bounds.right;
    }
    list.addEventListener('click', (event) => {
      const link = event.target.closest('a');
      if (!link || !list.contains(link)) return;
      try {
        sessionStorage.setItem(key, JSON.stringify({ url: link.href, left: list.scrollLeft }));
      } catch (_) { /* Navigation still works when storage is unavailable. */ }
    });
  });
})();
