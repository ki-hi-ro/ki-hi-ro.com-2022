<?php
/** Related published posts: shared tags first, then shared categories. */
$current_id = get_the_ID();
$related = array();
$excluded = array_merge(array($current_id), kihiro_excluded_post_ids());
foreach (array('post_tag', 'category') as $taxonomy) {
    $term_ids = wp_get_post_terms($current_id, $taxonomy, array('fields' => 'ids'));
    if (is_wp_error($term_ids) || !$term_ids) continue;
    $matches = get_posts(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'has_password' => false,
        'posts_per_page' => 3 - count($related),
        'post__not_in' => $excluded,
        'ignore_sticky_posts' => true,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(array('taxonomy' => $taxonomy, 'field' => 'term_id', 'terms' => $term_ids)),
    ));
    $related = array_merge($related, $matches);
    $excluded = array_merge($excluded, wp_list_pluck($matches, 'ID'));
    if (count($related) >= 3) break;
}
?>
<section class="related-posts" aria-labelledby="related-posts-heading">
  <h2 id="related-posts-heading">関連記事</h2>
  <?php if ($related) : ?>
    <div class="related-posts__grid">
      <?php foreach ($related as $related_post) : ?>
        <a class="related-posts__card" href="<?php echo esc_url(get_permalink($related_post)); ?>">
          <span class="related-posts__image" aria-hidden="true"><?php echo kihiro_article_thumbnail($related_post->ID); ?></span>
          <time datetime="<?php echo esc_attr(get_the_date('c', $related_post)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $related_post)); ?></time>
          <h3><?php echo esc_html(get_the_title($related_post)); ?></h3>
        </a>
      <?php endforeach; ?>
    </div>
  <?php else : ?>
    <p>関連記事はまだありません。<a href="<?php echo esc_url(kihiro_all_articles_url()); ?>">すべての記事を見る</a></p>
  <?php endif; ?>
</section>
