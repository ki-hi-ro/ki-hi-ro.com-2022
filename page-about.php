<?php
/** Template Name: 自己紹介 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('kihiro-about', get_theme_file_uri('/assets/css/about.css'), array('kihiro-magazine'), kihiro_asset_version('/assets/css/about.css'));
}, 20);
get_header(); ?>
<main id="main-content" class="about-page">
  <?php while (have_posts()) : the_post(); ?>
    <article>
      <header class="discovery-page-heading"><p class="discovery-eyebrow">ki-hi-ro.com</p><h1><?php the_title(); ?></h1></header>
      <?php // 本文はWordPressのDBが正本。content/about.htmlは原稿の控えで自動同期しない。 ?>
      <div class="about-body"><?php the_content(); ?></div>
    </article>
  <?php endwhile; ?>
</main>
<?php get_footer(); ?>
