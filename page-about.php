<?php
/** Template Name: 自己紹介 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('kihiro-about', get_theme_file_uri('/assets/css/about.css'), array('kihiro-magazine'), kihiro_asset_version('/assets/css/about.css'));
}, 20);
get_header(); ?>
<main id="main-content" class="about-page">
  <?php while (have_posts()) : the_post(); ?>
    <article>
      <h1 class="screen-reader-text"><?php the_title(); ?></h1>
      <div class="about-body"><?php the_content(); ?></div>
    </article>
  <?php endwhile; ?>
</main>
<?php get_footer(); ?>
