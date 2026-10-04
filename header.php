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
      <?php get_search_form(); ?>
    </div>
    <div class="site-header__strap"><span>WEB / AI / LIFE</span><span>WEBクリエイター 柴田浩貴</span></div>
  </header>
