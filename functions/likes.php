<?php
/** Anonymous, browser-based likes. Each vote has a unique, atomic option key. */
function kihiro_like_count($post_id) {
    global $wpdb;
    $prefix = $wpdb->esc_like('kihiro_like_' . $post_id . '_') . '%';
    return (int) $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->options} WHERE option_name LIKE %s", $prefix));
}

function kihiro_like_request() {
    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    $post = get_post($post_id);
    if (!$post || $post->post_type !== 'post' || $post->post_status !== 'publish' || $post->post_password !== '') {
        wp_send_json_error(array('message' => 'この記事では利用できません。'), 404);
    }
    $token = isset($_POST['visitor']) && is_string($_POST['visitor']) ? wp_unslash($_POST['visitor']) : '';
    if (!preg_match('/^[a-f0-9]{32}$/', $token)) {
        wp_send_json_error(array('message' => 'ブラウザー情報を確認できません。'), 400);
    }
    $key = 'kihiro_like_' . $post_id . '_' . hash_hmac('sha256', $token, wp_salt('auth'));
    $nonce_action = 'kihiro_like_' . $post_id . '_' . $token;
    if (isset($_POST['vote']) && $_POST['vote'] === '1') {
        check_ajax_referer($nonce_action, 'nonce');
        if (!add_option($key, '1', '', false) && get_option($key, false) === false) {
            wp_send_json_error(array('message' => '保存できませんでした。もう一度お試しください。'), 500);
        }
    }
    wp_send_json_success(array(
        'count' => kihiro_like_count($post_id),
        'liked' => get_option($key, false) !== false,
        'nonce' => wp_create_nonce($nonce_action),
    ));
}
add_action('wp_ajax_kihiro_like', 'kihiro_like_request');
add_action('wp_ajax_nopriv_kihiro_like', 'kihiro_like_request');
