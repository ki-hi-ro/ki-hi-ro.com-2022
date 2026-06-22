<?php get_header(); ?>

<main class="site-main">
  <?php if ((is_home() || is_front_page()) && !kihiro_current_topic()) : ?>
    <section class="outer-container site-hero" aria-labelledby="site-hero-title">
      <div class="site-hero__copy">
        <p class="site-hero__eyebrow">Freelance web engineer / Hiroki Shibata</p>
        <h1 id="site-hero-title" class="site-hero__title">
          <span>My philosophy.</span>
          <span>Our work.</span>
          <span>My life.</span>
        </h1>
        <p class="site-hero__lead">フリーランスWEBエンジニア 柴田 浩貴のブログ。<br class="site-hero__break">技術と思想、日々の発見を自分の言葉で記録します。</p>
        <div class="site-hero__actions">
          <a class="site-hero__primary" href="#latest-notes">最新の記事を見る <span aria-hidden="true">↘</span></a>
          <a class="site-hero__secondary" href="<?php echo esc_url(kihiro_topic_url('technology')); ?>">技術の記事</a>
        </div>
      </div>

      <div class="site-hero__visual" aria-hidden="true">
        <div class="site-hero__orbit"></div>
        <div class="site-hero__visual-card">
          <span class="site-hero__visual-label">CURRENTLY</span>
          <strong>Designing<br>with intent.</strong>
          <span class="site-hero__visual-index">N 35.18° / E 136.90°</span>
        </div>
        <span class="site-hero__shape site-hero__shape--one"></span>
        <span class="site-hero__shape site-hero__shape--two"></span>
      </div>
    </section>
  <?php endif; ?>

  <div class="outer-container front-container"<?php echo ((is_home() || is_front_page()) && !kihiro_current_topic()) ? ' id="latest-notes"' : ''; ?>>
    <div class="article-container">
    <div class="search-form-wrap --sp">
      <?php get_search_form(); ?>
    </div>

    <?php if (is_search()) : ?>
      <?php get_template_part('template-parts/index/search-results'); ?>
    <?php elseif (is_tag()) : ?>
      <?php get_template_part('template-parts/index/tag-archive'); ?>
    <?php elseif (is_home() || is_front_page() || is_date()) : ?>
      <?php get_template_part('template-parts/index/post-index'); ?>
    <?php endif; ?>
    </div>

    <?php get_sidebar('not-single'); ?>
  </div>
</main>

<?php get_footer(); ?>
