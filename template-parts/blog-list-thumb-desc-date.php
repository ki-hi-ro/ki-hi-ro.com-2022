<?php
  if ( have_posts() ) :
        $i = 0;
      while ( have_posts() ) :
      the_post();
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