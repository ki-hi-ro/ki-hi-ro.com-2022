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
        ["title" => "最近更新した記事", "tag" => "", "link" => "all-article/", "link-text" => "これまでに書いた記事", "category" => "", "per-page" => "1", "orderby" => 'modified'],
        ["title" => "これまでの仕事について", "tag" => "", "link" => "category/what-i-did/", "link-text" => "これまでの仕事についての記事一覧", "category" => "what-i-did/", "per-page" => "1", "orderby" => 'rand'],
        ["title" => "技術ブログ", "tag" => "", "link" => "category/skill-blog/", "link-text" => "技術ブログの一覧", "category" => "skill-blog/", "per-page" => "1", "orderby" => 'date', "orderby" => 'rand'],
        ["title" => "学習ブログ", "tag" => "", "link" => "category/study-blog/", "link-text" => "学習ブログの一覧", "category" => "study-blog", "per-page" => "1", "orderby" => 'date', "orderby" => 'rand'],
        ["title" => "日記", "tag" => "", "link" => "category/diary/", "link-text" => "日記の一覧", "category" => "diary", "per-page" => "1", "orderby" => 'date', "orderby" => 'rand'],
        ["title" => "雑記ブログ", "tag" => "", "link" => "category/random-blog/", "link-text" => "雑記ブログの一覧", "category" => "random-blog", "per-page" => "1", "orderby" => 'date', "orderby" => 'rand'],
        ["title" => "飲み記録", "tag" => "", "link" => "category/drink-comparison/", "link-text" => "飲み記録の一覧", "category" => "drink-comparison", "per-page" => "1", "orderby" => 'date', "orderby" => 'rand'],
      );
      foreach ($new_article_array as $new_article) :
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => $new_article["per-page"],
          'paged' => get_query_var('paged'),
          'tag' => $new_article["tag"],
          'category_name' => $new_article["category"],
          'orderby' => $new_article["orderby"]
        );
        $myposts = get_posts($args);
    ?>
      <div class="new-article">
        <h1 class="post-list-ttl --<?php echo $current_cat_slug; ?> --<?php echo $new_article["category"]; ?>">
          <?php echo $new_article['title']; ?>
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