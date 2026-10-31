<?php
/** 全公開記事を投稿日時順にたどる目次。本文のメインクエリは変更しない。 */
$timeline_page = max(1, absint(kihiro_get_request_value('timeline_page')));
$timeline = new WP_Query(array(
    'post_type' => 'post', 'post_status' => 'publish', 'has_password' => false,
    'posts_per_page' => 20, 'paged' => $timeline_page,
    'orderby' => array('date' => 'DESC', 'ID' => 'DESC'),
    'ignore_sticky_posts' => true, 'post__not_in' => kihiro_excluded_post_ids(),
));
$current_id = get_the_ID();
$timeline_url = get_permalink($current_id);
?>
<details class="post-timeline" id="post-timeline" open>
  <summary>記事のタイムライン<span>投稿日時の新しい順</span></summary>
  <nav aria-label="すべての記事を投稿日時から探す">
    <div class="post-timeline__scroll" tabindex="0" role="region" aria-label="記事一覧（スクロールできます）">
      <ol class="post-timeline__list">
        <?php foreach ($timeline->posts as $timeline_entry) : ?>
          <li class="post-timeline__item<?php if ($current_id === $timeline_entry->ID) echo ' is-current'; ?>">
            <time datetime="<?php echo esc_attr(get_the_date('c', $timeline_entry)); ?>"><?php echo esc_html(get_the_date('Y.m.d H:i', $timeline_entry)); ?></time>
            <a href="<?php echo esc_url(get_permalink($timeline_entry)); ?>"<?php if ($current_id === $timeline_entry->ID) echo ' aria-current="page"'; ?>><?php echo esc_html(get_the_title($timeline_entry)); ?><?php if ($current_id === $timeline_entry->ID) : ?><span class="post-timeline__current">閲覧中</span><?php endif; ?></a>
          </li>
        <?php endforeach; ?>
      </ol>
      <?php if (!$timeline->posts) : ?><p>このページの記事はありません。</p><?php endif; ?>
    </div>
    <?php if ($timeline->max_num_pages > 1) : ?>
      <div class="post-timeline__pages">
        <?php if ($timeline_page > 1) : ?><a href="<?php echo esc_url(add_query_arg('timeline_page', $timeline_page - 1, $timeline_url) . '#post-timeline'); ?>">← 新しい記事</a><?php endif; ?>
        <span><?php echo esc_html(number_format_i18n($timeline_page) . ' / ' . number_format_i18n($timeline->max_num_pages)); ?> ページ</span>
        <?php if ($timeline_page < $timeline->max_num_pages) : ?><a href="<?php echo esc_url(add_query_arg('timeline_page', $timeline_page + 1, $timeline_url) . '#post-timeline'); ?>">過去の記事 →</a><?php endif; ?>
      </div>
    <?php endif; ?>
  </nav>
</details>
