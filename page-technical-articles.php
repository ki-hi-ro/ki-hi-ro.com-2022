<?php
/** Template Name: ARTICLES — 技術記事 */
get_header();
$topics = array(
    'python' => array('label' => 'Python / データ処理', 'tags' => array('Python', 'FastAPI', 'Django', 'データ分析ライブラリ', 'スクレイピング')),
    'sql' => array('label' => 'SQL / データベース', 'tags' => array('SQL', 'データベース', 'プログラミング > SQL', 'プログラミング > データベース')),
    'web' => array('label' => 'Web開発', 'tags' => array('WordPress', 'WordPress REST API', 'HTML / CSS', 'JavaScript', 'TypeScript', 'React', 'Vue.js', 'Next.js', 'NuxtJS', 'WEB API', 'API')),
    'tools' => array('label' => 'Git / 開発環境', 'tags' => array('Git', 'GitHub', 'Docker', 'CI / CD', 'VSCode', 'venv', 'Node.js', 'npm', 'プログラミング > 開発環境')),
);
$selected = sanitize_key(kihiro_get_request_value('topic'));
if (!isset($topics[$selected])) $selected = '';
// Editorial classification is separate from general blog tags: incidental mentions
// must not make diary or career posts appear in ARTICLES.
$topic_filter = $selected
    ? array('key' => '_kihiro_article_topic', 'value' => $selected, 'compare' => '=')
    : array('key' => '_kihiro_article_topic', 'value' => array_keys($topics), 'compare' => 'IN');
$current_page = max(1, absint(kihiro_get_request_value('articles_page')));
$articles = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'has_password' => false, 'posts_per_page' => 12, 'paged' => $current_page, 'orderby' => 'date', 'order' => 'DESC', 'ignore_sticky_posts' => true, 'post__not_in' => kihiro_excluded_post_ids(), 'meta_query' => array($topic_filter)));
?>
<main id="main-content" class="case-page case-index technical-articles">
<?php while (have_posts()) : the_post(); ?>
  <figure class="article-timeline__main-view">
    <img src="<?php echo esc_url(add_query_arg('ver', kihiro_asset_version('/assets/images/articles-main-view.jpg'), get_theme_file_uri('/assets/images/articles-main-view.jpg'))); ?>" width="4032" height="3024" alt="豊かな草木と木々に囲まれた石段の風景" fetchpriority="high" decoding="async">
  </figure>
  <header class="case-hero"><h1><?php the_title(); ?></h1><div><?php the_content(); ?></div></header>
  <nav class="technical-topics" aria-label="技術記事の分野">
    <a href="<?php echo esc_url(get_permalink()); ?>" <?php if (!$selected) echo 'aria-current="page"'; ?>>すべて</a>
    <?php foreach ($topics as $key => $topic) : ?><a href="<?php echo esc_url(add_query_arg('topic', $key, get_permalink())); ?>" <?php if ($selected === $key) echo 'aria-current="page"'; ?>><?php echo esc_html($topic['label']); ?></a><?php endforeach; ?>
  </nav>
  <p class="technical-count"><?php echo esc_html(number_format_i18n($articles->found_posts)); ?>件の技術記事</p>
  <div class="case-list">
  <?php foreach ($articles->posts as $entry) : ?>
    <article class="case-card">
      <p class="case-eyebrow"><time datetime="<?php echo esc_attr(get_the_date('Y-m-d', $entry)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $entry)); ?></time></p>
      <h2><a href="<?php echo esc_url(get_permalink($entry)); ?>"><?php echo esc_html(get_the_title($entry)); ?></a></h2>
      <?php $labels = array(); foreach (get_post_meta($entry->ID, '_kihiro_article_topic', false) as $entry_topic) if (isset($topics[$entry_topic])) $labels[] = $topics[$entry_topic]['label']; ?>
      <p class="case-tech"><?php echo esc_html(implode(' / ', array_unique($labels))); ?></p>
      <a class="case-link" href="<?php echo esc_url(get_permalink($entry)); ?>">[ 技術記事を読む ]</a>
    </article>
  <?php endforeach; ?>
  <?php if (!$articles->posts) : ?><p>該当する技術記事はありません。</p><?php endif; ?>
  </div>
  <?php if ($articles->max_num_pages > 1) : ?>
    <nav class="technical-pagination" aria-label="技術記事のページ">
    <?php echo wp_kses_post(paginate_links(array('base' => add_query_arg('articles_page', '%#%', get_permalink()), 'format' => '', 'current' => $current_page, 'total' => $articles->max_num_pages, 'add_args' => $selected ? array('topic' => $selected) : array(), 'prev_text' => '前へ', 'next_text' => '次へ'))); ?>
    </nav>
  <?php endif; ?>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
