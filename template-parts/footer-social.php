<section class="footer-social" aria-labelledby="footer-social-title">

  <div class="footer-social__heading">
    <h2 id="footer-social-title">最近の発信</h2>
    <p>日々の発信と開発の記録</p>
  </div>

  <div class="footer-social__grid">

    <?php
    $social_sources = kihiro_social_sources();
    ?>

    <!-- Note -->
    <?php if (isset($social_sources['note'])) : ?>
      <?php
      get_template_part(
        'template-parts/footer-social-feed',
        null,
        array(
          'key'    => 'note',
          'source' => $social_sources['note'],
        )
      );
      ?>
    <?php endif; ?>


    <!-- Zenn -->
    <?php if (isset($social_sources['zenn'])) : ?>
      <?php
      get_template_part(
        'template-parts/footer-social-feed',
        null,
        array(
          'key'    => 'zenn',
          'source' => $social_sources['zenn'],
        )
      );
      ?>
    <?php endif; ?>


    <!-- GitHub -->
    <?php if (isset($social_sources['github_commits'])) : ?>
      <?php
      get_template_part(
        'template-parts/footer-social-feed',
        null,
        array(
          'key'    => 'github_commits',
          'source' => $social_sources['github_commits'],
        )
      );
      ?>
    <?php endif; ?>


    <!-- 下段（X・YouTube・Instagram）は一時非表示
    X
    <section
      class="footer-social__card footer-social__card--x"
      aria-labelledby="footer-feed-x"
    >
      <h3 id="footer-feed-x">
        <a
          href="https://x.com/2021_shibata"
          target="_blank"
          rel="noopener noreferrer"
        >
          X
          <span aria-hidden="true">↗</span>
        </a>
      </h3>

      <p class="footer-social__label">
        最新の投稿
      </p>

      <blockquote class="twitter-tweet" data-media-max-width="560"><p lang="ja" dir="ltr">2026年9月14日、自動運転車開発企業のWaymoが2027年に日本交通・GOとの提携により東京で自動運転サービスを提供開始することを発表した。 <br><br>2027年に東京で自動運転タクシーを利用できる未来がすぐそこに来ている。ぜひ利用したい。 <a href="https://t.co/wByWxogDnR">https://t.co/wByWxogDnR</a> <a href="https://t.co/EWW1hfPEfp">pic.twitter.com/EWW1hfPEfp</a></p>&mdash; Shibata Hiroki (@2021_shibata) <a href="https://x.com/2021_shibata/status/2101500629063721387?ref_src=twsrc%5Etfw">September 20, 2026</a></blockquote> <script async src="https://platform.x.com/widgets.js" charset="utf-8"></script>

      <a
        class="footer-social__more"
        href="https://x.com/2021_shibata"
        target="_blank"
        rel="noopener noreferrer"
      >
        Xですべて見る ↗
      </a>
      
    </section>


    YouTube
    <section
      class="footer-social__card footer-social__card--youtube"
      aria-labelledby="footer-feed-youtube"
    >
      <h3 id="footer-feed-youtube">
        <a
          href="https://www.youtube.com/@khiro9999"
          target="_blank"
          rel="noopener noreferrer"
        >
          YouTube
          <span aria-hidden="true">↗</span>
        </a>
      </h3>

      <p class="footer-social__label">
        最新の動画
      </p>

      <iframe
        class="footer-social__video"
        src="https://www.youtube-nocookie.com/embed/videoseries?list=UUiE72iE5Cf3Zj6ks19c3fSg&amp;rel=0"
        title="khiroの最新アップロード動画"
        loading="lazy"
        referrerpolicy="strict-origin-when-cross-origin"
        allow="encrypted-media; picture-in-picture; fullscreen"
        allowfullscreen
      ></iframe>

      <a
        class="footer-social__more"
        href="https://www.youtube.com/@khiro9999/videos"
        target="_blank"
        rel="noopener noreferrer"
      >
        YouTubeですべて見る ↗
      </a>
    </section>


    Instagram
    <section
      class="footer-social__card footer-social__card--instagram"
      aria-labelledby="footer-feed-instagram"
    >
      <h3 id="footer-feed-instagram">
        <a
          href="https://www.instagram.com/hiroki.hiroki2026/"
          target="_blank"
          rel="noopener noreferrer"
        >
          Instagram
          <span aria-hidden="true">↗</span>
        </a>
      </h3>

      <p class="footer-social__label">
        @hiroki.hiroki2026
      </p>

      自作プロフィール
      <a
        class="footer-social__instagram-profile"
        href="https://www.instagram.com/hiroki.hiroki2026/"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="hiroki.hiroki2026のInstagramプロフィールを見る"
      >
        <img
          class="footer-social__instagram-avatar"
          src="<?php echo esc_url(
            get_stylesheet_directory_uri()
            . '/assets/images/instagram-profile.jpg'
          ); ?>"
          alt="hiroki.hiroki2026"
          loading="lazy"
        >

        <div class="footer-social__instagram-profile-text">
          <strong>hiroki.hiroki2026</strong>
          <span>柴田浩貴</span>

          <span class="footer-social__instagram-profile-description">
            日々の風景と記録
          </span>
        </div>
      </a>

      Instagram 最新3枚
      <div class="footer-social__instagram-feed">
        <iframe
          class="footer-social__instagram"
          src="https://www.instagram.com/hiroki.hiroki2026/embed/"
          title="hiroki.hiroki2026のInstagram最新投稿"
          loading="lazy"
          referrerpolicy="strict-origin-when-cross-origin"
        ></iframe>
      </div>

      <a
        class="footer-social__more"
        href="https://www.instagram.com/hiroki.hiroki2026/"
        target="_blank"
        rel="noopener noreferrer"
      >
        Instagramで投稿を見る ↗
      </a>
    </section>

    -->

  </div>

</section>