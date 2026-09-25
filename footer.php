<footer class="site-footer">

  <?php get_template_part('template-parts/footer-social'); ?>

  <nav class="site-footer__directory" aria-label="外部サイト・プロフィール">


    <section class="site-footer__group" aria-labelledby="footer-social">

      <h2 id="footer-social">SNS・ブログ</h2>

      <ul>
        <li>
          <a href="https://x.com/2021_shibata"
          target="_blank"
          rel="noopener noreferrer">
          X
          <span class="site-footer__link-arrow" aria-hidden="true">↗&#xfe0e;</span>
          </a>
        </li>

        <li>
          <a href="https://www.youtube.com/@khiro9999"
          target="_blank"
          rel="noopener noreferrer">
          YouTube
          <span class="site-footer__link-arrow" aria-hidden="true">↗&#xfe0e;</span>
          </a>
        </li>

        <li>
          <a href="https://www.instagram.com/hiroki.hiroki2026/"
            target="_blank"
            rel="noopener noreferrer">
            Instagram
          <span class="site-footer__link-arrow" aria-hidden="true">↗&#xfe0e;</span>
          </a>
        </li>

        <li>
          <a href="https://khirok.hatenadiary.jp/"
             target="_blank"
             rel="noopener noreferrer">
            はてなブログ
          <span class="site-footer__link-arrow" aria-hidden="true">↗&#xfe0e;</span>
          </a>
        </li>
      </ul>

    </section>

    <section class="site-footer__group" aria-labelledby="footer-websites">

      <h2 id="footer-websites">制作したWebサイト</h2>

      <ul>
        <li>
          <a href="https://freelance-blog.onrender.com/"
             target="_blank"
             rel="noopener noreferrer">
            My Portfolio
          <span class="site-footer__link-arrow" aria-hidden="true">↗&#xfe0e;</span>
          </a>
        </li>

        <li>
          <a href="https://kaji-dx-ki-hi-ro.hiroki-hiroki.chatgpt.site"
             target="_blank"
             rel="noopener noreferrer">
            家事DX
          <span class="site-footer__link-arrow" aria-hidden="true">↗&#xfe0e;</span>
          </a>
        </li>

        <li>
          <a href="https://tech-gems-digest.lovable.app/"
             target="_blank"
             rel="noopener noreferrer">
            技術ブログ
          <span class="site-footer__link-arrow" aria-hidden="true">↗&#xfe0e;</span>
          </a>
        </li>
        
        <li><a href="https://ki-hi-ro.github.io/yokohama-live-trip/" target="_blank" rel="noopener noreferrer">Yokohama Live Trip <span class="site-footer__link-arrow" aria-hidden="true">↗&#xfe0e;</span></a></li>
        <li><a href="https://euphoria-random.hiroki-hiroki.chatgpt.site/" target="_blank" rel="noopener noreferrer">Euphoria Random <span class="site-footer__link-arrow" aria-hidden="true">↗&#xfe0e;</span></a></li>




        <li>
          <a href="https://ki-hi-ro.com/muji/"
             target="_blank"
             rel="noopener noreferrer">
            ほぼMUJI
          <span class="site-footer__link-arrow" aria-hidden="true">↗&#xfe0e;</span>
          </a>
        </li>
      </ul>

    </section>

  </nav>

  <div class="site-footer__bottom">

    <a class="site-footer__logo"
       href="<?php echo esc_url(home_url('/')); ?>">
      ki-hi-ro.com
    </a>

    <span>
      &copy; <?php echo esc_html(wp_date('Y')); ?> ki-hi-ro.com
    </span>

    <a class="site-footer__top" href="#page-top">
      ページの上へ &uarr;
    </a>

  </div>

</footer>

<a class="floating-page-top" href="#page-top" aria-label="ページの先頭へ戻る">
  <span aria-hidden="true">↑</span>
  <span>ページトップ</span>
</a>

<?php wp_footer(); ?>

</body>
</html>
