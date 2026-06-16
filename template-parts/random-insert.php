<?php
$insert_index = isset($args['insert_index']) ? max(1, (int) $args['insert_index']) : 1;
$insert_types = ['quote', 'image', 'tags'];
$insert_type = $insert_types[($insert_index - 1) % count($insert_types)];
$type_index = intdiv($insert_index - 1, count($insert_types));
?>

<aside class="random-insert-card random-insert-card--<?= esc_attr($insert_type); ?>">
  <?php if ($insert_type === 'quote') : ?>
    <?php
    $quote_posts = get_posts([
      'numberposts' => 80,
      'post_status' => 'publish',
      'orderby'     => 'modified',
      'order'       => 'DESC',
    ]);

    $quotes = [];

    foreach ($quote_posts as $quote_post) {
      $content = wp_strip_all_tags($quote_post->post_content);
      $sentences = preg_split('/[。！？]/u', $content);

      foreach ($sentences as $sentence) {
        $sentence = trim($sentence);

        if (mb_strlen($sentence) >= 20 && mb_strlen($sentence) <= 80) {
          $quotes[] = [
            'text' => $sentence,
            'url'  => get_permalink($quote_post->ID),
          ];
        }
      }
    }

    $quote = !empty($quotes) ? $quotes[array_rand($quotes)] : null;
    ?>

    <?php if ($quote) : ?>
      <a href="<?= esc_url($quote['url']); ?>" class="quote-box quote-link">
        <p><?= esc_html($quote['text']); ?></p>
      </a>
    <?php endif; ?>

  <?php elseif ($insert_type === 'image') : ?>
    <?php
    $image_ids = get_posts([
      'post_type'      => 'attachment',
      'post_status'    => 'inherit',
      'post_mime_type' => 'image',
      'posts_per_page' => -1,
      'orderby'        => 'date',
      'order'          => 'DESC',
      'fields'         => 'ids',
    ]);

    $image_id = !empty($image_ids) ? $image_ids[array_rand($image_ids)] : 0;
    $image = $image_id ? get_post($image_id) : null;
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'large') : '';
    $image_alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : '';
    $image_link = ($image && $image->post_parent) ? get_permalink($image->post_parent) : '';
    ?>

    <?php if ($image_url) : ?>
      <div class="random-image-wrap">
        <a href="<?= esc_url($image_link ?: $image_url); ?>" class="random-image">
          <img src="<?= esc_url($image_url); ?>" alt="<?= esc_attr($image_alt); ?>" class="random-image__img">
        </a>
      </div>
    <?php endif; ?>

  <?php elseif ($insert_type === 'tags') : ?>
    <?php
    $tags = get_tags([
      'hide_empty' => false,
      'orderby'    => 'name',
      'order'      => 'ASC',
    ]);

    $display_tags = [];
    $tag_count = count($tags);

    if ($tag_count > 0) {
      shuffle($tags);
      $display_tags = array_slice($tags, 0, min(3, $tag_count));
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
