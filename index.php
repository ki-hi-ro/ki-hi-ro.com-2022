<?php get_header();?>

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
				<a href="<?php the_permalink() ?>" class="new-blog__post top-card">
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
							<a href="<?php the_permalink() ?>" class="new-blog__post top-card">
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
			<section class="author sidebar__contents top-card" itemprop="author" itemscope itemtype="http://schema.org/Person">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/introduce/2022-04.png" class="img-responsive img-circle author__img">
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

			<section class="schedule sidebar__contents top-card">
				<h4>スケジュール</h4>
				<iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FTokyo&amp;showTabs=0&amp;showDate=1&amp;showPrint=0&amp;showTitle=0&amp;showNav=0&amp;showCalendars=0&amp;mode=AGENDA&amp;showTz=0&amp;src=a2hpcm8yMTM4QGdtYWlsLmNvbQ&amp;color=%23039BE5" style="border:solid 1px #777" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
				<p>※safariで閲覧すると「私はロボットではありません」という表示が出て、カレンダーが表示されない現象が起こる場合があります。カレンダーを表示させるには、Chromeなどの別のブラウザでご覧いただくか、設定 &gt; Safariの「サイト越えトラッキングを防ぐ」の設定をOFFしてください。</p>
			</section>

			<section class="concept sidebar__contents top-card">
				<h4>サイトのコンセプト</h4>
				<p>こちらのサイトでは、</p>
				<ul>
					<li>これまでに身につけてきたプログラミング知識などをアウトプットしていく「技術ブログ」</li>
					<li>新しいスキルについて学んだことを書いていく「学習ブログ」</li>
					<li>日常で感動したことなどについて書いていく「雑記ブログ」</li>
				</ul>
				<p>の3軸で発信していきます。</p>
			</section>

			<section class="sidebar__blog sidebar__contents top-card">
				<h4>技術ブログ</h4>

				<?php
				$args = array(
						'category_name' => 'skill-blog',
						'post_type' => 'post',
						'posts_per_page' => 5,
				);
				$myposts = get_posts($args);
				foreach ($myposts as $post):
						setup_postdata($post);
				?>
					<?php echo get_template_part('template-parts/sidebar-blog'); ?>
				<?php
				endforeach;
				wp_reset_postdata();
				?>

				<div class="more-link">
					<a href="<?php echo home_url('blog#skill-blog'); ?>">技術ブログ一覧<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"></a>
				</div>
			</section>

			<section class="sidebar__blog sidebar__contents top-card">
				<h4>学習ブログ</h4>

				<?php
				$args = array(
						'category_name' => 'study-blog',
						'post_type' => 'post',
						'posts_per_page' => 5,
				);
				$myposts = get_posts($args);
				foreach ($myposts as $post):
						setup_postdata($post);
				?>
					<?php echo get_template_part('template-parts/sidebar-blog'); ?>
				<?php
				endforeach;
				wp_reset_postdata();
				?>

				<div class="more-link">
					<a href="<?php echo home_url('blog#study-blog'); ?>">学習ブログ一覧<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"></a>
				</div>
			</section>

			<section class="sidebar__blog sidebar__contents top-card">
				<h4>雑記ブログ</h4>

				<?php
				$args = array(
						'category_name' => 'random-blog',
						'post_type' => 'post',
						'posts_per_page' => 5,
				);
				$myposts = get_posts($args);
				foreach ($myposts as $post):
						setup_postdata($post);
				?>
					<?php echo get_template_part('template-parts/sidebar-blog'); ?>
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
