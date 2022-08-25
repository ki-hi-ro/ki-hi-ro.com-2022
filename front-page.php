<?php get_header();?>

<div class="mv">
    <div class="mv-text-wrap">
      <div class="mv-text">WEB制作のコーディングで<span class="sp-none">、</span><br class="only-sp">価値を提供する</div>
    </div>
    <img class="pc-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-pc.png?20220823-1"
        alt="PCのメインビジュアル">
    <img class="sp-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-sp.png?20220823-1"
        alt="スマホのメインビジュアル">
    <div class="scrolldown1"><span>Scroll</span></div>
</div>

<main class="container">
    <?php echo get_template_part('template-parts/author'); ?>

    <section class="top-section" id="what-i-can">
        <h4>対応可能な項目</h4>
        <p>
            WordPress, EC-CUBE, LPサイトなどWebサイト全般のコーディングが対応可能です。対応可能な言語は、HTML / CSS, Sass, PHP, Twigなどです。<a href="#contact">こちら</a>よりご相談内容をお送りいただければ、金額と納期をお知らせします。
            金額と納期をお知らせする以前に、対応が難しい場合はその旨もご連絡します。対応可能項目を増やすために<a href="<?php echo home_url('/category/study-blog/'); ?>">学習ブログ</a>を更新しています。
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

    <!-- 技術 -->
    <ul class="blog-tab">
      <li class="blog-tab__item--skill blog-tab__study" contentId="study-blog--skill">学習ブログ</li>
      <li class="blog-tab__item--skill blog-tab__skill current-tab" contentId="skill-blog--skill">技術ブログ</li>
      <li class="blog-tab__item--skill blog-tab__random" contentId="random-blog--skill">雑記ブログ</li>
    </ul>
    <div class="blog-tab-contents">
      <section class="blog-tab-content--skill top-section sidebar__blog sidebar__contents" id="skill-blog--skill">
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

      <section class="blog-tab-content--skill top-section sidebar__blog sidebar__contents notShowMe" id="study-blog--skill">
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

      <section class="blog-tab-content--skill top-section sidebar__blog sidebar__contents notShowMe" id="random-blog--skill">
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

    <!-- 学習 -->
    <ul class="blog-tab">
      <li class="blog-tab__item--study blog-tab__skill" contentId="skill-blog--study">技術ブログ</li>
      <li class="blog-tab__item--study blog-tab__study current-tab" contentId="study-blog--study">学習ブログ</li>
      <li class="blog-tab__item--study blog-tab__random" contentId="random-blog--study">雑記ブログ</li>
    </ul>
    <div class="blog-tab-contents">
      <section class="blog-tab-content--study top-section sidebar__blog sidebar__contents notShowMe" id="skill-blog--study">
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

      <section class="blog-tab-content--study top-section sidebar__blog sidebar__contents" id="study-blog--study">
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

      <section class="blog-tab-content--study top-section sidebar__blog sidebar__contents notShowMe" id="random-blog--study">
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

    <!-- 雑記 -->
    <ul class="blog-tab">
      <li class="blog-tab__item--random blog-tab__skill" contentId="skill-blog--random">技術ブログ</li>
      <li class="blog-tab__item--random blog-tab__random current-tab" contentId="random-blog--random">雑記ブログ</li>
      <li class="blog-tab__item--random blog-tab__study" contentId="study-blog--random">学習ブログ</li>
    </ul>
    <div class="blog-tab-contents">
      <section class="blog-tab-content--random top-section sidebar__blog sidebar__contents notShowMe" id="skill-blog--random">
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

      <section class="blog-tab-content--random top-section sidebar__blog sidebar__contents notShowMe" id="study-blog--random">
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

      <section class="blog-tab-content--random top-section sidebar__blog sidebar__contents" id="random-blog--random">
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