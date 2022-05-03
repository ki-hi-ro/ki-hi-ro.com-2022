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
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
				</a>
			<?php endforeach; endif; wp_reset_postdata(); ?>

		<?php
		endforeach;
		?>

	</section>

	<section class="top-contents">
		<section class="main-column">

				<?php
				$offset_num = 0;
				for ($i = 1; $i <= 3; $i++) :

					$offset_num ++;
					$category_names = ["skill-blog", "study-blog", "random-blog"];

					foreach($category_names as $category_name) :
						$cat_posts = get_posts(array(
								'post_type' => 'post',
								'category_name' => $category_name,
								'offset' => $offset_num,
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
				endfor;
				?>
				<a class="top-blog-list-link" href="<?php echo home_url('blog'); ?>">ブログ一覧</a>

		</section>

		<aside class="sidebar">
			<section class="author" itemprop="author" itemscope itemtype="http://schema.org/Person">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/introduce/2022-04.png" class="img-responsive img-circle">
				<h4>
					<span itemprop="name">Shibata Hiroki</span>
				</h4>
				<hr>
				<div class="author__contents">
					<p class="author-text">
						造園学科の大学を卒業後、とあるビジネスホテルのフロント職を経験し、TECH::EXPERTでプログラミングを学びました。<br>
						現在は、WEB制作のフリーランスとして日々活動しています。
					</p>
					<div class="more-link">
						<a href="<?php echo home_url('introduce'); ?>">自己紹介ページ<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"></a>
					</div>
				</div>
			</section>

			<section class="concept">
				<h4>サイトのコンセプト</h4>
				<p>こちらのサイトでは、</p>
				<ul>
					<li>これまでに身につけてきたプログラミング知識などをアウトプットしていく「技術ブログ」</li>
					<li>新しいスキルについて学んだことを書いていく「学習ブログ」</li>
					<li>日常で感動したことなどについて書いていく「雑記ブログ」</li>
				</ul>
				<p>の3軸で発信していきます。</p>
			</section>

			<section class="sidebar__skill-blog">
				<h4>技術ブログ</h4>

				<?php
				$args = array(
						'category_name' => 'skill-blog',
						'post_type' => 'post',
						'posts_per_page' => 10,
				);
				$myposts = get_posts($args);
				foreach ($myposts as $post):
						setup_postdata($post);
				?>
					<a class="skill-blog__link" href="<?php the_permalink();?>">
						<div class="skill-blog__contents">
							<div class="skill-blog__meta">
								<span class="skill-blog__date">
									<?php echo get_the_date('Y.m.d'); ?>
								</span>
								<?php
								$posttags = get_the_tags();
								if ($posttags):
								?>
									<span class="skill-blog__tag">
										<?php foreach ($posttags as $tag) { echo $tag->name . ' '; } ?>
									</span>
								<?php
								endif;
								?>
							</div>

							<span class="skill-blog__ttl">
								<?php the_title();?>
							</span>
						</div>
					</a>
				<?php
				endforeach;
				wp_reset_postdata();
				?>

				<div class="more-link">
					<a href="<?php echo home_url('blog#skill-blog'); ?>">技術ブログ一覧<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"></a>
				</div>
			</section>

			<section class="sidebar__study-blog">
				<h4>学習ブログ</h4>

				<?php
				$args = array(
						'category_name' => 'study-blog',
						'post_type' => 'post',
						'posts_per_page' => 10,
				);
				$myposts = get_posts($args);
				foreach ($myposts as $post):
						setup_postdata($post);
				?>
					<a class="study-blog__link" href="<?php the_permalink();?>">
						<div class="study-blog__contents">
							<div class="study-blog__meta">
								<span class="study-blog__date">
									<?php echo get_the_date('Y.m.d'); ?>
								</span>
								<?php
								$posttags = get_the_tags();
								if ($posttags):
								?>
									<span class="study-blog__tag">
										<?php foreach ($posttags as $tag) { echo $tag->name . ' '; } ?>
									</span>
								<?php
								endif;
								?>
							</div>

							<span class="study-blog__ttl">
								<?php the_title();?>
							</span>
						</div>
					</a>
				<?php
				endforeach;
				wp_reset_postdata();
				?>

				<div class="more-link">
					<a href="<?php echo home_url('blog#study-blog'); ?>">学習ブログ一覧<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"></a>
				</div>
			</section>

			<section class="sidebar__random-blog">
				<h4>雑記ブログ</h4>

				<?php
				$args = array(
						'category_name' => 'random-blog',
						'post_type' => 'post',
						'posts_per_page' => 10,
				);
				$myposts = get_posts($args);
				foreach ($myposts as $post):
						setup_postdata($post);
				?>
					<a class="random-blog__link" href="<?php the_permalink();?>">
						<div class="random-blog__contents">
							<div class="random-blog__meta">
								<span class="random-blog__date">
									<?php echo get_the_date('Y.m.d'); ?>
								</span>
								<?php
								$posttags = get_the_tags();
								if ($posttags):
								?>
									<span class="random-blog__tag">
										<?php foreach ($posttags as $tag) { echo $tag->name . ' '; } ?>
									</span>
								<?php
								endif;
								?>
							</div>

							<span class="random-blog__ttl">
								<?php the_title();?>
							</span>
						</div>
					</a>
				<?php
				endforeach;
				wp_reset_postdata();
				?>

				<div class="more-link">
					<a href="<?php echo home_url('blog#random-blog'); ?>">雑記ブログ一覧<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"></a>
				</div>
			</section>


		</aside>
	</section>

<?php get_footer();?>
