<?php get_header(); ?>

<?php 
$term = null;
if (is_tag()) {
  $term = get_queried_object(); 
}
?>

<main class="outer-container front-container">
  <div class="article-container">

    <div class="search-form-wrap --sp">
      <?php // get_search_form(); ?>
    </div>

    <?php 
    // 検索結果ページのとき
    if (is_search()) : 
    ?>
      <h2 class="front-sec__ttl">
        "<?= get_search_query(); ?>" が本文中に含まれている記事
      </h2>

      <div class="front-sec__text front-sec__flex">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <div class="all-article__link front-sec__flex-item">
              <?php get_template_part("template-parts/blog-list"); ?>
            </div>
          <?php endwhile; ?>
        <?php else : ?>
          <p>該当する記事はありませんでした。</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>    

    <?php 
    // トップページ、日付ページのとき
    $is_front_or_date = is_home() || is_front_page() || is_date();
    if ($is_front_or_date) :
      get_template_part('template-parts/last-modified-posts');
    endif;
    ?>

    <?php
    // タグページのとき
    if (is_tag() && $term) : 
    ?>
      <?php $article_list_ttl = esc_html($term->name) . "についての記事"; ?>
      <h2 class="front-sec__ttl"><?= $article_list_ttl; ?></h2>

      <?php 
      if (tag_description()) : 
        add_filter('term_description', function ($description) {
          if (!empty($description)) {
            $description = '<p class="description-class">' . strip_tags($description, '<a>') . '</p>';
          }
          return $description;
        });
        echo tag_description();
      endif; 
      ?>

      <div class="front-sec__text front-sec__flex">
        <?php get_template_part("template-parts/tag-posts"); ?>
      </div>
    <?php endif; ?>

  </div>

  <?php get_sidebar('not-single'); ?>
</main>

<?php get_footer(); ?>