<?php require('data/navigation.php'); ?>

<?php wp_reset_query(); ?>

<footer class="footer">
    <nav class="footer__nav">
        <?php
		foreach ($nav as $nav_item) :
		?>
        <div class="footer__nav-contents nav-contents">
            <h4>
                <?php if ($nav_item['ttl'][0]) : ?>
                    <a href="<?php echo $nav_item['ttl'][0]; ?>"><?php echo $nav_item['ttl'][1]; ?></a>
                <?php else : ?>
                    <?php echo $nav_item['ttl'][1]; ?>
                <?php endif; ?>
            </h4>
            <ul>
				<?php for($i = 0; $i < count($nav_item['child']); $i++) : ?>
					<li><a href="<?php echo $nav_item['child'][$i][0]; ?>/">- <?php echo $nav_item['child'][$i][1]; ?></a></li>
				<?php endfor; ?>
            </ul>
        </div>
        <?php endforeach; ?>
    </nav>
</footer>


<p class="page-top --not-single-sp"><a class="page-top__link --not-single-sp" href="#">ページ<br>最上部へ</a></p>
<p class="page-top --single-sp"><a class="page-top__link" href="#">目次へ</a></p>

<?php wp_footer(); ?>
</body>

</html>