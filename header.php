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
        <a href="<?php echo esc_url(kihiro_topic_url('technology')); ?>">技術ブログ</a>
        <a href="<?php echo esc_url(kihiro_topic_url('philosophy')); ?>">人生哲学</a>
        <a href="<?php echo esc_url(kihiro_topic_url('curation')); ?>">情報のセレクトショップ</a>
      </nav>
      </div>
    </div>
  </header>

  <?php $active_design = kihiro_current_design_concept(); ?>
  <nav class="design-switcher" aria-label="デザイン案を切り替える">
    <span class="design-switcher__label">Design</span>
    <div class="design-switcher__options">
      <?php foreach (kihiro_design_concepts() as $design_key => $design_data) : ?>
        <a
          class="design-switcher__option<?php echo $active_design === $design_key ? ' is-active' : ''; ?>"
          href="<?php echo esc_url(kihiro_design_concept_url($design_key)); ?>"
          <?php echo $active_design === $design_key ? 'aria-current="page"' : ''; ?>
        >
          <span class="design-switcher__number"><?php echo esc_html(substr($design_data['label'], 0, 2)); ?></span>
          <span class="design-switcher__name"><?php echo esc_html($design_data['short']); ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </nav>
