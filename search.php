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
      <h2 class="front-sec__ttl">"<?php echo get_search_query(); ?>" が本文中に含まれている記事</h2>
      <div class="front-sec__text front-sec__flex">
        <?php
        if (have_posts()):
          while(have_posts()) : the_post();
        ?>
          <div class="all-article__link front-sec__flex-item">
            <?php echo get_template_part("template-parts/blog-list"); ?>
          </div>
        <?php
          endwhile;
        else:
        ?>
          <p>該当する記事はありませんでした。</p>
        <?php endif ; ?>
      </div>
      <a class="front-sec__more" href="<?php echo home_url("all-article"); ?>">これまでに書いた記事の一覧はこちら</a>
    </section>
  </div>
  <div class="pc-right-container">
  <div class="search-form-wrap --pc">
    <?php get_search_form() ; ?>
  </div>

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