<?php
/**
 * Database output query helpers.
 */

function kihiro_excerpt_more($more) {
    return ' ... ';
}
add_filter('excerpt_more', 'kihiro_excerpt_more');

function kihiro_excerpt_length($length) {
    return 190;
}
add_filter('excerpt_length', 'kihiro_excerpt_length', 999);

function kihiro_custom_excerpt($length = 170) {
    $post = get_post();

    if (!$post instanceof WP_Post) {
        return '';
    }

    $content = wp_strip_all_tags($post->post_excerpt);

    if ('' === $content) {
        $content = strip_shortcodes($post->post_content);
        $content = html_entity_decode(wp_strip_all_tags($content), ENT_QUOTES, 'UTF-8');
    }

    if (mb_strlen($content, 'UTF-8') > $length) {
        return mb_substr($content, 0, $length, 'UTF-8') . '...';
    }

    return $content;
}

function kihiro_home_posts_per_page() {
    return 24;
}

function kihiro_get_request_value($key) {
    if (!isset($_GET[$key])) {
        return '';
    }

    return sanitize_text_field(wp_unslash($_GET[$key]));
}

function kihiro_parse_ymd($date) {
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        return null;
    }

    $parsed = DateTimeImmutable::createFromFormat('!Y-m-d', $date, wp_timezone());
    $errors = DateTimeImmutable::getLastErrors();

    if (!$parsed instanceof DateTimeImmutable) {
        return null;
    }

    if (false !== $errors && ($errors['warning_count'] || $errors['error_count'])) {
        return null;
    }

    return $parsed->format('Y-m-d') === $date ? $parsed : null;
}

function kihiro_latest_post_date() {
    $latest_posts = get_posts(
        array(
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => 1,
            'orderby'             => 'date',
            'order'               => 'DESC',
            'post__not_in'        => kihiro_excluded_post_ids(),
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
        )
    );

    if (!$latest_posts) {
        return wp_date('Y-m-d');
    }

    return get_the_date('Y-m-d', $latest_posts[0]);
}

function kihiro_selected_journal_date() {
    $requested_date = kihiro_parse_ymd(kihiro_get_request_value('journal_date'));

    if ($requested_date instanceof DateTimeImmutable) {
        return $requested_date;
    }

    return kihiro_parse_ymd(kihiro_latest_post_date());
}

function kihiro_is_all_articles_view() {
    return 'all' === kihiro_get_request_value('view');
}

function kihiro_journal_date_url($date) {
    return add_query_arg('journal_date', $date, home_url('/'));
}

function kihiro_all_articles_url() {
    return add_query_arg('view', 'all', home_url('/'));
}

function kihiro_format_journal_date(DateTimeImmutable $date) {
    $weekdays = array('日', '月', '火', '水', '木', '金', '土');

    return $date->format('Y.m.d') . '（' . $weekdays[(int) $date->format('w')] . '）';
}

function kihiro_posts_for_journal_date($date) {
    $parsed_date = kihiro_parse_ymd($date);

    if (!$parsed_date instanceof DateTimeImmutable) {
        return array();
    }

    return get_posts(
        array(
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => -1,
            'orderby'             => 'date',
            'order'               => 'ASC',
            'post__not_in'        => kihiro_excluded_post_ids(),
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
            'date_query'          => array(
                array(
                    'year'  => (int) $parsed_date->format('Y'),
                    'month' => (int) $parsed_date->format('n'),
                    'day'   => (int) $parsed_date->format('j'),
                ),
            ),
        )
    );
}

function kihiro_month_post_days($year, $month) {
    $post_ids = get_posts(
        array(
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => -1,
            'fields'              => 'ids',
            'post__not_in'        => kihiro_excluded_post_ids(),
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
            'date_query'          => array(
                array(
                    'year'  => (int) $year,
                    'month' => (int) $month,
                ),
            ),
        )
    );

    $days = array();

    foreach ($post_ids as $post_id) {
        $days[(int) get_the_date('j', $post_id)] = true;
    }

    return $days;
}

function kihiro_configure_main_query($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->is_home()) {
        $query->set('posts_per_page', kihiro_is_all_articles_view() ? -1 : kihiro_home_posts_per_page());
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
        $query->set('no_found_rows', kihiro_is_all_articles_view());
    } elseif ($query->is_search() || $query->is_tag() || $query->is_date()) {
        $query->set('posts_per_page', 10);
    } else {
        return;
    }

    $excluded_ids = array_unique(
        array_merge(
            (array) $query->get('post__not_in'),
            kihiro_excluded_post_ids()
        )
    );

    $query->set('post__not_in', $excluded_ids);
}
add_action('pre_get_posts', 'kihiro_configure_main_query');
