<?php get_header(); ?>

<?php $slug = 'study-blog'; ?>

<div class="top-box col-xs-12">

	<div class="page__contents-container">
		<section class="<?php echo $slug; ?>" id="<?php echo $slug; ?>">
			<?php
			$args = array(
				'category_name' => $slug,
				'post_type' => 'post',
				'posts_per_page' => -1,
				'post_status' => 'publish',
			);
			$myposts = get_posts($args);
			if ($myposts) :
			?>
				<h2 class="<?php echo $slug; ?>__sec-ttl">学習ブログ</h2>
				<?php
				foreach ($myposts as $post) :
					setup_postdata($post);
				?>
					<a class="<?php echo $slug; ?>__link" href="<?php the_permalink(); ?>">
						<div class="<?php echo $slug; ?>__contents">
							<span class="<?php echo $slug; ?>__date">
								<?php echo get_the_date('Y.m.d'); ?>
							</span>
							<?php
							$posttags = get_the_tags();
							if ($posttags) :
							?>
								<span class="<?php echo $slug; ?>__tag">
									<?php
									foreach ($posttags as $tag) {
										echo $tag->name . ' ';
									}
									?>
								</span>
							<?php endif; ?>
							<span class="<?php echo $slug; ?>__ttl">
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