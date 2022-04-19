		</div>
</div>

</main>

<?php wp_reset_query(); ?>

<footer>
	<nav>
		<div class="nav-contents">
			<h4><a href="<?php echo home_url('service'); ?>">サービス一覧</a></h4>
			<ul>
				<li><a href="<?php echo home_url('service#web-update'); ?>">WEBサイトの更新サポート</a></li>
				<li><a href="<?php echo home_url('service#new-site-coding'); ?>">新規サイトコーディング</a></li>
			</ul>
		</div>
		<div class="nav-contents">
			<h4><a href="<?php echo home_url('introduce'); ?>">自己紹介</h4>
			<ul>
				<li><a href="<?php echo home_url('introduce#message'); ?>">メッセージ</a></li>
				<li><a href="https://twitter.com/2021_shibata" target="new">Twitter</a></li>
				<!-- <li><a href="">自宅兼事務所</a></li> -->
			</ul>
		</div>
		<div class="nav-contents">
			<h4><a href="<?php echo home_url('blog'); ?>">ブログ</a></h4>
			<ul>
				<li><a href="<?php echo home_url('blog#skill-blog'); ?>">技術ブログ</a></li>
				<li><a href="<?php echo home_url('blog#study-blog'); ?>">学習ブログ</a></li>
				<li><a href="<?php echo home_url('blog#random-blog'); ?>">雑記ブログ</a></li>
			</ul>
		</div>
		<div class="nav-contents">
			<h4>その他</h4>
			<ul>
				<li><a href="<?php echo home_url('schedule'); ?>">スケジュールのお知らせ</a></li>
				<li><a href="<?php echo home_url('contact'); ?>">お問い合わせ</a></li>
			</ul>
		</div>
	</nav>
</footer>

<?php wp_footer(); ?>
</body>
</html>