<?php
/** Template Name: 自己紹介 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('kihiro-about', get_theme_file_uri('/assets/css/about.css'), array('kihiro-magazine'), kihiro_asset_version('/assets/css/about.css'));
}, 20);
get_header(); ?>
<main id="main-content" class="about-page">
  <?php while (have_posts()) : the_post(); ?>
    <article>
      <header class="about-hero">
        <div class="about-hero__text">
          <h1 class="screen-reader-text"><?php the_title(); ?></h1>
          <div class="about-identity">
            <img class="about-avatar" src="<?php echo esc_url(get_theme_file_uri('/assets/images/about-avatar.jpg')); ?>" alt="柴田浩貴" width="88" height="88" decoding="async">
            <p class="about-name">柴田 浩貴<span>Hiroki Shibata</span></p>
          </div>
          <p class="about-lead">自分の言葉で考え、<br>自分の足で、人生を進める。</p>
          <p>つくること、書くこと、知らない場所を歩くこと。<br>その積み重ねの中に、自分らしい働き方と生き方を探しています。</p>
        </div>
      </header>
      <div class="about-body"><?php the_content(); ?></div>
    </article>
  <?php endwhile; ?>
</main>
<?php get_footer(); ?>
