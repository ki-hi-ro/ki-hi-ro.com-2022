<a class="blog-list-grid__link" href="<?php the_permalink(); ?>">
	<li class="blog-list-grid__contents">

		<div class="blog-list-grid__meta">
			<span class="blog-list-grid__date">
				<?php echo get_the_date('Y.m.d'); ?>
			</span>

			<?php
			$posttags = get_the_tags();
			if ($posttags) :
			?>
				<span class="blog-list-grid__tag">
					<?php foreach ($posttags as $tag) {
						echo $tag->name . ' ';
					} ?>
				</span>
			<?php
			endif;
			?>
		</div>

		<span class="blog-list-grid__ttl">
			<?php the_title(); ?>
		</span>

	</li>
</a>