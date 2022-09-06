<a class="template-blog-list__link" href="<?php the_permalink();?>">
	<div class="template-blog-list__contents">

		<div class="skill-blog__meta">
			<span class="skill-blog__date">
				<?php echo get_the_date('Y.m.d'); ?>
			</span>

			<?php
			$posttags = get_the_tags();
			if ($posttags):
			?>
				<span class="skill-blog__tag">
          <?php foreach ($posttags as $tag) { echo $tag->name . ' '; } ?>
				</span>
			<?php
			endif;
			?>
		</div>

		<span class="skill-blog__ttl">
			<?php the_title();?>
		</span>

</div>
</a>