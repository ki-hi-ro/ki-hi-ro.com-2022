<?php
/** Complete published writing history, grouped by year. */
global $wp_query;
$years = array();
foreach ($wp_query->posts as $entry) {
    $entry_year = (int) get_the_date('Y', $entry);
    $years[$entry_year < 2022 ? 0 : $entry_year][] = $entry;
}
krsort($years);
$peak = $years ? max(array_map('count', $years)) : 1;
?>
<main id="main-content" class="article-timeline">
  <header class="article-timeline__header">
    <div>
      <p class="magazine-eyebrow">WRITING ARCHIVE<?php if ($years) : ?> / <?php echo esc_html('2022 — ' . max(array_keys($years))); ?><?php endif; ?></p>
      <h1>すべての記事</h1>
      <p>つくり、考え、書き続けてきた記録。</p>
    </div>
    <p class="article-timeline__total"><strong><?php echo esc_html(number_format_i18n(count($wp_query->posts))); ?></strong><span>記事の積み重ね</span></p>
  </header>
  <nav class="article-timeline__years" aria-label="年別の記事へ移動">
    <?php foreach (array_reverse($years, true) as $year => $entries) : ?>
      <?php if (!$year) continue; ?>
      <a href="#year-<?php echo esc_attr($year); ?>"><strong><?php echo esc_html($year); ?><small>年</small></strong><span><?php echo esc_html(number_format_i18n(count($entries))); ?>記事</span><span class="article-timeline__bar" aria-hidden="true" style="--year-volume: <?php echo esc_attr((string) round(count($entries) / $peak * 100)); ?>%"></span></a>
    <?php endforeach; ?>
  </nav>
  <?php foreach ($years as $year => $entries) : ?>
    <section class="article-timeline__year" id="year-<?php echo esc_attr($year); ?>" aria-labelledby="year-heading-<?php echo esc_attr($year); ?>">
      <header><h2 id="year-heading-<?php echo esc_attr($year); ?>"><?php echo $year ? esc_html($year) . '<span>年</span>' : '2022年より前'; ?></h2><p><?php echo esc_html(number_format_i18n(count($entries))); ?>記事</p></header>
      <ol>
        <?php foreach ($entries as $entry) : ?>
          <li><a href="<?php echo esc_url(get_permalink($entry)); ?>"><time datetime="<?php echo esc_attr(get_the_date('Y-m-d', $entry)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $entry)); ?></time><span><?php echo esc_html(get_the_title($entry)); ?></span></a></li>
        <?php endforeach; ?>
      </ol>
    </section>
  <?php endforeach; ?>
  <?php if (!$years) : ?><p>まだ記事がありません。</p><?php endif; ?>
</main>
