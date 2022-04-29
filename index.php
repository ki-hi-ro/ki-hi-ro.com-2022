<?php get_header();?>

	<div id="particles-js"></div>

	<section class="top-new-blog">
		<?php
		$category_names = ["skill-blog", "study-blog", "random-blog"];

		foreach($category_names as $category_name) :
			$cat_posts = get_posts(array(
					'post_type' => 'post',
					'category_name' => $category_name,
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
			));
			global $post;
			if($cat_posts): foreach($cat_posts as $post): setup_postdata($post); ?>
				<a href="<?php the_permalink() ?>" class="new-blog__post">
					<p class="post__date"><?php the_time('Y/m/d') ?></p>
					<h3><?php the_title(); ?></h3>
					<span class="post__category"><?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?></span>
					<?php if(has_post_thumbnail()): ?>
						<?php the_post_thumbnail(); ?>
					<?php endif; ?>
					<?php the_excerpt(); ?>
				</a>
			<?php endforeach; endif; wp_reset_postdata(); ?>

		<?php
		endforeach;
		?>

	</section>

	<section class="top-contents">
		<section class="main-column">

				<?php
				$category_names = ["skill-blog", "study-blog", "random-blog"];

				foreach($category_names as $category_name) :
					$cat_posts = get_posts(array(
							'post_type' => 'post',
							'category_name' => $category_name,
							'posts_per_page' => 1,
							'orderby' => 'date',
							'order' => 'DESC'
					));
					global $post;
					if($cat_posts): foreach($cat_posts as $post): setup_postdata($post); ?>
						<a href="<?php the_permalink() ?>" class="new-blog__post">
							<p class="post__date"><?php the_time('Y/m/d') ?></p>
							<h3><?php the_title(); ?></h3>
							<span class="post__category"><?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?></span>
							<?php if(has_post_thumbnail()): ?>
								<?php the_post_thumbnail(); ?>
							<?php endif; ?>
							<?php the_excerpt(); ?>
						</a>
					<?php endforeach; endif; wp_reset_postdata(); ?>

				<?php
				endforeach;
				?>

		</section>

		<aside class="sidebar">
			<section class="author" itemprop="author" itemscope itemtype="http://schema.org/Person">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/introduce/2022-04.png" class="img-responsive img-circle">
				<h4>
					<span itemprop="name">Shibata Hiroki</span>
				</h4>
				<div class="author__contents">
					<p class="author-text">Web制作のフリーランスのエンジニアをしている柴田浩貴です。</p>
				</div>
			</section>

		</aside>
	</section>

<?php get_footer();?>
