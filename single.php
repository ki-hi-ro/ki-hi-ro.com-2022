<?php get_header(); ?>
<?php  $category = get_the_category(); $cat = $category[0]; ?>
<main class="l-container <?php echo $cat->slug; ?>">
    <div class="l-pc-left">
        <article class="post">
            <?php get_template_part('template-parts/bread'); ?>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
              <?php get_template_part('template-parts/post/meta'); ?>
              <h1 class="post__ttl"><?php the_title(); ?></h1>
              <?php 
              if(have_rows('what-you-know')): 
                get_template_part('template-parts/what-you-know'); 
              endif; 
              ?>
              <div class="post__content">
                <?php
                if(!in_category('drink-comparison')) : 
                  the_content(); 
                else :
                  get_template_part('template-parts/drink-comparision'); 
                endif; 
                ?>
              </div>
            <?php endwhile; endif; ?>
        </article>
    </div>
    <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>