<?php get_header(); ?>
<main class="l-container">
  <div class="l-pc-left">
    <article class="single-article">
      <div class="single-article__bread breadcrumbs">
        <?php if (function_exists('bcn_display')) {
          bcn_display();
        } ?>
      </div>
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

              <?php the_content(); ?>
        <?php endwhile; endif;
          wp_reset_postdata();
          ?>
            </div>
          </div>
    </article>
  </div>
  <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>