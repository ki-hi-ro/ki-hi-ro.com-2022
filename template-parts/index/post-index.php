<?php
/** Complete published writing history, grouped by year. */
global $wp_query;
$is_article_search = is_search();
$is_article_tag = is_tag();
$is_article_home = is_home() && !$is_article_search && '' === kihiro_get_request_value('view');
$selected_tag = kihiro_selected_article_tag();
$article_tags = get_tags(array('hide_empty' => true));
$years = array();
foreach ($wp_query->posts as $entry) {
    $entry_year = (int) get_the_date('Y', $entry);
    $years[$entry_year < 2022 ? 0 : $entry_year][] = $entry;
}
krsort($years);
$peak = $years ? max(array_map('count', $years)) : 1;
?>
<main id="main-content" class="article-timeline">
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
      <p class="magazine-eyebrow">WRITING ARCHIVE<?php if ($years) : ?> / <?php echo esc_html('2022 — ' . max(array_keys($years))); ?><?php endif; ?></p>
      <h1>すべての記事</h1>
      <p>つくり、考え、書き続けてきた記録。</p>
    </div>
    <p class="article-timeline__total"><strong><?php echo esc_html(number_format_i18n(count($wp_query->posts))); ?></strong><span>記事の積み重ね</span></p>
  </header>
  <?php endif; ?>
  <?php if (is_home()) : ?>
    <?php get_template_part('template-parts/index/article-filters'); ?>
  <?php endif; ?>
  <?php if (!$is_article_search) : ?>
  <nav class="article-timeline__years" aria-label="年別の記事へ移動">
    <?php foreach (array_reverse($years, true) as $year => $entries) : ?>
      <?php if (!$year) continue; ?>
      <a href="#year-<?php echo esc_attr($year); ?>"><strong><?php echo esc_html($year); ?><small>年</small></strong><span><?php echo esc_html(number_format_i18n(count($entries))); ?>記事</span><span class="article-timeline__bar" aria-hidden="true" style="--year-volume: <?php echo esc_attr((string) round(count($entries) / $peak * 100)); ?>%"></span></a>
    <?php endforeach; ?>
  </nav>
  <?php endif; ?>
  <?php foreach ($years as $year => $entries) : ?>
    <section class="article-timeline__year" id="year-<?php echo esc_attr($year); ?>" aria-labelledby="year-heading-<?php echo esc_attr($year); ?>">
      <header><h2 id="year-heading-<?php echo esc_attr($year); ?>"><?php echo $year ? esc_html($year) . '<span>年</span>' : '2021<span>年より前</span>'; ?></h2><p><?php echo esc_html(number_format_i18n(count($entries))); ?><?php echo $is_article_search ? '記事を表示' : '記事'; ?></p></header>
      <ol>
        <?php foreach ($entries as $entry) : ?>
          <li><a href="<?php echo esc_url(get_permalink($entry)); ?>"><span class="article-timeline__thumbnail" aria-hidden="true"><?php echo kihiro_article_thumbnail($entry->ID); ?></span><time datetime="<?php echo esc_attr(get_the_date('Y-m-d', $entry)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $entry)); ?></time><span><?php echo esc_html(get_the_title($entry)); ?></span></a></li>
        <?php endforeach; ?>
      </ol>
    </section>
  <?php endforeach; ?>
  <?php if (!$years) : ?><p>該当する記事はありません。</p><?php endif; ?>
  <?php if ($is_article_search || $is_article_tag) : ?>
    <?php the_posts_pagination(array('mid_size' => 1, 'prev_text' => '前へ', 'next_text' => '次へ')); ?>
  <?php endif; ?>
</main>
