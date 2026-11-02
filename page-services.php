<?php
/** Template Name: サービス・ご依頼 */
get_header(); ?>
<main id="main-content" class="services-page services-page--showcase">
<?php while (have_posts()) : the_post(); ?>
  <header class="services-page__header"><p class="magazine-eyebrow">WEB & AUTOMATION</p><h1>お手伝いできること</h1><p>Web制作・業務自動化で、事業の「伝える」と「進める」を。</p></header>
  <?php get_template_part('template-parts/service-showcase'); ?>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
