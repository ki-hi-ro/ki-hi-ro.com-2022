<?php wp_reset_query(); ?>

<footer>
	<nav>
		<div class="nav-contents">
			<h4><a href="<?php echo home_url('contact'); ?>">お問い合わせ</a></h4>
		</div>

		<div class="nav-contents">
			<h4>仕事</h4>
			<ul>
				<li><a href="<?php echo home_url('what-i-can'); ?>">対応可能な項目</a></li>
				<li><a href="<?php echo home_url('what-i-did'); ?>">これまでの仕事</a></li>
			</ul>
		</div>

		<div class="nav-contents">
			<h4><a href="<?php echo home_url('blog'); ?>">ブログ</a></h4>
			<ul>
				<li><a href="<?php echo home_url('category/skill-blog/'); ?>">技術ブログ</a></li>
				<li><a href="<?php echo home_url('category/study-blog/'); ?>">学習ブログ</a></li>
				<li><a href="<?php echo home_url('category/random-blog/'); ?>">雑記ブログ</a></li>
			</ul>
		</div>
	</nav>
</footer>

<?php wp_footer(); ?>
</body>
</html>