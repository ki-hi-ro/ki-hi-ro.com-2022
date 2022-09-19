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
	<meta name=”description” content=”WEB制作のコーディングをフリーランスとして行なっています。対応可能な業務は、WordPressやEC-CUBEなどです。レスポンシブコーディングも出来ます。“>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico">

	<!-- schema.org -->
	<meta itemprop="name" content="<?php the_title(''); ?>">
	<meta itemprop="description" content="<?php the_permalink() ?>">

	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/slick-theme.css" />


	<?php wp_head(); ?>
</head>

<body <?php body_class('kihiro-body'); ?>>

	<header class="header">
		<div class="header__container">
			<div class="header__contents header-nav">
				<div class="header__logo blogname">
					<a class="header__sitename-link" href="<?php echo home_url(); ?>">
						<span class="header__sitename-text sitename main">Shiata Hiroki</span>
					</a>
					<span class="header__sub-sitename sitename sub">WEB制作フリーランスエンジニア</span>
				</div>
				<nav class="header__nav-pc pc-nav">
					<ul class="header__ul-pc">
						<li class="header__li-pc"><a class="header__li-pc-link header-nav-link" href="#contact">お問い合わせ</a></li>
						<li class="header__li-pc"><a class="header__li-pc-link" href="#author">自己紹介</a></li>
						<li class="header__li-pc"><a class="header__li-pc-link" href="#what-i-did">これまでの仕事</a></li>
						<li class="header__li-pc header__li-pc--haschild has-child"><a class="header__li-pc-link" href="#blog">ブログ</a>
							<ul class="header__has-child-ul">
								<li class="header__has-child-li pc-nav__skill"><a class="header__has-child-li-link --skill" href="#skill-blog">技術ブログ</a></li>
								<li class="header__has-child-li pc-nav__study"><a class="header__has-child-li-link --study" href="#study-blog">学習ブログ</a></li>
								<li class="header__has-child-li pc-nav__random"><a class="header__has-child-li-link --random" href="#random-blog">雑記ブログ</a></li>
							</ul>
						</li>
					</ul>
				</nav>
				<div class="header__open-btn openbtn1">
					<span class="header__open-btn-line"></span>
					<span class="header__open-btn-line"></span>
					<span class="header__open-btn-line"></span>
				</div>
				<nav class="header__nav-sp sp-nav">
					<div class="header__sp-site-ttl header__logo blogname">
						<a class="header__sitename-link sitename" href="<?php echo home_url(); ?>">
							<span class="header__sp-sitename-logo sitename main">Shiata Hiroki</span>
						</a>
						<span class="header__sp-sitename-sub sitename sub">WEB制作フリーランスエンジニア</span>
					</div>
					<ul class="header__sp-ul">
						<li class="header__sp-li"><a class="header_sp-li-link sp-nav__top" href="#contact">お問い合わせ</a></li>
						<li class="header__sp-li"><a class="header_sp-li-link sp-nav__top" href="#author">自己紹介</a></li>
						<li class="header__sp-li"><a class="header_sp-li-link sp-nav__top" href="#what-i-did">これまでの仕事</a></li>
						<li class="header__sp-li"><span class="header_sp-li-link sp-nav__top sp-nav-blog">--- ブログ ---</span></li>
						<li class="header__sp-li"><a class="header_sp-li-link sp-nav-blog" href="#skill-blog">技術ブログ</a></li>
						<li class="header__sp-li"><a class="header_sp-li-link sp-nav-blog" href="#study-blog">学習ブログ</a></li>
						<li class="header__sp-li"><a class="header_sp-li-link sp-nav-blog" href="#random-blog">雑記ブログ</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</header>