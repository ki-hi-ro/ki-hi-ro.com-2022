<footer class="site-footer">

  <div class="site-footer__bottom">

    <a class="site-footer__logo"
       href="<?php echo esc_url(home_url('/')); ?>">
      ki-hi-ro.com
    </a>

    <span>
      &copy; <?php echo esc_html(wp_date('Y')); ?> ki-hi-ro.com
    </span>

    <a class="site-footer__contact" href="<?php echo esc_url(home_url('/contact-us/')); ?>">お問い合わせ</a>

  </div>

</footer>

<a class="floating-page-top" href="#page-top" aria-label="ページの先頭へ戻る">
  <span aria-hidden="true">↑</span>
  <span>ページトップ</span>
</a>

<?php wp_footer(); ?>

</body>
</html>
