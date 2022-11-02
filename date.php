<?php get_header(); ?>
<main class="l-container">
  <div class="l-pc-left">
    <h1><?php echo get_the_date('Y年n月'); ?>の記事一覧</h1>
    <div class="new-article">
      <?php
      $current_url =  get_pagenum_link(get_query_var('paged'));
      $uri = rtrim($current_url, '/');
      $uri = substr($uri, strrpos($uri, '/') + 1);
      $uri = abs($uri);
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'tag__not_in'   => array(116),
        'monthnum' => $uri,
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
  <?php get_sidebar();?>
</main>
<?php get_footer(); ?>