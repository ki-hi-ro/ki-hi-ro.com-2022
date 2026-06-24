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
  <header class="site-header">
    <div class="outer-container header__container">
      <div class="header__contents">
      <a class="header__sitename-link" href="<?php echo esc_url(home_url('/')); ?>" aria-label="ki-hi-ro.com トップページへ">
        <div class="header__logo">
          <img src="<?php echo esc_url(get_theme_file_uri('/assets/img/site-name-logo-4.svg')); ?>" alt="ロゴ">
          <span class="header__site-title">
            <span class="header__sitename-text">ki-hi-ro.com</span>
            <span class="header__site-role">Freelance Web Engineer</span>
          </span>
        </div>
      </a>

      <nav class="site-nav" aria-label="メインナビゲーション">
        <!-- <a href="<?php echo esc_url(home_url('/')); ?>">写真と言葉</a> -->
        <!-- <a href="<?php echo esc_url(kihiro_thought_trail_url()); ?>">思考の軌跡</a> -->
        <!-- <a href="<?php echo esc_url(kihiro_topic_url('philosophy')); ?>">人生哲学</a>
        <a href="<?php echo esc_url(kihiro_topic_url('technology')); ?>">技術ブログ</a> -->
      </nav>

      <button class="site-menu-toggle" type="button" aria-controls="site-menu-panel" aria-expanded="false">
        <span class="site-menu-toggle__icon" aria-hidden="true">
          <span class="site-menu-toggle__line"></span>
          <span class="site-menu-toggle__line"></span>
        </span>
        <span class="site-menu-toggle__text">Menu</span>
      </button>
      </div>
    </div>

    <div class="site-menu-panel" id="site-menu-panel" hidden>
      <div class="outer-container site-menu-panel__inner">
        <div class="site-menu-panel__head">
          <p>Navigate ki-hi-ro.com</p>
          <button class="site-menu-close" type="button">閉じる</button>
        </div>

        <div class="site-menu-panel__grid">
          <?php foreach (kihiro_navigation_sections() as $nav_section) : ?>
            <section class="site-menu-section">
              <h2><?php echo esc_html($nav_section['title']); ?></h2>
              <ul>
                <?php foreach ($nav_section['items'] as $nav_item) : ?>
                  <li>
                    <a href="<?php echo esc_url($nav_item['url']); ?>">
                      <span><?php echo esc_html($nav_item['label']); ?></span>
                      <small><?php echo esc_html($nav_item['description']); ?></small>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </section>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </header>
