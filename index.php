<?php get_header(); ?>

<?php echo get_template_part('template-parts/mv'); ?>

<main class="container">

	<section class="top-section sidebar__blog sidebar__contents">
		<h4><?php echo $term_name; ?></h4>
		<p><?php echo $term_desc; ?></p>

		<?php
		$args = array(
			'category_name' => $term_slug,
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

	<h4 class="tag-ttl">タグ</h4>
	<?php
	if (is_category()) {
		$cat_id = get_query_var('cat');
		$posttags = my_tags_in_cat($cat_id);
		if ($posttags) {
			echo '<ul class="tag-list">';
			foreach ($posttags as $tag) {
				echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . "#" . $tag->name . '</a></li>';
			}
			echo '</ul>';
		}
	}
	?>

</main>

<?php get_footer(); ?>