<?php
  $my_query_rand = new WP_Query(
    array(
      'post_type'      => 'post',
      'posts_per_page' => 11,
      'orderby' => 'rand',
      'post__not_in' => array(3874)
    )
  );
?>

<?php
if ( $my_query_rand->have_posts() ) :
  while ( $my_query_rand->have_posts() ) :
    $my_query_rand->the_post();
?>
<div class="all-article__link front-sec__flex-item">
  <?php echo get_template_part("template-parts/blog-list"); ?>
</div>
<?php
    endwhile;
  endif;
wp_reset_postdata();
?>