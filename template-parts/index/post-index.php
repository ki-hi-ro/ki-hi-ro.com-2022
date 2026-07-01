<?php $current_topic = kihiro_current_topic(); ?>
<?php if (!is_date()) : ?>
  <section class="life-article__section">
    <?php if ($current_topic) : ?>
      <?php $topic_data = kihiro_topic_definitions()[$current_topic]; ?>
      <h1 class="front-sec__ttl --sp-center"><?php echo esc_html($topic_data['label']); ?></h1>
      <p class="life-article__lead"><?php echo esc_html($topic_data['description']); ?></p>
    <?php else : ?>
      <h2 class="front-sec__ttl --sp-center">自分の人生を生きるための記事一覧</h2>
      <div class="logbook-overview" aria-label="ログの蓄積">
        <p class="logbook-overview__count">
          <span><?php echo esc_html(number_format_i18n(kihiro_get_logbook_total_posts())); ?></span> logs
          <?php $first_post_year = kihiro_get_logbook_first_post_year(); ?>
          <?php if ($first_post_year) : ?>
            <small>since <?php echo esc_html($first_post_year); ?></small>
          <?php endif; ?>
        </p>
        <ol class="logbook-activity" aria-label="最近の記録量">
          <?php foreach (kihiro_get_logbook_activity_counts() as $activity_day) : ?>
            <?php
            $activity_level = min(4, (int) $activity_day['count']);
            $activity_label = sprintf(
                '%s: %s件',
                wp_date('Y.m.d', strtotime($activity_day['date'])),
                number_format_i18n((int) $activity_day['count'])
            );
            ?>
            <li class="logbook-activity__day logbook-activity__day--level-<?php echo esc_attr((string) $activity_level); ?>" title="<?php echo esc_attr($activity_label); ?>" data-logbook-date="<?php echo esc_attr($activity_day['date']); ?>" data-logbook-level="<?php echo esc_attr((string) $activity_level); ?>" data-logbook-label="<?php echo esc_attr($activity_label); ?>">
              <span class="screen-reader-text"><?php echo esc_html($activity_label); ?></span>
            </li>
          <?php endforeach; ?>
        </ol>
      </div>

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
