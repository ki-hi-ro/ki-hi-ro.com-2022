<div class="all-article__post-wrap">
    <div class="all-article__main">
        <div class="all-article__text-wrap">
            <a class="all-article__href" href="<?php the_permalink(); ?>">
                <div class="all-article__text">
                    <div class="all-article__date">
                        <?php echo get_the_date('Y.m.d'); ?>（更新日: <?php echo get_the_modified_date('Y.m.d'); ?>）
                    </div>
                    <div class="all-article__ttl">
                        <?php
                        $tags = get_the_terms(get_the_ID(), 'post_tag');
                        if ($tags && !is_wp_error($tags)) {
                            $first_tag = reset($tags); // 最初のタグを取得
                            echo '<a href="' . esc_url(get_tag_link($first_tag->term_id)) . '">' . esc_html($first_tag->name) . '</a><span> ＞ </span>';
                        }
                        ?><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
