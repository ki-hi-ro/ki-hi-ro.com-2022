(() => {
  const timeline = document.querySelector('.post-timeline[data-show-current]');
  const viewport = timeline?.querySelector('.post-timeline__scroll');
  const current = timeline?.querySelector('.post-timeline__item.is-current');
  if (!viewport || !current) return;

  const alignCurrent = () => {
    const list = viewport.querySelector('.post-timeline__list');
    list.style.paddingBottom = '0px';
    const top = current.getBoundingClientRect().top - viewport.getBoundingClientRect().top + viewport.scrollTop;
    // ページ末尾の記事でも先頭に置けるだけの余白を確保する。
    list.style.paddingBottom = `${Math.max(0, top + viewport.clientHeight - viewport.scrollHeight)}px`;
    viewport.scrollTop = top;
  };
  alignCurrent();
  document.fonts?.ready.then(alignCurrent);
})();
