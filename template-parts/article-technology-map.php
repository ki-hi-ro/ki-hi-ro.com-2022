<?php
/** A navigable overview of this site's technical topics, with the article's tags highlighted. */
if (!is_singular('post') || post_password_required() || !has_category('技術・開発', get_the_ID())) return;
$definition = require get_template_directory() . '/content/tag-tree.php';
$terms = get_terms(array('taxonomy' => 'post_tag', 'hide_empty' => true));
if (is_wp_error($terms)) return;
$by_name = array();
foreach ($terms as $term) $by_name[$term->name] = $term;
$current_ids = wp_get_post_tags(get_the_ID(), array('fields' => 'ids'));
if (is_wp_error($current_ids)) $current_ids = array();
$technical_category = get_term_by('name', '技術・開発', 'category');
$has_match = false;
$contains_current = function ($items) use (&$contains_current, $by_name, $current_ids) {
    foreach ($items as $item) {
        if (is_array($item) ? $contains_current($item) : (isset($by_name[$item]) && in_array((int) $by_name[$item]->term_id, $current_ids, true))) return true;
    }
    return false;
};
$has_match = $contains_current($definition['技術・開発']);
$render = function ($items, $show_all = false) use (&$render, $contains_current, $by_name, $current_ids, $technical_category) {
    $other_tags = array();
    $group_active = $contains_current($items);
    echo '<ul class="technology-map__branches">';
    foreach ($items as $label => $item) {
        if (is_array($item)) {
            $active = $contains_current($item);
            echo '<li><details class="technology-map__branch"' . ($active ? ' open' : '') . '><summary>' . esc_html($label);
            if ($active) echo '<span class="technology-map__marker">この記事</span>';
            echo '</summary>';
            $render($item);
            echo '</details></li>';
        } elseif (isset($by_name[$item])) {
            $term = $by_name[$item];
            $active = in_array((int) $term->term_id, $current_ids, true);
            if (!$show_all && $group_active && !$active) { $other_tags[] = $item; continue; }
            $url = add_query_arg(array('view' => 'archive-all', 'article_category' => $technical_category->term_id, 'article_tag' => $term->term_id), home_url('/'));
            echo '<li><a class="technology-map__tag' . ($active ? ' technology-map__tag--current' : '') . '" href="' . esc_url($url) . '">' . esc_html($item);
            if ($active) echo '<span class="screen-reader-text">（この記事で扱う技術）</span>';
            echo '</a></li>';
        }
    }
    if ($other_tags) {
        echo '<li><details class="technology-map__branch"><summary>同じ分野のほかの技術</summary>';
        $render($other_tags, true);
        echo '</details></li>';
    }
    echo '</ul>';
};
?>
<aside class="technology-map" aria-label="この記事の技術の位置づけ">
  <p class="technology-map__heading">この記事の技術の位置づけ</p>
  <p class="technology-map__description">記事のタグをもとに、扱う技術を強調しています。ほかの分野も開いて、関連する記事を探せます。</p>
  <details class="technology-map__overview" <?php if ($has_match) echo 'open'; ?>>
    <summary>技術・開発</summary>
    <?php $render($definition['技術・開発']); ?>
  </details>
  <?php if (!$has_match) : ?><p class="technology-map__description">この記事に対応する具体的な技術分類は整理中です。</p><?php endif; ?>
  <p class="technology-map__note">このサイトの記事を読むための見取り図です。技術は複数の分野にまたがる場合があります。</p>
</aside>
