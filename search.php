<?php get_header();?>

<?php echo get_template_part('template-parts/loading'); ?>

<main class="l-container test">
  <div class="l-pc-left">
      <div class="new-article">
        <h1 class="post-list-ttl"><?php echo get_search_query(); ?>の検索結果</h1>
        <ul class="blog-list-grid">
          <?php if (have_posts()): ?>
            <?php while(have_posts()) : the_post();?>
          <?php echo get_template_part('template-parts/blog-list-grid'); ?>
          <?php endwhile; ?>
          <?php else: ?>
           <p>該当する記事はありませんでした。</p>
          <?php endif ; ?>
        </ul>
      </div>
  </div>
  <?php get_sidebar();?>
</main>

<?php get_footer();?>