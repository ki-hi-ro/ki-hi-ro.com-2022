<?php
$category_id = absint(kihiro_get_request_value('article_category'));
$tag_id = kihiro_selected_article_tag();
$categories = get_categories(array('hide_empty' => true, 'orderby' => 'count', 'order' => 'DESC'));
$tags = get_tags(array('hide_empty' => true));
$popular_tags = get_tags(array('hide_empty' => true, 'orderby' => 'count', 'order' => 'DESC', 'number' => 8));
$filter_url = function ($category, $tag) {
    $params = array();
    if ($category) $params['article_category'] = $category;
    if ($tag) $params['article_tag'] = $tag;
    // Keep a distinct local URL to avoid an old cached root redirect.
    if (wp_get_environment_type() === 'local') $params['local_home'] = '1';
    return $params ? add_query_arg($params, home_url('/')) : home_url('/');
};
?>
<section class="article-filters" aria-label="記事の絞り込み">
  <nav class="article-filters__categories" aria-label="カテゴリー">
    <a href="<?php echo esc_url($filter_url(0, $tag_id)); ?>" <?php if (!$category_id) echo 'aria-current="true"'; ?>>すべて</a>
    <?php foreach ($categories as $category) : ?>
      <a href="<?php echo esc_url($filter_url($category->term_id, $tag_id)); ?>" <?php if ($category_id === $category->term_id) echo 'aria-current="true"'; ?>><?php echo esc_html($category->name); ?></a>
    <?php endforeach; ?>
  </nav>
  <div class="article-filters__tags">
    <span class="article-filters__label">タグ</span>
    <a class="article-filters__pill" href="<?php echo esc_url($filter_url($category_id, 0)); ?>" <?php if (!$tag_id) echo 'aria-current="true"'; ?>>すべて</a>
    <?php if (!is_wp_error($popular_tags)) : foreach ($popular_tags as $tag) : ?>
      <a class="article-filters__pill" href="<?php echo esc_url($filter_url($category_id, $tag->term_id)); ?>" <?php if ($tag_id === $tag->term_id) echo 'aria-current="true"'; ?>><?php echo esc_html($tag->name); ?></a>
    <?php endforeach; endif; ?>
  </div>
  <form class="article-filters__form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
    <?php if ($category_id) : ?><input type="hidden" name="article_category" value="<?php echo esc_attr($category_id); ?>"><?php endif; ?>
    <label for="article-tag">すべてのタグから選ぶ</label>
    <select id="article-tag" name="article_tag">
      <option value="">すべてのタグ</option>
      <?php if (!is_wp_error($tags)) : foreach ($tags as $tag) : ?>
        <option value="<?php echo esc_attr($tag->term_id); ?>" <?php selected($tag_id, $tag->term_id); ?>><?php echo esc_html($tag->name); ?></option>
      <?php endforeach; endif; ?>
    </select>
    <button type="submit">絞り込む</button>
    <?php if ($category_id || $tag_id) : ?><a href="<?php echo esc_url($filter_url(0, 0)); ?>">絞り込みを解除</a><?php endif; ?>
  </form>
  <p class="article-filters__count" role="status"><?php echo esc_html(number_format_i18n(count($GLOBALS['wp_query']->posts))); ?>件の記事<?php if ($category_id || $tag_id) echo 'が見つかりました'; ?></p>
</section>
