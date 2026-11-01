<?php
/** Compact image-led article tile. Filters remain above the gallery. */
$entry = $args['entry'];
?>
<li class="article-gallery-card">
  <a href="<?php echo esc_url(get_permalink($entry)); ?>" title="<?php echo esc_attr(get_the_title($entry)); ?>">
    <span class="article-gallery-card__image" aria-hidden="true"><?php echo kihiro_article_thumbnail($entry->ID, 'medium'); ?></span>
    <span class="article-gallery-card__title"><?php echo esc_html(get_the_title($entry)); ?></span>
    <time datetime="<?php echo esc_attr(get_the_date('c', $entry)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $entry)); ?></time>
  </a>
</li>
