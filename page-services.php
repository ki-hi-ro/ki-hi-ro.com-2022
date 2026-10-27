<?php
/** Template Name: サービス・ご依頼 */
get_header(); ?>
<main id="main-content" class="services-page">
<?php while (have_posts()) : the_post(); ?>
  <header class="services-page__header"><p class="magazine-eyebrow">WORK WITH ME</p><h1><?php the_title(); ?></h1><p>いまの課題を整理し、必要な改善を一緒に形に。</p><div class="work-entry__links"><a href="<?php echo esc_url(home_url('/contact-us/')); ?>">仕事について相談する</a><a href="#service-scope">ご相談できることを見る</a></div></header>
  <div class="services-page__content"><?php the_content(); ?></div>
  <nav class="work-entry__links" aria-label="仕事についてもっと知る">
    <?php $case_index = kihiro_case_study_index(); if ($case_index) : ?><a href="<?php echo esc_url(get_permalink($case_index)); ?>">開発事例を見る</a><?php endif; ?>
    <?php $tech_page = get_page_by_path('articles'); if ($tech_page && 'publish' === $tech_page->post_status) : ?><a href="<?php echo esc_url(get_permalink($tech_page)); ?>">技術ブログを読む</a><?php endif; ?>
    <a href="<?php echo esc_url(home_url('/contact-us/')); ?>">仕事について相談する</a>
  </nav>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
