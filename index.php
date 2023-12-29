<?php get_header();?>
<?php
if(is_tag()) {
  $term = get_queried_object();
  $term_slug = $term->slug;
  $term_name = $term->name;
  $term_desc = $term->description;
}
?>

<main class="front-container">
  <div class="pc-left-container">
    <div class="search-form-wrap --sp">
      <?php get_search_form() ; ?>
    </div>
    <section class="front-sec">
      <?php
    if(is_front_page() || is_home()) {
      $article_list_ttl = "最近更新した";
    } else if(is_page("all-article")) {
      $article_list_ttl = "すべての";
    } else if(is_tag()) {
      $article_list_ttl = $term_name."についての";
    } else if(is_date()) {
      $article_list_ttl = get_query_var('year').'年'.get_query_var('monthnum').'月の';
    }
    ?>

      <?php if ( is_home() || is_front_page() ) : ?>
        <h2 class="front-sec__ttl">新着記事</h2>
        <div class="front-sec__text front-sec__flex">
          <?php echo get_template_part("template-parts/blog-list-thumb-desc-new"); ?>
        </div>
      <?php endif; ?>

      <h2 class="front-sec__ttl"><?php echo $article_list_ttl; ?>記事</h2>
      <div class="front-sec__text front-sec__flex">
        <?php
        if(is_date()) {
          echo get_template_part("template-parts/blog-list-thumb-desc-date");
        } else {
          echo get_template_part("template-parts/blog-list-thumb-desc");
        }
        ?>
      </div>

      <?php if(!is_page("all-article")) : ?>
        <h2 class="front-sec__ttl">ランダムに表示される記事</h2>
        <div class="front-sec__text front-sec__flex">
          <?php echo get_template_part("template-parts/blog-list-thumb-desc_rand"); ?>
        </div>
      <?php endif; ?>
      <?php if ( is_home() || is_front_page() ) : ?>
        <h2 class="front-sec__ttl">今の自分にとって重要な記事</h2>
        <div class="front-sec__text front-sec__flex">
          <?php echo get_template_part("template-parts/blog-list-thumb-desc_important"); ?>
        </div>
        <h2 class="front-sec__ttl">モバイルSuicaにエポスカードで上手くチャージが出来ない方に向けた記事</h2>
        <div class="front-sec__text front-sec__flex">
          <?php echo get_template_part("template-parts/blog-list-thumb-desc_query-top"); ?>
        </div>
        <h2 class="front-sec__ttl">2023年秋の京都の紅葉についての記事</h2>
        <div class="front-sec__text front-sec__flex">
          <?php echo get_template_part("template-parts/blog-list-thumb-desc_kyoto-koyo"); ?>
        </div>
        <h2 class="front-sec__ttl">鬱々としている方向けの記事</h2>
        <div class="front-sec__text front-sec__flex">
          <?php echo get_template_part("template-parts/blog-list-thumb-desc_utu"); ?>
        </div>
      <?php endif; ?>
      <a class="front-sec__more" href="<?php echo home_url("all-article"); ?>">すべての記事はこちら</a>
    </section>
  </div>
  <div class="pc-right-container">
    <div class="search-form-wrap --pc">
      <?php get_search_form() ; ?>
    </div>
    <section class="front-sec">
      <h2 class="front-sec__ttl">タグ</h2>
      <div class="front-sec__text">
        <?php wp_tag_cloud('format=list&smallest=16&largest=16&unit=px&number=100&exclude=116'); ?>
      </div>
    </section>
    <section class="front-sec">
      <h2 class="front-sec__ttl">年月アーカイブ</h2>
      <?php echo get_template_part("template-parts/date-article-list"); ?>
    </section>
  </div>
</main>

<?php get_footer();?>