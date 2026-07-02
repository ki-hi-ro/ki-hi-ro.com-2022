<?php
/**
 * Minimal front-end body class.
 */

function kihiro_add_design_body_class($classes) {
    $classes[] = 'design-refresh';

    return $classes;
}
add_filter('body_class', 'kihiro_add_design_body_class');
