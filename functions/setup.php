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
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support(
        'html5',
        array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script')
    );
}
add_action('after_setup_theme', 'kihiro_theme_setup');

function kihiro_add_page_slug_body_class($classes) {
    if (is_page()) {
        $page = get_post(get_queried_object_id());

        if ($page instanceof WP_Post) {
            $classes[] = sanitize_html_class($page->post_name);
        }
    }

    return $classes;
}
add_filter('body_class', 'kihiro_add_page_slug_body_class');

function kihiro_register_sidebars() {
    register_sidebar(
        array(
            'name'          => 'サイドバー',
            'id'            => 'sidebar-1',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>',
        )
    );
}
add_action('widgets_init', 'kihiro_register_sidebars');
