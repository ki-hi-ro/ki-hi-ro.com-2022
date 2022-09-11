<a class="blog-list-scroll__link" href="<?php the_permalink(); ?>">
    <div class="blog-list-scroll__contents">
        <div class="blog-list-scroll__thumb-nail-wrap">
            <?php
            if (has_post_thumbnail()) : the_post_thumbnail('full', ['class' => 'blog-list-scroll__img']); else :
            ?>
                <img class="blog-list-scroll__img" src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/no-image.png" alt="no-image" />
            <?php endif; ?>
        </div>
        <div class="blog-list-scroll__meta">
            <span class="blog-list-scroll__date">
                <?php echo get_the_date('Y.m.d'); ?>
            </span>

            <?php
            $posttags = get_the_tags();
            if ($posttags) :    
            ?>
                <span class="blog-list-scroll__tag">
                    <?php foreach ($posttags as $tag) {
                        echo $tag->name . ' ';
                    } ?>
                </span>
            <?php
            endif;
            ?>
        </div>

        <span class="blog-list-scroll__ttl">
            <?php the_title(); ?>
        </span>

    </div>
</a>