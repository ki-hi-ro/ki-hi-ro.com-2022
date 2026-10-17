/* Keep the active page visible in the horizontally scrollable page list. */
document.querySelectorAll('.pagination .nav-links').forEach(function (list) {
  // 現在ページを中央付近へ寄せる。ページ全体ではなく番号リストだけをスクロールする。
  var current = list.querySelector('[aria-current="page"]');
  if (current && list.scrollWidth > list.clientWidth) {
    list.scrollLeft += current.getBoundingClientRect().left - list.getBoundingClientRect().left
      - (list.clientWidth - current.getBoundingClientRect().width) / 2;
  }
  // Tab移動で画面外の番号にフォーカスした場合も、選択対象を見える位置へ戻す。
  list.addEventListener('focusin', function (event) {
    var item = event.target.getBoundingClientRect();
    var bounds = list.getBoundingClientRect();
    if (item.left < bounds.left) list.scrollLeft -= bounds.left - item.left + 8;
    if (item.right > bounds.right) list.scrollLeft += item.right - bounds.right + 8;
  });
});
