<div class="blog-list-grid__contents">
    <div class="blog-list-grid__thumb-nail-wrap">
        <a class="blog-list-grid__thumb-link" href="<?php the_permalink(); ?>">
            <?php
                if (has_post_thumbnail()) : the_post_thumbnail('full', ['class' => 'blog-list-grid__img']);
                else :
                ?>
            <img class="blog-list-grid__img" src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/no-image.png" alt="no-image" />
            <?php endif; ?>
        </a>
    </div>
    <div class="blog-list-grid__meta">
        <span class="blog-list-grid__category"></span>
        <span class="blog-list-grid__date">
            <span class="meta__date">投稿日: <?php echo get_the_date('Y.m.d'); ?></span>
            <span class="meta__date">更新日: <?php echo get_the_modified_date('Y.m.d'); ?></span>
        </span>
        <?php
			$posttags = get_the_tags();
			if ($posttags) :
		?>
        <div class="blog-list-grid__tag-wrap">
            <?php foreach ($posttags as $tag) : ?>
            <a class="tag-li" href="<?php echo home_url('tag/'.$tag->slug.''); ?>">
                <?php echo $tag->name; ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <a class="blog-list-grid__link-btn" href="<?php the_permalink(); ?>">この記事を読みたい</a>
</div>