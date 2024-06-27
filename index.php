<?php get_header(); ?>
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
          if(is_page("all-article")) {
            $article_list_ttl = "すべての";
          } else if(is_tag()) {
            $article_list_ttl = $term_name."についての";
          } else if(is_date()) {
            $article_list_ttl = get_query_var('year').'年'.get_query_var('monthnum').'月の';
          }
          ?>

          <?php if ( is_home() || is_front_page() ) : ?>
            <?php if(!is_page("all-article")) : ?>
              <h2 class="front-sec__ttl rand">ランダムに表示される記事</h2>
              <div class="front-sec__text front-sec__flex">
                  <?php echo get_template_part("template-parts/blog-list-thumb-desc_rand"); ?>
              </div>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ( is_home() || is_front_page() ) : ?>
            <h2 class="front-sec__ttl">最近書いた記事</h2>
            <div class="front-sec__text front-sec__flex">
                <?php echo get_template_part("template-parts/blog-list-thumb-desc-new"); ?>
            </div>
          <?php endif; ?>

          <?php if ( !(is_home() || is_front_page()) ) : ?>
            <h2 class="front-sec__ttl <?php if(is_tag()): ?>tag_article_ttl<?php endif; ?>"><?php echo $article_list_ttl; ?>記事</h2>
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

          <?php if ( is_home() || is_front_page() ) : ?>
            <h2 class="front-sec__ttl">最近更新した記事</h2>
            <div class="front-sec__text front-sec__flex">
              <?php echo get_template_part("template-parts/blog-list-thumb-desc_important"); ?>
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
            <?php if( is_tag() ) : ?>
            <?php 
            function tagChild($parentId, $childTags) {
              if(is_tag()) {
                $term = get_queried_object();
                $termId = $term->term_id;
                $termName = $term->name;
              }
              if($termId == $parentId) {
                echo '<div class="related_tag_card">';
                echo '<h2 class="front-sec__ttl">' . $termName . 'に関連するタグ</h2>';
                $tagIds = $childTags;
                foreach ($tagIds as $tagId) {
                  $tag = get_tag( $tagId ); 
                  echo '<a href="' . esc_url( get_tag_link( $tag ) ) . '">';
                  echo "- ";
                  echo $tag->name;
                  echo '<br>';
                  echo '</a>';
                }
                echo '</div>';
              } else if (in_array($termId, $childTags)) {
                echo '<div class="related_tag_card">';
                echo '<h2 class="front-sec__ttl">' . $termName . 'に関連するタグ</h2>';
                  $tag = get_tag( $parentId ); 
                  echo '<a href="' . esc_url( get_tag_link( $tag ) ) . '">';
                  echo "- ";
                  echo $tag->name;
                  echo '</a>';
                  echo '</div>';
                }
             }
            tagChild(81,array(255,238,236,237,288,273));
            tagChild(210,array(289));
            tagChild(188,array(233,234,286));
            tagChild(88,array(169,251,257,258));
            ?>
            <?php endif; ?>

            <section class="front-sec">
                <h2 class="front-sec__ttl">年月アーカイブ</h2>
                <?php echo get_template_part("template-parts/date-article-list"); ?>
            </section>
        </section>
    </div>
</main>

<h2 class="front-sec__ttl front-container tag-wrap-ttl">タグ</h2>
<section class="tag-wrap front-container">
    <div class="front-sec__text">
      <?php wp_tag_cloud('format=list&smallest=16&largest=16&unit=px&number=200&exclude=116'); ?>
    </div>
</section>

<?php get_footer();?>