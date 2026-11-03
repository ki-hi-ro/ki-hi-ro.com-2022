<?php
/** Template Name: CASE STUDY — 一覧 */
get_header(); ?>
<main id="main-content" class="article-timeline article-timeline--cards case-study-timeline technical-reading-list">
<?php while (have_posts()) : the_post(); ?>
  <?php
  // 開発事例は独自投稿タイプではなく、この一覧ページを親に持つ固定ページ。
  $cases = get_pages(array('parent' => get_the_ID(), 'post_status' => 'publish', 'sort_column' => 'post_modified,ID', 'sort_order' => 'DESC'));
  $cases = array_values(array_filter($cases, function ($case) { return !post_password_required($case); }));
  $case_categories = array('web' => 'Web制作', 'data' => 'データ処理', 'automation' => '業務自動化');
  $selected_category = kihiro_get_request_value('case_category');
  if (!isset($case_categories[$selected_category])) $selected_category = '';
  $available_categories = array();
  foreach ($cases as $case) {
      foreach (kihiro_case_study_categories($case) as $category) {
          if (isset($case_categories[$category])) $available_categories[$category] = $case_categories[$category];
      }
  }
  if ($selected_category) {
      $cases = array_values(array_filter($cases, function ($case) use ($selected_category) {
          return in_array($selected_category, kihiro_case_study_categories($case), true);
      }));
  }
  // 絞り込みを終えてから件数とページ数を確定する。順序を逆にすると空ページが生じる。
  $total = count($cases);
  $per_page = kihiro_home_posts_per_page();
  $total_pages = (int) ceil($total / $per_page);
  $current_page = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));
  $cases = array_slice($cases, ($current_page - 1) * $per_page, $per_page);
  ?>
  <?php get_template_part('template-parts/page-heading', null, array('eyebrow' => 'WORKS', 'title' => '制作実績', 'description' => '制作案件・個人開発・サンプルを通して、技術と解決への取り組みをご紹介します。')); ?>
  <?php if (current_user_can('edit_pages')) : ?>
    <div class="article-create"><a class="article-edit__link" href="<?php echo esc_url(add_query_arg(array('post_type' => 'page', 'kihiro_case_parent' => get_the_ID()), admin_url('post-new.php'))); ?>"><span aria-hidden="true">＋</span> 新規投稿</a></div>
  <?php endif; ?>
  <section class="article-filters" aria-label="開発事例の絞り込み">
    <nav class="article-filters__categories" aria-label="カテゴリー">
      <a href="<?php echo esc_url(get_permalink()); ?>" <?php if (!$selected_category) echo 'aria-current="true"'; ?>>すべて</a>
      <?php foreach ($case_categories as $slug => $label) : if (!isset($available_categories[$slug])) continue; ?>
        <a href="<?php echo esc_url(add_query_arg('case_category', $slug, get_permalink())); ?>" <?php if ($selected_category === $slug) echo 'aria-current="true"'; ?>><?php echo esc_html($label); ?></a>
      <?php endforeach; ?>
    </nav>
  </section>
  <?php if ($cases) : ?>
      <section class="article-timeline__year" aria-label="開発事例一覧">
        <ol>
          <?php foreach ($cases as $case) : ?>
            <?php get_template_part('template-parts/writing-card', null, array('entry' => $case, 'is_case' => true)); ?>
          <?php endforeach; ?>
        </ol>
      </section>
  <?php else : ?>
    <p>該当する開発事例はありません。</p>
  <?php endif; ?>
  <?php if ($total_pages > 1) : ?>
    <nav class="navigation pagination" aria-label="開発事例のページ送り">
      <div class="nav-links"><?php echo wp_kses_post(paginate_links(array(
          'base' => add_query_arg('paged', '%#%', get_permalink()),
          'format' => '',
          'current' => $current_page,
          'total' => $total_pages,
          'show_all' => true,
          'prev_next' => false,
          'add_args' => $selected_category ? array('case_category' => $selected_category) : array(),
      ))); ?></div>
    </nav>
  <?php endif; ?>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
