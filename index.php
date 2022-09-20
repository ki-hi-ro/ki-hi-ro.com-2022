<?php get_header(); ?>
<?php
$term = get_queried_object();
$term_slug = $term->slug;
$term_name = $term->name;
$term_desc = $term->description;
$mv_pc = 'mv-pc';
if ($term_name == '技術ブログ') {
	$mv_pc = 'mv-pc-skill';
} else if ($term_name == '学習ブログ') {
	$mv_pc = 'mv-pc-study';
} else if ($term_name == '雑記ブログ') {
	$mv_pc = 'mv-pc-random';
}
?>
<div class="blog-archive__mv mv">
	<div class="blog-archive__mv-text-wrap mv-text-wrap">
		<div class="blog-archive__mv-text mv-text"><?php echo $term_name; ?></div>
	</div>

	<img class="blog-archive__pc-img pc-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/<?php echo $mv_pc; ?>.png?20220823-1" alt="PCのメインビジュアル">
	<img class="blog-archive__sp-img sp-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-sp.png?20220823-1" alt="スマホのメインビジュアル">
	<div class="blog-archive__scroll scrolldown1">
		<span class="blog-archive__scroll-text">Scroll</span>
	</div>
</div>

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