<footer id="page-bottom" class="site-footer">

  <div class="site-footer__bottom">

    <a class="site-footer__logo"
       href="<?php echo esc_url(kihiro_logo_home_url()); ?>">
      ki-hi-ro.com
    </a>

    <span>
      &copy; <?php echo esc_html(wp_date('Y')); ?> ki-hi-ro.com
    </span>

    <?php if (!is_singular('post')) : ?><a class="site-footer__top" href="#page-top">ページトップ ↑</a><?php endif; ?>



  </div>

</footer>

<?php if (is_singular('post')) : ?>
<a class="floating-page-top" href="#page-bottom" aria-label="ページの最後へ移動">
  <span aria-hidden="true">↓</span>
</a>
<?php endif; ?>


<?php wp_footer(); ?>

</body>
</html>
