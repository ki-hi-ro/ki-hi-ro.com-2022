<?php
/** Template Name: CASE STUDY — 一覧 */
get_header(); ?>
<main id="main-content" class="article-timeline article-timeline--cards case-study-timeline">
<?php while (have_posts()) : the_post(); ?>
  <?php
  $cases = get_pages(array('parent' => get_the_ID(), 'post_status' => 'publish', 'sort_column' => 'post_modified,ID', 'sort_order' => 'DESC'));
  $cases = array_values(array_filter($cases, function ($case) { return !post_password_required($case); }));
  $total = count($cases);
  ?>
  <figure class="article-timeline__main-view">
    <img src="<?php echo esc_url(add_query_arg('ver', kihiro_asset_version('/assets/images/case-study-main-view.jpg'), get_theme_file_uri('/assets/images/case-study-main-view.jpg'))); ?>" width="4032" height="3024" alt="道路沿いの切り株と、その周りに茂る緑の草" fetchpriority="high" decoding="async">
  </figure>
  <header class="article-timeline__header">
    <div><h1>CASE STUDY</h1><div><?php the_content(); ?></div></div>
    <p class="article-list-heading__total">全<?php echo esc_html(number_format_i18n($total)); ?>件</p>
  </header>
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
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
