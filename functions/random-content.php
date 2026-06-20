<?php
/**
 * Cached data sources for random content cards and Ajax responses.
 */

function kihiro_get_quote_candidates() {
    static $quotes = null;

    if (null !== $quotes) {
        return $quotes;
    }

    $quotes = get_transient('kihiro_quote_candidates');

    if (false !== $quotes && is_array($quotes)) {
        return $quotes;
    }

    $quotes = array();
    $posts  = get_posts(
        array(
            'numberposts' => 80,
            'post_status' => 'publish',
            'orderby'     => 'modified',
            'order'       => 'DESC',
        )
    );

    foreach ($posts as $post) {
        $sentences = preg_split('/[。！？]/u', wp_strip_all_tags($post->post_content));

        foreach ($sentences as $sentence) {
            $sentence = trim($sentence);
            $length   = mb_strlen($sentence);

            if ($length >= 20 && $length <= 80) {
                $quotes[] = array(
                    'text'  => $sentence,
                    'url'   => get_permalink($post->ID),
                    'title' => get_the_title($post->ID),
                );
            }
        }
    }

    set_transient('kihiro_quote_candidates', $quotes, 12 * HOUR_IN_SECONDS);

    return $quotes;
}

function kihiro_get_random_image_ids() {
    static $image_ids = null;

    if (null !== $image_ids) {
        return $image_ids;
    }

    $image_ids = get_transient('kihiro_random_image_ids');

    if (false === $image_ids || !is_array($image_ids)) {
        $image_ids = get_posts(
            array(
                'post_type'              => 'attachment',
                'post_status'            => 'inherit',
                'post_mime_type'         => 'image',
                'posts_per_page'         => -1,
                'orderby'                => 'date',
                'order'                  => 'DESC',
                'fields'                 => 'ids',
                'no_found_rows'          => true,
                'update_post_meta_cache' => false,
                'update_post_term_cache' => false,
            )
        );
        set_transient('kihiro_random_image_ids', $image_ids, 12 * HOUR_IN_SECONDS);
    }

    return $image_ids;
}

function kihiro_get_random_tags() {
    static $tags = null;

    if (null !== $tags) {
        return $tags;
    }

    $tags = get_transient('kihiro_random_tags');

    if (false === $tags || !is_array($tags)) {
        $tags = get_tags(
            array(
                'hide_empty' => false,
                'orderby'    => 'name',
                'order'      => 'ASC',
            )
        );
        set_transient('kihiro_random_tags', $tags, 12 * HOUR_IN_SECONDS);
    }

    return $tags;
}

function kihiro_clear_random_content_cache() {
    delete_transient('kihiro_quote_candidates');
    delete_transient('kihiro_random_image_ids');
    delete_transient('kihiro_random_tags');
}
add_action('save_post', 'kihiro_clear_random_content_cache');
add_action('created_post_tag', 'kihiro_clear_random_content_cache');
add_action('edited_post_tag', 'kihiro_clear_random_content_cache');
add_action('delete_post_tag', 'kihiro_clear_random_content_cache');
