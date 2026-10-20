<?php
$category_id = absint(kihiro_get_request_value('article_category'));
$tag_id = kihiro_selected_article_tag();
$categories = get_categories(array('hide_empty' => true, 'orderby' => 'count', 'order' => 'DESC'));
// 記事件数が変わっても、カテゴリータブは指定した順番を維持する。
$category_order = array_flip(array('思考・生き方', '健康・セルフケア', '仕事・キャリア', '旅・場所', 'お金・制度', '技術・開発'));
usort($categories, function ($a, $b) use ($category_order) {
    return ($category_order[$a->name] ?? PHP_INT_MAX) <=> ($category_order[$b->name] ?? PHP_INT_MAX);
});
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
    <?php foreach ($categories as $category) : ?>
      <a href="<?php echo esc_url($filter_url($category->term_id, $tag_id)); ?>" <?php if ($category_id === $category->term_id) echo 'aria-current="true"'; ?>><?php echo esc_html($category->name); ?></a>
    <?php endforeach; ?>
  </nav>
</section>
