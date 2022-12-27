<?php require('data/navigation.php'); ?>

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
	<meta name=”description” content=”2019年末、TECH::EXPERTでプログラミングを経験後に、WEB制作のフリーランスとして活動を続けてきました。このブログでは、「これまでの仕事」「技術」「学習」「雑記」の4つのカテゴリーで発信していきます。“>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico">

	<!-- schema.org -->
	<meta itemprop="name" content="<?php the_title(''); ?>">
	<meta itemprop="description" content="<?php the_permalink() ?>">

	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<?php wp_head(); ?>
</head>

<body <?php body_class('kihiro-body front-page'); ?>>

	<header id="header" class="header">
		<div class="header__container">
			<div class="header__contents">
				<div class="header__logo">
					<a class="header__sitename-link" href="<?php echo home_url(); ?>">
						<span class="header__sitename-text">ki-hi-ro.com</span>
					</a>
				</div>
				<nav>
					<ul class="header__ul">
						<?php 
						$current_cat_slug = get_query_var('category_name'); 
						foreach ($nav as $nav_item) :
						?>
							<li class="header__li --has-child">
								<div class="header__has-child-li"><img class="header__has-child-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/expand-more.svg"><?php echo $nav_item['ttl']; ?></div>
								<ul class="header__child-ul">
									<?php for($i = 0; $i < count($nav_item['tag']); $i++) : ?>
										<li class="header__child-li">
											<a class="header__child-li-link" href="/tag/<?php echo $nav_item['tag'][$i][0]; ?>"><span class="header__sp-child-line">- </span><?php echo $nav_item['tag'][$i][1]; ?></a>
										</li>
									<?php endfor; ?>
								</ul>
							</li>
						<?php endforeach; ?>
						<li class="header__li"><a class="header__li-link" href="<?php echo home_url('all-article'); ?>">これまでに書いた記事<span class="header__sp-none"></span></a></li>
					</ul>
					<div class="header__hamburger">
						<span></span><span></span>
					</div>
				</nav>
			</div>
		</div>
	</header>