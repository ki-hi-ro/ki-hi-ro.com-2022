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
