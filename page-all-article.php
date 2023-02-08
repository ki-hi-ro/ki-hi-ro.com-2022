<?php get_header();?>

<?php // echo get_template_part('template-parts/loading'); ?>

<main class="front-container">
    <section class="front-sec">
        <h2 class="front-sec__ttl">これまでに書いた記事</h2>
        <div class="front-sec__text">
            <p>これまでにプログラミングや旅行についてなど、数多くの記事を書いてきました。</p>
        </div>
    </section>
    <?php
    $all_query = new WP_Query(
      array(
        'post_type'      => 'post',
        'posts_per_page' => -1,
      )
    );
    ?>
    <?php if ( $all_query->have_posts() ) : ?>
    <?php while ( $all_query->have_posts() ) : ?>
    <?php $all_query->the_post(); ?>
    <a class="all-article__link" href="<?php the_permalink(); ?>">    
      <div class="all-article__post-wrap">
        <div class="all-article__date"><?php echo get_the_date('Y.m.d'); ?></div>
        <div class="all-article__ttl"><?php the_title(); ?></div>
        <div class="all-article__desc"><?php the_excerpt(); ?></div>
      </div>
    </a>
    <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</main>

<?php get_footer();?>