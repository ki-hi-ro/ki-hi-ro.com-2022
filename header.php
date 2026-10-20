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
      <span class="site-header__category">WEBエンジニアの柴田浩貴です。自分の人生にとって大事なことを残していきます。</span>
    <?php $case_index = kihiro_case_study_index(); ?>
      <nav class="site-main-nav" aria-label="メインナビゲーション">
        <a href="<?php echo esc_url(home_url('/')); ?>" <?php if (is_front_page() || is_home()) : ?>aria-current="page"<?php elseif (is_singular('post') || is_search()) : ?>aria-current="true"<?php endif; ?>>日々のジャーナル</a>
        <?php $about_page = get_page_by_path('about'); if ($about_page && $about_page->post_status === 'publish') : ?>
          <a href="<?php echo esc_url(get_permalink($about_page)); ?>" <?php if (is_page($about_page->ID)) echo 'aria-current="page"'; ?>>自己紹介</a>
        <?php endif; ?>
        <?php if ($case_index) : ?>
          <a href="<?php echo esc_url(get_permalink($case_index)); ?>" <?php if (is_page_template(array('page-case-study.php', 'page-case-study-index.php'))) echo 'aria-current="page"'; ?>>開発事例</a>
        <?php endif; ?>
        <?php $contact_page = get_page_by_path('contact-us'); if ($contact_page && $contact_page->post_status === 'publish') : ?>
          <a href="<?php echo esc_url(get_permalink($contact_page)); ?>" <?php if (is_page($contact_page->ID)) echo 'aria-current="page"'; ?>>お問い合わせ</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>
