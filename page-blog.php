<?php get_header();?>

<main class="container">
	<section class="top-section" id="what-i-did">
		<h4>これまでの対応内容</h4>
		<p>これまでにクラウドソーシングや、エージェント、地元のWEB制作会社経由で様々なお仕事を経験しました。どんな仕事をしてきたのかを、掲載可能な範囲で投稿していきます。</p>
		<?php
					$args = array(
							'category_name' =>
		'what-i-did', 'post_type' => 'post', 'posts_per_page' => -1, ); $myposts =
		get_posts($args); foreach ($myposts as $post): setup_postdata($post); ?>
		<?php echo get_template_part('template-parts/sidebar-blog'); ?>
		<?php
					endforeach;
					wp_reset_postdata();
					?>
	</section>

	<section class="top-section sidebar__blog sidebar__contents" id="skill-blog">
		<h4>技術ブログ</h4>

		<p>これまでに身につけてきたWEB制作に必要なスキルを、テーマを決めて投稿していきます。</p>

		<?php
					$args = array(
							'category_name' =>
		'skill-blog', 'post_type' => 'post', 'posts_per_page' => -1, ); $myposts =
		get_posts($args); foreach ($myposts as $post): setup_postdata($post); ?>
		<?php echo get_template_part('template-parts/sidebar-blog'); ?>
		<?php
					endforeach;
					wp_reset_postdata();
					?>
	</section>

	<section class="top-section sidebar__blog sidebar__contents" id="study-blog">
		<h4>学習ブログ</h4>

		<p>参考書などで学んだことをテーマにしたブログ記事を投稿していきます。</p>

		<?php
					$args = array(
							'category_name' =>
		'study-blog', 'post_type' => 'post', 'posts_per_page' => -1, ); $myposts =
		get_posts($args); foreach ($myposts as $post): setup_postdata($post); ?>
		<?php echo get_template_part('template-parts/sidebar-blog'); ?>
		<?php
					endforeach;
					wp_reset_postdata();
					?>
	</section>

	<section class="top-section sidebar__blog sidebar__contents" id="random-blog">
		<h4>雑記ブログ</h4>

		<p>日常で感動したことなどを、息抜きに投稿していきます。</p>

		<?php
					$args = array(
							'category_name' =>
		'random-blog', 'post_type' => 'post', 'posts_per_page' => -1, ); $myposts =
		get_posts($args); foreach ($myposts as $post): setup_postdata($post); ?>
		<?php echo get_template_part('template-parts/sidebar-blog'); ?>
		<?php
					endforeach;
					wp_reset_postdata();
					?>
	</section>
</main>

<?php get_footer();?>
