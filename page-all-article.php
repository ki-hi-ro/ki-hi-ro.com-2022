<?php get_header();?>

<main class="front-container">
  <div class="pc-left-container">
    <section class="front-sec">
      <h2 class="front-sec__ttl">すべての記事</h2>
      <div class="front-sec__text front-sec__flex">
        <?php echo get_template_part("template-parts/blog-list-thumb-desc"); ?>
      </div>
    </section>
  </div>
  <div class="pc-right-container">
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