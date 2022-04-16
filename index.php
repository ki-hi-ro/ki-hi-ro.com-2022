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
	<div class="top-contents__card">
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
	</div>
	<div class="top-contents__card">
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
	</div>
</section>
<style>
	.author-text {
		text-align: center;
	}
	.top-contents {
		display: flex;
		justify-content: center;
		padding: 0 20px;
	}
	.top-contents__card {
		width: calc( (100% - 30px) / 3 );
	}
	.top-contents__card:nth-child(2) {
		margin: 0 15px;
	}
	.card__img {
    margin: 0;
    height: 170px;
	}
	.card__img img {
		width: 100%;
	}
	.card__text {
    padding: 0 17px;
    border: 1px solid #707070;
    height: calc(100% - 170px);
	}
	.card__text h3 {
		margin-bottom: 0;
	}
	.card__text ul {
    margin-top: 8px;
    margin-bottom: 17px;
    line-height: 1.8;
	}
	.card__text p {
		margin-top: 8px;
		margin-bottom: 0;
	}
</style>

	<section class="skill-blog" id="skill-blog">
		<h2 class="skill-blog__sec-ttl">技術ブログ</h2>
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
												<span class="skill-blog__date">
													<?php echo get_the_date('Y.m.d'); ?>
												</span>
												<?php
    $posttags = get_the_tags();
    if ($posttags):
    ?>
												<span class="skill-blog__tag">
													<?php
    foreach ($posttags as $tag) {
        echo $tag->name . ' ';
    }
    ?>
												</span>
												<?php endif;?>
				<span class="skill-blog__ttl">
					<?php the_title();?>
				</span>
			</div>
		</a>

		<?php
endforeach;
wp_reset_postdata();
?>

		<!-- <button class="skill-blog__btn">
			<a class="skill-blog-btn__link" href="">技術ブログ一覧</a>
		</button> -->

	</section>

		<section class="study-blog" id="study-blog">
		<?php
$args = array(
    'category_name' => 'study-blog',
    'post_type' => 'post',
    'posts_per_page' => 10,
    'post_status' => 'publish',
);
$myposts = get_posts($args);
if ($myposts):
?>
		<h2 class="study-blog__sec-ttl">学習ブログ</h2>
		<?php
foreach ($myposts as $post):
    setup_postdata($post);
    ?>
										<a class="study-blog__link" href="<?php the_permalink();?>">
											<div class="study-blog__contents">
												<span class="study-blog__date">
													<?php echo get_the_date('Y.m.d'); ?>
												</span>
												<?php
    $posttags = get_the_tags();
    if ($posttags):
    ?>
												<span class="study-blog__tag">
													<?php
    foreach ($posttags as $tag) {
        echo $tag->name . ' ';
    }
    ?>
												</span>
												<?php endif;?>
				<span class="study-blog__ttl">
					<?php the_title();?>
				</span>
			</div>
		</a>

		<?php
endforeach;
endif;
wp_reset_postdata();
?>

		<!-- <button class="study-blog__btn">
			<a class="study-blog-btn__link" href="">学習ブログ一覧</a>
		</button> -->

	</section>

		<section class="random-blog" id="random-blog">
		<?php
$args = array(
    'category_name' => 'random-blog',
    'post_type' => 'post',
    'posts_per_page' => 10,
    'post_status' => 'publish',
);
$myposts = get_posts($args);
if ($myposts):
?>
		<h2 class="random-blog__sec-ttl">雑記ブログ</h2>
		<?php
foreach ($myposts as $post):
    setup_postdata($post);
    ?>
										<a class="random-blog__link" href="<?php the_permalink();?>">
											<div class="random-blog__contents">
												<span class="random-blog__date">
													<?php echo get_the_date('Y.m.d'); ?>
												</span>
												<?php
    $posttags = get_the_tags();
    if ($posttags):
    ?>
												<span class="random-blog__tag">
													<?php
    foreach ($posttags as $tag) {
        echo $tag->name . ' ';
    }
    ?>
												</span>
												<?php endif;?>
				<span class="random-blog__ttl">
					<?php the_title();?>
				</span>
			</div>
		</a>

		<?php
endforeach;
endif;
wp_reset_postdata();
?>

		<!-- <button class="random-blog__btn">
			<a class="random-blog-btn__link" href="">雑記ブログ一覧</a>
		</button> -->

	</section>

	<section class="twitter">
		<h2 class="twitter__ttl">Twitter</h2>
		<a class="twitter-timeline" data-width="300" data-height="600" data-theme="light" href="https://twitter.com/2021_shibata?ref_src=twsrc%5Etfw">Tweets by 2021_shibata</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	</section>
</div>

<?php get_footer();?>
