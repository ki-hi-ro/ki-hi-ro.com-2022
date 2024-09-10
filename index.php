<?php 
get_header();
if(is_tag()) { $term = get_queried_object(); } 
?>
<main class="front-container">
  <div class="pc-left-container">
    <div class="search-form-wrap --sp">
      <?php get_search_form() ; ?>
    </div>
    <section class="front-sec">
      <?php if (is_search()) : ?>
      <h2 class="front-sec__ttl">"<?php echo get_search_query(); ?>" が本文中に含まれている記事</h2>
      <div class="front-sec__text front-sec__flex">
        <?php if (have_posts()): while(have_posts()) : the_post(); ?>
        <div class="all-article__link front-sec__flex-item">
          <?php echo get_template_part("template-parts/blog-list"); ?>
        </div>
        <?php
          endwhile;
        else:
          ?>
        <p>該当する記事はありませんでした。</p>
        <?php endif; ?>
        <?php endif; ?>
        <?php
          if(is_page("all-article")) {
            $article_list_ttl = "すべての";
          } else if(is_tag()) {
            $article_list_ttl = $term->name."についての";
          } else if(is_date()) {
            $article_list_ttl = get_query_var('year').'年'.get_query_var('monthnum').'月の';
          }
          ?>
        <?php if ( is_home() || is_front_page() ) : ?>
        <h2 class="front-sec__ttl">最近書いた記事</h2>
        <div class="front-sec__text front-sec__flex">
          <?php echo get_template_part("template-parts/blog-list-thumb-desc-new"); ?>
        </div>
        <?php endif; ?>
        <?php if ( !(is_home() || is_front_page() || is_search() ) ) : ?>
        <h2 class="front-sec__ttl <?php if(is_tag()): ?>tag_article_ttl<?php endif; ?>"><?php echo $article_list_ttl; ?>記事<?php if(is_tag()): ?>（<?php echo $term->count; ?>）<?php endif; ?></h2>
        <div class="front-sec__text front-sec__flex">
          <?php
              if(is_date()) {
                echo get_template_part("template-parts/blog-list-thumb-desc-date");
              } else {
                echo get_template_part("template-parts/blog-list-thumb-desc");
              }
              ?>
        </div>
        <?php endif; ?>
        <?php if ( (is_home() || is_front_page()) ) : ?>
        <a class="front-sec__more" href="<?php echo home_url("all-article"); ?>">すべての記事はこちら</a>
        <?php else : ?>
        <a class="front-sec__more" href="<?php echo home_url(); ?>">トップページはこちら</a>
        <?php endif; ?>
    </section>
  </div>
  <div class="pc-right-container">
    <div class="search-form-wrap --pc">
      <?php get_search_form() ; ?>
    </div>
    <section class="front-sec">
      <section class="front-sec">
        <h2 class="front-sec__ttl">年月アーカイブ</h2>
        <?php echo get_template_part("template-parts/date-article-list"); ?>
      </section>
      <section class="front-sec">
        <h2 class="front-sec__ttl">タグ</h2>
        <div class="front-sec__text">
          <?php 
          $tag_groups = array(
            'プログラミング' => array(148,292,334,322,52,74,318,290,289,287,277,173,204,119,140,117,193,84,87,221,337),
            '青春18きっぷ' => array(188,233,234,286),
          );
          $tag_cloud_settings = [
            'number' => 0, 'smallest' => 16, 'largest' => 16, 'format' => 'list', 'unit' => 'px', 'exclude' => 116,
          ];
          wp_tag_cloud($tag_cloud_settings); 
          ?>
        </div>
      </section>
    </section>
  </div>
</main>
<?php get_footer();?>