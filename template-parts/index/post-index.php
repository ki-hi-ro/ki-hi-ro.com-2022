<?php
/** Published writing timeline, grouped by year. */
global $wp_query;
if (is_home() && 'archive-all' !== kihiro_get_request_value('view')) {
    get_template_part('template-parts/index/journal-discovery');
    return;
}
$is_full_archive = 'archive-all' === kihiro_get_request_value('view');
$archive_category_id = $is_full_archive ? kihiro_selected_article_category() : 0;
$archive_category = $archive_category_id ? get_term($archive_category_id, 'category') : null;
$archive_tag_id = $is_full_archive ? kihiro_selected_article_tag() : 0;
$archive_tag = $archive_tag_id ? get_term($archive_tag_id, 'post_tag') : null;
$archive_title = $archive_tag instanceof WP_Term ? $archive_tag->name : ($archive_category instanceof WP_Term ? $archive_category->name : '日々の記録');
$is_article_search = is_search();
$is_article_tag = is_tag();
$is_reading_list = $is_full_archive || $is_article_search || $is_article_tag;
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
if ($is_reading_list || (is_home() && !$is_full_archive)) {
    $years = $wp_query->posts ? array('latest' => $wp_query->posts) : array();
}
?>
<main id="main-content" class="article-timeline <?php echo $is_full_archive ? 'journal-chronology' : ($is_reading_list ? 'article-timeline--cards technical-reading-list' : 'article-title-timeline'); ?>">
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
  <?php elseif (is_date() && !($archive_tag instanceof WP_Term)) : ?>
    <?php
      $date_title = wp_strip_all_tags(get_the_archive_title());
      $requested_month = kihiro_get_request_value('m') ?: (string) get_query_var('m');
      if (!$requested_month && get_query_var('year') && get_query_var('monthnum')) $requested_month = sprintf('%04d%02d', get_query_var('year'), get_query_var('monthnum'));
      if (preg_match('/^(\d{4})(0[1-9]|1[0-2])$/', $requested_month, $month_parts)) $date_title = (int) $month_parts[1] . '年' . (int) $month_parts[2] . '月';
    ?>
    <header class="article-timeline__header"><div><h1><?php echo esc_html($date_title); ?></h1><p><?php echo esc_html(number_format_i18n(count($wp_query->posts))); ?>記事の記録。</p></div></header>
  <?php else : ?>
  <header class="article-timeline__header">
    <div>
      <p class="magazine-eyebrow"><?php echo $is_full_archive ? 'DAILY JOURNAL' : 'WRITING ARCHIVE'; ?></p>
      <h1><?php echo esc_html($archive_title); ?></h1>
      <p><?php echo esc_html(number_format_i18n($is_full_archive ? $wp_query->found_posts : count($wp_query->posts))); ?>記事の記録。</p>
    </div>
  </header>
  <?php endif; ?>
  <?php if ($is_full_archive) get_template_part('template-parts/journal-search'); ?>
  <?php if ($is_full_archive) : ?>
    <?php if (is_user_logged_in() && current_user_can('edit_posts')) : ?>
      <div class="article-create"><a class="article-edit__link" href="<?php echo esc_url(kihiro_new_post_url($archive_category_id)); ?>"><span aria-hidden="true">＋</span> 新規投稿</a></div>
    <?php endif; ?>
    <?php get_template_part('template-parts/index/article-filters'); ?>
  <?php endif; ?>
  <?php if (is_home() && !$is_full_archive) : ?>
    <?php // 投稿できるログインユーザーだけに、管理画面の新規投稿への入口を表示する。 ?>
    <?php if (is_user_logged_in() && current_user_can('edit_posts')) : ?>
      <div class="article-create"><a class="article-edit__link" href="<?php echo esc_url(admin_url('post-new.php')); ?>">新規投稿</a></div>
    <?php endif; ?>
    <?php get_template_part('template-parts/index/article-filters'); ?>
  <?php endif; ?>
  <?php if ($is_full_archive) : ?>
    <?php get_template_part('template-parts/journal-timeline', null, array('entries' => $wp_query->posts)); ?>
  <?php else : ?>
  <?php foreach ($years as $year => $entries) : ?>
    <section class="<?php echo $is_reading_list ? 'article-timeline__year' : 'article-title-year'; ?>" id="year-<?php echo esc_attr($year); ?>" aria-labelledby="year-heading-<?php echo esc_attr($year); ?>">
      <?php if ($is_reading_list || (is_home() && !$is_full_archive)) : ?>
        <h2 id="year-heading-latest" class="screen-reader-text">記事一覧</h2>
      <?php else : ?>
        <header><h2 id="year-heading-<?php echo esc_attr($year); ?>"><?php echo $year ? esc_html($year) . '<span>年</span>' : '2021<span>年より前</span>'; ?></h2><p><?php echo esc_html(number_format_i18n(count($entries))); ?>記事を表示</p></header>
      <?php endif; ?>
      <ol<?php if (!$is_reading_list) echo ' class="article-title-list"'; ?>>
        <?php foreach ($entries as $entry) : ?>
          <?php if ($is_reading_list) : ?>
            <?php get_template_part('template-parts/writing-card', null, array('entry' => $entry, 'show_tags' => false, 'date_format' => 'Y.m.d H:i')); ?>
          <?php else : ?>
          <li><time datetime="<?php echo esc_attr(get_the_date('c', $entry)); ?>"><?php echo esc_html(get_the_date('Y.m.d H:i', $entry)); ?></time><a href="<?php echo esc_url(get_permalink($entry)); ?>"><?php echo esc_html(get_the_title($entry)); ?></a></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ol>
    </section>
  <?php endforeach; ?>
  <?php endif; ?>
  <?php if (!$years) : ?>
    <div class="article-empty">
      <p>該当する記事はありません。</p>
      <?php if ($is_full_archive) : ?>
        <p>選択した年月・カテゴリー・タグの組み合わせ、またはページ番号に一致する記事がありません。条件を変更してお探しください。</p>
        <div class="work-entry__links">
          <?php if (kihiro_selected_article_tag()) : ?><a href="<?php echo esc_url(add_query_arg(array_filter(array('view' => 'archive-all', 'article_category' => $archive_category_id, 'm' => kihiro_get_request_value('m'))), home_url('/'))); ?>">タグを解除して表示する</a><?php endif; ?>
          <a href="<?php echo esc_url(kihiro_journal_url()); ?>">すべての記事を表示する</a>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <?php if ($is_full_archive && $wp_query->max_num_pages > 1) : ?>
    <nav class="navigation pagination" aria-label="ジャーナルのページ送り"><div class="nav-links"><?php echo wp_kses_post(paginate_links(array(
      'base' => add_query_arg('paged', '%#%', home_url('/')), 'format' => '',
      'current' => max(1, (int) get_query_var('paged')), 'total' => $wp_query->max_num_pages,
      'show_all' => true, 'prev_next' => false,
      'add_args' => array_filter(array('view' => 'archive-all', 'article_category' => $archive_category_id, 'article_tag' => kihiro_selected_article_tag(), 'm' => kihiro_get_request_value('m'))),
    ))); ?></div></nav>
  <?php endif; ?>
  <?php if (!$is_full_archive && (is_home() || $is_article_search || $is_article_tag)) : ?>
    <?php the_posts_pagination(array('show_all' => true, 'prev_next' => false, 'add_fragment' => is_home() ? '#year-latest' : '')); ?>
  <?php endif; ?>
  <?php get_template_part('template-parts/monthly-archives'); ?>
</main>
