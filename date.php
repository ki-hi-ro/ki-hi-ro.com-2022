<?php get_header(); ?>
<main class="l-container">
  <div class="l-pc-left">
    <h1 class="post-list-ttl"><?php echo get_the_date('Y年n月'); ?>の記事一覧</h1>
    <div class="new-article">
    <?php
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;
      if(have_posts()): ?>
        <div class="new-article">
          <ul class="blog-list-grid">
            <?php while(have_posts()): the_post(); ?>            
              <?php echo get_template_part('template-parts/blog-list-grid'); ?>
            <?php endwhile; ?>      
          </ul>
        </div>
      <?php endif; ?>
      <?php wp_pagenavi(); ?>
    </div>
  </div>
  <?php get_sidebar();?>
</main>
<?php get_footer(); ?>