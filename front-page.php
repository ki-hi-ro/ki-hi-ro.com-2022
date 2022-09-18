<?php get_header(); ?>

<div class="mv">
  <div class="mv-text-wrap">
    <div class="mv-text">WEB制作のコーディングで<span class="sp-none">、</span><br class="only-sp">価値を提供する</div>
  </div>
  <img class="pc-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-pc.png?20220823-1" alt="PCのメインビジュアル">
  <img class="sp-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-sp.png?20220823-1" alt="スマホのメインビジュアル">
  <div class="scrolldown1"><span>Scroll</span></div>
</div>

<main>
  <?php echo get_template_part('template-parts/author'); ?>

  <section class="top-section" id="what-i-can">
    <h4>対応可能な項目</h4>
    <p>
      WordPress, EC-CUBE, LPサイトなどWebサイト全般のコーディングが対応可能です。対応可能な言語は、HTML / CSS, Sass, PHP, Twigなどです。<a href="contact">こちら</a>よりご相談内容をお送りいただければ、金額と納期をお知らせします。
      金額と納期をお知らせする以前に、対応が難しい場合はその旨もご連絡します。対応可能項目を増やすために<a href="<?php echo home_url('/category/study-blog/'); ?>">学習ブログ</a>を更新しています。
    </p>
  </section>

  <section class="top-section" id="what-i-did">
    <h4>これまでの仕事</h4>
    <p>これまでにクラウドソーシングや、エージェント、地元のWEB制作会社経由で様々なお仕事を経験しました。どんな仕事をしてきたのかを、掲載可能な範囲で投稿していきます。</p>
    <div class="blog-list-scroll">
      <?php $args = array('category_name' => 'what-i-did', 'post_type' => 'post', 'posts_per_page' => -1,);
      $myposts = get_posts($args);
      foreach ($myposts as $post) : setup_postdata($post); ?>
        <?php echo get_template_part('template-parts/blog-list-scroll'); ?>
      <?php endforeach;
      wp_reset_postdata(); ?>
    </div>
    <div class="more-link --top-sec">
      <a href="<?php echo home_url('category/what-i-did'); ?>">これまでの仕事一覧<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg" /></a>
    </div>
  </section>

  <!-- 技術 -->
  <div class="top-skill-blog">
    <h2 class="top-skill-blog__ttl">技術ブログ</h2>
    <p class="top-skill-blog__desc">これまでに身につけてきたWEB制作に必要なスキルを、テーマを決めて投稿していきます。</p>
    <hr class="top-skill-blog__hr">
    <?php
    $posttags = my_tags_in_cat(60);
    if ($posttags) {
      echo '<ul class="top-skill-blog__tag-ul">';
      foreach ($posttags as $tag) {
        echo '<li class="top-skill-blog__tag-li" contentid="' . $tag->slug . '">#' . $tag->name . '</li>';
      }
      echo '</ul>';
    }
    ?>
    <div class="blog-list-scroll--skill blog-list-scroll">
      <?php
      $args = array('category_name' => 'skill-blog', 'post_type' => 'post', 'posts_per_page' => -1);
      $myposts = get_posts($args);
      foreach ($myposts as $post) : setup_postdata($post);
      ?>
        <?php
        $posttags = get_the_tags();
        if ($posttags) :
        ?>
          <?php echo get_template_part('template-parts/blog-list-scroll'); ?>
        <?php
        endif;
        ?>
      <?php
      endforeach;
      wp_reset_postdata();
      ?>
    </div>
    <div class="more-link --top-sec">
      <a href="<?php echo home_url('category/skill-blog/'); ?>">技術ブログ一覧<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg" /></a>
    </div>
  </div>

  <!-- 学習 -->
  <div class="top-study-blog">
    <h2 class="top-study-blog__ttl">学習ブログ</h2>
    <p class="top-study-blog__desc">参考書などで学んだことをテーマにしたブログ記事を投稿していきます。</p>
    <hr class="top-study-blog__hr">
    <?php
    $posttags = my_tags_in_cat(69);
    if ($posttags) {
      echo '<ul class="top-study-blog__tag-ul">';
      foreach ($posttags as $tag) {
        if($tag->count >= 1) {
          echo '<li class="top-study-blog__tag-li" contentid="' . $tag->slug . '">#' . $tag->name. '</li>';
        }
      }
      echo '</ul>';
    }
    ?>
    <div class="blog-list-scroll--skill blog-list-scroll">
      <?php
      $args = array('category_name' => 'study-blog', 'post_type' => 'post', 'posts_per_page' => -1);
      $myposts = get_posts($args);
      foreach ($myposts as $post) : setup_postdata($post);
      ?>
        <?php
        $posttags = get_the_tags();
        if ($posttags) :
        ?>
          <?php echo get_template_part('template-parts/blog-list-scroll'); ?>
        <?php
        endif;
        ?>
      <?php
      endforeach;
      wp_reset_postdata();
      ?>
    </div>
    <div class="more-link --top-sec">
      <a href="<?php echo home_url('category/study-blog/'); ?>">学習ブログ一覧<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg" /></a>
    </div>
  </div>

  <section class="contact top-section" id="contact">
    <h4>お問い合わせ</h4>
    <?php echo do_shortcode('[contact-form-7 id="3467" title="お問い合わせ"]'); ?>
  </section>
</main>

<?php get_footer(); ?>