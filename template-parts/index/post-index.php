<?php
/** Complete published writing history, grouped by year. */
global $wp_query;
$is_article_search = is_search();
$is_article_tag = is_tag();
$is_article_home = is_home() && !$is_article_search && '' === kihiro_get_request_value('view');
// 取得はメインクエリ側で完了している。ここでは取得済みの投稿を年ごとに整理する。
// 2021年以前はまとめるが、ホームは年で分断せず更新順を維持する。
// サイトのタイムゾーンで本日更新の記事を判定する。
$today = current_datetime()->format('Y-m-d');
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
  <?php elseif (is_date()) : ?>
    <header class="article-timeline__header"><div><h1><?php echo esc_html(wp_strip_all_tags(get_the_archive_title())); ?></h1><p>公開日で探す記事一覧</p></div></header>
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
    <?php // 投稿できるログインユーザーだけに、管理画面の新規投稿への入口を表示する。 ?>
    <?php if (is_user_logged_in() && current_user_can('edit_posts')) : ?>
      <div class="article-create"><a class="article-edit__link" href="<?php echo esc_url(admin_url('post-new.php')); ?>">新規投稿</a></div>
    <?php endif; ?>
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
          <li><a href="<?php echo esc_url(get_permalink($entry)); ?>"><span class="article-timeline__thumbnail" aria-hidden="true"><?php echo kihiro_article_thumbnail($entry->ID, 'large'); ?></span><span class="article-card-dates"><time datetime="<?php echo esc_attr(get_the_date('Y-m-d', $entry)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $entry)); ?> 公開</time> ／ <time datetime="<?php echo esc_attr(get_the_modified_date('Y-m-d', $entry)); ?>"><?php echo esc_html(get_the_modified_date('Y.m.d', $entry)); ?> 更新</time></span><span><?php if (get_the_modified_date('Y-m-d', $entry) === $today) : ?><span class="article-card-new">本日更新</span><?php endif; ?><?php echo esc_html(get_the_title($entry)); ?></span></a></li>
        <?php endforeach; ?>
      </ol>
    </section>
  <?php endforeach; ?>
  <?php if (!$years) : ?><p>該当する記事はありません。</p><?php endif; ?>
  <?php if (is_home() || $is_article_search || $is_article_tag) : ?>
    <?php the_posts_pagination(array('show_all' => true, 'prev_next' => false, 'add_fragment' => is_home() ? '#year-latest' : '')); ?>
  <?php endif; ?>
  <?php get_template_part('template-parts/monthly-archives'); ?>
</main>
