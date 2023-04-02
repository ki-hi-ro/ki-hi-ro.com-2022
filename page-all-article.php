<?php get_header();?>

<main class="front-container">
  <section class="front-sec">
    <h2 class="front-sec__ttl">これまでに書いた記事</h2>
    <div class="front-sec__text">
      <p>これまでにプログラミングや旅行についてなど、数多くの記事を書いてきました。</p>
    </div>
    <div class="front-sec__text front-sec__flex">
      <?php echo get_template_part("template-parts/blog-list-thumb-desc"); ?>
    </div>
  </section>
</main>

<?php get_footer();?>