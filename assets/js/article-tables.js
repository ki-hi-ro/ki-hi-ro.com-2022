(() => {
  document.querySelectorAll('.db-single__content table').forEach(table => {
    let container = table.closest('.wp-block-table, .article-table-scroll');
    if (!container) {
      container = document.createElement('div');
      container.className = 'article-table-scroll';
      table.before(container);
      container.append(table);
    }
    container.tabIndex = 0;
    container.setAttribute('role', 'region');
    container.setAttribute('aria-label', '表（横にスクロールできます）');
  });
})();
