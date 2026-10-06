<?php
/** Template Name: CASE STUDY — 一覧 */
get_header(); ?>
<main id="main-content" class="case-page case-index">
<?php while (have_posts()) : the_post(); ?>
  <figure class="article-timeline__main-view case-index__main-view">
    <img src="<?php echo esc_url(add_query_arg('ver', kihiro_asset_version('/assets/images/case-study-main-view.jpg'), get_theme_file_uri('/assets/images/case-study-main-view.jpg'))); ?>" width="4032" height="3024" alt="緑の木々と芝生に囲まれた、緩やかに曲がる小道" fetchpriority="high" decoding="async">
  </figure>
  <header class="case-hero"><h1><?php the_title(); ?></h1><div><?php the_content(); ?></div></header>
  <div class="case-list">
  <?php $cases = get_pages(array('parent' => get_the_ID(), 'post_status' => 'publish', 'sort_column' => 'menu_order,ID')); $number = 0; ?>
  <?php foreach ($cases as $case) : if (post_password_required($case)) continue; ?>
    <article class="case-card">
      <p class="case-eyebrow"><?php echo esc_html(sprintf('%02d', ++$number)); ?></p>
      <?php $image = kihiro_case_study_image($case); if ($image) : ?>
        <a class="case-card__image" href="<?php echo esc_url(get_permalink($case)); ?>"><?php echo wp_kses_post($image); ?></a>
      <?php endif; ?>
      <h2><a href="<?php echo esc_url(get_permalink($case)); ?>"><?php echo esc_html($case->post_title); ?></a></h2>
      <?php $technology = kihiro_case_study_technology($case); if ($technology !== '') : ?><p class="case-tech"><?php echo esc_html($technology); ?></p><?php endif; ?>
      <a class="case-link" href="<?php echo esc_url(get_permalink($case)); ?>" aria-label="<?php echo esc_attr($case->post_title . 'のケーススタディを見る'); ?>">[ ケーススタディを見る ]</a>
    </article>
  <?php endforeach; ?>
  <?php if (!$number) : ?><p>ケーススタディは準備中です。</p><?php endif; ?>
  </div>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
