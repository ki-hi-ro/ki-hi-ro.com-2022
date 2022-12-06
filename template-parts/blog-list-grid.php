<a class="blog-list-grid__link <?php if ( is_home() || is_front_page() ) : ?>--top-page<?php endif; ?>" href="<?php the_permalink(); ?>">
    <div class="blog-list-grid__contents">
        <div class="blog-list-grid__thumb-nail-wrap">
            <?php
			if (has_post_thumbnail()) : the_post_thumbnail('full', ['class' => 'blog-list-grid__img']);
			else :
			?>
            <img class="blog-list-grid__img" src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/no-image.png" alt="no-image" />
            <?php endif; ?>
        </div>
        <div class="blog-list-grid__meta">
            <span class="blog-list-grid__date">
                <?php echo get_the_date('Y.m.d'); ?>
            </span>
            <span class="blog-list-grid__ttl">
                <?php the_title(); ?>
            </span>
            <?php
			$posttags = get_the_tags();
			if ($posttags) :
			?>
			<div class="blog-list-grid__tag-wrap">			
				<?php foreach ($posttags as $tag) : ?>
				<span class="blog-list-grid__tag">
					<?php echo $tag->name . ' '; ?>
				</span>
				<?php endforeach; ?>
			</div>
            <?php endif; ?>
        </div>
    </div>
</a>