<footer class="site-footer">
  <nav class="site-footer__directory" aria-label="外部サイト・プロフィール">
    <section class="site-footer__group" aria-labelledby="footer-writing">
      <h2 id="footer-writing">ブログ・執筆</h2>
      <ul>
        <li><a href="https://note.com/khiro_maru">note</a></li>
        <li><a href="https://zenn.dev/khiro_maru">Zenn</a></li>
        <li><a href="https://khirok.hatenadiary.jp/">はてなブログ</a></li>
      </ul>
    </section>
    <section class="site-footer__group" aria-labelledby="footer-development">
      <h2 id="footer-development">開発・学習</h2>
      <ul>
        <li><a href="https://freelance-blog.onrender.com/">My Portfolio</a></li>
        <li><a href="https://github.com/ki-hi-ro">GitHub</a></li>
        <!-- <li><a href="https://paiza.jp/skill_checks/retry_results">paiza スキルチェック</a></li> -->
      </ul>
    </section>
    <section class="site-footer__group" aria-labelledby="footer-social">
      <h2 id="footer-social">SNS・動画</h2>
      <ul>
        <li><a href="https://x.com/2021_shibata">X</a></li>
        <li><a href="https://www.instagram.com/hiroki.hiroki2026/">Instagram</a></li>
        <li><a href="https://www.youtube.com/@khiro9999">YouTube</a></li>
      </ul>
    </section>
    <section class="site-footer__group" aria-labelledby="footer-websites">
      <h2 id="footer-websites">Webサイト</h2>
      <ul>
        <!-- <li><a href="https://preview--tech-gems-digest.lovable.app/">Tech Gems Digest</a></li> -->
        <li><a href="https://kaji-dx-ki-hi-ro.hiroki-hiroki.chatgpt.site">家事DX</a></li>
        <li><a href="https://ki-hi-ro.com/muji/">ほぼMUJI</a></li>
      </ul>
    </section>
  </nav>
  <div class="site-footer__bottom">
    <a class="site-footer__logo" href="<?php echo esc_url(home_url('/')); ?>">ki-hi-ro.com</a>
    <span>&copy; <?php echo esc_html(wp_date('Y')); ?> ki-hi-ro.com</span>
    <a class="site-footer__top" href="#page-top">ページの上へ &uarr;</a>
  </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
