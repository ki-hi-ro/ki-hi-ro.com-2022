<?php
/**
 * Theme setup and WordPress integration.
 */

if (!defined('KIHIRO_EXCLUDED_POST_IDS')) {
    define('KIHIRO_EXCLUDED_POST_IDS', array(3874));
}

function kihiro_excluded_post_ids() {
    return array_map('absint', KIHIRO_EXCLUDED_POST_IDS);
}

function kihiro_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support(
        'html5',
        array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script')
    );
}
add_action('after_setup_theme', 'kihiro_theme_setup');

/** Keep the site tagline and homepage search description aligned. */
function kihiro_site_description() {
    return '柴田浩貴です。毎日ブログを更新しています。';
}
add_filter('option_blogdescription', 'kihiro_site_description');

add_filter('document_title_parts', function ($parts) {
    if (is_front_page() || is_home()) {
        $parts['title'] = kihiro_site_description();
        $parts['tagline'] = get_bloginfo('name');
    }
    return $parts;
});

add_action('wp_head', function () {
    if (!is_front_page() && !is_home()) return;
    printf('<meta name="description" content="%s">' . "\n", esc_attr(kihiro_site_description()));
}, 5);
