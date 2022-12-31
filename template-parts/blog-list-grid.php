<div class="blog-list-grid__contents">
    <a class="blog-list-grid__thumb-link" href="<?php the_permalink(); ?>">
        <div class="blog-list-grid__thumb-nail-wrap">
            <?php
                if (has_post_thumbnail()) : the_post_thumbnail('full', ['class' => 'blog-list-grid__img']);
                else :
                ?>
            <img class="blog-list-grid__img" src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/no-image.png" alt="no-image" />
            <?php endif; ?>
    </a>
    </div>
    <div class="blog-list-grid__meta">
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
    <?php if(have_rows('what-you-know')): ?>
    <div class="blog-list-grid__what-you-know-ttl-wrap">
        <?php
            $category = get_the_category();
            $cat_slug = $category[0]->category_nicename;
            ?>
        <h2 class="blog-list-grid__what-you-know-ttl <?php if($cat_slug): ?>--<?php echo $cat_slug; endif; ?>">この記事を読むと分かること</h2>
        <ul class="blog-list-grid__what-you-know-ul">
            <?php while(have_rows('what-you-know')): the_row(); ?>
            <li class="blog-list-grid__what-you-know-li"><?php the_sub_field('text'); ?></li>
            <?php endwhile; ?>
        </ul>
    </div>
    <?php endif; ?>
    <a class="blog-list-grid__link-btn" href="<?php the_permalink(); ?>">この記事を読みたい</a>
</div>