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
    <div class="site-header__menu-row">
      <span class="site-header__category">WEB / AI / LIFE</span>
    <?php $case_index = kihiro_case_study_index(); ?>
    <?php if ($case_index) : ?>
      <nav class="site-main-nav" aria-label="メインナビゲーション">
        <a href="<?php echo esc_url(get_permalink($case_index)); ?>" <?php if (is_page_template(array('page-case-study.php', 'page-case-study-index.php'))) echo 'aria-current="page"'; ?>>CASE STUDY</a>
        <a href="<?php echo esc_url(home_url('/articles/')); ?>">ARTICLES</a>
        <?php foreach (array('about' => 'ABOUT', 'contact-us' => 'CONTACT') as $slug => $label) : $nav_page = get_page_by_path($slug); if ($nav_page && $nav_page->post_status === 'publish') : ?>
          <a href="<?php echo esc_url(get_permalink($nav_page)); ?>"><?php echo esc_html($label); ?></a>
        <?php elseif ($slug === 'about') : ?>
          <span class="site-main-nav__pending" aria-disabled="true" title="ABOUTページは準備中です">ABOUT</span>
        <?php endif; endforeach; ?>
      </nav>
    <?php endif; ?>
    </div>
  </header>
