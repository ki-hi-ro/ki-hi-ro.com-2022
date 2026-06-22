<?php if (!is_singular('post')) : ?>
  <p class="page-top --not-single-sp"><a class="page-top__link --not-single-sp" href="#">↑</a></p>
<?php endif; ?>

<footer class="site-footer">
  <div class="outer-container site-footer__inner">
    <div class="site-footer__brand">
      <span class="site-footer__mark" aria-hidden="true">K</span>
      <div>
        <strong>ki-hi-ro.com</strong>
        <p>フリーランスWEBエンジニア 柴田 浩貴のブログ。</p>
      </div>
    </div>
    <nav class="site-footer__nav" aria-label="フッターナビゲーション">
      <a href="<?php echo esc_url(kihiro_topic_url('technology')); ?>">技術ブログ</a>
      <a href="<?php echo esc_url(kihiro_topic_url('philosophy')); ?>">人生哲学</a>
      <a href="<?php echo esc_url(kihiro_topic_url('curation')); ?>">情報のセレクトショップ</a>
    </nav>
    <p class="site-footer__copyright">© <?php echo esc_html(wp_date('Y')); ?> ki-hi-ro.com</p>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>
