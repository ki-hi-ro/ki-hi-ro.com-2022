<?php
/** Build a display tree from live terms, retaining every available tag once. */
function kihiro_tag_display_tree($tags, $root = '') {
    $by_name = array();
    foreach ($tags as $tag) $by_name[$tag->name] = $tag;
    $used = array();
    $build = function ($definition) use (&$build, $by_name, &$used) {
        $nodes = array();
        foreach ($definition as $label => $item) {
            if (is_array($item)) {
                $children = $build($item);
                if (!$children) continue;
                $ids = array();
                foreach ($children as $child) $ids = array_merge($ids, $child['ids']);
                $nodes[] = array('label' => $label, 'children' => $children, 'ids' => $ids);
            } elseif (isset($by_name[$item]) && !isset($used[$by_name[$item]->term_id])) {
                $tag = $by_name[$item];
                $used[$tag->term_id] = true;
                $nodes[] = array('tag' => $tag, 'ids' => array($tag->term_id));
            }
        }
        return $nodes;
    };
    $definition = require get_template_directory() . '/content/tag-tree.php';
    // 特定分野の一覧では、その子分類を最上位として表示する。
    if ($root && isset($definition[$root])) return $build($definition[$root]);
    $tree = $build($definition);
    $remaining = array();
    foreach ($tags as $tag) {
        if (!isset($used[$tag->term_id])) $remaining[] = array('tag' => $tag, 'ids' => array($tag->term_id));
    }
    if ($remaining) {
        $remaining_ids = array();
        foreach ($remaining as $node) $remaining_ids = array_merge($remaining_ids, $node['ids']);
        $tree[] = array('label' => 'そのほかのタグ', 'children' => $remaining, 'ids' => $remaining_ids);
    }
    return $tree;
}

function kihiro_render_tag_tree($nodes, $selected_id) {
    echo '<ul class="tag-tree__branches">';
    foreach ($nodes as $node) {
        echo '<li>';
        if (isset($node['tag'])) {
            $tag = $node['tag'];
            printf('<label class="tag-tree__tag"><input type="radio" name="article_tag" value="%1$d" data-tag-label="%2$s" %3$s><span>%4$s</span></label>', (int) $tag->term_id, esc_attr($tag->name), checked($selected_id, $tag->term_id, false), esc_html($tag->name));
        } else {
            printf('<details class="tag-tree__branch" %s><summary>%s</summary>', in_array($selected_id, $node['ids'], true) ? 'open' : '', esc_html($node['label']));
            kihiro_render_tag_tree($node['children'], $selected_id);
            echo '</details>';
        }
        echo '</li>';
    }
    echo '</ul>';
}
