<?php
/**
 * Front-end assets.
 */

/** 更新時刻をURLのverへ付け、変更後のCSS/JSが古いキャッシュと区別されるようにする。 */
function kihiro_asset_version($relative_path) {
    $path = get_template_directory() . $relative_path;

    return file_exists($path) ? (string) filemtime($path) : null;
}

function kihiro_enqueue_assets() {
    if (is_singular('post') && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    wp_enqueue_script('kihiro-category-scroll', get_theme_file_uri('/assets/js/category-scroll.js'), array(), kihiro_asset_version('/assets/js/category-scroll.js'), true);
    wp_enqueue_script('kihiro-page-scroll', get_theme_file_uri('/assets/js/page-scroll.js'), array(), kihiro_asset_version('/assets/js/page-scroll.js'), true);
    // 記事本文がある画面だけで目次・コードコピーを読み込み、他画面の処理を抑える。
    if (is_single() || is_page_template('page-case-study.php')) {
        if (is_single()) {
            wp_enqueue_script('kihiro-article-like', get_theme_file_uri('/assets/js/article-like.js'), array(), kihiro_asset_version('/assets/js/article-like.js'), true);
        }
        wp_enqueue_script(
            'kihiro-article-toc',
            get_theme_file_uri('/assets/js/article-toc.js'),
            array(),
            kihiro_asset_version('/assets/js/article-toc.js'),
            true
        );
        wp_enqueue_script(
            'kihiro-code-copy',
            get_theme_file_uri('/assets/js/code-copy.js'),
            array(),
            kihiro_asset_version('/assets/js/code-copy.js'),
            true
        );
    }
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
        'kihiro-case-study' => '/assets/css/case-study.css',
        'kihiro-discovery' => '/assets/css/discovery.css',
    );
    if (kihiro_is_story()) {
        $styles['kihiro-story'] = '/assets/css/story.css';
    }

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

/** 公開後の表示リンクだけを同じタブで開く。プレビューの動作は変えない。 */
add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_script('kihiro-editor-view-post', get_theme_file_uri('/assets/js/editor-view-post.js'), array(), kihiro_asset_version('/assets/js/editor-view-post.js'), true);
});

/** 以前のサイトアイコンをブラウザーとホーム画面で共通して使用する。 */
function kihiro_setup_site_icons() {
    remove_action('wp_head', 'wp_site_icon', 99);
    add_action('wp_head', 'kihiro_site_icons', 99);
}
add_action('after_setup_theme', 'kihiro_setup_site_icons');

function kihiro_site_icons() {
    $icons = array(
        array('icon', '/assets/icons/favicon.ico', '16x16', 'image/x-icon'),
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

/** Embedded previews render in a separate WordPress document. */
add_action('embed_head', function () {
    printf('<link rel="stylesheet" href="%s">', esc_url(add_query_arg('ver', kihiro_asset_version('/assets/css/embed.css'), get_theme_file_uri('/assets/css/embed.css'))));
});
