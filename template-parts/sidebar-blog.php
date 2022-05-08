<a class="sidebar-blog__link" href="<?php the_permalink();?>">
	<div class="sidebar-blog__contents">
		<div class="sidebar-blog__meta">
			<span class="sidebar-blog__date">
				<?php echo get_the_date('Y.m.d'); ?>
			</span>
			<?php
			$posttags = get_the_tags();
			if ($posttags):
			?>
				<span class="sidebar-blog__tag">
          <?php foreach ($posttags as $tag) { echo $tag->name . ' '; } ?>
				</span>
			<?php
			endif;
			?>
		</div>

		<span class="sidebar-blog__ttl">
			<?php the_title();?>
		</span>
	</div>
</a>