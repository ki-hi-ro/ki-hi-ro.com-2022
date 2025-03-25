<?php global $post_ids; ?>
<h2 class="front-sec__ttl --has-mt --sp-center">最近更新した記事</h2>
<div class="front-sec__text front-sec__flex">
<?php
  $my_query_modified = new WP_Query(
    array(
      'post_type' => 'post',
      'posts_per_page' => 1,
      'orderby' => 'modified',
      'post__not_in'   => array_merge(array(3874), $post_ids), // main-query.php の投稿を除外
    )
  );

  if ($my_query_modified->have_posts()) :
    while ($my_query_modified->have_posts()) :
      $my_query_modified->the_post();
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