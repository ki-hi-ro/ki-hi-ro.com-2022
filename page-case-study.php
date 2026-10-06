<?php
/** Template Name: CASE STUDY — 詳細 */
get_header(); ?>
<main id="main-content" class="case-page case-detail">
<?php while (have_posts()) : the_post(); ?>
  <?php $parent_id = wp_get_post_parent_id(get_the_ID()); $parent = $parent_id ? get_post($parent_id) : null; if ($parent && $parent->post_status === 'publish') : ?><a class="case-link" href="<?php echo esc_url(get_permalink($parent)); ?>">← CASE STUDY 一覧</a><?php endif; ?>
  <article><header class="case-hero"><p class="case-eyebrow">CASE STUDY / SAMPLE PROJECT</p><h1><?php the_title(); ?></h1><?php if (!post_password_required()) : ?><p><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?></header><div class="case-content"><?php the_content(); ?></div></article>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
