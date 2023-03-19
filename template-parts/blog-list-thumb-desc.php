<?php
$term_slug = "";
if(is_tag()) {
  $term = get_queried_object();
  $term_slug = $term->slug;
}
$per_num = -1;
if ( is_home() || is_front_page() ) :
  $per_num = 3;
endif;
      $news_query = new WP_Query(
        array(
          'post_type'      => 'post',
          'posts_per_page' => $per_num,
          'tag' => $term_slug
        )
      );
  if ( $news_query->have_posts() ) :
        $i = 0;
      while ( $news_query->have_posts() ) :
      $news_query->the_post();
      ?>
<a class="all-article__link front-sec__flex-item
<?php if ( is_home() || is_front_page() ) : ?>
  <?php if($i == 1) : ?>
    --center
  <?php endif; ?>
<?php else : ?>
  <?php if($i % 3 == 1) : ?>
    --center --page
  <?php endif; ?>
<?php endif; ?>
  " href="<?php the_permalink(); ?>">
  <div class="all-article__post-wrap">
    <div class="all-article__date"><?php echo get_the_date('Y.m.d'); ?></div>
    <div class="all-article__ttl"><?php the_title(); ?></div>
    <?php
            if (has_post_thumbnail()) :
              the_post_thumbnail('',array( 'class' => 'front-sec__flex-item-thumb' ));
          ?>
    <?php else : ?>
    <img class="front-sec__flex-item-thumb" src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/no-image.png" alt="no-image">
    <?php endif; ?>
    <div class="all-article__desc"><?php the_excerpt(); ?></div>
  </div>
</a>
<?php
      $i++;
      endwhile;
      endif;
      wp_reset_postdata();
      ?>