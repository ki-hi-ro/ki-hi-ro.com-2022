<?php
// 最近書いた記事
get_template_part('template-parts/new-posts');

// ▼タグ一覧追加
$tags = get_tags();
if ($tags) :
    echo '<div class="tag-list">';
    echo '<h2 class="front-sec__ttl --sp-center">タグ一覧</h2>';
    echo '<ul class="front-sec__text front-sec__flex">';
    foreach ($tags as $tag) {
        echo '<li><a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a></li>';
    }
    echo '</ul>';
    echo '</div>';
endif;
?>