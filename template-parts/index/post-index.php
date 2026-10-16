<?php
/** Complete published writing history, grouped by year. */
global $wp_query;
$is_article_search = is_search();
$is_article_tag = is_tag();
$is_article_home = is_home() && !$is_article_search && '' === kihiro_get_request_value('view');
$years = array();
foreach ($wp_query->posts as $entry) {
    $entry_year = (int) get_the_date('Y', $entry);
    $years[$entry_year < 2022 ? 0 : $entry_year][] = $entry;
}
krsort($years);
if (is_home()) {
    $years = $wp_query->posts ? array('latest' => $wp_query->posts) : array();
}
?>
<main id="main-content" class="article-timeline article-timeline--cards">
  <?php if ($is_article_search) : ?>
    <header class="article-timeline__header">
      <div>
        <h1>検索結果</h1>
        <p>「<?php echo esc_html(get_search_query()); ?>」の記事一覧</p>
      </div>
      <p class="article-timeline__total"><strong><?php echo esc_html(number_format_i18n($wp_query->found_posts)); ?></strong><span>件の記事</span></p>
    </header>
  <?php elseif ($is_article_tag) : ?>
    <header class="article-timeline__header">
      <div>
        <h1><?php single_tag_title(); ?></h1>
        <p>このタグが付いた記事</p>
        <?php if (tag_description()) : ?>
          <div class="journal-description"><?php echo wp_kses_post(tag_description()); ?></div>
        <?php endif; ?>
      </div>
      <p class="article-timeline__total"><strong><?php echo esc_html(number_format_i18n($wp_query->found_posts)); ?></strong><span>件の記事</span></p>
    </header>
  <?php elseif ($is_article_home) : ?>
    <h1 class="screen-reader-text">記事一覧</h1>
    <figure class="article-timeline__main-view">
      <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/home-main-view.jpg')); ?>" width="4032" height="3024" alt="木々に囲まれたログハウスの風景" fetchpriority="high" decoding="async">
    </figure>
  <?php else : ?>
  <header class="article-timeline__header">
    <div>
      <p class="magazine-eyebrow">WRITING ARCHIVE</p>
      <h1>すべての記事</h1>
      <p>つくり、考え、書き続けてきた記録。</p>
    </div>
    <p class="article-timeline__total"><strong><?php echo esc_html(number_format_i18n($wp_query->found_posts)); ?></strong><span>記事の積み重ね</span></p>
  </header>
  <?php endif; ?>
  <?php if (is_home()) : ?>
    <?php get_template_part('template-parts/index/article-filters'); ?>
  <?php endif; ?>
  <?php foreach ($years as $year => $entries) : ?>
    <section class="article-timeline__year" id="year-<?php echo esc_attr($year); ?>" aria-labelledby="year-heading-<?php echo esc_attr($year); ?>">
      <?php if (is_home()) : ?>
        <h2 id="year-heading-latest" class="screen-reader-text">記事一覧</h2>
      <?php else : ?>
        <header><h2 id="year-heading-<?php echo esc_attr($year); ?>"><?php echo $year ? esc_html($year) . '<span>年</span>' : '2021<span>年より前</span>'; ?></h2><p><?php echo esc_html(number_format_i18n(count($entries))); ?>記事を表示</p></header>
      <?php endif; ?>
      <ol>
        <?php foreach ($entries as $entry) : ?>
          <li><a href="<?php echo esc_url(get_permalink($entry)); ?>"><span class="article-timeline__thumbnail" aria-hidden="true"><?php echo kihiro_article_thumbnail($entry->ID, 'large'); ?></span><span class="article-card-dates"><time datetime="<?php echo esc_attr(get_the_date('Y-m-d', $entry)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $entry)); ?> 公開</time> ／ <time datetime="<?php echo esc_attr(get_the_modified_date('Y-m-d', $entry)); ?>"><?php echo esc_html(get_the_modified_date('Y.m.d', $entry)); ?> 更新</time></span><span><?php echo esc_html(get_the_title($entry)); ?></span></a></li>
        <?php endforeach; ?>
      </ol>
    </section>
  <?php endforeach; ?>
  <?php if (!$years) : ?><p>該当する記事はありません。</p><?php endif; ?>
  <?php if (is_home() && $wp_query->post_count) : ?>
    <?php $range_start = (max(1, (int) get_query_var('paged')) - 1) * (int) $wp_query->get('posts_per_page') + 1; ?>
    <p class="article-list-range"><?php echo esc_html(number_format_i18n($range_start)); ?>〜<?php echo esc_html(number_format_i18n($range_start + $wp_query->post_count - 1)); ?>件を表示 / 全<?php echo esc_html(number_format_i18n($wp_query->found_posts)); ?>記事</p>
  <?php endif; ?>
  <?php if (is_home() || $is_article_search || $is_article_tag) : ?>
    <?php the_posts_pagination(array('show_all' => true, 'prev_next' => false, 'add_fragment' => is_home() ? '#year-latest' : '')); ?>
  <?php endif; ?>
</main>
