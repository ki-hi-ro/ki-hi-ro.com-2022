(() => {
  const track = document.querySelector('#experience-slides');
  if (!track) return;
  const section = track.closest('.work-experiences');
  const controls = section.querySelector('.work-experiences__controls');
  const previous = controls.querySelector('[data-experience-prev]');
  const next = controls.querySelector('[data-experience-next]');
  const label = controls.querySelector('[data-experience-position]');
  const cards = [...track.children];
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)');
  const update = () => {
    const maximum = track.scrollWidth - track.clientWidth;
    controls.hidden = maximum <= 2;
    previous.disabled = track.scrollLeft <= 2;
    next.disabled = track.scrollLeft >= maximum - 2;
    const shown = cards.map((card, index) => ({card, index})).filter(({card}) => card.offsetLeft + card.offsetWidth > track.scrollLeft + 2 && card.offsetLeft < track.scrollLeft + track.clientWidth - 2);
    label.textContent = shown.length ? `${shown[0].index + 1}–${shown[shown.length - 1].index + 1} / ${cards.length}` : '';
  };
  const move = direction => {
    if (!cards.length) return;
    const gap = parseFloat(getComputedStyle(track).columnGap) || 0;
    track.scrollBy({left: direction * (cards[0].offsetWidth + gap), behavior: reduced.matches ? 'instant' : 'smooth'});
  };
  previous.addEventListener('click', () => move(-1));
  next.addEventListener('click', () => move(1));
  track.addEventListener('scroll', update, {passive: true});
  track.addEventListener('keydown', event => {
    if (event.target !== track || !['ArrowLeft', 'ArrowRight'].includes(event.key)) return;
    event.preventDefault();
    move(event.key === 'ArrowRight' ? 1 : -1);
  });
  // Links from articles and the homepage must still reveal the intended card.
  const revealHash = () => {
    const card = cards.find(item => '#' + item.id === window.location.hash);
    if (card) track.scrollTo({left: card.offsetLeft, behavior: 'instant'});
    update();
  };
  window.addEventListener('hashchange', revealHash);
  window.addEventListener('load', revealHash, {once: true});
  window.addEventListener('resize', update);
  if ('ResizeObserver' in window) new ResizeObserver(update).observe(track);
  revealHash();
})();
