<?php get_header(); ?>

<?php if (is_page('contact-us')) : ?>
  <main id="main-content" class="case-page case-index contact-index">
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('template-parts/page-heading', null, array('eyebrow' => 'CONTACT', 'title' => '仕事のご相談', 'description' => '')); ?>
      <article class="contact-page">
        <div class="contact-page__body">
          <div class="case-content"><?php the_content(); ?></div>
        </div>
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
        <?php get_template_part('template-parts/page-heading', null, array('eyebrow' => 'INFORMATION')); ?>
        <div class="db-single__content">
          <?php the_content(); ?>
        </div>
      </article>
    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
