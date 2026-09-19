<?php
/** Public feeds are refreshed by WP-Cron, never during footer rendering. */
require_once __DIR__ . '/social-feed-parsers.php';

const KIHIRO_SOCIAL_ITEM_LIMIT = 3;
const KIHIRO_SOCIAL_CACHE_VERSION = '2';

function kihiro_social_cache_key($source_key) {
    return 'kihiro_social_' . $source_key;
}

function kihiro_social_cached_items($source_key) {
    $items = get_transient(kihiro_social_cache_key($source_key));
    return is_array($items) ? $items : array();
}

function kihiro_social_sources() {
    return array(
        'note' => array(
            'name' => 'note',
            'url' => 'https://note.com/khiro_maru',
            'feed' => 'https://note.com/khiro_maru/rss',
            'label' => '最新の記事',
        ),
        'zenn' => array(
            'name' => 'Zenn',
            'url' => 'https://zenn.dev/khiro_maru',
            'feed' => 'https://zenn.dev/khiro_maru/feed',
            'label' => '最新の記事',
        ),
        'github_commits' => array(
            'name' => 'GitHub',
            'url' => 'https://github.com/ki-hi-ro',
            'feed' => 'https://github.com/ki-hi-ro.atom',
            'label' => '最近のコミット',
        ),
    );
}

function kihiro_schedule_social_feeds() {
    // Refresh once after changing the cache format; do not show old push titles.
    if (get_option('kihiro_social_feed_version') !== KIHIRO_SOCIAL_CACHE_VERSION) {
        wp_clear_scheduled_hook('kihiro_refresh_social_feeds');
        if (wp_schedule_event(time(), 'hourly', 'kihiro_refresh_social_feeds')) {
            update_option('kihiro_social_feed_version', KIHIRO_SOCIAL_CACHE_VERSION, false);
        }
        return;
    }
    if (!wp_next_scheduled('kihiro_refresh_social_feeds')) {
        wp_schedule_event(time(), 'hourly', 'kihiro_refresh_social_feeds');
    }
}
add_action('init', 'kihiro_schedule_social_feeds');

function kihiro_social_feed_cache_lifetime($seconds, $url) {
    foreach (kihiro_social_sources() as $source) {
        if ($source['feed'] === $url) {
            return HOUR_IN_SECONDS;
        }
    }
    return $seconds;
}

function kihiro_refresh_social_feeds() {
    require_once ABSPATH . WPINC . '/feed.php';
    add_filter('wp_feed_cache_transient_lifetime', 'kihiro_social_feed_cache_lifetime', 10, 2);
    try {
        foreach (kihiro_social_sources() as $key => $source) {
            kihiro_refresh_social_source($key, $source);
        }
    } finally {
        remove_filter('wp_feed_cache_transient_lifetime', 'kihiro_social_feed_cache_lifetime', 10);
    }
}
add_action('kihiro_refresh_social_feeds', 'kihiro_refresh_social_feeds');

function kihiro_unschedule_social_feeds() {
    wp_clear_scheduled_hook('kihiro_refresh_social_feeds');
}
add_action('switch_theme', 'kihiro_unschedule_social_feeds');

/** Refresh one source while keeping its previous cache if fetching fails. */
function kihiro_refresh_social_source($key, $source) {
    $feed = fetch_feed($source['feed']);
    if (is_wp_error($feed)) {
        return;
    }

    $items = $key === 'github_commits'
        ? kihiro_github_feed_commits($feed)
        : kihiro_social_feed_articles($feed);

    // Empty GitHub results can mean that its embedded HTML format changed.
    if ($key === 'github_commits' && !$items) {
        return;
    }

    set_transient(kihiro_social_cache_key($key), $items, 7 * DAY_IN_SECONDS);
}
