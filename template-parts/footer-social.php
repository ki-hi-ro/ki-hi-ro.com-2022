<section class="footer-social" aria-labelledby="footer-social-title">
  <div class="footer-social__heading">
    <h2 id="footer-social-title">各サービスの最新投稿</h2>
    <p>日々の発信と開発の記録</p>
  </div>
  <div class="footer-social__grid">
    <section class="footer-social__card" aria-labelledby="footer-feed-youtube">
      <h3 id="footer-feed-youtube"><a href="https://www.youtube.com/@khiro9999">YouTube <span aria-hidden="true">↗</span></a></h3>
      <p class="footer-social__label">最新の動画</p>
      <iframe class="footer-social__video" src="https://www.youtube-nocookie.com/embed/videoseries?list=UUiE72iE5Cf3Zj6ks19c3fSg&amp;rel=0" title="khiroの最新アップロード動画" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" allow="encrypted-media; picture-in-picture; fullscreen" allowfullscreen></iframe>
      <a class="footer-social__more" href="https://www.youtube.com/@khiro9999/videos">YouTubeですべて見る ↗</a>
    </section>
    <?php foreach (kihiro_social_sources() as $key => $source) : ?>
      <?php $items = get_transient('kihiro_social_' . $key); ?>
      <section class="footer-social__card" aria-labelledby="footer-feed-<?php echo esc_attr($key); ?>">
        <h3 id="footer-feed-<?php echo esc_attr($key); ?>"><a href="<?php echo esc_url($source['url']); ?>"><?php echo esc_html($source['name']); ?> <span aria-hidden="true">↗</span></a></h3>
        <p class="footer-social__label"><?php echo esc_html($source['label']); ?></p>
        <?php if (is_array($items) && $items) : ?>
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
        <a class="footer-social__more" href="<?php echo esc_url($source['url']); ?>"><?php echo esc_html($source['name']); ?>ですべて見る ↗</a>
      </section>
    <?php endforeach; ?>
    <section class="footer-social__card footer-social__card--instagram" aria-labelledby="footer-feed-instagram">
      <h3 id="footer-feed-instagram"><a href="https://www.instagram.com/hiroki.hiroki2026/" target="_blank" rel="noopener noreferrer">Instagram <span aria-hidden="true">↗</span></a></h3>
      <p class="footer-social__label">@hiroki.hiroki2026</p>
      <iframe class="footer-social__instagram" src="https://www.instagram.com/hiroki.hiroki2026/embed/" title="hiroki.hiroki2026のInstagramプロフィール" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
      <a class="footer-social__more" href="https://www.instagram.com/hiroki.hiroki2026/" target="_blank" rel="noopener noreferrer">Instagramで投稿を見る ↗</a>
    </section>
  </div>
</section>
