<?php
/** Convert external feed entries to the small data model used by footer cards. */
function kihiro_social_feed_articles($feed) {
    $items = array();
    foreach ($feed->get_items(0, KIHIRO_SOCIAL_ITEM_LIMIT) as $entry) {
        $url = esc_url_raw($entry->get_permalink(), array('http', 'https'));
        $title = wp_strip_all_tags($entry->get_title());
        if (!$url || !$title) {
            continue;
        }
        $items[] = array(
            'title' => $title,
            'url' => $url,
            'date' => (int) $entry->get_date('U'),
        );
    }
    return $items;
}

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
    return array_slice($commits, 0, KIHIRO_SOCIAL_ITEM_LIMIT);
}
