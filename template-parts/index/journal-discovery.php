<?php
/** 更新記事の大きな棚と、公開順の小さなリストで読みたい記事を探す。 */
global $wp_query;
$today = current_datetime()->format('Y-m-d');
$category_id = kihiro_selected_article_category();
$category = get_term($category_id, 'category');
$category_name = $category instanceof WP_Term ? $category->name : '日々のジャーナル';
$recent_args = array(
    'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 6,
    'orderby' => array('date' => 'DESC', 'ID' => 'DESC'),
    'ignore_sticky_posts' => true, 'no_found_rows' => true,
    'post__not_in' => array_merge(kihiro_excluded_post_ids(), wp_list_pluck($wp_query->posts, 'ID')),
);
if ($category_id) $recent_args['cat'] = $category_id;
if (kihiro_selected_article_tag()) $recent_args['tag_id'] = kihiro_selected_article_tag();
$recent_posts = get_posts($recent_args);
?>
<main id="main-content" class="journal-discovery">
  <header class="discovery-heading">
    <div><p class="discovery-eyebrow">日々のジャーナル</p><h1><?php echo esc_html($category_name); ?></h1><p class="discovery-description">自分の人生にとって、大事なこと。</p></div>
    <?php if (is_user_logged_in() && current_user_can('edit_posts')) : ?>
      <a class="discovery-create" href="<?php echo esc_url(admin_url('post-new.php')); ?>"><span aria-hidden="true">＋</span> 新規投稿</a>
    <?php endif; ?>
  </header>
  <?php get_template_part('template-parts/index/article-filters'); ?>
  <section class="discovery-section" aria-labelledby="year-heading-latest" id="year-latest">
    <header class="discovery-section-heading"><h2 id="year-heading-latest">最近の更新</h2><span>書き足しながら、考える。</span></header>
    <?php if ($wp_query->posts) : ?>
      <ol class="discovery-featured">
        <?php foreach ($wp_query->posts as $entry) : ?>
          <li><a class="discovery-feature" href="<?php echo esc_url(get_permalink($entry)); ?>">
            <span class="discovery-meta"><?php echo esc_html(get_the_modified_date('Y年n月j日', $entry)); ?> 更新</span>
            <h3><?php echo esc_html(get_the_title($entry)); ?></h3>
            <span class="discovery-artwork"><?php echo kihiro_article_thumbnail($entry->ID, 'large'); ?><?php if (get_the_modified_date('Y-m-d', $entry) === $today) : ?><span class="discovery-badge">本日更新</span><?php endif; ?><span class="discovery-open" aria-hidden="true">↗</span></span>
            <span class="discovery-published"><?php echo esc_html(get_the_date('Y.m.d', $entry)); ?> 公開</span>
          </a></li>
        <?php endforeach; ?>
      </ol>
    <?php else : ?><p>該当する記事はありません。</p><?php endif; ?>
    <?php the_posts_pagination(array('mid_size' => 1, 'prev_text' => '前へ', 'next_text' => '次へ', 'add_fragment' => '#year-latest')); ?>
  </section>
  <?php if ($recent_posts) : ?>
    <section class="discovery-section" aria-labelledby="discovery-recent-heading">
      <header class="discovery-section-heading"><h2 id="discovery-recent-heading">新しく書いたこと</h2><span>日々の記録から。</span></header>
      <ol class="discovery-tracks">
        <?php foreach ($recent_posts as $entry) : ?>
          <li><a href="<?php echo esc_url(get_permalink($entry)); ?>"><span class="discovery-track-art" aria-hidden="true"><?php echo kihiro_article_thumbnail($entry->ID, 'thumbnail'); ?></span><span class="discovery-track-copy"><span class="discovery-track-title"><?php echo esc_html(get_the_title($entry)); ?></span><span class="discovery-meta"><?php echo esc_html(get_the_date('Y年n月j日', $entry)); ?> 公開</span></span><span class="discovery-track-arrow" aria-hidden="true">›</span></a></li>
        <?php endforeach; ?>
      </ol>
    </section>
  <?php endif; ?>
  <section class="discovery-library" aria-labelledby="discovery-library-heading"><div><h2 id="discovery-library-heading">これまでの記録</h2><p>読みたい月へ、ふと戻る。</p></div><?php get_template_part('template-parts/monthly-archives'); ?></section>
</main>
