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
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">

	<!-- schema.org -->
	<meta itemprop="name" content="<?php the_title(''); ?>">
	<meta itemprop="description" content="<?php the_permalink() ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		<div class="container header-container">
			<div class="header-nav row align-items-center">

				<div class="blogname">
					<?php if (is_front_page()) { ?>
					<h1 class="title">
					<?php } ?>
						<a href="<?php echo home_url(); ?>" class="sitename">
								<span class="sitename main">ki-hi-ro.com</span>
						</a>
					<?php if (is_front_page()) { ?>
					</h1>
					<?php } ?>
				</div>

				<nav class="nav-menu">
					<ul class="nav-menu__ul">
						<li><a href="<?php echo home_url('schedule'); ?>" class="schedule">スケジュールのお知らせ</a></li>
					</ul>
				</nav>

			</div>
		</div>

	</header>

	<style>
		/* ----------------------------------------------------------------------
			共通スタイル
		---------------------------------------------------------------------- */
		* {
			box-sizing: border-box;
		}
		a {
			color: #337ab7;
    	text-decoration: none;
			background-color: transparent;
			cursor: pointer;
			transition: all 0.2s ease-in-out;
		}
		html {
    	margin-top: 0!important;
		}

		/* ----------------------------------------------------------------------
			Bootstrap
		---------------------------------------------------------------------- */
		.row {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			margin-right: -15px;
			margin-left: -15px;
		}
		.justify-content-center {
			-ms-flex-pack: center!important;
			justify-content: center!important;
		}
		.col-xs-12 {
			width: 100%;
			float: left;
			position: relative;
			min-height: 1px;
			padding-left: 15px;
			padding-right: 15px;
		}
		/* ----------------------------------------------------------------------
			ヘッダー
		---------------------------------------------------------------------- */
		header {
			position: relative;
			padding-bottom: 0;
		}
		.container {
			margin-right: auto;
			margin-left: auto;
			padding-left: 15px;
			padding-right: 15px;
		}
		.header-nav {
			margin: 2rem auto;
			text-align: center;
		}
		header .blogname {
			padding: 0;
			margin-top: 0;
		}
		header h1.title {
			margin-top: -2px;
			margin-bottom: 0;
			line-height: 30px;
		}
		span.sitename.main {
			color: #313131db;
			font-size: 30px;
			font-family: Helvetica Neue;
			letter-spacing: 0.1px;
			font-weight: 500;
		}
		.nav-menu {
    	margin-left: auto;
		}
		.nav-menu__ul {
			list-style: none;
			margin-bottom: 0;
		}
		header nav ul li a:hover {
			text-decoration: none;
			color: #313131db;
		}
		@media (min-width: 768px) {
			.container {
				width: 750px;
			}
			.header-nav {
				margin: 40px auto 20px;
				max-width: 100%;
			}
			.nav-menu__ul {
				display: -webkit-box;
				display: -ms-flexbox;
				display: flex;
				-webkit-box-align: center;
				-ms-flex-align: center;
				align-items: center;
				-ms-flex-pack: distribute;
				justify-content: space-around;
			}
		}
		@media (min-width: 992px) {
			.container {
				width: 970px;
			}
		}
		@media (min-width: 1024px) {
			.header-nav {
				width: 100%;
				max-width: 900px;
			}
		}
		@media (min-width: 1000px) and (max-width: 1023px) {
			.header-nav {
				max-width: 845px;
			}
		}
		@media (min-width: 1200px) {
			.container {
				width: 1170px;
			}
			.header-nav {
				margin: 4rem auto 1rem;
			}
			header .blogname {
				margin: 10px 0;
			}
		}
		@media (max-width: 1199px) {
			.header-container {
				padding-left: 0;
				padding-right: 0;
			}
		}
		@media (max-width: 999px) {
			.header-nav {
				max-width: 720px;
			}
		}
		@media (min-width: 721px) and (max-width: 767px) {
			.header-nav {
				max-width: 100%;
			}
		}
		@media (max-width: 767px) {
			.header-nav {
				padding: 0 15px;
			}
			span.sitename.main {
				font-size: 20px;
			}
			.nav-menu__ul {
				padding: 0;
    		margin: 0;
			}
			.nav-menu__ul li {
				font-size: 14px;
			}
			.home .nav-menu__ul {
				margin-top: 2px;
			}
		}
	</style>

	<main id="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<div class="container">
			<div class="main-contents row justify-content-center">

				<article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
