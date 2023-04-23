<?php get_header();?>

<main class="front-container">
  <section class="front-sec">
    <h2 class="front-sec__ttl"><?php echo get_query_var('year').'年'.get_query_var('monthnum').'月'; ?></h2>
    <div class="front-sec__text">
      <p><?php echo get_query_var('year').'年'.get_query_var('monthnum').'月'; ?>の記事一覧</p>
    </div>
    <div class="front-sec__text front-sec__flex">
      <?php echo get_template_part("template-parts/blog-list-thumb-desc-date"); ?>
    </div>
  </section>
</main>

<?php echo get_template_part("template-parts/date-article-list"); ?>

<?php get_footer();?>