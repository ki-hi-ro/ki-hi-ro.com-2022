<!DOCTYPE HTML>
<html lang="ja">

<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-MLVT1B3MQP"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'G-MLVT1B3MQP');
	</script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if (is_archive() || is_search() || is_tag() || is_paged()) : ?>
		<meta name="robots" content="noindex,follow">
	<?php endif; ?>

	<title>
		<?php
		global $page, $paged;
		if (is_single() || is_page() || is_archive() || is_search()) {
			wp_title('|', true, 'right');
		} elseif (is_404()) {
			echo '404 |';
		}
		bloginfo('name');
		if ($paged >= 2 || $page >= 2) {
			echo '-' . sprintf('%sページ', max($paged, $page));
		}
		?>
	</title>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico">

	<!-- schema.org -->
	<meta itemprop="name" content="<?php the_title(''); ?>">
	<meta itemprop="description" content="<?php the_permalink() ?>">

	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/slick-theme.css" />


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
						<li class="has-child"><a href="<?php echo home_url('service'); ?>">Service</a>
							<ul>
								<li><a href="<?php echo home_url('service/#web-update'); ?>">WEBサイトの更新サポート</a></li>
								<li><a href="<?php echo home_url('service/#new-site-coding'); ?>">新規サイトコーディング</a></li>
							</ul>
						</li>
						<li class="has-child"><a href="<?php echo home_url('introduce'); ?>">Introduce</a>
							<ul>
								<li><a href="<?php echo home_url('introduce/#message'); ?>">メッセージ</a></li>
								<li><a href="<?php echo home_url('introduce/#address'); ?>">自宅兼事務所</a></li>
								<li><a href="<?php echo home_url('introduce/#twitter'); ?>">Twitter</a></li>
							</ul>
						</li>
						<li class="has-child"><a href="<?php echo home_url('blog'); ?>">Blog</a>
							<?php echo get_template_part('template-parts/nav-blog'); ?>
						</li>
						<li class="has-child"><a>Others</a>
							<ul>
								<li><a href="<?php echo home_url('schedule'); ?>">スケジュールのお知らせ</a></li>
								<li><a href="<?php echo home_url('contact'); ?>">お問い合わせ</a></li>
								<li><a href="<?php echo home_url('consultation'); ?>">WEBに関する無料相談</a></li>
							</ul>
						</li>
					</ul>
				</nav>

				<div class="openbtn1"><span></span><span></span><span></span></div>
				<nav class="sp-nav">
					<ul>
						<li><a class="sp-nav__top" href="<?php echo home_url(); ?>">Top</a></li>
						<li><a class="sp-nav__service" href="<?php echo home_url('service'); ?>">Service</a></li>
						<li><a href="<?php echo home_url('introduce'); ?>">Introduce</a></li>
						<li><a href="<?php echo home_url('blog'); ?>">Blog</a></li>
						<li><a class="sp-nav__contact" href="<?php echo home_url('contact'); ?>">Contact</a></li>
					</ul>
				</nav>

			</div>
		</div>
	</header>

	<main id="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<div class="container">
			<div class="main-contents">

				<article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">