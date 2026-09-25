<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class('db-output-page'); ?>>
  <?php wp_body_open(); ?>
  <a class="skip-link" href="#main-content">本文へスキップ</a>
  <header id="page-top" class="site-header">
    <div class="site-header__inner">
      <a class="site-title" href="<?php echo esc_url(home_url('/')); ?>">ki-hi-ro.com</a>
      <nav class="site-header__nav" aria-label="メインメニュー">
        <a href="<?php echo esc_url(kihiro_all_articles_url()); ?>">記事一覧</a>
        <a href="<?php echo esc_url(kihiro_journal_date_url(kihiro_latest_post_date())); ?>">日付で探す</a>
      </nav>
      <?php get_search_form(); ?>
    </div>
    <div class="site-header__strap"><span>WEB / AI / LIFE</span><span>自律型WEBクリエイター 柴田浩貴</span></div>
  </header>
