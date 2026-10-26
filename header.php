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
  <?php $journal_active = is_singular('post') || is_search() || is_category() || is_tag() || is_date()
      || (is_home() && (in_array(kihiro_get_request_value('view'), array('journal', 'all', 'archive-all'), true)
          || is_paged() || '' !== kihiro_get_request_value('journal_date'))); ?>
  <header id="page-top" class="site-header">
    <div class="site-header__inner">
      <a class="site-title" href="<?php echo esc_url(kihiro_logo_home_url()); ?>">ki-hi-ro.com</a>
      <?php if ($journal_active) get_search_form(); ?>
    </div>
    <div class="site-header__menu-row">
      <span class="site-header__category">WEBエンジニアの柴田浩貴です。就職ではなく業務委託を目指しています。</span>
    <?php $case_index = kihiro_case_study_index(); ?>
      <nav class="site-main-nav" aria-label="メインナビゲーション">
        <?php if ($case_index) : ?>
          <a href="<?php echo esc_url(get_permalink($case_index)); ?>" <?php if (is_page_template(array('page-case-study.php', 'page-case-study-index.php'))) echo 'aria-current="page"'; ?>>開発事例</a>
        <?php endif; ?>
        <?php $services_page = kihiro_services_page(); if ($services_page) : ?>
          <a href="<?php echo esc_url(get_permalink($services_page)); ?>" <?php if (is_page($services_page->ID)) echo 'aria-current="page"'; ?>>サービス・ご依頼</a>
        <?php endif; ?>
        <details class="journal-menu<?php if ($journal_active) echo ' journal-menu--active'; ?>">
          <summary><a href="<?php echo esc_url(kihiro_journal_url()); ?>" <?php if (is_home() && in_array(kihiro_get_request_value('view'), array('journal', 'archive-all'), true)) echo 'aria-current="page"'; ?>>日々のジャーナル</a><span class="journal-menu__chevron" aria-hidden="true"><svg viewBox="0 0 16 16" width="14" height="14"><path d="m4 6 4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/></svg></span></summary>
          <div class="journal-menu__panel">
            <div class="journal-menu__categories">
              <?php foreach (array('技術・開発', '思考・生き方', '健康・セルフケア', '仕事・キャリア', '旅・場所', 'お金・制度') as $menu_category_name) :
                $menu_category = get_term_by('name', $menu_category_name, 'category');
                if (!$menu_category instanceof WP_Term) continue;
              ?>
                <a href="<?php echo esc_url(add_query_arg(array('view' => 'archive-all', 'article_category' => $menu_category->term_id), home_url('/'))); ?>"><?php echo esc_html($menu_category->name); ?></a>
              <?php endforeach; ?>
            </div>
          </div>
        </details>
        <?php $about_page = get_page_by_path('about'); if ($about_page && $about_page->post_status === 'publish') : ?>
          <a href="<?php echo esc_url(get_permalink($about_page)); ?>" <?php if (is_page($about_page->ID)) echo 'aria-current="page"'; ?>>自己紹介</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>
