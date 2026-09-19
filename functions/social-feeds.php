<?php
/** Public feeds are refreshed by WP-Cron, never during footer rendering. */
function kihiro_social_sources() {
    return array(
        'note' => array('name' => 'note', 'url' => 'https://note.com/khiro_maru', 'feed' => 'https://note.com/khiro_maru/rss', 'label' => '最新の記事'),
        'zenn' => array('name' => 'Zenn', 'url' => 'https://zenn.dev/khiro_maru', 'feed' => 'https://zenn.dev/khiro_maru/feed', 'label' => '最新の記事'),
        'github_commits' => array('name' => 'GitHub', 'url' => 'https://github.com/ki-hi-ro', 'feed' => 'https://github.com/ki-hi-ro.atom', 'label' => '最近のコミット'),
    );
}

function kihiro_schedule_social_feeds() {
    // Refresh once after changing the cache format; do not show old push titles.
    if (get_option('kihiro_social_feed_version') !== '2') {
        wp_clear_scheduled_hook('kihiro_refresh_social_feeds');
        if (wp_schedule_event(time(), 'hourly', 'kihiro_refresh_social_feeds')) {
            update_option('kihiro_social_feed_version', '2', false);
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
        if ($source['feed'] === $url) return HOUR_IN_SECONDS;
    }
    return $seconds;
}

function kihiro_refresh_social_feeds() {
    require_once ABSPATH . WPINC . '/feed.php';
    add_filter('wp_feed_cache_transient_lifetime', 'kihiro_social_feed_cache_lifetime', 10, 2);
    try {
        foreach (kihiro_social_sources() as $key => $source) {
            $feed = fetch_feed($source['feed']);
            // Retain the last successful response during temporary outages.
            if (is_wp_error($feed)) continue;
            if ($key === 'github_commits') {
                $commits = kihiro_github_feed_commits($feed);
                if ($commits) set_transient('kihiro_social_' . $key, $commits, 7 * DAY_IN_SECONDS);
                continue;
            }
            $items = array();
            foreach ($feed->get_items(0, 3) as $item) {
                $url = esc_url_raw($item->get_permalink(), array('http', 'https'));
                $title = wp_strip_all_tags($item->get_title());
                if (!$url || !$title) continue;
                $items[] = array(
                    'title' => $title,
                    'url' => $url,
                    'date' => (int) $item->get_date('U'),
                );
            }
            set_transient('kihiro_social_' . $key, $items, 7 * DAY_IN_SECONDS);
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

/** Extract commit subjects and permalinks, rather than the Atom push-event title. */
function kihiro_github_feed_commits($feed) {
    if (!class_exists('DOMDocument')) return array();
    $commits = array();
    foreach ($feed->get_items() as $entry) {
        $document = new DOMDocument();
        $previous = libxml_use_internal_errors(true);
        try {
            $loaded = $document->loadHTML('<?xml encoding="UTF-8">' . $entry->get_content(), LIBXML_NONET);
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
        }
        if (!$loaded) continue;
        $xpath = new DOMXPath($document);
        foreach ($xpath->query('//li[.//blockquote]') as $row) {
            $link = $xpath->query('.//a[contains(@href, "/commit/")]', $row)->item(0);
            $subject = $xpath->query('.//blockquote', $row)->item(0);
            if (!$link || !$subject) continue;
            $url = $link->getAttribute('href');
            if (strpos($url, '/') === 0) $url = 'https://github.com' . $url;
            if (!preg_match('~^https://github\.com/([^/]+/[^/]+)/commit/([a-f0-9]{40})(?:#.*)?$~i', $url, $match)) continue;
            $title = trim(preg_split('/\R/u', trim($subject->textContent))[0]);
            if ($title === '' || isset($commits[$match[1] . '/' . $match[2]])) continue;
            $commits[$match[1] . '/' . $match[2]] = array(
                'title' => $title,
                'url' => $url,
                'date' => (int) $entry->get_date('U'),
                'repository' => $match[1],
            );
        }
    }
    $commits = array_values($commits);
    usort($commits, function ($a, $b) { return $b['date'] <=> $a['date']; });
    return array_slice($commits, 0, 3);
}
