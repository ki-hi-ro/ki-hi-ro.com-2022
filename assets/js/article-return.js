(() => {
  'use strict';

  const backLink = document.querySelector('.db-back-link a, .case-detail .case-link');
  const parameter = 'return_to';

  const localUrl = (value) => {
    if (!value) return null;
    try {
      const url = new URL(value, window.location.href);
      return url.origin === window.location.origin && /^https?:$/.test(url.protocol) ? url : null;
    } catch (_) {
      return null;
    }
  };

  // Store the list URL in the article link so filters, pagination and new tabs work.
  const listLinks = document.querySelectorAll(
    '.technical-articles .case-card a, .case-index .case-card a, ' +
    '.magazine-card__link, .article-timeline__year li a'
  );
  const listUrl = new URL(window.location.href);
  listUrl.searchParams.delete(parameter);
  listLinks.forEach((link) => {
    const target = localUrl(link.getAttribute('href'));
    if (!target) return;
    target.searchParams.set(parameter, listUrl.href);
    link.href = target.href;
  });

  if (!backLink) return;
  const returnUrl = localUrl(new URL(window.location.href).searchParams.get(parameter));
  if (!returnUrl) return; // Direct visits keep the existing default list link.
  backLink.href = returnUrl.href;
  backLink.addEventListener('click', (event) => {
    if (event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
    if (document.referrer === returnUrl.href && window.history.length > 1) {
      event.preventDefault();
      window.history.back();
    }
  });

  // Keep the original list when browsing related, previous or next articles.
  document.querySelectorAll('.article-navigation a, .related-posts a').forEach((link) => {
    const target = localUrl(link.getAttribute('href'));
    if (!target) return;
    target.searchParams.set(parameter, returnUrl.href);
    link.href = target.href;
  });
})();
