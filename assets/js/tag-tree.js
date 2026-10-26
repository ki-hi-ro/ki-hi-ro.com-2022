(function () {
  'use strict';
  document.querySelectorAll('.tag-tree-picker').forEach(function (picker) {
    var summary = picker.querySelector(':scope > summary');
    var selectedLabel = picker.querySelector('[data-selected-tag]');
    function fitPanel() {
      if (!picker.open) return;
      var bounds = summary.getBoundingClientRect();
      var below = window.innerHeight - bounds.bottom - 20;
      var above = bounds.top - 20;
      var useAbove = below < 240 && above > below;
      picker.dataset.side = useAbove ? 'above' : 'below';
      picker.style.setProperty('--tag-tree-max-height', Math.max(120, Math.min(520, useAbove ? above : below)) + 'px');
    }
    picker.addEventListener('toggle', fitPanel);
    window.addEventListener('resize', fitPanel);
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
