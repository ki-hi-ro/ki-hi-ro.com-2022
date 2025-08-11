<?php
// 最近書いた記事
get_template_part('template-parts/new-posts');

$common_names = require locate_template('template-parts/_tag-names.php');

// スマホ用の見た目（クラス）で同じパーツを再利用
get_template_part('template-parts/tag-list', null, [
  'container_class' => 'tag-list',                  // SP用
  'ul_class'        => 'front-sec__text front-sec__flex',
  'title_tag'       => 'h2',
  'title_text'      => 'タグ一覧',
  'order_mode'      => 'custom',                    // 気分で順序を変えたいとき
  'custom_names'    => $common_names,         // ★名前指定
  'hide_empty'      => false,
]);
?>