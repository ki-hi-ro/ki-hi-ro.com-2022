<!DOCTYPE HTML>
<html lang="ja">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-MLVT1B3MQP"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-MLVT1B3MQP');
	</script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if(is_archive() || is_search() || is_tag() || is_paged()) : ?>
		<meta name="robots" content="noindex,follow">
	<?php endif; ?>

	<title>
	<?php
	global $page, $paged;
	if(is_single() || is_page() || is_archive() || is_search()) {
	  wp_title('|',true,'right');
	} elseif(is_404()) {
		echo'404 |';
	}
		bloginfo('name');
		if($paged >= 2 || $page >= 2) {
		echo'-'.sprintf('%sページ', max($paged,$page));
	}
	?>
	</title>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico">

	<!-- schema.org -->
	<meta itemprop="name" content="<?php the_title(''); ?>">
	<meta itemprop="description" content="<?php the_permalink() ?>">

	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/slick-theme.css"/>


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		<div class="container header-container">
			<div class="header-nav row">
					<div class="blogname">
						<a href="<?php echo home_url(); ?>" class="sitename">
							<span class="sitename main">ki-hi-ro.com</span>
						</a>
						<span class="sitename sub">WEB制作フリーランスエンジニア</span>
					</div>
					<nav class="pc-nav">
						<ul>
							<li><a href="<?php echo home_url('blog/#skill-blog'); ?>">お問い合わせ</a></li>
							<li><a href="<?php echo home_url('blog/#skill-blog'); ?>">対応可能な項目</a></li>
							<li><a href="<?php echo home_url('blog/#skill-blog'); ?>">これまでの対応内容</a></li>
							<li class="has-child"><a href="<?php echo home_url('blog'); ?>">ブログ</a>
								<ul>
									<li><a href="<?php echo home_url('blog/#skill-blog'); ?>">技術ブログ</a></li>
									<li><a href="<?php echo home_url('blog/#study-blog'); ?>">学習ブログ</a></li>
									<li><a href="<?php echo home_url('blog/#random-blog'); ?>">雑記ブログ</a></li>
								</ul>
							</li>
						</ul>
					</nav>

					<div class="openbtn1"><span></span><span></span><span></span></div>
					<nav class="sp-nav">
						<ul>
							<li><a class="sp-nav__top" href="<?php echo home_url(); ?>">お問い合わせ</a></li>
							<li><a class="sp-nav__top" href="<?php echo home_url(); ?>">対応可能な項目</a></li>
							<li><a class="sp-nav__top" href="<?php echo home_url(); ?>">これまでの対応内容</a></li>
							<li><a class="sp-nav__top" href="<?php echo home_url(); ?>">技術ブログ</a></li>
							<li><a class="sp-nav__top" href="<?php echo home_url(); ?>">学習ブログ</a></li>
							<li><a class="sp-nav__top" href="<?php echo home_url(); ?>">雑記ブログ</a></li>
						</ul>
					</nav>

			</div>
		</div>
	</header>

	<main id="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<div class="container">
			<div class="main-contents">

				<article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
