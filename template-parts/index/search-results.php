<header class="journal-panel__header">
  <h1 class="journal-date-title">検索</h1>
  <p class="journal-panel__lead">「<?php echo esc_html(get_search_query()); ?>」が本文中に含まれている記事</p>
</header>

<div class="journal-list">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('template-parts/blog-list'); ?>
    <?php endwhile; ?>
  <?php else : ?>
    <p class="journal-empty">該当する記事はありませんでした。</p>
  <?php endif; ?>
</div>

<?php
the_posts_pagination(
    array(
        'mid_size'  => 1,
        'prev_text' => '前へ',
        'next_text' => '次へ',
    )
);
