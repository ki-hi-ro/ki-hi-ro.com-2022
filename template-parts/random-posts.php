<?php global $post_ids; ?>
<h2 class="front-sec__ttl --has-mt --sp-center">ランダムに表示される記事</h2>
<div class="front-sec__text front-sec__flex">
<?php
  $my_query_random = new WP_Query(
    array(
      'post_type' => 'post',
      'posts_per_page' => 3,
      'orderby' => 'rand',
      'post__not_in'   => array_merge(array(3874), $post_ids), // main-query.php の投稿を除外
    )
  );

  if ($my_query_random->have_posts()) :
   while ($my_query_random->have_posts()) :
    $my_query_random->the_post();
?>
    <div class="all-article__link front-sec__flex-item">
     <?php get_template_part("template-parts/blog-list"); ?>
    </div>
<?php
    endwhile;
  endif;
  wp_reset_postdata();
?>
</div>