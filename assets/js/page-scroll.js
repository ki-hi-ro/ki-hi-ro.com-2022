(() => {
  const button = document.querySelector('.floating-page-top');
  if (!button) return;
  const arrow = button.querySelector('span');
  const footerTop = document.querySelector('.site-footer__top');
  // 上半分では最下部へ、下半分では最上部へ。同じボタンの役割とラベルを同期する。
  const update = () => {
    const maximum = Math.max(0, document.documentElement.scrollHeight - window.innerHeight);
    const goDown = maximum > 0 && window.scrollY < maximum / 2;
    button.href = goDown ? '#page-bottom' : '#page-top';
    button.setAttribute('aria-label', goDown ? 'ページの最後へ移動' : 'ページの先頭へ戻る');
    arrow.textContent = goDown ? '↓' : '↑';
    // フッターが画面に入ったら、両方の矢印の中心を同じ高さにする。
    if (footerTop) {
      const bounds = footerTop.getBoundingClientRect();
      const center = bounds.top + bounds.height / 2;
      if (bounds.top >= 0 && bounds.bottom <= window.innerHeight) {
        button.style.bottom = `${Math.max(12, window.innerHeight - center - button.offsetHeight / 2)}px`;
      } else {
        button.style.removeProperty('bottom');
      }
    }
  };
  button.addEventListener('click', (event) => {
    event.preventDefault();
    window.scrollTo({
      top: button.getAttribute('href') === '#page-bottom' ? document.documentElement.scrollHeight : 0,
      behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'instant' : 'smooth',
    });
  });
  window.addEventListener('scroll', update, { passive: true });
  window.addEventListener('resize', update);
  window.addEventListener('load', update);
  update();
})();
