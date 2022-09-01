<?php get_header(); ?>

<main class="container">
  <div class="mv">
    <div class="mv-text-wrap">
      <div class="mv-text">これまでの仕事</div>
    </div>
    <img class="pc-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-pc.png?20220823-1" alt="PCのメインビジュアル">
    <img class="sp-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-sp.png?20220823-1" alt="スマホのメインビジュアル">
    <div class="scrolldown1"><span>Scroll</span></div>
  </div>
  <section class="top-section" id="what-i-did">
    <h4>これまでの仕事</h4>
    <p>これまでにクラウドソーシングや、エージェント、地元のWEB制作会社経由で様々なお仕事を経験しました。どんな仕事をしてきたのかを、掲載可能な範囲で投稿していきます。</p>
    <div class="top-contents__wrap">
      <?php $args = array('category_name' => 'what-i-did', 'post_type' => 'post', 'posts_per_page' => -1,);
      $myposts = get_posts($args);
      foreach ($myposts as $post) : setup_postdata($post); ?>
        <?php echo get_template_part('template-parts/top-contents'); ?>
      <?php endforeach;
      wp_reset_postdata(); ?>
    </div>
    <div class="more-link --top-sec">
      <a href="<?php echo home_url('category/what-i-did'); ?>">これまでの仕事一覧<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg" /></a>
    </div>
  </section>
</main>

<?php get_footer(); ?>