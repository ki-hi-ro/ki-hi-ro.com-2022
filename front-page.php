<?php get_header();?>

<main class="front-container">
  <div class="pc-left-container">
    <section class="front-sec">
      <h2 class="front-sec__ttl">最近書いた記事</h2>
      <div class="front-sec__text front-sec__flex">
        <?php echo get_template_part("template-parts/blog-list-thumb-desc"); ?>
      </div>
      <a class="front-sec__more" href="<?php echo home_url("all-article"); ?>">これまでに書いた記事の一覧はこちら</a>
    </section>
  </div>
  <div class="pc-right-container">
    <section class="front-sec">
      <h2 class="front-sec__ttl">年月アーカイブ</h2>
      <?php echo get_template_part("template-parts/date-article-list"); ?>
    </section>

    <section class="front-sec">
      <h2 class="front-sec__ttl">タグ</h2>
      <div class="front-sec__text">
        <?php
        $args = array(
            'orderby' => 'name',
            'order' => 'ASC'
        );
        $posttags = get_tags( $args );

        if ( $posttags ){
          echo ' <ul class="front-sec__tag-list"> ';
          $tag_count = count($posttags);
          $i = 1;
          foreach( $posttags as $tag ) {
            if($i != $tag_count) {
              echo '<li class="front-sec__item"><a class="front-sec__link" href="'. get_tag_link( $tag->term_id ) . '">' . $tag->name .  '</a></li>';
            } else {
              echo '<li class="front-sec__item"><a class="front-sec__link" href="'. get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></li>';
            }
            $i++;
          }
          echo ' </ul> ';
        }
        ?>
      </div>
    </section>
  </div>

  <!-- <section class="front-sec">
    <h2 class="front-sec__ttl">自己紹介</h2>
    <div class="front-sec__text">
      <p>29歳男性です。愛知県一宮市に住んでいます。<br>これまでは、WEB制作のフリーランスエンジニアとして、WEBサイトのコーディングを行ってきました。<br>2023年2月1日からは、正社員のソフトウェア評価エンジニアとして、就業開始しました。</p>
    </div>
  </section> -->
  <!-- <section class="sns-wrap">
    <section class="front-sec --twitter">
      <h2 class="front-sec__ttl">Twitter</h2>
      <div class="front-sec__text">
        <a class="twitter-timeline" data-width="350" data-height="555" href="https://twitter.com/2021_shibata?ref_src=twsrc%5Etfw">Tweets by 2021_shibata</a>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
      </div>
    </section>
    <section class="front-sec">
      <h2 class="front-sec__ttl">Instagram</h2>
      <div class="front-sec__text">
        <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
        <div class="elfsight-app-cfaaba04-9b5b-4a31-a9b8-82d0cc5d60c1"></div>
      </div>
    </section>
  </section> -->
  <style>
    #eapps-instagram-feed-1 {
      max-width: 100%;
    }
  </style>
</main>

<?php get_footer();?>