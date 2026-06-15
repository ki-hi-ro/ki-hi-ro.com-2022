<?php
// 画像ランダム表示
wp_enqueue_script(
    'random-image',
    get_template_directory_uri() . '/assets/js/random-image.js',
    ['config'],
    date('YmdHi'),
    true
);

wp_localize_script(
    'random-image',
    'imageAjax',
    [
        'ajaxUrl' => admin_url('admin-ajax.php')
    ]
);

function get_random_image() {
    global $wpdb;

    $image_id = $wpdb->get_var("
        SELECT ID
        FROM {$wpdb->posts}
        WHERE post_type = 'attachment'
        AND post_mime_type LIKE 'image%'
        ORDER BY RAND()
        LIMIT 1
    ");

    if (!$image_id) {
        wp_send_json(null);
    }

    $image_url = wp_get_attachment_image_url($image_id, 'large');

    $image_alt = get_post_meta(
        $image_id,
        '_wp_attachment_image_alt',
        true
    );

    $image = get_post($image_id);

    $post_url = '';

    if ($image && $image->post_parent) {
        $post_url = get_permalink($image->post_parent);
    }

    wp_send_json([
        'imageUrl' => $image_url,
        'alt'      => $image_alt,
        'postUrl'  => $post_url,
    ]);
}

add_action('wp_ajax_get_random_image', 'get_random_image');
add_action('wp_ajax_nopriv_get_random_image', 'get_random_image');