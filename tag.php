<?php get_header(); ?>
<?php
$term = get_queried_object();
$term_slug = $term->slug;
$term_name = $term->name;
$term_desc = $term->description;
?>
<main class="l-container">
  <div class="l-pc-left">
    <h1 class="post-list-ttl"><?php echo $term_name; ?>の記事一覧</h1>
    <div class="new-article">
      <?php
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'paged' => get_query_var('paged'),
        'tag' => $term_slug
      );
      $myposts = get_posts($args);
      ?>
      <ul class="blog-list-grid">
        <?php foreach ($myposts as $post) : setup_postdata($post); ?>
          <?php echo get_template_part('template-parts/blog-list-grid'); ?>
        <?php endforeach;
        wp_reset_postdata(); ?>
      </ul>
      <?php wp_pagenavi(); ?>
    </div>
  </div>
  <?php get_sidebar();?>
</main>
<?php get_footer(); ?>