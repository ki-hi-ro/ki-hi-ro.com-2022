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
    add_theme_support(
        'html5',
        array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script')
    );
}
add_action('after_setup_theme', 'kihiro_theme_setup');
