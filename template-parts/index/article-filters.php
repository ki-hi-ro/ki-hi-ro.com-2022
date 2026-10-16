<?php
$category_id = absint(kihiro_get_request_value('article_category'));
$tag_id = kihiro_selected_article_tag();
$categories = get_categories(array('hide_empty' => true, 'orderby' => 'count', 'order' => 'DESC'));
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
</section>
