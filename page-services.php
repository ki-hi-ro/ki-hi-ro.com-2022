<?php
/** Template Name: Web制作・業務自動化 */
get_header(); ?>
<main id="main-content" class="services-page">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('template-parts/page-heading', null, array(
      'eyebrow' => 'WEB & AUTOMATION',
      'title' => 'Web制作・業務自動化',
      'description' => '掲載内容の準備中です。',
  )); ?>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
