<!DOCTYPE HTML>
<html lang="ja">

<head>
  <!-- Google Analyticsの導入部分 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-MLVT1B3MQP"></script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());
  gtag('config', 'G-MLVT1B3MQP');
  </script>

  <!-- <meta> と SEO関連 -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if (is_archive() || is_search() || is_tag() || is_paged()) : ?>
    <meta name="robots" content="noindex,follow">
  <?php endif; ?>

  <!-- サイトの概要（メタ情報） -->
  <meta name="description" content="自分の人生を生きるためのブログ">
  <link rel="shortcut icon" href="<?php echo esc_url(get_theme_file_uri('/assets/img/favicon.ico')); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class('kihiro-body front-page'); ?>>
  <?php wp_body_open(); ?>
  <?php $navigation_sections = function_exists('kihiro_navigation_sections') ? kihiro_navigation_sections() : array(); ?>
  <header class="site-header">
    <div class="outer-container header__container">
      <div class="header__contents">
        <a class="header__sitename-link" href="<?php echo esc_url(home_url('/')); ?>" aria-label="ki-hi-ro.com トップページへ">
          <div class="header__logo">
            <img src="<?php echo esc_url(get_theme_file_uri('/assets/img/site-name-logo-4.svg')); ?>" alt="ロゴ">
            <span class="header__site-title">
              <span class="header__sitename-text">ki-hi-ro.com</span>
            </span>
          </div>
        </a>

        <?php if ($navigation_sections) : ?>
          <button class="site-menu-toggle" type="button" aria-controls="site-menu-panel" aria-expanded="false">
            <span class="site-menu-toggle__icon" aria-hidden="true">
              <span class="site-menu-toggle__line"></span>
              <span class="site-menu-toggle__line"></span>
            </span>
            <span class="site-menu-toggle__text">Menu</span>
          </button>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <?php if ($navigation_sections) : ?>
    <div id="site-menu-panel" class="site-menu-panel" hidden>
      <div class="outer-container site-menu-panel__inner">
        <div class="site-menu-panel__grid">
          <?php foreach ($navigation_sections as $navigation_section) : ?>
            <section class="site-menu-section">
              <h2><?php echo esc_html($navigation_section['title']); ?></h2>
              <ul>
                <?php foreach ($navigation_section['items'] as $navigation_item) : ?>
                  <li>
                    <a href="<?php echo esc_url($navigation_item['url']); ?>">
                      <span><?php echo esc_html($navigation_item['label']); ?></span>
                      <small><?php echo esc_html($navigation_item['description']); ?></small>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </section>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
