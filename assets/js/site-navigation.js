(function () {
  'use strict';
  var header = document.querySelector('.site-header');
  if (!header) return;
  var toggle = header.querySelector('.site-nav-toggle');
  var nav = header.querySelector('.site-main-nav');
  if (!toggle || !nav) return;
  var narrow = window.matchMedia('(max-width: 1100px)');

  function setOpen(open) {
    header.classList.toggle('site-header--menu-open', open);
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
