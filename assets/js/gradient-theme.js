/** Show reading progress without animating page content. */
(() => {
  // Scroll progress uses one frame per update and no layout-changing properties.
  const progress = document.createElement('div');
  progress.className = 'site-reading-progress';
  progress.setAttribute('aria-hidden', 'true');
  document.body.append(progress);
  let queued = false;
  const update = () => {
    const distance = document.documentElement.scrollHeight - window.innerHeight;
    progress.style.transform = `scaleX(${distance > 0 ? Math.min(1, Math.max(0, window.scrollY / distance)) : 0})`;
    queued = false;
  };
  const schedule = () => {
    if (queued) return;
    queued = true;
    requestAnimationFrame(update);
  };
  window.addEventListener('scroll', schedule, { passive: true });
  window.addEventListener('resize', schedule);
  window.addEventListener('load', schedule, { once: true });
  if ('ResizeObserver' in window) new ResizeObserver(schedule).observe(document.body);
  update();
})();
