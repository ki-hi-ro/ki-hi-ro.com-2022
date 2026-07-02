<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class('db-output-page'); ?>>
  <?php wp_body_open(); ?>
  <header class="site-header">
    <div class="site-header__inner">
      <a class="site-title" href="<?php echo esc_url(home_url('/')); ?>">Euphoria</a>
      <?php get_search_form(); ?>
    </div>
  </header>
