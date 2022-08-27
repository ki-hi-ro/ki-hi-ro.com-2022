<?php get_header();?>

<main class="container">
  <h1><?php echo get_the_date('Y年n月'); ?>の記事一覧</h1>
	<section class="top-section sidebar__blog sidebar__contents">
    <?php
    $args = array(
        'tag__not_in'   => array( 105 ),
    );
    $query = new WP_Query( $args );
    ?>
    <?php if(have_posts()): while($query->have_posts()):$query->the_post(); ?>
	    <?php echo get_template_part('template-parts/sidebar-blog'); ?>
    <?php endwhile; endif; wp_reset_postdata(); ?>
	</section>

</main>

<?php get_footer();?>