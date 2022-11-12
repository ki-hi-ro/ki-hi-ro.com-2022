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
    <h1 class="post-list-ttl --<?php echo $current_cat_slug; ?>"><?php echo $post_list_ttl; ?></h1>
    <div class="new-article">
      <?php
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'paged' => get_query_var('paged'),
        'category' => $current_cat_id,
        'post__not_in' => array(3874),
      );
      $myposts = get_posts($args);
      ?>
      <ul class="blog-list-grid">
        <?php foreach ($myposts as $post): setup_postdata($post);?>
	          <?php echo get_template_part('template-parts/blog-list-grid'); ?>
	      <?php endforeach; wp_reset_postdata();?>
      </ul>
      <div class="author-box__more">
        <a class="author-box__link" href="<?php echo home_url('all-article'); ?>">全ての記事を見る<img class="author-box__link-icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"></a>
      </div>
    </div>

    <h1 class="post-list-ttl --<?php echo $current_cat_slug; ?>"><?php echo $post_list_ttl; ?></h1>
    <div class="new-article">
      <?php
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'paged' => get_query_var('paged'),
        'category' => $current_cat_id,
        'post__not_in' => array(3874),
      );
      $myposts = get_posts($args);
      ?>
      <ul class="blog-list-grid">
        <?php foreach ($myposts as $post): setup_postdata($post);?>
	          <?php echo get_template_part('template-parts/blog-list-grid'); ?>
	      <?php endforeach; wp_reset_postdata();?>
      </ul>
      <div class="author-box__more">
        <a class="author-box__link" href="<?php echo home_url('all-article'); ?>">全ての記事を見る<img class="author-box__link-icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"></a>
      </div>
    </div>
  </div>
  <?php get_sidebar();?>
</main>

<?php get_footer();?>