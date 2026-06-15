<?php
// タグのランダム表示
wp_enqueue_script(
    'random-tags',
    get_template_directory_uri() . '/assets/js/random-tags.js',
    ['config'],
    date('YmdHi'),
    true
);

wp_localize_script(
    'random-tags',
    'tagAjax',
    [
        'ajaxUrl' => admin_url('admin-ajax.php')
    ]
);

function get_random_tags_ajax() {
    $tags = get_tags([
        'hide_empty' => false,
    ]);

    if (empty($tags)) {
        wp_send_json(null);
    }

    shuffle($tags);

    $tags = array_slice($tags, 0, 3);

    $result = [];

    foreach ($tags as $tag) {
        $result[] = [
            'name' => $tag->name,
            'url'  => get_tag_link($tag->term_id),
        ];
    }

    wp_send_json($result);
}

add_action('wp_ajax_get_random_tags', 'get_random_tags_ajax');
add_action('wp_ajax_nopriv_get_random_tags', 'get_random_tags_ajax');