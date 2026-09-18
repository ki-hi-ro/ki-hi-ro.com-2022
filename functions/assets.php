<?php
/**
 * Front-end assets.
 */

function kihiro_asset_version($relative_path) {
    $path = get_template_directory() . $relative_path;

    return file_exists($path) ? (string) filemtime($path) : null;
}

function kihiro_enqueue_assets() {
    wp_enqueue_script(
        'kihiro-pagination',
        get_theme_file_uri('/assets/js/pagination.js'),
        array(),
        kihiro_asset_version('/assets/js/pagination.js'),
        true
    );
    $styles = array(
        'kihiro-design-refresh' => '/assets/css/design-refresh.css',
        'kihiro-magazine' => '/assets/css/magazine.css',
    );

    foreach ($styles as $handle => $relative_path) {
        wp_enqueue_style(
            $handle,
            get_theme_file_uri($relative_path),
            array(),
            kihiro_asset_version($relative_path)
        );
    }
}
add_action('wp_enqueue_scripts', 'kihiro_enqueue_assets');

/** Use the theme's handwritten logo for front-end browser and home-screen icons. */
function kihiro_setup_site_icons() {
    remove_action('wp_head', 'wp_site_icon', 99);
    add_action('wp_head', 'kihiro_site_icons', 99);
}
add_action('after_setup_theme', 'kihiro_setup_site_icons');

function kihiro_site_icons() {
    $icons = array(
        array('icon', '/assets/icons/favicon.ico', '16x16 32x32 48x48', 'image/x-icon'),
        array('icon', '/assets/icons/favicon.svg', 'any', 'image/svg+xml'),
        array('apple-touch-icon', '/assets/icons/apple-touch-icon.png', '180x180', 'image/png'),
    );

    foreach ($icons as $icon) {
        $url = add_query_arg('ver', kihiro_asset_version($icon[1]), get_theme_file_uri($icon[1]));
        printf(
            '<link rel="%s" href="%s" sizes="%s" type="%s">' . "\n",
            esc_attr($icon[0]),
            esc_url($url),
            esc_attr($icon[2]),
            esc_attr($icon[3])
        );
    }
}
