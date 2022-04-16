<?php get_header();?>

<div class="top-box col-xs-12">
	<section class="author" itemprop="author" itemscope itemtype="http://schema.org/Person">
		<img src="https://ki-hi-ro.com/ki-hi-ro.com-2022/wp-content/uploads/2022/01/2022-profile.png" class="img-responsive img-circle">
		<h4>
			<span itemprop="name">Shibata Hiroki</span>
		</h4>
		<hr>
		<div class="author__contents">
			<p class="author-text">Web制作のフリーランスのエンジニアをしている柴田浩貴です。</p>
		</div>
	</section>

	<section class="top-contents">
		<!-- <div class="top-contents__card">
			<figure class="card__img">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/serivice.png" alt="サービス">
			</figure>
			<div class="card__text">
				<h3>サービス一覧</h3>
				<p>WEBサイトの更新サポートや<br>新規サイト制作など</p>
			</div>
		</div>
		<div class="top-contents__card">
			<figure class="card__img">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/introduce.png" alt="自己紹介">
			</figure>
			<div class="card__text">
				<h3>自己紹介</h3>
				<p>経歴や趣味など</p>
			</div>
		</div> -->
		<a class="top-contents__card" href="<?php echo home_url('blog'); ?>">
			<figure class="card__img">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/blog.png" alt="ブログ">
			</figure>
			<div class="card__text">
				<h3>ブログ</h3>
				<ul>
					<li>技術ブログ</li>
					<li>学習ブログ</li>
					<li>雑記ブログ</li>
				</ul>
			</div>
		</a>
	</section>
</div>

<?php get_footer();?>
