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

				<nav class="nav-menu">
					<ul class="nav-menu__ul">
						<li><a href="<?php echo home_url('schedule'); ?>" class="schedule">スケジュールのお知らせ</a></li>
					</ul>
				</nav>
				<nav>
					<ul>
						<li><a href="#">Top</a></li>
						<li><a href="#">About</a></li>
						<li class="has-child"><a href="#">Service</a><!--子要素を持つ li にはhas-childというクラス名をつける-->
							<ul>
								<li><a href="#">Service Top</a></li>
								<li><a href="#">Service-1</a></li>
								<li class="has-child"><a href="#">Service-2</a>
									<ul>
										<li><a href="#">Service-2 Top</a></li>
										<li><a href="#">Service-2-1</a></li>
										<li><a href="#">Service-2-2</a></li>
										<li><a href="#">Service-2-3</a></li>
										<li><a href="#">Service-2-4</a></li>
									</ul>
								</li>
								<li><a href="#">Service-3</a></li>
							</ul>
						</li>
						<li class="has-child"><a href="#">Blog</a>
							<ul>
								<li><a href="#">Blog Top</a></li>
								<li><a href="#">Blog-1</a></li>
								<li><a href="#">Blog-2</a></li>
								<li><a href="#">Blog-3</a></li>
								<li><a href="#">Blog-4</a></li>
							</ul>
						</li>
					</ul>
				</nav>
			</div>
		</div>

	</header>

	<main id="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<div class="container">
			<div class="main-contents row justify-content-center">

				<article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
