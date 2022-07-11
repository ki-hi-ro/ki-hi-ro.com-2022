<?php get_header();?>

<section
  class="author sidebar__contents top-card"
  itemprop="author"
  itemscope
  itemtype="http://schema.org/Person"
>
  <img
    src="<?php echo get_template_directory_uri(); ?>/assets/img/introduce/2022-04.png"
    class="img-responsive img-circle author__img"
  />
  <h4>
    <span itemprop="name">Shibata Hiroki</span>
  </h4>
  <hr />
  <div class="author__contents">
    <p class="author-text">
      2019年末にプログラミングスクールTECH::EXPERTを受講して以来、フリーランスとして、HTML
      / CSS,WordPress,
      EC-CUBEなどを使用して、Webサイトの新規開発や改修を行なってきました。
    </p>
  </div>
</section>

<section class="top-section what-i-can">
  <h4>対応可能な項目</h4>
  <p>WordPress, EC-CUBE, LPサイトなどWebサイト全般のコーディングが対応可能です。
対応可能な言語は、HTML / CSS, Sass, PHP, Twigなどです。
<a href="#contact">こちら</a>よりご相談内容をお送りいただければ、金額と納期をお知らせします。
金額と納期をお知らせする以前に、対応が難しい場合はその旨もご連絡します。
対応可能項目を増やすために学習ブログを更新しています。</p>
</section>

<section class="top-section what-i-did">
  <h4>これまでの対応内容</h4>
  <p>これまでにクラウドソーシングや、エージェント、地元のWEB制作会社経由で様々なお仕事を
経験しました。どんな仕事をしてきたのかを掲載できる範囲で投稿していきます。</p>
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
      <a href="<?php echo home_url('blog/#what-i-did'); ?>"
        >これまでの対応内容をもっと見る<img
          src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"
      /></a>
    </div>

</section>

<section class="top-section sidebar__blog sidebar__contents">
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
      <a href="<?php echo home_url('blog/#skill-blog'); ?>"
        >技術ブログをもっと見る<img
          src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"
      /></a>
    </div>
</section>

<section class="top-section sidebar__blog sidebar__contents ">
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
      <a href="<?php echo home_url('blog/#study-blog'); ?>"
        >学習ブログをもっと見る<img
          src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"
      /></a>
    </div>
</section>

<section class="top-section sidebar__blog sidebar__contents ">
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
      <a href="<?php echo home_url('blog/#random-blog'); ?>"
        >雑記ブログをもっと見る<img
          src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg"
      /></a>
    </div>
</section>

<section class="contact top-section" id="contact">
  <h4>お問い合わせ</h4>
  <?php echo do_shortcode('[contact-form-7 id="3467" title="お問い合わせ"]'); ?>
</section>

<?php get_footer();?>
