<?php
$my_query = new WP_Query(
  array(
    'post__not_in' => array(3874),
    'date_query' => array(
      array(
        'year'  => get_query_var('year'),
        'month' => get_query_var('monthnum'),
      ),
    )
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