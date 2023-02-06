<?php get_header();?>

<?php // echo get_template_part('template-parts/loading'); ?>

<main class="front-container">
  <section class="front-sec">
    <h2 class="front-sec__ttl">新着記事</h2>
    <div class="front-sec__text">
      <?php
      $news_query = new WP_Query(
        array(
          'post_type'      => 'post',
          'posts_per_page' => 1,
        )
      );
      ?>
      <?php if ( $news_query->have_posts() ) : ?>
      <?php while ( $news_query->have_posts() ) : ?>
      <?php $news_query->the_post(); ?>
      <a class="all-article__link" href="<?php the_permalink(); ?>">
        <div class="all-article__post-wrap">
          <div class="all-article__date"><?php echo get_the_date('Y.m.d'); ?></div>
          <div class="all-article__ttl"><?php the_title(); ?></div>
          <div class="all-article__desc"><?php the_excerpt(); ?></div>
        </div>
      </a>
      <?php endwhile; ?>
      <?php endif; ?>
      <?php wp_reset_postdata(); ?>
    </div>
  </section>
  <section class="front-sec">
    <h2 class="front-sec__ttl">これまでに書いた記事について</h2>
    <div class="front-sec__text">
      <p>これまでにプログラミングや旅行についてなど、数多くの記事を書いてきました。</p>
      <a href="<?php echo home_url("all-article"); ?>">これまでに書いた記事の一覧</a>
    </div>
  </section>
  <section class="front-sec">
    <h2 class="front-sec__ttl">私について</h2>
    <div class="front-sec__text">
      <p>29歳男性です。愛知県一宮市に住んでいます。ソフトウェア開発エンジニアとして2月1日から就業開始しました。<br>これまでは、WEB制作のフリーランスエンジニアとして、WEBサイトのコーディングを行ってきました。</p>
      <p>コーディングとは、デザインされたWEBサイトをHTML / CSSという言語を使って、WEB上に構築していくことです。<br>ブログを投稿出来たりするには、WordPressというCMS(コンテンツマネジメントシステム)を利用します。</p>
      <p>このブログでは、日々の学習・就業経験を踏まえて情報発信していきます。</p>
    </div>
  </section>
  <section class="front-sec">
    <h2 class="front-sec__ttl">基本情報技術者試験について</h2>
    <div class="front-sec__text">
      <p>4/16に受験予定です。</p>
      <p>ソフトウェア開発エンジニアとしてこれから活躍していくための基礎となる知識が詰まっている試験です。</p>
      <p>過去問を見てみたところ、知らない用語がたくさんあったので、しっかりと学習してから試験に臨みたいです。</p>
    </div>
  </section>
  <section class="front-sec">
    <h2 class="front-sec__ttl">TOEICについて</h2>
    <div class="front-sec__text">
      <p>TOEICは、3/19に受験予定です。</p>
      <p>大学生の時に810点を獲得したことがありましたが、ブランクがあるため、<br class="d-sp-none">先日購入した参考書を使用して学習を進めていきます。</p>
      <a href="<?php echo home_url("result-first-mock-exam-toeic"); ?>">TOEIC L&A テスト200%活用模試を購入して、1回目の模試を受けてみた結果</a>
    </div>
  </section>
  <section class="front-sec">
    <h2 class="front-sec__ttl">chocoZAPについて</h2>
    <div class="front-sec__text">
      <p>今年からchocoZAPに入会しました。chocoZAPはライザップが運営しているコンビニ感覚で通えるジムです。</p>
      <p>今後このブログで筋トレのメリットなどを伝えていけたらと思います。</p>
    </div>
  </section>
  <section class="front-sec">
    <h2 class="front-sec__ttl">Twitter</h2>
    <div class="front-sec__text">
      <p>Twitterは基本的に毎朝1ツイート行っています。<br>朝起きてすぐに行うメモ書きから発信したい内容を決めてツイートしています。<br>ツイート直後は他のユーザーのツイートを見ていいねを押したり、フォローしたりしています。</p>
      <a href="https://twitter.com/2021_shibata">Twitterアカウント</a>
    </div>
  </section>
  <section class="front-sec">
    <h2 class="front-sec__ttl">Instagram</h2>
    <div class="front-sec__text">
      <p>インスタは、スマホで撮影した写真を不定期で投稿しています。</p>
      <a href="https://www.instagram.com/hiroki.hiroki2020/">インスタのアカウント</a>
    </div>
  </section>
</main>

<?php get_footer();?>