<?php
/**
 * Editorial topic navigation and post classification.
 */

function kihiro_topic_definitions() {
    return array(
        'technology' => array(
            'label'       => '技術ブログ',
            'description' => 'Web制作、プログラミング、デザインの実践記録。',
            'tag_names'   => array(
                'プログラミング', 'Python', 'Git', 'TypeScript', 'JavaScript',
                'React', 'Vue.js', 'WordPress', 'HTML / CSS', 'AI活用',
                'アプリ開発', 'デザイン', 'アルゴリズム', 'ネットワーク',
            ),
        ),
        'philosophy' => array(
            'label'       => '人生哲学',
            'description' => '働き方、生き方、自分との向き合い方について。',
            'tag_names'   => array(),
        ),
        'curation' => array(
            'label'       => '情報のセレクトショップ',
            'description' => '旅、文化、道具、日々の発見から選んだ情報。',
            'tag_names'   => array('情報のセレクトショップ'),
        ),
    );
}

function kihiro_current_topic() {
    $topic = sanitize_key((string) get_query_var('topic'));

    return isset(kihiro_topic_definitions()[$topic]) ? $topic : '';
}

function kihiro_topic_url($topic) {
    if (!isset(kihiro_topic_definitions()[$topic])) {
        return home_url('/');
    }

    return add_query_arg('topic', $topic, home_url('/'));
}

function kihiro_thought_trail_url() {
    return add_query_arg('trail', 'thoughts', home_url('/'));
}

function kihiro_is_thought_trail() {
    return 'thoughts' === sanitize_key((string) get_query_var('trail'));
}

function kihiro_navigation_sections() {
    return array(
        array(
            'title' => '関連サイト',
            'items' => array(
                array(
                    'label'       => 'My portfolio',
                    'url'         => 'https://freelance-blog.onrender.com/',
                    'description' => 'フリーランスWEBエンジニアとしてのサイトです。',
                ),
                array(
                    'label'       => 'GitHub',
                    'url'         => 'https://github.com/ki-hi-ro',
                    'description' => '私のリポジトリとコミット履歴を確認できます。',
                ),
                array(
                    'label'       => 'Hatena Blog',
                    'url'         => 'https://khirok.hatenadiary.jp/',
                    'description' => 'フリーランスWEB制作の駆け出し期に書いていたブログです。',
                ),
            ),
        ),
    );
}

function kihiro_register_topic_query_var($query_vars) {
    $query_vars[] = 'topic';
    $query_vars[] = 'trail';

    return $query_vars;
}
add_filter('query_vars', 'kihiro_register_topic_query_var');

function kihiro_topic_tag_ids() {
    static $topic_tag_ids = null;

    if (null !== $topic_tag_ids) {
        return $topic_tag_ids;
    }

    $topic_tag_ids = array(
        'technology' => array(),
        'curation'   => array(),
    );
    $terms = get_terms(
        array(
            'taxonomy'   => 'post_tag',
            'hide_empty' => false,
        )
    );

    if (is_wp_error($terms)) {
        return $topic_tag_ids;
    }

    $definitions = kihiro_topic_definitions();

    foreach ($terms as $term) {
        foreach (array('technology', 'curation') as $topic) {
            if (in_array($term->name, $definitions[$topic]['tag_names'], true)) {
                $topic_tag_ids[$topic][] = (int) $term->term_id;
            }
        }
    }

    return $topic_tag_ids;
}

function kihiro_apply_topic_query($query, $topic) {
    $tag_ids   = kihiro_topic_tag_ids();
    $tax_query = array('relation' => 'AND');

    if ('curation' === $topic) {
        $tax_query[] = array(
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $tag_ids['curation'],
        );
    } elseif ('technology' === $topic) {
        $tax_query[] = array(
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $tag_ids['technology'],
        );
        if ($tag_ids['curation']) {
            $tax_query[] = array(
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => $tag_ids['curation'],
                'operator' => 'NOT IN',
            );
        }
    } else {
        $excluded_tag_ids = array_merge($tag_ids['curation'], $tag_ids['technology']);
        if ($excluded_tag_ids) {
            $tax_query[] = array(
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => $excluded_tag_ids,
                'operator' => 'NOT IN',
            );
        } else {
            // With no classification tags, every post belongs to philosophy.
            return;
        }
    }

    $query->set('tax_query', $tax_query);
}
