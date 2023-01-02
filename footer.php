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
				<?php for($i = 0; $i < count($nav_item['tag']); $i++) : ?>
					<li><a href="/tag/<?php echo $nav_item['tag'][$i][0]; ?>/">- <?php echo $nav_item['tag'][$i][1]; ?></a></li>
				<?php endfor; ?>
            </ul>
        </div>
        <?php endforeach; ?>
    </nav>
</footer>

<?php
$page_top_text = "";
$is_single_class = "";
if(is_single() && !in_category('record')) {
    $page_top_text = "目次へ";
    $is_single_class = " --single";
} else {
    $page_top_text = "ページ<br>最上部へ";
}
?>

<p class="page-top<?php echo $is_single_class; ?>"><a class="page-top__link" href="#"><?php echo $page_top_text; ?></a></p>

<?php wp_footer(); ?>
</body>

</html>