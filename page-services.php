<?php
/** Template Name: サービス・ご依頼 */
get_header(); ?>
<main id="main-content" class="services-page">
<?php while (have_posts()) : the_post(); ?>
  <header class="services-page__header"><p class="magazine-eyebrow">WORK WITH ME</p><h1><?php the_title(); ?></h1><p>Webの実装と、日々の手作業を減らす仕組みづくり。</p></header>
  <div class="services-page__content"><?php the_content(); ?></div>
  <nav class="work-entry__links" aria-label="仕事についてもっと知る">
    <?php $case_index = kihiro_case_study_index(); if ($case_index) : ?><a href="<?php echo esc_url(get_permalink($case_index)); ?>">開発事例を見る</a><?php endif; ?>
    <?php $tech_category = get_term_by('name', '技術・開発', 'category'); if ($tech_category) : ?><a href="<?php echo esc_url(add_query_arg(array('view' => 'archive-all', 'article_category' => $tech_category->term_id), home_url('/'))); ?>">技術記事を読む</a><?php endif; ?>
    <a href="<?php echo esc_url(home_url('/contact-us/')); ?>">仕事について相談する</a>
  </nav>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
