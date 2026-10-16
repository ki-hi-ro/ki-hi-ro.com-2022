<?php
/** Template Name: CASE STUDY — 一覧 */
get_header(); ?>
<main id="main-content" class="article-timeline article-timeline--cards case-study-timeline">
<?php while (have_posts()) : the_post(); ?>
  <?php
  $cases = get_pages(array('parent' => get_the_ID(), 'post_status' => 'publish', 'sort_column' => 'post_modified,ID', 'sort_order' => 'DESC'));
  $cases = array_values(array_filter($cases, function ($case) { return !post_password_required($case); }));
  $total = count($cases);
  $per_page = kihiro_home_posts_per_page();
  $total_pages = (int) ceil($total / $per_page);
  $current_page = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));
  $cases = array_slice($cases, ($current_page - 1) * $per_page, $per_page);
  ?>
  <h1 class="screen-reader-text">開発事例</h1>
  <?php if ($cases) : ?>
      <section class="article-timeline__year" aria-label="開発事例一覧">
        <ol>
          <?php foreach ($cases as $case) : ?>
            <?php $image = kihiro_case_study_image($case); ?>
            <li><a href="<?php echo esc_url(get_permalink($case)); ?>"><span class="article-timeline__thumbnail" aria-hidden="true"><?php echo $image ? wp_kses_post($image) : '<img src="' . esc_url(get_theme_file_uri('/assets/images/case-study-placeholder.svg')) . '" alt="" width="320" height="200" loading="lazy">'; ?></span><time datetime="<?php echo esc_attr(get_the_modified_date('Y-m-d', $case)); ?>"><?php echo esc_html(get_the_modified_date('Y-m-d', $case)); ?></time><span><?php echo esc_html($case->post_title); ?></span></a></li>
          <?php endforeach; ?>
        </ol>
      </section>
  <?php else : ?>
    <p>ケーススタディは準備中です。</p>
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
      ))); ?></div>
    </nav>
  <?php endif; ?>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
