(() => {
  const timeline = document.querySelector('.post-timeline[data-show-current]');
  const viewport = timeline?.querySelector('.post-timeline__scroll');
  const current = timeline?.querySelector('.post-timeline__item.is-current');
  if (!viewport || !current) return;

  const alignCurrent = () => {
    viewport.style.maxHeight = '';
    const top = current.getBoundingClientRect().top - viewport.getBoundingClientRect().top + viewport.scrollTop;
    // ページ末尾では残りの記事に合わせて高さを縮め、空白を作らず先頭に揃える。
    viewport.style.maxHeight = `${Math.min(viewport.clientHeight, viewport.scrollHeight - top)}px`;
    viewport.scrollTop = top;
  };
  alignCurrent();
  document.fonts?.ready.then(alignCurrent);
})();
