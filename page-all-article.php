<?php get_header();?>

<?php // echo get_template_part('template-parts/loading'); ?>

<main class="front-container">
  <section class="front-sec">
    <h2 class="front-sec__ttl">これまでに書いた記事</h2>
    <div class="front-sec__text">
      <p>これまでにプログラミングや旅行についてなど、数多くの記事を書いてきました。</p>
    </div>
    <div class="front-sec__text front-sec__flex">
      <?php
        $all_query = new WP_Query(
          array(
            'post_type'      => 'post',
            'posts_per_page' => -1,
          )
        );
        ?>
      <?php if ( $all_query->have_posts() ) : $i = 0; ?>
      <?php while ( $all_query->have_posts() ) : ?>
      <?php $all_query->the_post(); ?>
      <a class="all-article__link front-sec__flex-item --page <?php if($i % 3 == 1): ?>--center<?php endif; ?>" href="<?php the_permalink(); ?>">
        <div class="all-article__post-wrap">
          <div class="all-article__date"><?php echo get_the_date('Y.m.d'); ?></div>
          <div class="all-article__ttl"><?php the_title(); ?></div>
          <?php
          if (has_post_thumbnail()) :
            the_post_thumbnail('',array( 'class' => 'front-sec__flex-item-thumb' ));
          ?>
          <?php else : ?>
          <img class="front-sec__flex-item-thumb" src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/no-image.png" alt="no-image">
          <?php endif; ?>
          <div class="all-article__desc"><?php the_excerpt(); ?></div>
        </div>
      </a>
      <?php $i++; endwhile; ?>
      <?php endif; ?>
      <?php wp_reset_postdata(); ?>
    </div>
  </section>
</main>

<?php get_footer();?>