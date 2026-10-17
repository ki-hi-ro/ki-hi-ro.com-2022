<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <header id="page-top" class="site-header">
    <div class="site-header__inner">
      <a class="site-title" href="<?php echo esc_url(kihiro_logo_home_url()); ?>">ki-hi-ro.com</a>
      <?php get_search_form(); ?>
    </div>
    <div class="site-header__menu-row">
      <span class="site-header__category">WEBエンジニアの柴田浩貴です。心の声を可視化しています。</span>
    <?php $case_index = kihiro_case_study_index(); ?>
      <nav class="site-main-nav" aria-label="メインナビゲーション">
        <a href="<?php echo esc_url(home_url('/')); ?>" <?php if (is_front_page() || is_home()) : ?>aria-current="page"<?php elseif (is_singular('post') || is_search()) : ?>aria-current="true"<?php endif; ?>>日々のジャーナル</a>
        <?php if ($case_index) : ?>
          <a href="<?php echo esc_url(get_permalink($case_index)); ?>" <?php if (is_page_template(array('page-case-study.php', 'page-case-study-index.php'))) echo 'aria-current="page"'; ?>>開発事例</a>
        <?php endif; ?>
        <?php foreach (array('about' => '自己紹介', 'contact-us' => 'お問い合わせ') as $slug => $label) : $nav_page = get_page_by_path($slug); if ($nav_page && $nav_page->post_status === 'publish') : ?>
          <a href="<?php echo esc_url(get_permalink($nav_page)); ?>" <?php if (is_page($nav_page->ID)) echo 'aria-current="page"'; ?>><?php echo esc_html($label); ?></a>
        <?php endif; endforeach; ?>
      </nav>
    </div>
  </header>
