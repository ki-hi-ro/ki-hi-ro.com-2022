<?php
$tag_id = kihiro_selected_article_tag();
$action = $args['action'] ?? home_url('/');
$hidden = $args['hidden'] ?? array();
$clear_url = $args['clear_url'] ?? $action;
$filter_tags = $args['tags'] ?? get_tags(array('hide_empty' => true, 'orderby' => 'name', 'order' => 'ASC'));
?>
    <form class="archive-tag-filter" action="<?php echo esc_url($action); ?>" method="get">
      <?php foreach ($hidden as $name => $value) : ?><input type="hidden" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>"><?php endforeach; ?>
      <span id="archive-tag-label">タグ</span>
      <?php $selected_tag = $tag_id ? get_term($tag_id, 'post_tag') : null; ?>
      <details class="tag-tree-picker">
        <summary aria-labelledby="archive-tag-label archive-tag-selection"><span id="archive-tag-selection" data-selected-tag><?php echo $selected_tag instanceof WP_Term ? esc_html($selected_tag->name) : 'すべてのタグ'; ?></span><span class="tag-tree-picker__chevron" aria-hidden="true"><svg viewBox="0 0 16 16" width="14" height="14"><path d="m3 6 5 5 5-5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></summary>
        <div class="tag-tree-picker__panel">
          <p class="tag-tree-picker__hint">テーマを開いてタグを選ぶと、自動で絞り込みます。</p>
          <fieldset class="tag-tree"><legend class="screen-reader-text">タグを1つ選択</legend>
            <label class="tag-tree__tag tag-tree__all"><input type="radio" name="article_tag" value="" data-tag-label="すべてのタグ" <?php checked($tag_id, 0); ?>><span>すべてのタグ</span></label>
            <?php kihiro_render_tag_tree(kihiro_tag_display_tree($filter_tags, $args['root'] ?? ''), $tag_id); ?>
          </fieldset>
        </div>
      </details>
      <?php if ($tag_id) : ?><a href="<?php echo esc_url($clear_url); ?>">タグを解除</a><?php endif; ?>
    </form>
