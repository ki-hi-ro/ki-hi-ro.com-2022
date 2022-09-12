<?php get_header(); ?>

<div class="mv">
  <div class="mv-text-wrap">
    <div class="mv-text">これまでの仕事</div>
  </div>
  <img class="pc-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-pc.png?20220823-1" alt="PCのメインビジュアル">
  <img class="sp-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-sp.png?20220823-1" alt="スマホのメインビジュアル">
  <div class="scrolldown1"><span>Scroll</span></div>
</div>
<main class="container">
  <section class="top-section" id="what-i-did">
    <h4>これまでの仕事</h4>
    <p>これまでにクラウドソーシングや、エージェント、地元のWEB制作会社経由で様々なお仕事を経験しました。どんな仕事をしてきたのかを、掲載可能な範囲で投稿していきます。</p>

    <ul class="blog-list-grid">
      <?php $args = array('category_name' => 'what-i-did', 'post_type' => 'post', 'posts_per_page' => -1,);
      $myposts = get_posts($args);
      ?>
      <?php foreach ($myposts as $post) : setup_postdata($post); ?>
        <?php echo get_template_part('template-parts/blog-list-grid'); ?>
      <?php endforeach;
      wp_reset_postdata(); ?>
    </ul>
  </section>
</main>

<?php get_footer(); ?>