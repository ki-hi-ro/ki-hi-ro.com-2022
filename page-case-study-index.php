<?php
/** Template Name: CASE STUDY — 一覧 */
get_header(); ?>
<main id="main-content" class="article-timeline case-study-timeline">
<?php while (have_posts()) : the_post(); ?>
  <?php
  $cases = get_pages(array('parent' => get_the_ID(), 'post_status' => 'publish', 'sort_column' => 'post_date,ID', 'sort_order' => 'DESC'));
  $years = array();
  foreach ($cases as $case) {
      if (post_password_required($case)) continue;
      $years[(int) get_the_date('Y', $case)][] = $case;
  }
  krsort($years);
  $total = array_sum(array_map('count', $years));
  $peak = $years ? max(array_map('count', $years)) : 1;
  ?>
  <figure class="article-timeline__main-view">
    <img src="<?php echo esc_url(add_query_arg('ver', kihiro_asset_version('/assets/images/case-study-main-view.jpg'), get_theme_file_uri('/assets/images/case-study-main-view.jpg'))); ?>" width="4032" height="3024" alt="道路沿いの切り株と、その周りに茂る緑の草" fetchpriority="high" decoding="async">
  </figure>
  <header class="article-timeline__header">
    <div><h1>開発事例</h1><div><?php the_content(); ?></div></div>
    <p class="article-timeline__total"><strong><?php echo esc_html(number_format_i18n($total)); ?></strong><span>件の開発事例</span></p>
  </header>
  <?php if ($years) : ?>
    <nav class="article-timeline__years" aria-label="年別の開発事例へ移動">
      <?php foreach (array_reverse($years, true) as $year => $entries) : ?>
        <a href="#year-<?php echo esc_attr($year); ?>"><strong><?php echo esc_html($year); ?><small>年</small></strong><span><?php echo esc_html(count($entries)); ?>件</span><span class="article-timeline__bar" aria-hidden="true" style="--year-volume: <?php echo esc_attr((string) round(count($entries) / $peak * 100)); ?>%"></span></a>
      <?php endforeach; ?>
    </nav>
    <?php foreach ($years as $year => $entries) : ?>
      <section class="article-timeline__year" id="year-<?php echo esc_attr($year); ?>" aria-labelledby="year-heading-<?php echo esc_attr($year); ?>">
        <header><h2 id="year-heading-<?php echo esc_attr($year); ?>"><?php echo esc_html($year); ?><span>年</span></h2><p><?php echo esc_html(count($entries)); ?>件</p></header>
        <ol>
          <?php foreach ($entries as $case) : ?>
            <?php $image = kihiro_case_study_image($case); ?>
            <li><a href="<?php echo esc_url(get_permalink($case)); ?>"><span class="article-timeline__thumbnail" aria-hidden="true"><?php echo $image ? wp_kses_post($image) : kihiro_article_thumbnail($case->ID); ?></span><time datetime="<?php echo esc_attr(get_the_date('Y-m-d', $case)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $case)); ?></time><span><?php echo esc_html($case->post_title); ?></span></a></li>
          <?php endforeach; ?>
        </ol>
      </section>
    <?php endforeach; ?>
  <?php else : ?>
    <p>ケーススタディは準備中です。</p>
  <?php endif; ?>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
