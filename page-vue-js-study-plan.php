<?php get_header();?>

<?php echo get_template_part('template-parts/loading'); ?>

<main class="l-container test">
  <div class="l-pc-left">
  <article class="single-article">
    <div class="single-article__bread breadcrumbs"><?php if (function_exists('bcn_display')) {bcn_display();} ?></div>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="single-article__post author calendar single-wrap">
          <?php get_template_part('template-parts/post-meta'); ?>
          <h1 class="post-list-ttl"><?php the_title(); ?></h1>
          <div class="author__contents">
            <?php the_content(); ?>
          </div>
        </div>
      <?php endwhile; endif; ?>
    </div>
  </article>
  <?php get_sidebar();?>
</main>

<?php get_footer();?>