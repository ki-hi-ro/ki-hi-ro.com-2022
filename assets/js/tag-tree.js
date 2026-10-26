(function () {
  'use strict';
  document.querySelectorAll('.tag-tree-picker').forEach(function (picker) {
    var summary = picker.querySelector(':scope > summary');
    var selectedLabel = picker.querySelector('[data-selected-tag]');
    picker.addEventListener('change', function (event) {
      if (!event.target.matches('input[name="article_tag"]')) return;
      selectedLabel.textContent = event.target.dataset.tagLabel;
      picker.open = false;
      summary.focus();
    });
    picker.addEventListener('keydown', function (event) {
      if (event.key !== 'Escape') return;
      picker.open = false;
      summary.focus();
      event.preventDefault();
    });
    document.addEventListener('pointerdown', function (event) {
      if (!picker.contains(event.target)) picker.open = false;
    });
  });
}());
