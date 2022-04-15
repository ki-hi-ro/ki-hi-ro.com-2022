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

	<main id="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<div class="container">
			<div class="main-contents row justify-content-center">

				<article itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
