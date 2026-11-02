(() => {
  const track = document.querySelector('#experience-slides');
  if (!track) return;
  const cards = [...track.children];
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)');
  const move = direction => {
    if (!cards.length) return;
    const gap = parseFloat(getComputedStyle(track).columnGap) || 0;
    track.scrollBy({left: direction * (cards[0].offsetWidth + gap), behavior: reduced.matches ? 'instant' : 'smooth'});
  };
  track.addEventListener('keydown', event => {
    if (event.target !== track || !['ArrowLeft', 'ArrowRight'].includes(event.key)) return;
    event.preventDefault();
    move(event.key === 'ArrowRight' ? 1 : -1);
  });
  // Links from articles and the homepage must still reveal the intended card.
  const revealHash = () => {
    const card = cards.find(item => '#' + item.id === window.location.hash);
    if (card) track.scrollTo({left: card.offsetLeft, behavior: 'instant'});
  };
  window.addEventListener('hashchange', revealHash);
  window.addEventListener('load', revealHash, {once: true});
  revealHash();
})();
