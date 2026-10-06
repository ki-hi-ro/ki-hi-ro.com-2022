<?php get_header(); ?>

<?php if (is_page('contact-us')) : ?>
  <main id="main-content" class="case-page case-index contact-index">
    <?php while (have_posts()) : the_post(); ?>
      <figure class="article-timeline__main-view">
        <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/contact-main-view.jpg')); ?>" width="4032" height="3024" alt="街中で豊かに育つ草木の風景" fetchpriority="high" decoding="async">
      </figure>
      <article class="contact-page">
        <header class="case-hero">
          <h1><?php the_title(); ?></h1>
          <div class="case-content"><?php the_content(); ?></div>
        </header>
      </article>
    <?php endwhile; ?>
  </main>
  <?php get_footer(); ?>
  <?php return; ?>
<?php endif; ?>

<main id="main-content" class="journal-app journal-app--single">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <article class="journal-panel journal-panel--single db-single">
        <h1><?php the_title(); ?></h1>
        <div class="db-single__content">
          <?php the_content(); ?>
        </div>
      </article>
    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
