(() => {
  const button = document.querySelector('.floating-page-top');
  if (!button) return;
  const arrow = button.querySelector('span');
  const update = () => {
    const maximum = Math.max(0, document.documentElement.scrollHeight - window.innerHeight);
    const goDown = maximum > 0 && window.scrollY < maximum / 2;
    button.href = goDown ? '#page-bottom' : '#page-top';
    button.setAttribute('aria-label', goDown ? 'ページの最後へ移動' : 'ページの先頭へ戻る');
    arrow.textContent = goDown ? '↓' : '↑';
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
