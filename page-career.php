<?php
/** Template Name: 職務経歴 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('kihiro-about', get_theme_file_uri('/assets/css/about.css'), array('kihiro-magazine'), kihiro_asset_version('/assets/css/about.css'));
}, 20);
get_header(); ?>
<main id="main-content" class="about-page career-page">
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('template-parts/page-heading', null, array('eyebrow' => 'WORK EXPERIENCE', 'title' => '職務経歴', 'description' => '実務での担当範囲と、課題への取り組み。')); ?>
    <?php get_template_part('template-parts/work-experiences'); ?>
  <?php endwhile; ?>
</main>
<?php get_footer(); ?>
