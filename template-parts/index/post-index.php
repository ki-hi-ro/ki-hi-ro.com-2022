<?php $current_topic = kihiro_current_topic(); ?>
<?php if (!is_date()) : ?>
  <section class="life-article__section">
    <?php if ($current_topic) : ?>
      <?php $topic_data = kihiro_topic_definitions()[$current_topic]; ?>
      <p class="section-kicker">Selected topic</p>
      <h1 class="front-sec__ttl --sp-center"><?php echo esc_html($topic_data['label']); ?></h1>
      <p class="life-article__lead"><?php echo esc_html($topic_data['description']); ?></p>
    <?php else : ?>
      <p class="section-kicker">Journal</p>
      <h2 class="front-sec__ttl --sp-center">Latest notes</h2>
      <p class="life-article__lead">技術と思想と日々の発見を、自分の言葉で整理する。</p>
    <?php endif; ?>

    <?php get_template_part('template-parts/last-modified-posts'); ?>
  </section>
<?php else : ?>
  <?php get_template_part('template-parts/last-modified-posts'); ?>
<?php endif; ?>
