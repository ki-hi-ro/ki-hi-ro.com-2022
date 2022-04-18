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
		<a class="top-contents__card" href="<?php echo home_url('service'); ?>">
			<div class="card">
				<div class="card__imgframe introduce"></div>
				<div class="card__textbox">
					<div class="card__titletext">サービス一覧</div>
					<div class="card__overviewtext">
						<p>WEBサイトの更新サポートや<br>新規サイト制作など</p>
					</div>
				</div>
			</div>
		</a>
		<a class="top-contents__card" href="<?php echo home_url('introduce'); ?>">
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
		<a class="top-contents__card" href="<?php echo home_url('blog'); ?>">
			<div class="card">
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
</div>

<?php get_footer();?>
