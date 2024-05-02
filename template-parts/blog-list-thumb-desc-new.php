<?php
$term_slug = "";
if(is_tag()) {
  $term = get_queried_object();
  $term_slug = $term->slug;
}

$per_num = -1;
$order_pram = 'date';
if ( is_home() || is_front_page() ) :
  $per_num = 5;
  $order_pram = 'date';
endif;
  $my_query = new WP_Query(
    array(
      'post_type'      => 'post',
      'posts_per_page' => $per_num,
      'tag' => $term_slug,
      'orderby' => $order_pram,
      'post__not_in' => array(3874),
    )
  );
if ( $my_query->have_posts() ) :
  while ( $my_query->have_posts() ) :
    $my_query->the_post();
?>
<div class="all-article__link front-sec__flex-item">
  <?php echo get_template_part("template-parts/blog-list"); ?>
</div>
<?php
    endwhile;
  endif;
wp_reset_postdata();
?>