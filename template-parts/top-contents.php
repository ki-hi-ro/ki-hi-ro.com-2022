<a class="skill-blog__link" href="<?php the_permalink();?>">
    <div class="skill-blog__contents">
        <div class="thumb-nail-wrap">
            <?php
            if(has_post_thumbnail()):
                the_post_thumbnail();
            else:
            ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/no-image.png" alt="no-image" />
            <?php endif; ?>
        </div>
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