<?php if (!is_date()) : ?>
  <section class="life-article__section">
    <h1 class="front-sec__ttl --sp-center">My blog, my life</h1>
    <p class="life-article__lead">自分 × 何か, 自分の心のコップを満たす</p>

    <?php get_template_part('template-parts/last-modified-posts'); ?>
  </section>
<?php else : ?>
  <?php get_template_part('template-parts/last-modified-posts'); ?>
<?php endif; ?>
