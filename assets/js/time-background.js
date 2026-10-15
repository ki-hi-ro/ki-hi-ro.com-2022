(function () {
  'use strict';

  function updateBackground() {
    var hour = new Date().getHours();
    var period = 'night';

    if (hour >= 5 && hour < 11) {
      period = 'morning';
    } else if (hour >= 11 && hour < 17) {
      period = 'day';
    } else if (hour >= 17 && hour < 20) {
      period = 'evening';
    }

    document.documentElement.setAttribute('data-time-of-day', period);
  }

  updateBackground();
  window.setInterval(updateBackground, 60000);
  document.addEventListener('visibilitychange', function () {
    if (!document.hidden) {
      updateBackground();
    }
  });
  window.addEventListener('pageshow', updateBackground);
}());
