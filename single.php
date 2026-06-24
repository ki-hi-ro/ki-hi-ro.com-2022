<?php get_header(); ?>
<main class="outer-container front-container">
  <div class="l-pc-left --single">
    <article class="post">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php get_template_part('template-parts/single-bread', null, array('location' => 'top')); ?>
      
      <div class="all-article__date"><?php echo get_the_date('Y.m.d'); ?>（更新日: <?php echo get_the_modified_date('Y.m.d'); ?>）</div>

      <h1 class="post__ttl"><?php the_title(); ?></h1>

      <a class="article-toc-page-link" href="#article-toc-inline">
        目次を見る <span aria-hidden="true">↑</span>
      </a>

      <?php the_post_thumbnail( array( 366, 244 ), ['class' => 'post__thumb'] );?>

      <aside id="article-toc-inline" class="article-toc article-toc--inline" aria-labelledby="article-toc-inline-title">
        <p id="article-toc-inline-title" class="article-toc__title">目次</p>
        <ol class="article-toc__list" data-article-toc-list></ol>
      </aside>

      <h2 id="first-ttl">はじめに</h2>

      <div class="post__content">
        <?php the_content(); ?>
      </div>

      <?php comments_template(); ?>
      
      <?php
      $prevpost = get_adjacent_post(false, '', true);
      $nextpost = get_adjacent_post(false, '', false);
      if( $prevpost or $nextpost) :
      ?>
      <ul class="nav-links">
        
        <?php if( $prevpost ) : ?>
        <li class="nav-links__nav --pre">
          <a class="nav-links__link" href="<?php echo esc_url(get_permalink($prevpost->ID)); ?>">
            ← <?php echo esc_html(get_the_title($prevpost->ID)); ?>
          </a>
        </li>
        <?php endif; ?>

        <?php if( $nextpost ) : ?>
        <li class="nav-links__nav --next">
          <a class="nav-links__link" href="<?php echo esc_url(get_permalink($nextpost->ID)); ?>">
            <?php echo esc_html(get_the_title($nextpost->ID)); ?> →
          </a>
        </li>
        <?php endif; ?>
      </ul>

      <?php 
      get_template_part('template-parts/single-bread', null, array('location' => 'bottom'));

      endif; endwhile; endif; ?>
    </article>
  </div>
  <?php get_sidebar(); ?>

  <p class="page-top --single-pc">
    <a class="page-top__link --single-pc" href="#" data-mode="top" aria-label="ページの一番上へ移動">↑</a>
  </p>
</main>
<?php get_footer(); ?>
