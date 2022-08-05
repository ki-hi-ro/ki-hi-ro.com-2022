<?php get_header();?>

<div class="mv">
  <img class="pc-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-pc.png?20220804" alt="PCのメインビジュアル">
  <img class="sp-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-sp.png?20220804" alt="スマホのメインビジュアル">
  <a href="<?php echo home_url('#contact'); ?>" class="contact-btn">
    <img class="sp-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/contact-btn.png?20220806" alt="お問い合わせボタン">
  </a>
</div>

<main class="container">
  <?php echo get_template_part('template-parts/author'); ?>

  <section class="top-section" id="what-i-can">
    <h4>対応可能な項目</h4>
    <p>
      WordPress, EC-CUBE, LPサイトなどWebサイト全般のコーディングが対応可能です。対応可能な言語は、HTML / CSS, Sass, PHP, Twigなどです。
      <a href="#contact">こちら</a>よりご相談内容をお送りいただければ、金額と納期をお知らせします。
      金額と納期をお知らせする以前に、対応が難しい場合はその旨もご連絡します。対応可能項目を増やすために<a href="#study-blog">学習ブログ</a>を更新しています。
    </p>
  </section>

  <section class="top-section" id="what-i-did">
    <h4>これまでの対応内容</h4>
    <p>これまでにクラウドソーシングや、エージェント、地元のWEB制作会社経由で様々なお仕事を経験しました。どんな仕事をしてきたのかを、掲載可能な範囲で投稿していきます。</p>
    <?php
          $args = array(
              'category_name' =>
    'what-i-did', 'post_type' => 'post', 'posts_per_page' => 5, ); $myposts =
    get_posts($args); foreach ($myposts as $post): setup_postdata($post); ?>
    <?php echo get_template_part('template-parts/sidebar-blog'); ?>
    <?php
          endforeach;
          wp_reset_postdata();
          ?>
              <div class="more-link --top-sec">
        <a href="<?php echo home_url('category/what-i-did'); ?>"
          >これまでの対応内容をもっと見る<img
            src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"
        /></a>
      </div>

  </section>

  <section class="top-section sidebar__blog sidebar__contents" id="skill-blog">
    <h4>技術ブログ</h4>

    <p>これまでに身につけてきたWEB制作に必要なスキルを、テーマを決めて投稿していきます。</p>

    <?php
          $args = array(
              'category_name' =>
    'skill-blog', 'post_type' => 'post', 'posts_per_page' => 3, ); $myposts =
    get_posts($args); foreach ($myposts as $post): setup_postdata($post); ?>
    <?php echo get_template_part('template-parts/sidebar-blog'); ?>
    <?php
          endforeach;
          wp_reset_postdata();
          ?>
              <div class="more-link --top-sec">
        <a href="<?php echo home_url('category/skill-blog/'); ?>"
          >技術ブログをもっと見る<img
            src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"
        /></a>
      </div>
  </section>

  <section class="top-section sidebar__blog sidebar__contents" id="study-blog">
    <h4>学習ブログ</h4>

    <p>参考書などで学んだことをテーマにしたブログ記事を投稿していきます。</p>

    <?php
          $args = array(
              'category_name' =>
    'study-blog', 'post_type' => 'post', 'posts_per_page' => 3, ); $myposts =
    get_posts($args); foreach ($myposts as $post): setup_postdata($post); ?>
    <?php echo get_template_part('template-parts/sidebar-blog'); ?>
    <?php
          endforeach;
          wp_reset_postdata();
          ?>
      <div class="more-link --top-sec">
        <a href="<?php echo home_url('category/study-blog/'); ?>"
          >学習ブログをもっと見る<img
            src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"
        /></a>
      </div>
  </section>

  <section class="top-section sidebar__blog sidebar__contents" id="random-blog">
    <h4>雑記ブログ</h4>

    <p>日常で感動したことなどを、息抜きに投稿していきます。</p>

    <?php
          $args = array(
              'category_name' =>
    'random-blog', 'post_type' => 'post', 'posts_per_page' => 3, ); $myposts =
    get_posts($args); foreach ($myposts as $post): setup_postdata($post); ?>
    <?php echo get_template_part('template-parts/sidebar-blog'); ?>
    <?php
          endforeach;
          wp_reset_postdata();
          ?>

              <div class="more-link --top-sec">
        <a href="<?php echo home_url('category/random-blog/'); ?>"
          >雑記ブログをもっと見る<img
            src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"
        /></a>
      </div>
  </section>

  <section class="contact top-section" id="contact">
    <h4>お問い合わせ</h4>
    <?php echo do_shortcode('[contact-form-7 id="3467" title="お問い合わせ"]'); ?>
  </section>
</main>

<?php get_footer();?>
