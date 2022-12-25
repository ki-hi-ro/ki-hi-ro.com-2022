<?php wp_reset_query(); ?>

<footer class="footer">
    <nav class="footer__nav">
        <?php
		$footer_nav = [
			[ 'ttl' => '趣味', 'tag' => [ ['music','音楽'], ['本', '本'], ['旅行', '旅行'] ] ],
			[ 'ttl' => 'サイト制作', 'tag' => [ ['html-css','HTML / CSS'], ['wordpress', 'WordPress'], ['jquery', 'jQuery'] ] ],
			[ 'ttl' => 'プログラミング', 'tag' => [ ['java','Java'], ['vue-js', 'Vue.js'], ['typescript', 'TypeScript'], ['プログラミング', 'その他'] ] ],
		];
		foreach ($footer_nav as $footer_nav_item) :
		?>
        <div class="footer__nav-contents nav-contents">
            <h4><?php echo $footer_nav_item['ttl']; ?></h4>
            <ul>
				<?php for($i = 0; $i < count($footer_nav_item['tag']); $i++) : ?>
					<li><a href="/tag/<?php echo $footer_nav_item['tag'][$i][0]; ?>/">- <?php echo $footer_nav_item['tag'][$i][1]; ?></a></li>
				<?php endfor; ?>
            </ul>
        </div>
        <?php endforeach; ?>
    </nav>
</footer>

<p class="page-top"><a class="page-top__link" href="#">ページ<br>最上部へ</a></p>

<?php wp_footer(); ?>
</body>

</html>