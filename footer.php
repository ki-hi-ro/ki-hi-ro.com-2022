<?php require('data/navigation.php'); ?>

<?php wp_reset_query(); ?>

<footer class="footer">
    <nav class="footer__nav">
        <?php
		foreach ($nav as $nav_item) :
		?>
        <div class="footer__nav-contents nav-contents">
            <h4><?php echo $nav_item['ttl']; ?></h4>
            <ul>
				<?php for($i = 0; $i < count($nav_item['tag']); $i++) : ?>
					<li><a href="/tag/<?php echo $nav_item['tag'][$i][0]; ?>/">- <?php echo $nav_item['tag'][$i][1]; ?></a></li>
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