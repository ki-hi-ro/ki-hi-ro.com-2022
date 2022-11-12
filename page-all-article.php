<?php get_header();?>

<main class="l-container test">
  <div class="l-pc-left">
    <div class="single-article__bread breadcrumbs">
        <?php if (function_exists('bcn_display')) {
          bcn_display();
        } ?>
    </div>
    <h1 class="post-list-ttl --all-article">全ての記事</h1>
    <div class="new-article">
      <?php
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 30,
        'paged' => get_query_var('paged'),
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