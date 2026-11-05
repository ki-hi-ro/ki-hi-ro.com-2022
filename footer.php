<footer id="page-bottom" class="site-footer">

  <div class="site-footer__bottom">
    <div class="site-footer__brand">
    <a class="site-footer__logo"
       href="<?php echo esc_url(kihiro_logo_home_url()); ?>">
      ki-hi-ro.com
    </a>

    <span>
      &copy; <?php echo esc_html(wp_date('Y')); ?> ki-hi-ro.com
    </span>
    </div>
    <a class="site-footer__top" href="#page-top" aria-label="ページトップへ戻る"><span aria-hidden="true">↑</span></a>



  </div>

</footer>

<?php if (is_singular('post') || is_page_template('page-case-study.php')) : ?>
<a class="floating-page-top" href="#page-bottom" aria-label="ページの最後へ移動">
  <span aria-hidden="true">↓</span>
</a>
<?php endif; ?>


<?php wp_footer(); ?>

</body>
</html>
