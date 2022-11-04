<?php get_header(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="study-list-show-post__container">
    <?php the_content(); ?>
</div>
<?php endwhile; endif; wp_reset_postdata();?>
<?php get_footer(); ?>