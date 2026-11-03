<?php
/** 最近更新した公開記事を1件紹介する。 */
$args = array(
    'post_type' => 'post', 'post_status' => 'publish', 'has_password' => false,
    'posts_per_page' => 1, 'ignore_sticky_posts' => true,
    'post__not_in' => kihiro_excluded_post_ids(), 'orderby' => array('modified' => 'DESC', 'ID' => 'DESC'),
);
$recent = get_posts($args);
$journal_url = kihiro_journal_url();
?>
<section class="work-home__section recent-journal featured-preview" id="recent-journal" aria-labelledby="recent-journal-heading">
  <header class="work-home__heading"><p class="magazine-eyebrow">DAILY JOURNAL</p>
<h2 id="recent-journal-heading">日々の記録</h2><p>心に浮かんだ言葉を書き続けています。最近はAIの思考も取り入れています。</p></header>
  <div class="recent-journal__grid" id="recent-journal-posts">
    <?php foreach ($recent as $entry) :
        $excerpt = $entry->post_excerpt ?: $entry->post_content;
        $excerpt = wp_html_excerpt(preg_replace('/\s+/u', ' ', wp_strip_all_tags(strip_shortcodes($excerpt))), 150, '…');
    ?>
    <article class="recent-journal__card"><a href="<?php echo esc_url(get_permalink($entry)); ?>">
      <span class="recent-journal__thumbnail" aria-hidden="true"><?php echo kihiro_article_thumbnail($entry->ID, 'large'); ?></span>
      <?php $entry_categories = get_the_category($entry->ID); if ($entry_categories) : ?>
        <span class="featured-preview__category"><?php echo esc_html($entry_categories[0]->name); ?></span>
      <?php endif; ?>
      <h3><?php echo esc_html(get_the_title($entry)); ?></h3>

      <p class="recent-journal__excerpt"><?php echo esc_html($excerpt); ?></p>
      <div class="recent-journal__dates"><time datetime="<?php echo esc_attr(get_the_modified_date('c', $entry)); ?>"><?php echo esc_html(get_the_modified_date('Y.m.d', $entry)); ?> 更新</time><span aria-hidden="true"> / </span><time datetime="<?php echo esc_attr(get_the_date('c', $entry)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $entry)); ?> 公開</time></div>
      <span class="recent-journal__read">記事を読む <span aria-hidden="true">→</span></span>
    </a></article>
    <?php endforeach; ?>
    <?php if (!$recent) : ?><p>記事はまだありません。</p><?php endif; ?>
  </div>
  <p class="work-home__more"><a class="work-home__button" href="<?php echo esc_url($journal_url); ?>">日々のジャーナルをもっと読む&#x3000;<span aria-hidden="true">→</span></a></p>
</section>
