<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#ffffff">
  <meta name="color-scheme" content="light">
  <?php wp_head(); ?>
  <!-- Google Analytics 4 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-MLVT1B3MQP"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-MLVT1B3MQP');
  </script>  
</head>

<body <?php body_class('db-output-page'); ?>>
  <?php wp_body_open(); ?>
  <a class="skip-link" href="#main-content">本文へスキップ</a>
  <?php $journal_active = is_singular('post') || is_search() || is_category() || is_tag() || is_date()
      || (is_home() && (in_array(kihiro_get_request_value('view'), array('journal', 'all', 'archive-all'), true)
          || is_paged() || '' !== kihiro_get_request_value('journal_date'))); ?>
  <header id="page-top" class="site-header">
    <div class="site-header__inner">
      <a class="site-title" href="<?php echo esc_url(kihiro_logo_home_url()); ?>">ki-hi-ro.com</a>
      <button class="site-nav-toggle" type="button" aria-controls="site-main-navigation" aria-expanded="false" aria-label="メニューを開く"><span class="site-nav-toggle__icon" aria-hidden="true"><span></span><span></span><span></span></span></button>
      <?php if ($journal_active && !(is_home() && in_array(kihiro_get_request_value('view'), array('journal', 'all', 'archive-all'), true))) get_search_form(); ?>
    </div>
    <div class="site-header__menu-row">
    <?php
      $case_index = kihiro_case_study_index();
    ?>
      <nav id="site-main-navigation" class="site-main-nav" aria-label="メインナビゲーション">
        <?php $services_page = kihiro_services_page(); if ($services_page) : ?>
          <a href="<?php echo esc_url(get_permalink($services_page)); ?>" <?php if (is_page($services_page->ID)) echo 'aria-current="page"'; ?>>Web制作・業務自動化</a>
        <?php endif; ?>
        <?php if ($case_index) : ?>
          <a href="<?php echo esc_url(get_permalink($case_index)); ?>" <?php if (is_page_template(array('page-case-study.php', 'page-case-study-index.php'))) echo 'aria-current="page"'; ?>>制作実績</a>
        <?php endif; ?>
        <a href="<?php echo esc_url(kihiro_journal_url()); ?>" <?php if ($journal_active) echo 'aria-current="page"'; ?>>日々の記録</a>
        <?php $about_page = get_page_by_path('about'); if ($about_page && $about_page->post_status === 'publish') : ?>
          <a href="<?php echo esc_url(get_permalink($about_page)); ?>" <?php if (is_page($about_page->ID)) echo 'aria-current="page"'; ?>>自己紹介</a>
        <?php endif; ?>
        <a class="site-main-nav__contact" href="<?php echo esc_url(home_url('/contact-us/')); ?>" <?php if (is_page('contact-us')) echo 'aria-current="page"'; ?>>お問い合わせ</a>
      </nav>
    </div>
  </header>
