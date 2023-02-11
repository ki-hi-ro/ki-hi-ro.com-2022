<?php get_header(); ?>
<?php
$term = get_queried_object();
$term_slug = $term->slug;
$term_name = $term->name;
$term_desc = $term->description;
?>
<?php
$tag_mv = get_template_directory_uri() . "/assets/img/tag/tag-mv-" . $term_slug . ".png";
error_reporting(0);
if(exif_imagetype($tag_mv)) :
?>
<div class="tag-mv l-container">
  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/tag/tag-mv-<?php echo $term_slug; ?>.png" alt="<?php echo $term_name; ?>の一覧ページのメイン画像">
  <h1><?php echo $term_name; ?></h1>
  <div class="overlay"></div>
</div>
<?php endif; ?>
<main class="l-container">
  <div class="l-pc-left">
    <!-- <section class="front-sec">
        <h2 class="front-sec__ttl"><?php echo $term_name; ?>についての記事</h2>
    </section> -->
    <?php
    $tag_query = new WP_Query(
      array(
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'tag' => $term_slug
      )
    );
    ?>
      <?php if ( $tag_query->have_posts() ) : ?>
        <?php while ( $tag_query->have_posts() ) : ?>
          <?php $tag_query->the_post(); ?>
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
  </div>
  <?php get_sidebar();?>
</main>
<?php get_footer(); ?>