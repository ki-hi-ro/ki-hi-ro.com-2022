<?php
$term_slug = "";
if(is_tag()) {
  $term = get_queried_object();
  $term_slug = $term->slug;
}

$per_num = -1;
$order_pram = 'date';
if ( is_home() || is_front_page() ) :
  $per_num = 10;//最近書いた記事、最近更新した記事の表示数
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
  $post_ids = array(); 
  while ( $my_query->have_posts() ) :
    $my_query->the_post();
?>
<div class="all-article__link front-sec__flex-item">
  <?php
    $post_id = $post->ID;
    array_push($post_ids, $post_id);
    echo get_template_part("template-parts/blog-list"); 
  ?>
</div>
<?php
    endwhile;
  endif;
wp_reset_postdata();
?>

<?php if ( is_home() || is_front_page() ) : ?>
  <h2 class="front-sec__ttl --has-mt">最近更新した記事</h2>
    <div class="front-sec__text front-sec__flex">
    <?php
    $my_query_rand = new WP_Query(
      array(
            'post_type' => 'post',
            'posts_per_page' => $per_num,
            'orderby' => 'modified',
            'post__not_in' => $post_ids
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
    </div>
<?php endif; ?>

<?php if ( is_home() || is_front_page() ) : ?>
  <h2 class="front-sec__ttl --has-mt">ランダムに表示される記事</h2>
    <div class="front-sec__text front-sec__flex">
    <?php
    $my_query_rand = new WP_Query(
      array(
            'post_type' => 'post',
            'posts_per_page' => $per_num * 8,
            'orderby' => 'rand',
            'post__not_in' => $post_ids
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
    </div>
<?php endif; ?> 