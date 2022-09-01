<?php get_header();?>

<main class="container">
  <div class="mv">
      <div class="mv-text-wrap">
        <div class="mv-text">お問い合わせ</div>
      </div>
      <img class="pc-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-pc.png?20220823-1"
          alt="PCのメインビジュアル">
      <img class="sp-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-sp.png?20220823-1"
          alt="スマホのメインビジュアル">
      <div class="scrolldown1"><span>Scroll</span></div>
  </div>
  <section class="contact top-section" id="contact">
    <h4>お問い合わせフォーム</h4>
    <?php echo do_shortcode('[contact-form-7 id="3467" title="お問い合わせ"]'); ?>
  </section>
</main>

<?php get_footer();?>