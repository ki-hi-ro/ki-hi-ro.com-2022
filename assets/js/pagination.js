/* Keep the active page visible in the horizontally scrollable page list. */
document.querySelectorAll('.pagination .nav-links').forEach(function (list) {
  var current = list.querySelector('[aria-current="page"]');
  if (current && list.scrollWidth > list.clientWidth) {
    list.scrollLeft += current.getBoundingClientRect().left - list.getBoundingClientRect().left
      - (list.clientWidth - current.getBoundingClientRect().width) / 2;
  }
  list.addEventListener('focusin', function (event) {
    var item = event.target.getBoundingClientRect();
    var bounds = list.getBoundingClientRect();
    if (item.left < bounds.left) list.scrollLeft -= bounds.left - item.left + 8;
    if (item.right > bounds.right) list.scrollLeft += item.right - bounds.right + 8;
  });
});
