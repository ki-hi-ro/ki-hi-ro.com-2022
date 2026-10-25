<?php
/** 更新記事の大きな棚と、公開順の小さなリストで読みたい記事を探す。 */
global $wp_query;
$today = current_datetime()->format('Y-m-d');
// 各カテゴリーは更新日の新しい3件に絞る。
$category_shelves = array();
foreach (array('思考・生き方', '健康・セルフケア', '仕事・キャリア', '旅・場所', 'お金・制度', '技術・開発') as $shelf_name) {
    $shelf_term = get_term_by('name', $shelf_name, 'category');
    if (!$shelf_term instanceof WP_Term) continue;
    $page_key = 'category_page_' . $shelf_term->term_id;
    $shelf_page = max(1, absint(kihiro_get_request_value($page_key)));
    $shelf_query = new WP_Query(array(
        'post_type' => 'post', 'post_status' => 'publish', 'has_password' => false,
        'posts_per_page' => 3, 'paged' => $shelf_page, 'cat' => $shelf_term->term_id,
        'orderby' => array('modified' => 'DESC', 'ID' => 'DESC'),
        'ignore_sticky_posts' => true, 'no_found_rows' => false,
        'post__not_in' => kihiro_excluded_post_ids(),
    ));
    if ($shelf_query->posts) $category_shelves[] = array('term' => $shelf_term, 'posts' => $shelf_query->posts, 'page' => $shelf_page, 'pages' => $shelf_query->max_num_pages, 'page_key' => $page_key);
}
?>
<main id="main-content" class="journal-discovery">
  <h1 class="screen-reader-text">日々のジャーナル</h1>
  <?php if (is_user_logged_in() && current_user_can('edit_posts')) : ?>
    <div class="article-create"><a class="discovery-create" href="<?php echo esc_url(admin_url('post-new.php')); ?>"><span aria-hidden="true">＋</span> 新規投稿</a></div>
  <?php endif; ?>
  <section class="discovery-section" aria-labelledby="year-heading-latest" id="year-latest">
    <header class="discovery-section-heading"><h2 id="year-heading-latest">更新した記事</h2></header>
    <?php if ($wp_query->posts) : ?>
      <ol class="discovery-featured">
        <?php foreach ($wp_query->posts as $entry) : ?>
          <li><a class="discovery-feature" href="<?php echo esc_url(get_permalink($entry)); ?>">
            <span class="discovery-artwork"><?php echo kihiro_article_thumbnail($entry->ID, 'large'); ?><?php if (get_the_modified_date('Y-m-d', $entry) === $today) : ?><span class="discovery-badge">本日更新</span><?php endif; ?><span class="discovery-open" aria-hidden="true">↗</span></span>
            <h3><?php echo esc_html(get_the_title($entry)); ?></h3>
            <span class="discovery-meta"><?php echo esc_html(get_the_modified_date('Y年n月j日', $entry)); ?> 更新</span>
            <span class="discovery-published"><?php echo esc_html(get_the_date('Y.m.d', $entry)); ?> 公開</span>
          </a></li>
        <?php endforeach; ?>
      </ol>
    <?php else : ?><p>該当する記事はありません。</p><?php endif; ?>
    <?php the_posts_pagination(array('show_all' => true, 'prev_next' => false, 'add_fragment' => '#year-latest')); ?>
  </section>
  <?php foreach ($category_shelves as $shelf) : ?>
    <section class="discovery-section" aria-labelledby="discovery-category-<?php echo esc_attr($shelf['term']->term_id); ?>">
      <header class="discovery-section-heading"><h2 id="discovery-category-<?php echo esc_attr($shelf['term']->term_id); ?>"><?php echo esc_html($shelf['term']->name); ?></h2></header>
      <ol class="discovery-featured">
        <?php foreach ($shelf['posts'] as $entry) : ?>
          <li><a class="discovery-feature" href="<?php echo esc_url(get_permalink($entry)); ?>">
            <span class="discovery-artwork"><?php echo kihiro_article_thumbnail($entry->ID, 'large'); ?><?php if (get_the_modified_date('Y-m-d', $entry) === $today) : ?><span class="discovery-badge">本日更新</span><?php endif; ?><span class="discovery-open" aria-hidden="true">↗</span></span>
            <h3><?php echo esc_html(get_the_title($entry)); ?></h3>
            <span class="discovery-meta"><?php echo esc_html(get_the_modified_date('Y年n月j日', $entry)); ?> 更新</span>
            <span class="discovery-published"><?php echo esc_html(get_the_date('Y.m.d', $entry)); ?> 公開</span>
          </a></li>
        <?php endforeach; ?>
      </ol>
      <?php if ($shelf['pages'] > 1) : ?>
        <nav class="navigation pagination" aria-label="<?php echo esc_attr($shelf['term']->name . 'のページ送り'); ?>"><div class="nav-links"><?php echo wp_kses_post(paginate_links(array(
            'base' => add_query_arg($shelf['page_key'], '%#%', get_pagenum_link(max(1, get_query_var('paged')))),
            'format' => '', 'current' => $shelf['page'], 'total' => $shelf['pages'],
            'show_all' => true, 'prev_next' => false,
            'add_fragment' => '#discovery-category-' . $shelf['term']->term_id,
        ))); ?></div></nav>
      <?php endif; ?>
    </section>
  <?php endforeach; ?>
  <section class="discovery-library" aria-labelledby="discovery-library-heading"><div><h2 id="discovery-library-heading">これまでの記録</h2><p>読みたい月へ、ふと戻る。</p></div><?php get_template_part('template-parts/monthly-archives'); ?></section>
</main>
