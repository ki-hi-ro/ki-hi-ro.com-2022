<?php get_header(); ?>

<?php echo get_template_part('template-parts/mv'); ?>

<main class="container">
	<section class="top-section sidebar__blog sidebar__contents">
		<?php
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => -1,
			'category' => array(69, 60, 67)
		);
		$myposts = get_posts($args);
		?>
		<ul class="blog-list-grid">
			<?php foreach ($myposts as $post) : setup_postdata($post); ?>
				<?php echo get_template_part('template-parts/blog-list-grid'); ?>
			<?php endforeach;
			wp_reset_postdata(); ?>
		</ul>
	</section>
</main>

<?php get_footer(); ?>