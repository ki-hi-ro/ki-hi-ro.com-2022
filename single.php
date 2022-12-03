<?php get_header(); ?>
<?php  $category = get_the_category(); $cat = $category[0]; ?>
<main class="l-container <?php echo $cat->slug; ?>">
  <div class="l-pc-left">
    <article class="single-article">
      <?php get_template_part('template-parts/bread'); ?>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div class="single-article__post author calendar single-wrap">
            <?php get_template_part('template-parts/post-meta'); ?>
            <h1><?php the_title(); ?></h1>
            <?php 
            if(have_rows('what-you-know')): 
              get_template_part('template-parts/what-you-know'); 
            endif; 
            ?>
            <div class="author__contents">
              <?php
              if(!in_category('drink-comparison')) : 
                the_content(); 
              else :
                get_template_part('template-parts/drink-comparision'); 
              endif; 
              ?>
            </div>
          </div>
      <?php endwhile; endif; ?>
      <?php get_template_part('template-parts/related-post');  ?>
    </article>
  </div>
  <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>