<?php /** Decorative service illustrations, sharing the surrounding sky palette. */ ?>
<svg class="service-illustration" viewBox="0 0 360 160" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">
 <ellipse cx="180" cy="142" rx="140" ry="10" fill="currentColor" opacity=".06"/>
 <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
 <?php if (($args['kind'] ?? '') === 'web') : ?>
  <rect x="45" y="20" width="230" height="118" rx="10" fill="var(--sky-paper,#fff)"/>
  <path d="M45 44h230"/><circle cx="58" cy="32" r="1"/><circle cx="67" cy="32" r="1"/><circle cx="76" cy="32" r="1"/>
  <rect x="62" y="59" width="81" height="61" rx="5" fill="var(--sky-panel,#edf1f5)" stroke="none"/>
  <path d="m74 105 15-17 12 10 13-19 17 26M158 65h85m-85 13h64m-64 20h79m-79 13h54"/>
  <rect x="250" y="62" width="55" height="80" rx="8" fill="var(--sky-paper,#fff)"/>
  <path d="M267 71h21m-28 17h35m-35 10h35m-35 10h23m-8 24h5"/>
  <path d="m312 34 4 8 9 2-9 3-4 8-3-8-8-3 8-2Z" fill="var(--sky-panel,#edf1f5)"/>
 <?php else : ?>
  <rect x="35" y="44" width="64" height="84" rx="7" fill="var(--sky-paper,#fff)"/>
  <path d="M48 62h37m-37 13h37m-37 13h37m-37 13h24M60 58v48m13-48v48" opacity=".55"/>
  <path d="M109 86h32m-8-8 8 8-8 8"/>
  <rect x="150" y="44" width="68" height="84" rx="12" fill="var(--sky-panel,#edf1f5)"/>
  <path d="m178 68-12 16 12 16m12-32 12 16-12 16m-3-28-7 24"/>
  <path d="M228 86h32m-8-8 8 8-8 8"/>
  <rect x="271" y="44" width="58" height="84" rx="7" fill="var(--sky-paper,#fff)"/>
  <path d="M284 62h30m-30 13h22m-22 13h30" opacity=".55"/>
  <circle cx="312" cy="115" r="16" fill="var(--sky-panel,#edf1f5)"/><path d="m305 115 5 5 9-10"/>
  <path d="M163 29c12-10 31-10 43 0m-4-10 4 10-11-1" opacity=".6"/>
 <?php endif; ?>
 </g>
</svg>
