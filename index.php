<?php get_header();?>

<div class="top-box col-xs-12">
	<div id="particles-js"></div>
	<section class="author" itemprop="author" itemscope itemtype="http://schema.org/Person">
		<img src="https://ki-hi-ro.com/ki-hi-ro.com-2022/wp-content/uploads/2022/01/2022-profile.png" class="img-responsive img-circle">
		<h4>
			<span itemprop="name">Shibata Hiroki</span>
		</h4>
		<div class="author__contents">
			<p class="author-text">Web制作のフリーランスのエンジニアをしている柴田浩貴です。</p>
		</div>
	</section>

	<a href="<?php echo home_url('consultation'); ?>" class="consultation-bnr__wrap">
		<p>無料相談実施中</p>
		<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/consultation-bnr.png" class="consultation-bnr">
		<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/consultation-bnr-sp.png" class="consultation-bnr --sp">
	</a>

	<section class="top-contents">
		<a class="top-contents__card --service" href="<?php echo home_url('service'); ?>">
			<div class="card">
				<div class="card__imgframe service"></div>
				<div class="card__textbox">
					<div class="card__titletext">サービス一覧</div>
					<div class="card__overviewtext">
						<p>WEBサイトの更新サポートや<br>新規サイト制作など</p>
					</div>
				</div>
			</div>
		</a>
		<a class="top-contents__card --introduce" href="<?php echo home_url('introduce'); ?>">
			<div class="card">
				<div class="card__imgframe introduce"></div>
				<div class="card__textbox">
					<div class="card__titletext">自己紹介</div>
					<div class="card__overviewtext">
						<p>経歴など</p>
					</div>
				</div>
			</div>
		</a>
		<a class="top-contents__card --blog" href="<?php echo home_url('blog'); ?>">
			<div class="card last">
				<div class="card__imgframe blog"></div>
				<div class="card__textbox">
					<div class="card__titletext">ブログ</div>
					<div class="card__overviewtext">
						<ul>
							<li>技術ブログ</li>
							<li>学習ブログ</li>
							<li>雑記ブログ</li>
						</ul>
					</div>
				</div>
			</div>
		</a>
	</section>

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
</div>

<?php get_footer();?>
