(function () {
  'use strict';
  document.addEventListener('keydown', function (event) { if (event.key === 'Tab') document.body.classList.add('keyboard-focus'); });
  document.addEventListener('pointerdown', function () { document.body.classList.remove('keyboard-focus'); });
  var header = document.querySelector('.site-header');
  if (!header) return;
  var toggle = header.querySelector('.site-nav-toggle');
  var nav = header.querySelector('.site-main-nav');
  if (!toggle || !nav) return;
  var narrow = window.matchMedia('(max-width: 1100px)');

  function setOpen(open) {
    header.classList.toggle('site-header--menu-open', open);
    document.body.classList.toggle('site-menu-open', open);
    document.querySelectorAll('body > main, body > .site-footer').forEach(function (element) { element.inert = open; });
    toggle.setAttribute('aria-expanded', String(open));
    toggle.setAttribute('aria-label', open ? 'メニューを閉じる' : 'メニューを開く');
    if (!open) {
      nav.querySelectorAll('details[open]').forEach(function (menu) { menu.open = false; });
    }
  }

  header.classList.add('site-header--collapsible');
  toggle.addEventListener('click', function () {
    setOpen(narrow.matches && toggle.getAttribute('aria-expanded') !== 'true');
  });
  header.addEventListener('keydown', function (event) {
    if (event.key === 'Tab' && narrow.matches && toggle.getAttribute('aria-expanded') === 'true') {
      var focusable = Array.from(header.querySelectorAll('a, button, input')).filter(function (element) { return element.getClientRects().length && !element.disabled; });
      var first = focusable[0], last = focusable[focusable.length - 1];
      if (event.shiftKey && document.activeElement === first) { last.focus(); event.preventDefault(); }
      else if (!event.shiftKey && document.activeElement === last) { first.focus(); event.preventDefault(); }
    }

    if (event.key !== 'Escape' || !narrow.matches || toggle.getAttribute('aria-expanded') !== 'true') return;
    setOpen(false);
    toggle.focus();
    event.preventDefault();
  });
  nav.addEventListener('click', function (event) {
    if (narrow.matches && event.target.closest('a')) setOpen(false);
  });
  document.addEventListener('pointerdown', function (event) {
    if (narrow.matches && !header.contains(event.target)) setOpen(false);
  });
  header.addEventListener('focusout', function (event) {
    if (narrow.matches && !header.contains(event.relatedTarget)) setOpen(false);
  });
  narrow.addEventListener('change', function () { setOpen(false); });
}());
