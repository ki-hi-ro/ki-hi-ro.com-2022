<?php get_header();?>

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
      $new_article_array = array(['最近書いた記事','','all-article',''], ['Vue.js','vue-js','tag/vue-js/',''], ['飲み記録', '', 'category/drink-comparison/','drink-comparison'], ['WordPress','wordpress','tag/wordpress/',''], ['TypeScript','typescript','tag/typescript/',''], ['HTML / CSS','html-css','tag/html-css/',''], ['音楽','music','tag/music/',''], ['フリーランス','フリーランス','tag/フリーランス/',''], ['本','本','tag/本/','']);
      foreach ($new_article_array as $new_article) :
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => 3,
          'paged' => get_query_var('paged'),
          'tag' => $new_article[1],
          'category_name' => $new_article[3]
        );
        $myposts = get_posts($args);
        ?>
      <div class="new-article">
        <h1 class="post-list-ttl --<?php echo $current_cat_slug; ?>"><?php echo $new_article[0]; ?></h1>
        <ul class="blog-list-grid">
          <?php foreach ($myposts as $post): setup_postdata($post);?>
              <?php echo get_template_part('template-parts/blog-list-grid'); ?>
          <?php endforeach; wp_reset_postdata();?>
        </ul>
        <div class="author-box__more">
          <a class="author-box__link" href="<?php echo home_url($new_article[2]); ?>">もっと見る<img class="author-box__link-icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"></a>
        </div>
      </div>
     <?php endforeach; ?>
  </div>
  <?php get_sidebar();?>
</main>

<?php get_footer();?>