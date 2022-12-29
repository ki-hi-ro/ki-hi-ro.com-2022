<?php get_header();?>

<?php // echo get_template_part('template-parts/loading'); ?>

<main class="l-container test">
  <div class="l-pc-left">
    <?php
    $current_cat_id = get_query_var('cat');
    $current_cat_slug = get_query_var('category_name');
    if ($current_cat_id == "") {
      $post_list_ttl = "最近書いた記事";
    } elseif ($current_cat_id == "98") {
      $post_list_ttl = "これまでの仕事";
    } elseif ($current_cat_id == "60") {
      $post_list_ttl = "技術ブログ";
    } elseif ($current_cat_id == "69") {
      $post_list_ttl = "学習ブログ";
    } elseif ($current_cat_id == "67") {
      $post_list_ttl = "雑記ブログ";
    } elseif ($current_cat_slug == "drink-comparison") {
      $post_list_ttl = "飲み比べ";
    }
    ?>

      <?php
      $new_article_array = ["title" => "これまでに書いた記事", "tag" => "", "link" => "", "link-text" => "", "category" => "", "per-page" => "6"];
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;
      $my_query = new WP_Query(array(
        'post_type' => 'post',
        'paged' => $paged,
        'posts_per_page' => $new_article_array["per-page"],
        'tag' => $new_article_array["tag"],
        'category_name' => $new_article_array["category"],
      ));
      if($my_query->have_posts()): ?>
        <div class="new-article">
          <h1 class="post-list-ttl --<?php echo $current_cat_slug; ?> --<?php echo $new_article_array["category"]; ?>">
            <?php echo $new_article_array['title']; ?>
          </h1>
          <ul class="blog-list-grid --<?php echo $new_article_array["tag"]; ?>">
            <?php while($my_query->have_posts()): $my_query->the_post(); ?>            
              <?php echo get_template_part('template-parts/blog-list-grid'); ?>
            <?php endwhile; ?>      
          </ul>
        </div>
      <?php endif; ?>
      <?php wp_pagenavi(array('query' => $my_query)); ?>
  </div>
  <?php get_sidebar();?>
</main>

<?php get_footer();?>