<?php get_header();?>

<div class="mv">
    <img class="pc-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-pc.png?20220813"
        alt="PCのメインビジュアル">
    <img class="sp-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-sp.png?202208013"
        alt="スマホのメインビジュアル">
    <div class="scrolldown1"><span>Scroll</span></div>
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
        <h4>これまでの仕事</h4>
        <p>これまでにクラウドソーシングや、エージェント、地元のWEB制作会社経由で様々なお仕事を経験しました。どんな仕事をしてきたのかを、掲載可能な範囲で投稿していきます。</p>
        <div class="top-contents__wrap">
          <?php $args = array( 'category_name' =>'what-i-did', 'post_type' => 'post', 'posts_per_page' => -1, ); $myposts = get_posts($args); foreach ($myposts as $post): setup_postdata($post); ?>
            <?php echo get_template_part('template-parts/top-contents'); ?>
          <?php endforeach; wp_reset_postdata(); ?>
        </div>
        <div class="more-link --top-sec">
          <a href="<?php echo home_url('category/what-i-did'); ?>">これまでの仕事一覧<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg" /></a>
        </div>
    </section>

    <div class="top-section --blog" id="blog">
      <h4>ブログ</h4>
    </div>
    <ul class="blog-tab">
      <li class="blog-tab__item blog-tab__skill current-tab" contentId="skill-blog">技術ブログ</li>
      <li class="blog-tab__item blog-tab__study" contentId="study-blog">学習ブログ</li>
      <li class="blog-tab__item blog-tab__random" contentId="random-blog">雑記ブログ</li>
    </ul>
    <div class="blog-tab-contents">
      <section class="blog-tab-content top-section sidebar__blog sidebar__contents" id="skill-blog">
          <p>これまでに身につけてきたWEB制作に必要なスキルを、テーマを決めて投稿していきます。</p>
          <div class="top-contents__wrap">
            <?php $args = array( 'category_name' => 'skill-blog', 'post_type' => 'post', 'posts_per_page' => -1, ); $myposts = get_posts($args); foreach ($myposts as $post): setup_postdata($post); ?>
              <?php echo get_template_part('template-parts/top-contents'); ?>
            <?php endforeach; wp_reset_postdata(); ?>
          </div>
          <div class="more-link --top-sec">
            <a href="<?php echo home_url('category/skill-blog/'); ?>">技術ブログ一覧<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg" /></a>
          </div>
      </section>

      <section class="blog-tab-content top-section sidebar__blog sidebar__contents notShowMe" id="study-blog">
          <p>参考書などで学んだことをテーマにしたブログ記事を投稿していきます。</p>
          <div class="top-contents__wrap">
            <?php $args = array( 'category_name' => 'study-blog', 'post_type' => 'post', 'posts_per_page' => -1, ); $myposts = get_posts($args); foreach ($myposts as $post): setup_postdata($post); ?>
              <?php echo get_template_part('template-parts/top-contents'); ?>
            <?php endforeach; wp_reset_postdata(); ?>
          </div>
          <div class="more-link --top-sec">
              <a href="<?php echo home_url('category/study-blog/'); ?>">学習ブログ一覧<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg" /></a>
          </div>
      </section>

      <section class="blog-tab-content top-section sidebar__blog sidebar__contents notShowMe" id="random-blog">
          <p>日常で感動したことなどを、息抜きに投稿していきます。</p>
          <div class="top-contents__wrap">
            <?php $args = array( 'category_name' => 'random-blog', 'post_type' => 'post', 'posts_per_page' => -1, ); $myposts = get_posts($args); foreach ($myposts as $post): setup_postdata($post); ?>
              <?php echo get_template_part('template-parts/top-contents'); ?>
            <?php endforeach; wp_reset_postdata(); ?>
          </div>
          <div class="more-link --top-sec">
              <a href="<?php echo home_url('category/random-blog/'); ?>">雑記ブログ一覧<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg" /></a>
          </div>
      </section>
    </div>

    <section class="contact top-section" id="contact">
        <h4>お問い合わせ</h4>
        <?php echo do_shortcode('[contact-form-7 id="3467" title="お問い合わせ"]'); ?>
    </section>
</main>

<?php get_footer();?>