<?php if (!is_date()) : ?>
  <section class="life-article__section">
    <h1 class="front-sec__ttl --sp-center">Code, Thought, Life</h1>
    <p class="life-article__lead">技術と思考と人生を、自分の言葉で整理する。</p>

    <?php get_template_part('template-parts/last-modified-posts'); ?>
  </section>
<?php else : ?>
  <?php get_template_part('template-parts/last-modified-posts'); ?>
<?php endif; ?>
