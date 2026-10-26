<?php
$category_id = kihiro_selected_article_category();
$tag_id = kihiro_selected_article_tag();
$archive_mode = 'archive-all' === kihiro_get_request_value('view');
$categories = get_categories(array('hide_empty' => true, 'orderby' => 'count', 'order' => 'DESC'));
// 記事件数が変わっても、カテゴリータブは指定した順番を維持する。
$category_order = array_flip(array('技術・開発', '思考・生き方', '健康・セルフケア', '仕事・キャリア', '旅・場所', 'お金・制度'));
usort($categories, function ($a, $b) use ($category_order) {
    return ($category_order[$a->name] ?? PHP_INT_MAX) <=> ($category_order[$b->name] ?? PHP_INT_MAX);
});
$filter_url = function ($category, $tag) use ($archive_mode) {
    $params = $archive_mode ? array('view' => 'archive-all') : array();
    if ($archive_mode && is_date()) $params['m'] = get_query_var('m') ?: sprintf('%04d%02d', get_query_var('year'), get_query_var('monthnum'));
    if ($category) $params['article_category'] = $category;
    if ($tag) $params['article_tag'] = $tag;
    // Keep a distinct local URL to avoid an old cached root redirect.
    if (wp_get_environment_type() === 'local') $params['local_home'] = '1';
    return $params ? add_query_arg($params, home_url('/')) : home_url('/');
};
?>
<section class="article-filters" aria-label="記事の絞り込み">
  <nav class="article-filters__categories" aria-label="カテゴリー">
    <a href="<?php echo esc_url($filter_url(0, $tag_id)); ?>" <?php if (!$category_id) echo 'aria-current="true"'; ?>><?php echo $archive_mode ? 'すべて' : '最新の更新'; ?></a>
    <?php foreach ($categories as $category) : ?>
      <a href="<?php echo esc_url($filter_url($category->term_id, $tag_id)); ?>" <?php if ($category_id === $category->term_id) echo 'aria-current="true"'; ?>><?php echo esc_html($category->name); ?></a>
    <?php endforeach; ?>
  </nav>
  <?php if ($archive_mode) : $filter_tags = get_tags(array('hide_empty' => true, 'orderby' => 'name', 'order' => 'ASC')); ?>
    <form class="archive-tag-filter" action="<?php echo esc_url(home_url('/')); ?>" method="get">
      <input type="hidden" name="view" value="archive-all">
      <?php if ($category_id) : ?><input type="hidden" name="article_category" value="<?php echo esc_attr($category_id); ?>"><?php endif; ?>
      <?php if (is_date()) : ?><input type="hidden" name="m" value="<?php echo esc_attr(get_query_var('m') ?: sprintf('%04d%02d', get_query_var('year'), get_query_var('monthnum'))); ?>"><?php endif; ?>
      <label for="archive-tag">タグ</label>
      <select id="archive-tag" name="article_tag">
        <option value="">すべてのタグ</option>
        <?php foreach ($filter_tags as $filter_tag) : ?>
          <option value="<?php echo esc_attr($filter_tag->term_id); ?>" <?php selected($tag_id, $filter_tag->term_id); ?>><?php echo esc_html($filter_tag->name); ?></option>
        <?php endforeach; ?>
      </select>
      <button type="submit">絞り込む</button>
      <?php if ($tag_id) : ?><a href="<?php echo esc_url($filter_url($category_id, 0)); ?>">タグを解除</a><?php endif; ?>
    </form>
  <?php endif; ?>
</section>
