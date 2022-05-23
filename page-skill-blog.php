<?php get_header(); ?>

<?php $slug = 'skill-blog'; ?>

<div class="top-box col-xs-12">

	<div class="page__contents-container">
		<section class="skill-blog" id="skill-blog">
			<h2 class="skill-blog__sec-ttl">技術ブログ</h2>
			<?php
			$args = array(
				'category_name' => 'skill-blog',
				'post_type' => 'post',
				'posts_per_page' => -1,
			);
			$myposts = get_posts($args);
			foreach ($myposts as $post) :
				setup_postdata($post);
			?>
				<a class="skill-blog__link" href="<?php the_permalink(); ?>">
					<div class="skill-blog__contents">
						<span class="skill-blog__date">
							<?php echo get_the_date('Y.m.d'); ?>
						</span>
						<?php
						$posttags = get_the_tags();
						if ($posttags) :
						?>
							<span class="skill-blog__tag">
								<?php
								foreach ($posttags as $tag) {
									echo $tag->name . ' ';
								}
								?>
							</span>
						<?php endif; ?>
						<span class="skill-blog__ttl">
							<?php the_title(); ?>
						</span>
					</div>
				</a>

			<?php
			endforeach;
			wp_reset_postdata();
			?>

		</section>
	</div>

</div>

<?php get_footer(); ?>