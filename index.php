<?php get_header();?>

<main class="l-container test">
  <div class="l-pc-left">
    <div class="new-article">
      <?php
      $current_cat_id = get_query_var('cat');
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 30,
        'paged' => get_query_var('paged'),
        'category' => $current_cat_id,
        'post__not_in' => array(3874)
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