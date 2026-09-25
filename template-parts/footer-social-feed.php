<?php
$key = $args['key'];
$source = $args['source'];
$items = kihiro_social_cached_items($key);
?>
<section class="footer-social__card" aria-labelledby="footer-feed-<?php echo esc_attr($key); ?>">
  <h3 id="footer-feed-<?php echo esc_attr($key); ?>"><a href="<?php echo esc_url($source['url']); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($source['name']); ?> <span aria-hidden="true">↗</span></a></h3>
  <p class="footer-social__label"><?php echo esc_html($source['label']); ?></p>
  <?php if ($items) : ?>
    <ul class="footer-social__posts">
      <?php foreach ($items as $item) : ?>
        <li>
          <a href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($item['title'] . '（新しいタブで開く）'); ?>">
            <?php if ($item['date']) : ?>
              <time datetime="<?php echo esc_attr(gmdate('c', $item['date'])); ?>"><?php echo esc_html(wp_date('Y.m.d', $item['date'])); ?></time>
            <?php endif; ?>
            <span><?php echo esc_html($item['title']); ?></span>
            <?php if (!empty($item['repository'])) : ?>
              <small class="footer-social__repository"><?php echo esc_html($item['repository']); ?></small>
            <?php endif; ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else : ?>
    <p class="footer-social__empty">投稿は<?php echo esc_html($source['name']); ?>のプロフィールからご覧いただけます。</p>
  <?php endif; ?>
  <a class="footer-social__more" href="<?php echo esc_url($source['url']); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($source['name']); ?>ですべて見る ↗</a>
</section>
