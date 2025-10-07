<?php
// template-parts/tag-list.php

// 受け取り設定（デフォルト）
$container_class = $args['container_class'] ?? 'tag-list';
$ul_class        = $args['ul_class']        ?? 'front-sec__text front-sec__flex';
$title_tag       = $args['title_tag']       ?? 'h2';
$title_text      = $args['title_text']      ?? 'タグ一覧';
$hide_empty      = $args['hide_empty']      ?? false;

// 並び順オプション: 'custom' / 'name' / 'count' / 'rand'
$order_mode      = $args['order_mode']      ?? 'custom';

// 手動順（どちらか／両方OK）
$custom_slugs    = $args['custom_slugs']    ?? [];   // 例: ['shopping_list_app', ...]
$custom_names    = $args['custom_names']    ?? [];   // 例: ['哲学', '旅行', ...]

$query = [
  'hide_empty' => $hide_empty,
  'orderby'    => 'name',
  'order'      => 'ASC',
];

$tags = get_tags($query);
if (empty($tags)) return;

// マップ作成（スラッグ／名前）
$map_by_slug = [];
$map_by_name = [];
foreach ($tags as $t) {
  $map_by_slug[$t->slug] = $t;
  $map_by_name[$t->name] = $t; // 表示名での完全一致
}

// 並び替え
if ($order_mode === 'custom') {
  $sorted = [];

  // 1) 名前での指定を優先
  if (!empty($custom_names)) {
    foreach ($custom_names as $nm) {
      if (isset($map_by_name[$nm])) $sorted[] = $map_by_name[$nm];
    }
  }

  // 2) スラッグ指定があれば続けて反映（重複しないように）
  if (!empty($custom_slugs)) {
    $seen_ids = array_column($sorted, 'term_id');
    foreach ($custom_slugs as $slug) {
      if (isset($map_by_slug[$slug]) && !in_array($map_by_slug[$slug]->term_id, $seen_ids, true)) {
        $sorted[] = $map_by_slug[$slug];
      }
    }
  }

  // 何も指定が無ければ全件（名前順）のまま
  if (!empty($sorted)) $tags = $sorted;

} elseif ($order_mode === 'rand') {
  shuffle($tags);
}

// 出力
?>

<div class="<?= esc_attr($container_class); ?>">
  <<?= tag_escape($title_tag); ?>>
    <?= esc_html($title_text); ?>
  </<?= tag_escape($title_tag); ?>>
  <ul class="<?= esc_attr($ul_class); ?>">
    <?php foreach ($tags as $tag): ?>
      <li>
        <a href="<?= esc_url(get_tag_link($tag->term_id)); ?>">
          <?= esc_html($tag->name); ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>