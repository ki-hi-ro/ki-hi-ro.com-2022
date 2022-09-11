<?php get_header(); ?>
<div class="mv">
	<div class="mv-text-wrap">
		<div class="mv-text">ブログ一覧</div>
	</div>
	<img class="pc-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-pc.png?20220823-1" alt="PCのメインビジュアル">
	<img class="sp-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-sp.png?20220823-1" alt="スマホのメインビジュアル">
	<div class="scrolldown1"><span>Scroll</span></div>
</div>

<main class="container">


	<section class="top-section sidebar__blog sidebar__contents">
		<?php
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => -1,
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