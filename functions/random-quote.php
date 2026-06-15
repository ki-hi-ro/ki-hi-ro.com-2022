<?php
// 名言ランダム表示
wp_enqueue_script(
    'quote',
    get_template_directory_uri() . '/assets/js/random-quote.js',
    ['config'],
    date('YmdHi'),
    true
);

wp_localize_script(
    'quote',
    'quoteAjax',
    [
        'ajaxUrl' => admin_url('admin-ajax.php')
    ]
);

function get_random_quote_from_posts() {
    $posts = get_posts([
        'numberposts'  => 100,
        'post_status'  => 'publish',
        'orderby'      => 'rand',
    ]);

    $quotes = [];

    foreach ($posts as $post) {
        $content = wp_strip_all_tags($post->post_content);
        $sentences = preg_split('/[。！？]/u', $content);

        foreach ($sentences as $sentence) {
            $sentence = trim($sentence);

            if (
                mb_strlen($sentence) >= 20 &&
                mb_strlen($sentence) <= 80
            ) {
                $quotes[] = [
                    'text'  => $sentence,
                    'url'   => get_permalink($post->ID),
                    'title' => get_the_title($post->ID),
                ];
            }
        }
    }

    if (empty($quotes)) {
        return null;
    }

    return $quotes[array_rand($quotes)];
}

function ajax_get_random_quote() {
    $quote = get_random_quote_from_posts();

    if (!$quote) {
        wp_send_json(null);
    }

    wp_send_json($quote);
}

add_action('wp_ajax_get_random_quote', 'ajax_get_random_quote');
add_action('wp_ajax_nopriv_get_random_quote', 'ajax_get_random_quote');