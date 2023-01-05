<?php get_header(); ?>
<?php  $category = get_the_category(); $cat = $category[0]; ?>
<main class="l-container <?php echo $cat->slug; ?>">
  <div class="l-pc-left --single">
    <article class="post">
      <?php get_template_part('template-parts/bread'); ?>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php get_template_part('template-parts/post/meta'); ?>
      <div class="blog-list-grid__tag-wrap">
        <?php
                $posttags = get_the_tags();
                if ($posttags) :
                  foreach ($posttags as $tag) :
        ?>
        <a class="blog-list-grid__tag" href="<?php echo home_url('tag/'.$tag->slug.''); ?>">
          <?php echo $tag->name; ?>
        </a>
        <?php
                  endforeach;
                endif;
                ?>
      </div>
      <h1 class="post__ttl"><?php the_title(); ?></h1>
      <?php the_post_thumbnail( array( 366, 244 ), ['class' => 'post__thumb']  );?>
      <?php if(!in_category('record')): ?>
        <h2 id="first-ttl">はじめに</h2>
      <?php endif; ?>
      <div class="post__content">
        <?php
          if(in_category('record')) :
            get_template_part('template-parts/record');
          else :
            the_content();
          endif;
        ?>
      </div>

      <?php
            $prevpost = get_adjacent_post(true, '', true, 'post_tag');
            $nextpost = get_adjacent_post(true, '', false, 'post_tag');
            if( $prevpost or $nextpost) :
            ?>
      <ul class="nav-links">
        <?php if( $prevpost ) : ?>
        <li class="nav-links__nav --pre">
          <a class="nav-links__link" href="<?php echo get_permalink($prevpost->ID); ?>">
            <img class="nav-links__link-icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg">
            <?php echo get_the_post_thumbnail($prevpost->ID, '', array( 'class' => 'nav-links__thumb' )); ?>
          </a>
        </li>
        <?php endif; ?>
        <?php if( $nextpost ) : ?>
        <li class="nav-links__nav --next">
          <a class="nav-links__link" href="<?php echo get_permalink($nextpost->ID); ?>">
            <?php echo get_the_post_thumbnail($nextpost->ID, '', array( 'class' => 'nav-links__thumb' )); ?>
            <img class="nav-links__link-icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg">
          </a>
        </li>
        <?php endif; ?>
      </ul>
      <?php endif; ?>
      <?php endwhile; endif; ?>

    </article>
  </div>
  <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>