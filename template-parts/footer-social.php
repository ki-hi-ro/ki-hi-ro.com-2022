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
      <?php get_template_part('template-parts/footer-social-feed', null, array('key' => $key, 'source' => $source)); ?>
    <?php endforeach; ?>
    <section class="footer-social__card footer-social__card--instagram" aria-labelledby="footer-feed-instagram">
      <h3 id="footer-feed-instagram"><a href="https://www.instagram.com/hiroki.hiroki2026/" target="_blank" rel="noopener noreferrer">Instagram <span aria-hidden="true">↗</span></a></h3>
      <p class="footer-social__label">@hiroki.hiroki2026</p>
      <iframe class="footer-social__instagram" src="https://www.instagram.com/hiroki.hiroki2026/embed/" title="hiroki.hiroki2026のInstagramプロフィール" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
      <a class="footer-social__more" href="https://www.instagram.com/hiroki.hiroki2026/" target="_blank" rel="noopener noreferrer">Instagramで投稿を見る ↗</a>
    </section>
  </div>
</section>
