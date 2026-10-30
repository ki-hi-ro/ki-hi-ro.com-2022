<?php
/** Template Name: ARTICLES — 技術記事 */
get_header();
$technical_category = get_term_by('name', '技術・開発', 'category');
$current_page = max(1, absint(kihiro_get_request_value('articles_page')));
$articles = new WP_Query(array(
    'post_type' => 'post', 'post_status' => 'publish', 'has_password' => false,
    'category__in' => $technical_category instanceof WP_Term ? array($technical_category->term_id) : array(0),
    'post__not_in' => kihiro_excluded_post_ids(),
    'tag_id' => kihiro_selected_article_tag(),
    'posts_per_page' => 12, 'paged' => $current_page,
    'orderby' => array('date' => 'DESC', 'ID' => 'DESC'), 'ignore_sticky_posts' => true,
));
$entries = $technical_category instanceof WP_Term ? $articles->posts : array();
$total_pages = $technical_category instanceof WP_Term ? (int) $articles->max_num_pages : 0;
?>
<main id="main-content" class="article-timeline article-timeline--cards case-study-timeline">
<?php while (have_posts()) : the_post(); ?>
  <aside class="case-experience-entry"><h1>技術ブログ</h1><p>日々のジャーナルの「技術・開発」の記事を、公開日の新しい順に掲載しています。各記事の冒頭で、扱う技術がどの分野に位置するかを樹形図で確認できます。</p></aside>
  <?php if (is_user_logged_in() && current_user_can('edit_posts')) : ?>
    <div class="article-create"><a class="article-edit__link" href="<?php echo esc_url(admin_url('post-new.php')); ?>"><span aria-hidden="true">＋</span> 新規投稿</a></div>
  <?php endif; ?>
  <?php get_template_part('template-parts/tag-filter', null, array('action' => get_permalink(), 'clear_url' => get_permalink(), 'root' => '技術・開発')); ?>
  <section class="article-timeline__year" aria-label="技術・開発の記事一覧"><ol>
    <?php foreach ($entries as $entry) : ?>
      <?php get_template_part('template-parts/writing-card', null, array('entry' => $entry, 'tag_base' => get_permalink())); ?>
    <?php endforeach; ?>
  </ol><?php if (!$entries) : ?><p>該当する記事はありません。</p><?php endif; ?></section>
  <?php if ($total_pages > 1) : ?><nav class="navigation pagination" aria-label="技術ブログのページ送り"><div class="nav-links"><?php echo wp_kses_post(paginate_links(array('base' => add_query_arg('articles_page', '%#%', get_permalink()), 'format' => '', 'current' => $current_page, 'total' => $total_pages, 'show_all' => true, 'prev_next' => false, 'add_args' => kihiro_selected_article_tag() ? array('article_tag' => kihiro_selected_article_tag()) : array()))); ?></div></nav><?php endif; ?>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
