<?php
$term_slug = "";
if(is_tag()) {
  $term = get_queried_object();
  $term_slug = $term->slug;
}

$per_num = -1;
if ( is_home() || is_front_page() ) :
  $per_num = 10;
endif;
      $news_query = new WP_Query(
        array(
          'post_type'      => 'post',
          'posts_per_page' => $per_num,
          'tag' => $term_slug,
          'orderby' => 'modified'
        )
      );
  if ( $news_query->have_posts() ) :
        $i = 0;
      while ( $news_query->have_posts() ) :
      $news_query->the_post();
      ?>
<div class="all-article__link front-sec__flex-item
<?php if ( is_home() || is_front_page() ) : ?>
  <?php if($i == 1) : ?>
    --center
  <?php endif; ?>
<?php else : ?>
  <?php if($i % 3 == 1) : ?>
    --center --page
  <?php endif; ?>
<?php endif; ?>
  ">
  <?php echo get_template_part("template-parts/blog-list"); ?>
</div>
<?php
      $i++;
      endwhile;
      endif;
      wp_reset_postdata();
      ?>