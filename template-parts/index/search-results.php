<h1 class="front-sec__ttl front-sec__ttl--list-heading">
  「<?php echo esc_html(get_search_query()); ?>」が本文中に含まれている記事
</h1>

<div class="front-sec__text front-sec__flex article-list">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <div class="all-article__link front-sec__flex-item">
        <?php get_template_part('template-parts/blog-list'); ?>
      </div>
    <?php endwhile; ?>
  <?php else : ?>
    <p>該当する記事はありませんでした。</p>
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
