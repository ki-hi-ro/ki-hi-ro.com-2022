<?php get_header(); ?>

<?php $slug = 'random-blog'; ?>

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
				<h2 class="random-blog__sec-ttl">雑記ブログ</h2>
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