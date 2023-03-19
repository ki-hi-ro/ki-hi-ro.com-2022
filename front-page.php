<?php get_header();?>

<?php // echo get_template_part('template-parts/loading'); ?>

<main class="front-container">
  <section class="front-sec">
    <h2 class="front-sec__ttl">最近書いた記事</h2>
    <div class="front-sec__text front-sec__flex">
      <?php
      $news_query = new WP_Query(
        array(
          'post_type'      => 'post',
          'posts_per_page' => 3,
        )
      );
      if ( $news_query->have_posts() ) :
        $i = 0;
      while ( $news_query->have_posts() ) :
      $news_query->the_post();
      ?>
      <a class="all-article__link front-sec__flex-item <?php if($i == 1): ?>--center<?php endif; ?>" href="<?php the_permalink(); ?>">
        <div class="all-article__post-wrap">
          <div class="all-article__date"><?php echo get_the_date('Y.m.d'); ?></div>
          <div class="all-article__ttl"><?php the_title(); ?></div>
          <?php
            if (has_post_thumbnail()) :
              the_post_thumbnail('',array( 'class' => 'front-sec__flex-item-thumb' ));
          ?>
          <?php else : ?>
              <img class="front-sec__flex-item-thumb" src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/no-image.png" alt="no-image">
          <?php endif; ?>
          <div class="all-article__desc"><?php the_excerpt(); ?></div>
        </div>
      </a>
      <?php
      $i++;
      endwhile;
      endif;
      wp_reset_postdata();
      ?>
    </div>
    <a href="<?php echo home_url("all-article"); ?>">これまでに書いた記事の一覧</a>
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
            echo '<li class="front-sec__item"><a class="front-sec__link" href="'. get_tag_link( $tag->term_id ) . '">' . $tag->name . ',' . '</a></li>';
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
  <section class="front-sec">
    <h2 class="front-sec__ttl">自己紹介</h2>
    <div class="front-sec__text">
      <p>29歳男性です。愛知県一宮市に住んでいます。<br>これまでは、WEB制作のフリーランスエンジニアとして、WEBサイトのコーディングを行ってきました。<br>2023年2月1日からは、正社員のソフトウェア開発エンジニアとして、就業開始しました。</p>
      <img class="front-sec__my-prof-img" src="https://ki-hi-ro.com/ki-hi-ro.com-2022/wp-content/uploads/2023/02/IMG_3771-1536x2048.jpeg" alt="自分のプロフィール画像">
      <figcaption class="wp-element-caption"><a href="https://ki-hi-ro.com/location-of-one-ok-c-h-a-o-s-m-y-t-h/">ONE OK ROCK「C.h.a.o.s.m.y.t.h.」のロケ地へ</a></figcaption>
    </div>
  </section>
  <section class="front-sec">
    <h2 class="front-sec__ttl">Twitter</h2>
    <div class="front-sec__text">
      <a class="twitter-timeline" data-width="350" data-height="630" href="https://twitter.com/2021_shibata?ref_src=twsrc%5Etfw">Tweets by 2021_shibata</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
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