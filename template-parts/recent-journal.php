<?php
/** 最近更新した公開記事を、ジャーナルと同じカテゴリーで紹介する。 */
$categories = array();
foreach (array('技術・開発', '思考・生き方', '健康・セルフケア', '仕事・キャリア', '旅・場所', 'お金・制度') as $name) {
    $term = get_term_by('name', $name, 'category');
    if ($term instanceof WP_Term) $categories[$term->term_id] = $term;
}
$selected = absint(kihiro_get_request_value('recent_category'));
if (!isset($categories[$selected])) $selected = 0;
$args = array(
    'post_type' => 'post', 'post_status' => 'publish', 'has_password' => false,
    'posts_per_page' => 8, 'ignore_sticky_posts' => true,
    'post__not_in' => kihiro_excluded_post_ids(), 'orderby' => array('modified' => 'DESC', 'ID' => 'DESC'),
);
if ($selected) $args['cat'] = $selected;
$recent = get_posts($args);
$journal_url = $selected ? add_query_arg('article_category', $selected, kihiro_journal_url()) : kihiro_journal_url();
?>
<section class="work-home__section recent-journal" id="recent-journal" aria-labelledby="recent-journal-heading">
  <header class="work-home__heading"><p class="magazine-eyebrow">LATEST JOURNAL</p><h2 id="recent-journal-heading">日々のジャーナル、最近の更新。</h2><p>技術の学びも、日々の思考や経験も。最近書き直した記事を含め、更新順にご紹介します。</p></header>
  <nav class="recent-journal__categories" aria-label="最近更新した記事のカテゴリー">
    <a href="<?php echo esc_url(home_url('/#recent-journal')); ?>" <?php if (!$selected) echo 'aria-current="true"'; ?>>すべて</a>
    <?php foreach ($categories as $term) : ?><a href="<?php echo esc_url(add_query_arg('recent_category', $term->term_id, home_url('/')) . '#recent-journal'); ?>" <?php if ($selected === $term->term_id) echo 'aria-current="true"'; ?>><?php echo esc_html($term->name); ?></a><?php endforeach; ?>
  </nav>
  <p class="screen-reader-text" role="status" aria-live="polite" data-recent-journal-status></p>
  <div class="recent-journal__grid">
    <?php foreach ($recent as $entry) :
        $tags = get_the_tags($entry->ID);
        $excerpt = $entry->post_excerpt ?: $entry->post_content;
        $excerpt = wp_html_excerpt(preg_replace('/\s+/u', ' ', wp_strip_all_tags(strip_shortcodes($excerpt))), 90, '…');
    ?>
    <article class="recent-journal__card"><a href="<?php echo esc_url(get_permalink($entry)); ?>">
      <h3><?php echo esc_html(get_the_title($entry)); ?></h3>
      <?php if ($tags && !is_wp_error($tags)) : ?><ul class="recent-journal__tags" aria-label="タグ"><?php foreach (array_slice($tags, 0, 3) as $tag) : ?><li><?php echo esc_html($tag->name); ?></li><?php endforeach; ?></ul><?php endif; ?>
      <p class="recent-journal__excerpt"><?php echo esc_html($excerpt); ?></p>
      <div class="recent-journal__dates"><time datetime="<?php echo esc_attr(get_the_modified_date('c', $entry)); ?>"><?php echo esc_html(get_the_modified_date('Y.m.d', $entry)); ?> 更新</time><span aria-hidden="true"> / </span><time datetime="<?php echo esc_attr(get_the_date('c', $entry)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $entry)); ?> 公開</time></div>
      <span class="recent-journal__read">記事を読む <span aria-hidden="true">→</span></span>
    </a></article>
    <?php endforeach; ?>
    <?php if (!$recent) : ?><p>このカテゴリーの記事はまだありません。</p><?php endif; ?>
  </div>
  <p class="work-home__more"><a class="work-home__button" href="<?php echo esc_url($journal_url); ?>">日々のジャーナルをもっと読む <span aria-hidden="true">→</span></a></p>
</section>
