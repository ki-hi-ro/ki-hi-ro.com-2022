<?php get_header(); ?>

<?php $slug = 'random-blog'; ?>

<section class="random-blog__pickup">
	<h2 class="random-blog__sec-ttl">雑記ブログ</h2>
	<div class="top-new-blog">
		<?php
		$cat_posts = get_posts(array(
			'post_type' => 'post',
			'category_name' => $slug,
			'posts_per_page' => 3,
			'orderby' => 'rand'
		));
		global $post;
		if ($cat_posts) : foreach ($cat_posts as $post) : setup_postdata($post);
		?>
				<a href="<?php the_permalink() ?>" class="new-blog__post top-card">
					<p class="post__date"><?php the_time('Y/m/d') ?></p>
					<h3><?php the_title(); ?></h3>
					<span class="post__category">
						<?php $cat = get_the_category();
						$cat = $cat[0]; {
							echo $cat->cat_name;
						} ?>
					</span>
					<?php if (has_post_thumbnail()) : ?>
						<?php the_post_thumbnail(); ?>
					<?php else : ?>
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/no-image.png" alt="no-image 仮画像">
					<?php endif; ?>
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
				</a>
		<?php endforeach;
		endif;
		wp_reset_postdata(); ?>
	</div>
</section>

<section class="random-blog__tag-section">
	<h2 class="random-blog__sec-ttl">タグ</h2>
	<div class="tag__wrap">
		<span class="tag">#本（3）</span>
		<span class="tag">#コワーキングスペース（10）</span>
		<span class="tag">#旅行（3）</span>
	</div>
</section>

<section class="random-blog__latest">
	<h2 class="random-blog__sec-ttl">最新記事</h2>
	<div class="top-new-blog">
		<?php
		$cat_posts = get_posts(array(
			'post_type' => 'post',
			'category_name' => $slug,
			'posts_per_page' => 10,
			'orderby' => 'date',
			'order' => "DESC"
		));
		global $post;
		if ($cat_posts) : foreach ($cat_posts as $post) : setup_postdata($post);
		?>
				<a href="<?php the_permalink() ?>" class="new-blog__post top-card">
					<?php if (has_post_thumbnail()) : ?>
						<?php the_post_thumbnail(); ?>
					<?php else : ?>
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/no-image.png" alt="no-image 仮画像">
					<?php endif; ?>
				</a>
		<?php endforeach;
		endif;
		wp_reset_postdata(); ?>
	</div>
</section>


<div class="top-box col-xs-12">

	<div class="page__contents-container">
		<section class="random-blog" id="random-blog">
			<?php
			$args = array(
				'category_name' => 'random-blog',
				'post_type' => 'post',
				'posts_per_page' => -1,
				'post_status' => 'publish',
			);
			$myposts = get_posts($args);
			if ($myposts) :
			?>
				<h2 class="random-blog__sec-ttl">過去記事アーカイブ</h2>
				<?php
				foreach ($myposts as $post) :
					setup_postdata($post);
				?>
					<a class="random-blog__link" href="<?php the_permalink(); ?>">
						<div class="random-blog__contents">
							<span class="random-blog__date">
								<?php echo get_the_date('Y.m.d'); ?>
							</span>
							<?php
							$posttags = get_the_tags();
							if ($posttags) :
							?>
								<span class="random-blog__tag">
									<?php
									foreach ($posttags as $tag) {
										echo $tag->name . ' ';
									}
									?>
								</span>
							<?php endif; ?>
							<span class="random-blog__ttl">
								<?php the_title(); ?>
							</span>
						</div>
					</a>

			<?php
				endforeach;
			endif;
			wp_reset_postdata();
			?>

		</section>
	</div>

</div>

<?php get_footer(); ?>