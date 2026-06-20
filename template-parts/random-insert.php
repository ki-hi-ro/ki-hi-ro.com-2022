<?php
$insert_index = isset($args['insert_index']) ? max(1, (int) $args['insert_index']) : 1;
$insert_types = ['quote', 'image', 'tags'];
$insert_type = $insert_types[($insert_index - 1) % count($insert_types)];
$type_index = intdiv($insert_index - 1, count($insert_types));
?>

<aside class="random-insert-card random-insert-card--<?= esc_attr($insert_type); ?>">
  <?php if ($insert_type === 'quote') : ?>
    <?php
    $quotes = kihiro_get_quote_candidates();
    shuffle($quotes);
    $quote = !empty($quotes) ? $quotes[$type_index % count($quotes)] : null;
    ?>

    <?php if ($quote) : ?>
      <a href="<?= esc_url($quote['url']); ?>" class="random-insert-card__link quote-box quote-link">
        <p><?= esc_html($quote['text']); ?></p>
      </a>
    <?php endif; ?>

  <?php elseif ($insert_type === 'image') : ?>
    <?php
    $image_ids = kihiro_get_random_image_ids();
    shuffle($image_ids);
    $image_id = !empty($image_ids) ? $image_ids[$type_index % count($image_ids)] : 0;
    $image = $image_id ? get_post($image_id) : null;
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'large') : '';
    $image_alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : '';
    $image_link = ($image && $image->post_parent) ? get_permalink($image->post_parent) : '';
    ?>

    <?php if ($image_url) : ?>
      <a href="<?= esc_url($image_link ?: $image_url); ?>" class="random-insert-card__link random-image">
        <div class="random-image-wrap">
          <img src="<?= esc_url($image_url); ?>" alt="<?= esc_attr($image_alt); ?>" class="random-image__img" loading="lazy" decoding="async">
        </div>
      </a>
    <?php endif; ?>

  <?php elseif ($insert_type === 'tags') : ?>
    <?php
    $tags = kihiro_get_random_tags();
    shuffle($tags);
    $display_tags = [];
    $tag_count = count($tags);

    if ($tag_count > 0) {
      $tag_offset = ($type_index * 3) % $tag_count;

      for ($tag_index = 0; $tag_index < min(3, $tag_count); $tag_index++) {
        $display_tags[] = $tags[($tag_offset + $tag_index) % $tag_count];
      }
    }
    ?>

    <?php if (!empty($display_tags)) : ?>
      <div class="random-insert-tags">
        <ul class="random-insert-tags__list">
          <?php foreach ($display_tags as $tag) : ?>
            <li>
              <a href="<?= esc_url(get_tag_link($tag->term_id)); ?>">
                <?= esc_html($tag->name); ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</aside>
