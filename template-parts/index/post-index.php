<?php $current_topic = kihiro_current_topic(); ?>
<?php if (!is_date()) : ?>
  <section class="life-article__section">
    <?php if ($current_topic) : ?>
      <?php $topic_data = kihiro_topic_definitions()[$current_topic]; ?>
      <h1 class="front-sec__ttl --sp-center"><?php echo esc_html($topic_data['label']); ?></h1>
      <p class="life-article__lead"><?php echo esc_html($topic_data['description']); ?></p>
    <?php else : ?>
      <h2 class="front-sec__ttl --sp-center">自分の人生を生きるための記事一覧</h2>

      <?php $selected_tags = kihiro_get_selected_tag_index_tags(); ?>
      <?php if ($selected_tags) : ?>
        <div class="logbook-filter" data-logbook-filter>
          <button class="logbook-filter__button is-active" type="button" data-filter-tag="all" aria-pressed="true">すべて</button>
          <?php foreach ($selected_tags as $selected_tag) : ?>
            <button class="logbook-filter__button" type="button" data-filter-tag="<?php echo esc_attr($selected_tag->slug); ?>" aria-pressed="false">
              # <?php echo esc_html($selected_tag->name); ?>
            </button>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <?php get_template_part('template-parts/last-modified-posts'); ?>
  </section>
<?php else : ?>
  <?php get_template_part('template-parts/last-modified-posts'); ?>
<?php endif; ?>
