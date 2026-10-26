<?php
/**
 * Theme bootstrap.
 *
 * Feature implementations live in the functions directory so this file only
 * defines the loading order.
 */

// 読み込み順は依存関係に合わせる。共通設定・アセット・取得処理を先に定義し、
// その後でお問い合わせ・いいね・固定ページ固有の機能を登録する。
$kihiro_function_files = array(
    'setup.php',
    'assets.php',
    'content.php',
    'contact.php',
    'likes.php',
    'story.php',
    'case-study.php',
    'services.php',
    'design-preview.php',
);

foreach ($kihiro_function_files as $kihiro_function_file) {
    require_once get_template_directory() . '/functions/' . $kihiro_function_file;
}
