<?php
/**
 * Theme bootstrap.
 *
 * Feature implementations live in the functions directory so this file only
 * defines the loading order.
 */

$kihiro_function_files = array(
    'setup.php',
    'assets.php',
    'content.php',
    'seo.php',
    'admin-bar.php',
    'editor.php',
    'random-content.php',
    'design-preview.php',
);

foreach ($kihiro_function_files as $kihiro_function_file) {
    require_once get_template_directory() . '/functions/' . $kihiro_function_file;
}
