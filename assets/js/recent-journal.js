(() => {
  const section = document.querySelector('.recent-journal');
  if (!section) return;
  const navigation = section.querySelector('.recent-journal__categories');
  const status = section.querySelector('[data-recent-journal-status]');
  let controller;
  let request = 0;

  navigation.addEventListener('click', async (event) => {
    const link = event.target.closest('a');
    if (!link || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
    event.preventDefault();
    const sequence = ++request;
    if (controller) controller.abort();
    // Selecting the current category also cancels any pending switch.
    if (link.hasAttribute('aria-current')) {
      section.removeAttribute('aria-busy');
      status.textContent = '';
      return;
    }
    controller = new AbortController();
    section.setAttribute('aria-busy', 'true');
    status.textContent = '記事を読み込んでいます。';
    try {
      const response = await fetch(link.href, { signal: controller.signal, credentials: 'same-origin' });
      if (!response.ok) throw new Error('Unable to load journal');
      const document = new DOMParser().parseFromString(await response.text(), 'text/html');
      const next = document.querySelector('.recent-journal');
      const grid = next?.querySelector('.recent-journal__grid');
      const more = next?.querySelector('.work-home__more');
      if (!grid || !more) throw new Error('Journal section missing');
      if (sequence !== request) return;
      const position = { left: window.scrollX, top: window.scrollY };
      section.querySelector('.recent-journal__grid').replaceWith(grid);
      section.querySelector('.work-home__more').replaceWith(more);
      navigation.querySelectorAll('a').forEach((item) => {
        if (item === link) item.setAttribute('aria-current', 'true');
        else item.removeAttribute('aria-current');
      });
      // Updating the URL without navigation avoids the fragment's scroll jump.
      history.replaceState(history.state, '', link.href);
      window.scrollTo({ ...position, behavior: 'instant' });
      status.textContent = `${link.textContent.trim()}の記事を表示しました。`;
    } catch (error) {
      if (error.name !== 'AbortError' && sequence === request) {
        status.textContent = '記事を読み込めませんでした。もう一度カテゴリーを選んでください。';
      }
    } finally {
      if (sequence === request) section.removeAttribute('aria-busy');
    }
  });
})();
