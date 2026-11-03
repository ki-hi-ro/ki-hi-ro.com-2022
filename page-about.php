<?php
/** Template Name: 自己紹介 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('kihiro-about', get_theme_file_uri('/assets/css/about.css'), array('kihiro-magazine'), kihiro_asset_version('/assets/css/about.css'));
}, 20);
get_header(); ?>
<main id="main-content" class="about-page">
  <?php while (have_posts()) : the_post(); ?>
    <article>
      <?php get_template_part('template-parts/page-heading', null, array('eyebrow' => 'ABOUT', 'title' => '自己紹介', 'description' => '柴田 浩貴 — 経験と、仕事への向き合い方。')); ?>
      <?php // 本文はWordPressのDBが正本。content/about.htmlは原稿の控えで自動同期しない。 ?>
      <div class="about-body">
        <?php the_content(); ?>
        <?php $career_page = get_page_by_path('career'); if ($career_page && 'publish' === $career_page->post_status) : ?>
          <section aria-labelledby="about-career-heading">
            <h2 id="about-career-heading">職務経歴</h2>
            <p>これまでの実務で担当した仕事と、課題への取り組みをまとめています。</p>
            <p><a href="<?php echo esc_url(get_permalink($career_page)); ?>">職務経歴を見る →</a></p>
          </section>
        <?php endif; ?>
      </div>
    </article>
  <?php endwhile; ?>
</main>
<?php get_footer(); ?>
