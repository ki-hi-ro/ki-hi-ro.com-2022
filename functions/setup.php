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

// 投稿と同じカテゴリーを固定ページの編集画面でも設定できるようにする。
function kihiro_register_page_categories() {
    register_taxonomy_for_object_type('category', 'page');
}
add_action('init', 'kihiro_register_page_categories', 20);
