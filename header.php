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
  <meta name="description" content="自分の考えについて発信">
  <link rel="shortcut icon" href="<?php echo esc_url(get_theme_file_uri('/assets/img/favicon.ico')); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class('kihiro-body front-page'); ?>>
  <?php wp_body_open(); ?>
  <header class="outer-container header__container">
    <div class="header__contents">
      <a class="header__sitename-link" href="<?php echo esc_url(home_url('/')); ?>">
        <div class="header__logo">
          <img src="<?php echo esc_url(get_theme_file_uri('/assets/img/site-name-logo-4.svg')); ?>" alt="ロゴ">
          <span class="header__sitename-text">ki-hi-ro.com</span>
        </div>
      </a>
    </div>
  </header>
