<?php get_header(); ?>

<main class="outer-container front-container">
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
</main>

<?php get_footer(); ?>
