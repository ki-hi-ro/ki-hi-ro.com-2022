<?php get_header();?>

<main class="front-container">
  <section class="front-sec">
    <h2 class="front-sec__ttl">これまでに書いた記事</h2>
    <section class="front-sec">
      <?php echo get_template_part("template-parts/date-article-list"); ?>
    </section>
    <div class="front-sec__text front-sec__flex">
      <?php echo get_template_part("template-parts/blog-list-thumb-desc"); ?>
    </div>
  </section>
</main>

<?php get_footer();?>