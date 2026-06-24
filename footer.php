<footer class="site-footer">
  <div class="outer-container site-footer__inner">
    <div class="site-footer__brand">
      <span class="site-footer__mark" aria-hidden="true">K</span>
      <div>
        <strong>ki-hi-ro.com</strong>
        <!-- <p>写真、言葉、技術、人生哲学を移動しながら記録する場所。</p> -->
        <p>自然、セレンディピティ、哲学</p>
      </div>
    </div>

    <nav class="site-footer__nav" aria-label="フッターナビゲーション">
      <?php foreach (kihiro_navigation_sections() as $nav_section) : ?>
        <div class="site-footer__nav-column">
          <h2><?php echo esc_html($nav_section['title']); ?></h2>
          <?php foreach ($nav_section['items'] as $nav_item) : ?>
            <a href="<?php echo esc_url($nav_item['url']); ?>"><?php echo esc_html($nav_item['label']); ?></a>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </nav>
    <p class="site-footer__copyright">© <?php echo esc_html(wp_date('Y')); ?> ki-hi-ro.com</p>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>
