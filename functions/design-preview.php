<?php
/**
 * Design concept preview helpers.
 *
 * The selected concept is persisted in a cookie so links to posts and archives
 * keep the same visual treatment during local review.
 */

function kihiro_design_concepts() {
    return array(
        'serendipity' => array(
            'label' => 'Nature Serendipity',
            'short' => 'Serendipity',
        ),
    );
}

function kihiro_current_design_concept() {
    static $current_concept = null;

    if (null !== $current_concept) {
        return $current_concept;
    }

    $concepts          = kihiro_design_concepts();
    $requested_concept = isset($_GET['design'])
        ? sanitize_key(wp_unslash($_GET['design']))
        : '';
    $saved_concept     = isset($_COOKIE['kihiro_design'])
        ? sanitize_key(wp_unslash($_COOKIE['kihiro_design']))
        : '';

    if (isset($concepts[$requested_concept])) {
        $current_concept = $requested_concept;
    } elseif (isset($concepts[$saved_concept])) {
        $current_concept = $saved_concept;
    } else {
        $current_concept = 'serendipity';
    }

    return $current_concept;
}

function kihiro_remember_design_concept() {
    if (!isset($_GET['design']) || headers_sent()) {
        return;
    }

    $requested_concept = sanitize_key(wp_unslash($_GET['design']));

    if (!isset(kihiro_design_concepts()[$requested_concept])) {
        return;
    }

    setcookie(
        'kihiro_design',
        $requested_concept,
        array(
            'expires'  => time() + MONTH_IN_SECONDS,
            'path'     => defined('COOKIEPATH') && COOKIEPATH ? COOKIEPATH : '/',
            'secure'   => is_ssl(),
            'httponly' => true,
            'samesite' => 'Lax',
        )
    );

    $_COOKIE['kihiro_design'] = $requested_concept;
}
add_action('init', 'kihiro_remember_design_concept');

function kihiro_add_design_body_class($classes) {
    $classes[] = 'design-refresh';
    $classes[] = 'design-' . kihiro_current_design_concept();

    return $classes;
}
add_filter('body_class', 'kihiro_add_design_body_class');

function kihiro_design_concept_url($concept) {
    return add_query_arg('design', $concept, home_url('/'));
}
