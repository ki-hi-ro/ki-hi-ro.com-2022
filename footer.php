<footer class="site-footer">

  <?php get_template_part('template-parts/footer-social'); ?>

  <nav class="site-footer__directory" aria-label="外部サイト・プロフィール">

    <section class="site-footer__group" aria-labelledby="footer-writing">

      <h2 id="footer-writing">ブログ・執筆</h2>

      <ul>
        <li>
          <a href="https://note.com/khiro_maru"
             target="_blank"
             rel="noopener noreferrer">
            note
          </a>
        </li>

        <li>
          <a href="https://zenn.dev/khiro_maru"
             target="_blank"
             rel="noopener noreferrer">
            Zenn
          </a>
        </li>

        <li>
          <a href="https://khirok.hatenadiary.jp/"
             target="_blank"
             rel="noopener noreferrer">
            はてなブログ
          </a>
        </li>
      </ul>

    </section>

    <section class="site-footer__group" aria-labelledby="footer-development">

      <h2 id="footer-development">開発・学習</h2>

      <ul>
        <li>
          <a href="https://freelance-blog.onrender.com/"
             target="_blank"
             rel="noopener noreferrer">
            My Portfolio
          </a>
        </li>

        <li>
          <a href="https://github.com/ki-hi-ro"
             target="_blank"
             rel="noopener noreferrer">
            GitHub
          </a>
        </li>

        <!--
        <li>
          <a href="https://paiza.jp/skill_checks/retry_results"
             target="_blank"
             rel="noopener noreferrer">
            paiza スキルチェック
          </a>
        </li>
        -->
      </ul>

    </section>

    <section class="site-footer__group" aria-labelledby="footer-social">

      <h2 id="footer-social">SNS・動画</h2>

      <ul>
        <li>
          <a href="https://www.instagram.com/hiroki.hiroki2026/"
             target="_blank"
             rel="noopener noreferrer">
            Instagram
          </a>
        </li>

        <li>
          <a href="https://www.youtube.com/@khiro9999"
             target="_blank"
             rel="noopener noreferrer">
            YouTube
          </a>
        </li>
      </ul>

    </section>

    <section class="site-footer__group" aria-labelledby="footer-websites">

      <h2 id="footer-websites">Webサイト</h2>

      <ul>
        <li>
          <a href="https://tech-gems-digest.lovable.app/"
             target="_blank"
             rel="noopener noreferrer">
            技術ブログ
          </a>
        </li>

        <li>
          <a href="https://kaji-dx-ki-hi-ro.hiroki-hiroki.chatgpt.site"
             target="_blank"
             rel="noopener noreferrer">
            家事DX
          </a>
        </li>

        <li>
          <a href="https://ki-hi-ro.com/muji/"
             target="_blank"
             rel="noopener noreferrer">
            ほぼMUJI
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

<?php wp_footer(); ?>

</body>
</html>