/* Load X only near the footer; keep a usable profile card if X is unavailable. */
(function () {
  'use strict';

  var feeds = document.querySelectorAll('[data-x-profile]');
  if (!feeds.length) return;

  var widgetsReady;
  function loadWidgets() {
    if (widgetsReady) return widgetsReady;
    widgetsReady = new Promise(function (resolve, reject) {
      if (window.twttr && window.twttr.widgets) {
        resolve(window.twttr);
        return;
      }
      var twitter = window.twttr = window.twttr || {};
      twitter._e = twitter._e || [];
      twitter.ready = twitter.ready || function (callback) { twitter._e.push(callback); };
      twitter.ready(resolve);
      var script = document.querySelector('script[src="https://platform.twitter.com/widgets.js"]');
      if (!script) {
        script = document.createElement('script');
        script.src = 'https://platform.twitter.com/widgets.js';
        script.async = true;
        script.addEventListener('error', reject, { once: true });
        document.head.appendChild(script);
      }
    });
    return widgetsReady;
  }

  function render(feed) {
    var timeline = feed.querySelector('.footer-social__x-timeline');
    var fallback = feed.querySelector('.footer-social__x-fallback');
    var status = feed.querySelector('.footer-social__x-status');
    var expired = false;
    status.textContent = 'Xの投稿を読み込んでいます…';

    function failed() {
      expired = true;
      timeline.hidden = true;
      fallback.hidden = false;
      status.textContent = '現在、Xの投稿を読み込めません。下の「Xですべて見る」からご覧ください。';
    }

    var timeout = window.setTimeout(failed, 12000);
    loadWidgets().then(function (twitter) {
      if (expired) return;
      return twitter.widgets.createTimeline(
        { sourceType: 'profile', screenName: feed.dataset.xProfile },
        timeline,
        { lang: 'ja', theme: 'light', height: 420, chrome: 'noheader nofooter noborders transparent', dnt: true }
      ).then(function (iframe) {
        window.clearTimeout(timeout);
        if (!iframe) {
          failed();
          return;
        }
        timeline.hidden = false;
        fallback.hidden = true;
      });
    }).catch(function () {
      window.clearTimeout(timeout);
      failed();
    });
  }

  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        observer.unobserve(entry.target);
        render(entry.target);
      });
    }, { rootMargin: '300px' });
    feeds.forEach(function (feed) { observer.observe(feed); });
  } else {
    feeds.forEach(render);
  }
}());
