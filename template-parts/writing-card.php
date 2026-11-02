<?php
/** Shared compact card for all article and case study indexes. */
$entry = $args['entry'];
$date_format = $args['date_format'] ?? 'Y.m.d';
$is_case = !empty($args['is_case']);
$image = $is_case ? kihiro_case_study_image($entry) : kihiro_article_thumbnail($entry->ID, 'large');
if (!$image && $is_case) $image = '<img src="' . esc_url(get_theme_file_uri('/assets/images/case-study-placeholder.svg')) . '" alt="" loading="lazy">';
$excerpt = $entry->post_excerpt ?: $entry->post_content;
$excerpt = wp_html_excerpt(preg_replace('/\s+/u', ' ', wp_strip_all_tags(strip_shortcodes($excerpt))), 90, '…');
?>
<li class="writing-card">
  <a class="writing-card__link" href="<?php echo esc_url(get_permalink($entry)); ?>">
    <span class="article-timeline__thumbnail" aria-hidden="true"><?php echo wp_kses_post($image); ?></span>
    <h3 class="writing-card__title"><?php echo esc_html(get_the_title($entry)); ?></h3>
    <p class="writing-card__excerpt"><?php echo esc_html($excerpt); ?></p>
    <span class="article-card-dates"><time datetime="<?php echo esc_attr(get_the_modified_date('c', $entry)); ?>"><?php echo esc_html(get_the_modified_date($date_format, $entry)); ?> 更新</time> / <time datetime="<?php echo esc_attr(get_the_date('c', $entry)); ?>"><?php echo esc_html(get_the_date($date_format, $entry)); ?> 公開</time></span>
    <span class="writing-card__read"><?php echo $is_case ? '課題と実装内容を見る' : '記事を読む'; ?> <span aria-hidden="true">→</span></span>
  </a>
</li>
