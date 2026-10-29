<?php
$entry = $args['entry'];
$tag_base = $args['tag_base'] ?? home_url('/');
$tag_args = $args['tag_args'] ?? array();
$tags = get_the_tags($entry->ID);
?>
<li class="writing-card">
  <a class="writing-card__link" href="<?php echo esc_url(get_permalink($entry)); ?>">
    <span class="article-timeline__thumbnail" aria-hidden="true"><?php echo kihiro_article_thumbnail($entry->ID, 'large'); ?></span>
    <span class="article-card-dates"><time datetime="<?php echo esc_attr(get_the_date('c', $entry)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $entry)); ?> 公開</time> / <time datetime="<?php echo esc_attr(get_the_modified_date('c', $entry)); ?>"><?php echo esc_html(get_the_modified_date('Y.m.d', $entry)); ?> 更新</time></span>
    <span class="writing-card__title"><?php echo esc_html(get_the_title($entry)); ?></span>
  </a>
  <?php if ($tags && !is_wp_error($tags)) : ?>
  <div class="writing-card__tags" aria-label="タグ">
    <?php foreach ($tags as $tag) : ?><a href="<?php echo esc_url(add_query_arg(array_merge($tag_args, array('article_tag' => $tag->term_id)), $tag_base)); ?>" <?php if (kihiro_selected_article_tag() === $tag->term_id) echo 'aria-current="true"'; ?>><?php echo esc_html($tag->name); ?></a><?php endforeach; ?>
  </div>
  <?php endif; ?>
</li>
