<?php
/** Template Name: ARTICLES — 技術記事 */
get_header();
$selection = require get_template_directory() . '/content/featured-technical-articles.php';
$topics = array('implementation' => '実装の取り組み', 'investigation' => '原因の調査', 'verification' => '検証・改善');
$selected = kihiro_get_request_value('topic');
if (!isset($topics[$selected])) $selected = '';
$entries = get_posts(array('post_type' => 'post', 'post_status' => 'publish', 'has_password' => false, 'post__in' => array_keys($selection), 'orderby' => 'post__in', 'posts_per_page' => count($selection), 'ignore_sticky_posts' => true));
if ($selected) $entries = array_values(array_filter($entries, function ($entry) use ($selection, $selected) { return $selection[$entry->ID]['topic'] === $selected; }));
$current_page = max(1, absint(kihiro_get_request_value('articles_page')));
$total_pages = (int) ceil(count($entries) / kihiro_home_posts_per_page());
$entries = array_slice($entries, ($current_page - 1) * kihiro_home_posts_per_page(), kihiro_home_posts_per_page());
?>
<main id="main-content" class="article-timeline article-timeline--cards case-study-timeline">
<?php while (have_posts()) : the_post(); ?>
  <aside class="case-experience-entry"><h1>技術ブログ</h1><p>課題をどう捉え、実装し、確かめてきたか。技術への取り組み方が伝わる記事を、日々のジャーナルから厳選しました。</p><a href="<?php echo esc_url(add_query_arg(array('view' => 'archive-all', 'article_category' => ($term = get_term_by('name', '技術・開発', 'category')) instanceof WP_Term ? $term->term_id : ''), home_url('/'))); ?>">技術・開発の記事をすべて読む →</a></aside>
  <section class="article-filters" aria-label="技術ブログの絞り込み"><nav class="article-filters__categories" aria-label="取り組みの種類">
    <a href="<?php the_permalink(); ?>" <?php if (!$selected) echo 'aria-current="true"'; ?>>すべて</a>
    <?php foreach ($topics as $key => $label) : ?><a href="<?php echo esc_url(add_query_arg('topic', $key, get_permalink())); ?>" <?php if ($selected === $key) echo 'aria-current="true"'; ?>><?php echo esc_html($label); ?></a><?php endforeach; ?>
  </nav></section>
  <section class="article-timeline__year" aria-label="厳選した技術ブログ一覧"><ol>
    <?php foreach ($entries as $entry) : ?>
      <li><a href="<?php echo esc_url(get_permalink($entry)); ?>"><span class="article-timeline__thumbnail" aria-hidden="true"><?php echo kihiro_article_thumbnail($entry->ID, 'large'); ?></span><span class="article-card-dates"><time datetime="<?php echo esc_attr(get_the_date('Y-m-d', $entry)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $entry)); ?> 公開</time> ／ <time datetime="<?php echo esc_attr(get_the_modified_date('Y-m-d', $entry)); ?>"><?php echo esc_html(get_the_modified_date('Y.m.d', $entry)); ?> 更新</time></span><span><?php echo esc_html(get_the_title($entry)); ?></span></a></li>
    <?php endforeach; ?>
  </ol><?php if (!$entries) : ?><p>該当する記事はありません。</p><?php endif; ?></section>
  <?php if ($total_pages > 1) : ?><nav class="navigation pagination" aria-label="技術ブログのページ送り"><div class="nav-links"><?php echo wp_kses_post(paginate_links(array('base' => add_query_arg('articles_page', '%#%', get_permalink()), 'format' => '', 'current' => $current_page, 'total' => $total_pages, 'show_all' => true, 'prev_next' => false, 'add_args' => $selected ? array('topic' => $selected) : array()))); ?></div></nav><?php endif; ?>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
