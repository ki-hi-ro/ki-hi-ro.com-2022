<?php get_header(); ?>

<main class="l-container">
  <div class="l-pc-left">
    <div class="new-article">
      <?php
	  $current_cat_id = get_query_var('cat');
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
		'category' => $current_cat_id
      );
      $myposts = get_posts($args);
      ?>
      <ul class="blog-list-grid">
        <?php foreach ($myposts as $post) : setup_postdata($post); ?>
          <?php echo get_template_part('template-parts/blog-list-grid'); ?>
        <?php endforeach;
        wp_reset_postdata(); ?>
      </ul>
    </div>
  </div>
  <div class="l-pc-right">
    <?php echo get_template_part('template-parts/author'); ?>
  </div>

</main>

<?php get_footer(); ?>