<?php 
get_header();
$term = null;
if(is_tag()) { 
    $term = get_queried_object(); 
} 
?>

<?php if (is_date() && get_query_var('year') == 2025 && get_query_var('monthnum') == 3) : ?>
  <div class="callender-img front-container">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/202503.jpeg" alt="2025年3月のカレンダー画像">
  </div>
<?php endif; ?>  

<main class="front-container">
  <div class="pc-left-container">
    <div class="search-form-wrap --sp">
      <?php get_search_form(); ?>
    </div>

    <section class="front-sec">
      <?php if (is_search()) : ?>
        <h2 class="front-sec__ttl">"<?php echo get_search_query(); ?>" が本文中に含まれている記事</h2>
        <div class="front-sec__text front-sec__flex">
          <?php if (have_posts()): while(have_posts()) : the_post(); ?>
            <div class="all-article__link front-sec__flex-item">
              <?php get_template_part("template-parts/blog-list"); ?>
            </div>
          <?php endwhile; else: ?>
            <p>該当する記事はありませんでした。</p>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <?php 
      $is_front = is_home() || is_front_page();
      if ($is_front) : 
        get_template_part("template-parts/front-posts");
      endif;
      ?>

      <?php 
      // デフォルト値を設定
      $article_list_ttl = "記事";

      if (is_page("all-article")) {
          $article_list_ttl = "すべての";
      } elseif (is_tag() && $term) {
          $article_list_ttl = esc_html($term->name) . "についての";
      } elseif (is_date()) {
          if (get_query_var('monthnum')) {
              $article_list_ttl = get_query_var('year') . '年' . get_query_var('monthnum') . '月の';
          } else {
              $article_list_ttl = get_query_var('year') . '年の';
          }
      }
      ?>

      <?php if (!$is_front && !is_search()) : ?>
        <h2 class="front-sec__ttl"><?php echo $article_list_ttl; ?>記事</h2>
        <div class="front-sec__text front-sec__flex">
          <?php
          if (is_date()) {
              get_template_part("template-parts/blog-list-thumb-desc-date");
          } else {
              get_template_part("template-parts/blog-list-thumb-desc");
          }
          ?>
        </div>
      <?php endif; ?>
    </section>
  </div>

  <?php get_sidebar('front'); ?>
</main>

<?php get_footer(); ?>