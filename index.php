<?php get_header(); ?>

<main class="site-main">
  <?php if (kihiro_is_thought_trail()) : ?>
    <?php get_template_part('template-parts/thought-trail'); ?>
  <?php else : ?>
    <?php if ((is_home() || is_front_page()) && !kihiro_current_topic()) : ?>
      <?php get_template_part('template-parts/serendipity-hero'); ?>
    <?php endif; ?>

    <div class="outer-container front-container"<?php echo ((is_home() || is_front_page()) && !kihiro_current_topic()) ? ' id="latest-notes"' : ''; ?>>
      <div class="article-container">
      <div class="search-form-wrap --sp">
        <?php if ( is_search() ) : ?>
          <?php get_search_form(); ?>
        <?php endif; ?>
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

      <?php if (!is_singular('post')) : ?>
        <p class="page-top --not-single-sp"><a class="page-top__link --not-single-sp" href="#">↑</a></p>
      <?php endif; ?>      
    </div>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
