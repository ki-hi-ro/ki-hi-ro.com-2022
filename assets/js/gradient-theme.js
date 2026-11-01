/** Motion enhances the page; content stays visible without JavaScript. */
(() => {
  const preference = window.matchMedia('(prefers-reduced-motion: reduce)');
  let observer;
  const animations = new Set();
  const animate = (element, delay = 0) => {
    const animation = element.animate([
      { opacity: .35, transform: 'translateY(24px)' },
      { opacity: 1, transform: 'translateY(0)' }
    ], { duration: 1000, delay, easing: 'cubic-bezier(.2,.65,.3,1)' });
    animations.add(animation);
    animation.finished.then(() => animations.delete(animation)).catch(() => {});
  };
  const setup = () => {
    observer?.disconnect();
    animations.forEach(animation => animation.cancel());
    animations.clear();
    if (preference.matches || !('IntersectionObserver' in window) || !Element.prototype.animate) return;
    observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        animate(entry.target, 120);
        observer.unobserve(entry.target);
      });
    }, { threshold: .08, rootMargin: '0px 0px -80px 0px' });
    document.querySelectorAll('.work-home__heading, .work-profile, .work-project, .work-help-article, .recent-journal__card, .work-home-contact, .discovery-section-heading, .services-page__header, .case-hero, .story-hero').forEach(element => observer.observe(element));
  };
  setup();
  preference.addEventListener('change', setup);
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
