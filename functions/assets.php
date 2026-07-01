<?php
/**
 * Front-end assets.
 */

function kihiro_asset_version($relative_path) {
    $path = get_template_directory() . $relative_path;

    return file_exists($path) ? (string) filemtime($path) : null;
}

function kihiro_enqueue_assets() {
    $is_tag_index_page = is_page_template('page-tag-hierarchy.php')
        || (function_exists('kihiro_is_tag_index_request') && kihiro_is_tag_index_request());
    $styles = array(
        'kihiro-foundation'    => '/assets/css/foundation/variables.css',
        'kihiro-style'         => '/style.css',
        'kihiro-base'          => '/assets/css/base.css',
        'kihiro-container'     => '/assets/css/container.css',
        'kihiro-page-top'      => '/assets/css/page-top.css',
    );

    if ($is_tag_index_page) {
        $styles['kihiro-article-list'] = '/assets/css/article-list.css';
    } elseif (is_singular()) {
        $styles['kihiro-single'] = '/assets/css/single.css';
    } else {
        $styles['kihiro-sidebar']       = '/assets/css/sidebar.css';
        $styles['kihiro-article-list']  = '/assets/css/article-list.css';
        $styles['kihiro-random-insert'] = '/assets/css/random-insert.css';
    }

    // Keep the concept layer last so it can consistently restyle every template.
    $styles['kihiro-design-refresh'] = '/assets/css/design-refresh.css';

    foreach ($styles as $handle => $relative_path) {
        wp_enqueue_style(
            $handle,
            get_theme_file_uri($relative_path),
            'kihiro-foundation' === $handle ? array() : array('kihiro-foundation'),
            kihiro_asset_version($relative_path)
        );
    }

    wp_enqueue_script(
        'kihiro-site',
        get_theme_file_uri('/assets/js/site.js'),
        array(),
        kihiro_asset_version('/assets/js/site.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'kihiro_enqueue_assets');
