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
      $new_article_array = array(
        ["title" => "これまでに書いた記事", "tag" => "", "link" => "", "link-text" => "", "category" => "", "per-page" => "-1"],
      );
      foreach ($new_article_array as $new_article) :
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => $new_article["per-page"],
          'paged' => get_query_var('paged'),
          'tag' => $new_article["tag"],
          'category_name' => $new_article["category"]
        );
        $myposts = get_posts($args);
        ?>
      <div class="new-article">
        <h1 class="post-list-ttl --<?php echo $current_cat_slug; ?> --<?php echo $new_article["category"]; ?>">
          <?php echo $new_article['title']; ?>
          <!-- <a class="post-list-ttl__study-list" href="<?php echo home_url('vue-js-study-plan'); ?>">学習計画はこちら<img class="post-list-ttl__study-list-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/study-list-arrow-right.svg"></a> -->
        </h1>
        <ul class="blog-list-grid --<?php echo $new_article["tag"]; ?>">
          <?php foreach ($myposts as $post): setup_postdata($post);?>
              <?php echo get_template_part('template-parts/blog-list-grid'); ?>
          <?php endforeach; wp_reset_postdata();?>
        </ul>
        <?php if($new_article["link"]): ?>
          <div class="author-box__more">
            <a class="author-box__link" href="<?php echo home_url($new_article["link"]); ?>"><?php echo $new_article["link-text"]; ?><img class="author-box__link-icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"></a>
          </div>
        <?php endif; ?>
      </div>
     <?php endforeach; ?>
  </div>
  <?php get_sidebar();?>
</main>

<?php get_footer();?>