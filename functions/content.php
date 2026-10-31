<?php
/**
 * Database output query helpers.
 */

function kihiro_logo_home_url() {
    $url = home_url('/');
    // Avoid a browser-cached production redirect after importing the local DB.
    if (wp_get_environment_type() === 'local') {
        $url = add_query_arg('local_home', '1', $url);
    }
    return $url;
}

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
    return 3;
}

function kihiro_get_request_value($key) {
    if (!isset($_GET[$key]) || !is_scalar($_GET[$key])) {
        return '';
    }

    return sanitize_text_field(wp_unslash($_GET[$key]));
}

function kihiro_redirect_empty_search() {
    if (is_admin() || !isset($_GET['s']) || !is_scalar($_GET['s'])) {
        return;
    }

    if ('' !== trim(kihiro_get_request_value('s'))) {
        return;
    }

    wp_safe_redirect(add_query_arg('view', 'archive-all', kihiro_logo_home_url()));
    exit;
}
add_action('template_redirect', 'kihiro_redirect_empty_search', 0);

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
    $requested_value = kihiro_get_request_value('journal_date');
    // Month selection opens the first day; existing daily links keep their date.
    if (preg_match('/^\d{4}-\d{2}$/', $requested_value)) {
        $requested_value .= '-01';
    }
    $requested_date = kihiro_parse_ymd($requested_value);

    if ($requested_date instanceof DateTimeImmutable) {
        return $requested_date;
    }

    return kihiro_parse_ymd(kihiro_latest_post_date());
}

function kihiro_journal_url() {
    return add_query_arg('view', 'archive-all', kihiro_logo_home_url());
}

// 以前のジャーナル入口も、現在の標準である全記事一覧へ統一する。
function kihiro_redirect_legacy_journal_view() {
    if (!is_home() || 'journal' !== kihiro_get_request_value('view')) return;
    $url = kihiro_journal_url();
    if (kihiro_selected_article_category()) $url = add_query_arg('article_category', kihiro_selected_article_category(), $url);
    if (kihiro_selected_article_tag()) $url = add_query_arg('article_tag', kihiro_selected_article_tag(), $url);
    wp_safe_redirect($url);
    exit;
}
add_action('template_redirect', 'kihiro_redirect_legacy_journal_view', 1);

function kihiro_is_all_articles_view() {
    return 'journal' === kihiro_get_request_value('view')
        || 'archive-all' === kihiro_get_request_value('view')
        || 'all' === kihiro_get_request_value('view')
        || ('' === kihiro_get_request_value('view') && '' === kihiro_get_request_value('journal_date'));
}

function kihiro_journal_date_url($date) {
    return add_query_arg('journal_date', $date, home_url('/'));
}

function kihiro_all_articles_url() {
    return add_query_arg('view', 'all', home_url('/'));
}

function kihiro_format_journal_date(DateTimeImmutable $date) {
    $weekdays = array('日', '月', '火', '水', '木', '金', '土');

    return $date->format('Y年n月j日') . '(' . $weekdays[(int) $date->format('w')] . ')';
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

/**
 * 公開画面のメインクエリだけを調整する。
 * 独自WP_Queryや管理画面まで書き換えると、管理一覧や補助取得が壊れるため対象外。
 * ホームは更新順、カードの日付は公開日と更新日の両方で、役割が異なる。
 */
function kihiro_configure_main_query($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->is_home() && 'archive-all' === kihiro_get_request_value('view')) {
        // 全記事のタイムラインは100件ずつ表示する。
        $query->set('posts_per_page', 100);
        if (kihiro_selected_article_category()) $query->set('cat', kihiro_selected_article_category());
        if (kihiro_selected_article_tag()) $query->set('tag_id', kihiro_selected_article_tag());
        $query->set('no_found_rows', false);
        $query->set('ignore_sticky_posts', true);
        $query->set('orderby', array('date' => 'DESC', 'ID' => 'DESC'));
    } elseif ($query->is_home()) {
        // 更新した記事は1ページ最大3件で、続きはページ番号から表示する。
        $query->set('posts_per_page', 3);
        $query->set('orderby', array('modified' => 'DESC', 'ID' => 'DESC'));
        $query->set('order', 'DESC');
        $query->set('no_found_rows', false);
        $query->set('ignore_sticky_posts', true);
        // 入力値はヘルパーで検証し、条件はWordPressのtax_queryへ渡す。
        // 複数条件を指定した場合は、両方に該当する記事だけを表示する。
        $tax_filters = array('relation' => 'AND');
        if (kihiro_is_all_articles_view() && kihiro_selected_article_tag()) {
            $tax_filters[] = array(
                'taxonomy' => 'post_tag',
                'field' => 'term_id',
                'terms' => kihiro_selected_article_tag(),
            );
        }
        $category_id = kihiro_selected_article_category();
        if (kihiro_is_all_articles_view() && $category_id) {
            $tax_filters[] = array('taxonomy' => 'category', 'field' => 'term_id', 'terms' => $category_id);
        }
        if (count($tax_filters) > 1) {
            $query->set('tax_query', $tax_filters);
        }
    } elseif ($query->is_date()) {
        if (kihiro_selected_article_category()) $query->set('cat', kihiro_selected_article_category());
        if (kihiro_selected_article_tag()) $query->set('tag_id', kihiro_selected_article_tag());
        // 年月アーカイブは対象期間の全記事を一度に表示する。
        $query->set('posts_per_page', -1);
        $query->set('no_found_rows', true);
        $query->set('orderby', array('date' => 'DESC', 'ID' => 'DESC'));
    } elseif ($query->is_search() || $query->is_archive()) {
        $query->set('posts_per_page', 10);
        if ($query->is_search()) {
            $query->set('post_type', 'post');
            // 検索結果もタイムラインとして公開日時の新しい順に並べる。
            $query->set('orderby', array('date' => 'DESC', 'ID' => 'DESC'));
        }
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

/** Expose every page number; the theme keeps the list horizontally scrollable. */
function kihiro_pagination_args($args) {
    $args['show_all'] = true;
    $args['prev_next'] = false;
    return $args;
}
add_filter('the_posts_pagination_args', 'kihiro_pagination_args');

/** Adjacent links follow the same published-post exclusions as article lists. */
function kihiro_adjacent_post_where($where) {
    $where .= " AND p.post_status = 'publish'";
    $excluded_ids = kihiro_excluded_post_ids();

    if ($excluded_ids) {
        $where .= ' AND p.ID NOT IN (' . implode(',', $excluded_ids) . ')';
    }

    return $where;
}
add_filter('get_previous_post_where', 'kihiro_adjacent_post_where');
add_filter('get_next_post_where', 'kihiro_adjacent_post_where');

/** Keep tag filtering on the complete writing archive. */
/** 初期表示のカテゴリーを取得し、記事取得とタブの選択表示で共有する。 */
function kihiro_selected_article_category() {
    $requested = kihiro_get_request_value('article_category');
    if ($requested !== '') return absint($requested);
    // 指定がなければカテゴリーを絞らず最新の更新を表示する。
    return 0;
}

/** カテゴリー一覧から新規投稿へ、初期選択するカテゴリーを渡す。 */
function kihiro_new_post_url($category_id = 0) {
    $url = admin_url('post-new.php');
    $category = $category_id ? get_term($category_id, 'category') : null;
    return $category instanceof WP_Term
        ? add_query_arg('kihiro_category', $category->term_id, $url)
        : $url;
}

/** 新規投稿画面で作られる自動下書きに、指定カテゴリーを設定する。 */
function kihiro_set_new_post_category() {
    $post_type = kihiro_get_request_value('post_type');
    $requested = kihiro_get_request_value('kihiro_category');
    if (('' !== $post_type && 'post' !== $post_type) || !ctype_digit($requested)) {
        return;
    }

    $taxonomy = get_taxonomy('category');
    $category = get_term((int) $requested, 'category');
    if (!$category instanceof WP_Term || !current_user_can('edit_posts') || !$taxonomy || !current_user_can($taxonomy->cap->assign_terms)) {
        return;
    }

    // WordPressは自動下書きに既定カテゴリーを付けないため、実際の関連を設定する。
    // ブロックエディターは、この関連をREST API経由で初期データとして読み込む。
    add_action('wp_after_insert_post', function ($post_id, $post, $update) use ($category) {
        if (!$update && 'post' === $post->post_type && 'auto-draft' === $post->post_status) {
            wp_set_post_categories($post_id, array($category->term_id));
        }
    }, 10, 3);
}
add_action('load-post-new.php', 'kihiro_set_new_post_category');

function kihiro_selected_article_tag() {
    $value = kihiro_get_request_value('article_tag');
    return ctype_digit($value) ? absint($value) : 0;
}

/** Use the featured image, the first content image, then a local cover. */
/** アイキャッチ → 本文の最初の画像 → 代替画像の順で選ぶ。保護本文は探索しない。 */
function kihiro_article_thumbnail($post_id, $size = 'medium') {
    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail($post_id, $size, array('alt' => '', 'loading' => 'lazy', 'decoding' => 'async'));
    }
    $entry = get_post($post_id);
    $url = '';
    if ($entry && !post_password_required($entry)) {
        $html = new WP_HTML_Tag_Processor($entry->post_content);
        while ($html->next_tag('IMG')) {
            $url = esc_url($html->get_attribute('src'));
            if ($url) break;
        }
    }
    if (!$url) $url = get_theme_file_uri('/assets/images/article-placeholder.svg');
    return '<img src="' . esc_url($url) . '" alt="" width="320" height="200" loading="lazy" decoding="async">';
}

/** Empty filtered journal/date results are a valid listing, not a missing page. */
function kihiro_handle_empty_journal_archive($preempt, $query) {
    if (false !== $preempt || is_admin() || 'archive-all' !== kihiro_get_request_value('view')) return $preempt;
    // Keep actual missing articles and other routes as 404s, even if view is appended.
    if (!$query->is_home() && !$query->is_date()) return $preempt;
    if ($query->posts) return $preempt;
    status_header(200);
    nocache_headers();
    return true;
}
add_filter('pre_handle_404', 'kihiro_handle_empty_journal_archive', 10, 2);
