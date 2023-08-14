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
      <h2 class="front-sec__ttl"><?php echo $article_list_ttl; ?>記事</h2>
      <div class="front-sec__text front-sec__flex">
        <?php
        if(is_date()) {echo get_template_part("template-parts/blog-list-thumb-desc-date");}
        else {echo get_template_part("template-parts/blog-list-thumb-desc");}
        ?>
      </div>
      <a class="front-sec__more" href="<?php echo home_url("all-article"); ?>">これまでに書いた記事の一覧はこちら</a>
    </section>
  </div>
  <div class="pc-right-container">
    <?php get_search_form() ; ?>
    
    <section class="front-sec">
      <h2 class="front-sec__ttl">年月アーカイブ</h2>
      <?php echo get_template_part("template-parts/date-article-list"); ?>
    </section>

    <section class="front-sec">
      <h2 class="front-sec__ttl">タグ</h2>
      <div class="front-sec__text">
        <?php
        $args = array(
            'orderby' => 'name',
            'order' => 'ASC'
        );
        $posttags = get_tags( $args );

        if ( $posttags ){
          echo ' <ul class="front-sec__tag-list"> ';
          $tag_count = count($posttags);
          $i = 1;
          foreach( $posttags as $tag ) {
            if($i != $tag_count) {
              echo '<li class="front-sec__item"><a class="front-sec__link" href="'. get_tag_link( $tag->term_id ) . '">' . $tag->name .  '</a></li>';
            } else {
              echo '<li class="front-sec__item"><a class="front-sec__link" href="'. get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></li>';
            }
            $i++;
          }
          echo ' </ul> ';
        }
        ?>
      </div>
    </section>
  </div>
</main>

<?php get_footer();?>