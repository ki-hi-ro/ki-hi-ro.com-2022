<?php get_header(); ?>

<div class="top-box col-xs-12">

	<div class="page__contents-container">
		<section class="skill-blog" id="what-i-did">
			<h2 class="skill-blog__sec-ttl">これまでの対応内容</h2>
			<?php
			$args = array(
				'category_name' => 'what-i-did',
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

		<section class="study-blog" id="study-blog">
			<?php
			$args = array(
				'category_name' => 'study-blog',
				'post_type' => 'post',
				'posts_per_page' => -1,
				'post_status' => 'publish',
			);
			$myposts = get_posts($args);
			if ($myposts) :
			?>
				<h2 class="study-blog__sec-ttl">学習ブログ</h2>
				<?php
				foreach ($myposts as $post) :
					setup_postdata($post);
				?>
					<a class="study-blog__link" href="<?php the_permalink(); ?>">
						<div class="study-blog__contents">
							<span class="study-blog__date">
								<?php echo get_the_date('Y.m.d'); ?>
							</span>
							<?php
							$posttags = get_the_tags();
							if ($posttags) :
							?>
								<span class="study-blog__tag">
									<?php
									foreach ($posttags as $tag) {
										echo $tag->name . ' ';
									}
									?>
								</span>
							<?php endif; ?>
							<span class="study-blog__ttl">
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