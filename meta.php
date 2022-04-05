<p class="meta">
	<time itemprop="datePublished"><?php the_time('Y/m/d'); ?></time>
	<?php if ( get_the_modified_date('Y/m/d') > get_the_time('Y/m/d') ) { ?>
		<time itemprop="dateModified">
			(更新日: <?php echo the_modified_date('Y/m/d') ?>)
		</time>
	<?php } ?>
</p>