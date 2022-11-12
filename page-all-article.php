<?php get_header();?>

<main class="l-container test">
  <div class="l-pc-left">
    <h1 class="post-list-ttl --all-article"><?php the_title(); ?></h1>
    <div class="new-article">
      <?php
      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'paged' => $paged,
        'post__not_in' => array(3874),
      );
      $myposts = get_posts($args);
      ?>
      <ul class="blog-list-grid">
        <?php foreach ($myposts as $post): setup_postdata($post);?>
	        <?php echo get_template_part('template-parts/blog-list-grid'); ?>
	    <?php endforeach; wp_reset_postdata();?>
      </ul>
      <?php wp_pagenavi(); ?>
    </div>
  </div>
  <?php get_sidebar();?>
</main>

<?php get_footer();?>