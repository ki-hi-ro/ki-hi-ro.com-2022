<?php
/** Page hierarchy, with the final item identifying the current page. */
if (is_home() && !is_paged() && '' === kihiro_get_request_value('view') && '' === kihiro_get_request_value('journal_date')) return;
$items = array(array('label' => 'ホーム', 'url' => kihiro_logo_home_url()));
$journal = array('label' => '日々の記録', 'url' => kihiro_journal_url());
if (is_singular('post')) {
    $items[] = $journal;
    $items[] = array('label' => get_the_title(), 'url' => '');
} elseif (is_page()) {
    foreach (array_reverse(get_post_ancestors(get_queried_object_id())) as $ancestor) {
        $ancestor_label = get_page_template_slug($ancestor) === 'page-case-study-index.php' ? '制作実績' : get_the_title($ancestor);
        $items[] = array('label' => $ancestor_label, 'url' => get_permalink($ancestor));
    }
    $label = get_the_title();
    if (is_page_template('page-case-study-index.php')) $label = '制作実績';
    if (is_page_template('page-about.php')) $label = '自己紹介';
    if (is_page('contact-us')) $label = 'お問い合わせ';
    $items[] = array('label' => $label, 'url' => '');
} elseif (is_search()) {
    $items[] = $journal;
    $items[] = array('label' => '検索結果', 'url' => '');
} elseif (is_404()) {
    $items[] = array('label' => 'ページが見つかりません', 'url' => '');
} else {
    $items[] = $journal;
    if (is_tag() || is_category()) {
        $items[] = array('label' => single_term_title('', false), 'url' => '');
    } else {
        $category_id = kihiro_selected_article_category();
        $tag_id = kihiro_selected_article_tag();
        $category = $category_id ? get_term($category_id, 'category') : null;
        $tag = $tag_id ? get_term($tag_id, 'post_tag') : null;
        if ($category instanceof WP_Term) $items[] = array('label' => $category->name, 'url' => add_query_arg('article_category', $category_id, kihiro_journal_url()));
        if ($tag instanceof WP_Term) $items[] = array('label' => $tag->name, 'url' => add_query_arg('article_tag', $tag_id, kihiro_journal_url()));
        if (is_date()) $items[] = array('label' => wp_strip_all_tags(get_the_archive_title()), 'url' => '');
        elseif (kihiro_get_request_value('journal_date')) $items[] = array('label' => kihiro_get_request_value('journal_date'), 'url' => '');
    }
}
$page_number = max(1, (int) get_query_var('paged'));
if ($page_number > 1) $items[] = array('label' => $page_number . 'ページ目', 'url' => '');
$last = count($items) - 1;
?>
<nav class="site-breadcrumbs" aria-label="パンくずリスト">
  <ol>
    <?php foreach ($items as $index => $item) : ?>
      <li>
        <?php if ($index < $last && $item['url']) : ?>
          <a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a>
        <?php else : ?>
          <span<?php if ($index === $last) echo ' aria-current="page"'; ?>><?php echo esc_html($item['label']); ?></span>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ol>
</nav>
