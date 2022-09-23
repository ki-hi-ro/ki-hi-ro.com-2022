<?php get_header(); ?>

<?php
$term = get_queried_object();
$term_slug = $term->slug;
$term_name = $term->name;
$term_desc = $term->description;
?>

<?php echo get_template_part('template-parts/mv'); ?>

<main class="container">

  <section class="top-section sidebar__blog sidebar__contents">
    <h4><?php echo $term_name; ?>の記事一覧</h4>
    <p><?php echo $term_desc; ?></p>
    <ul class="blog-list-grid">
      <?php
      $args = array(
        'posts_per_page' => -1,
        'tag' => $term_slug
      );
      $the_query = new WP_Query($args);
      if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
          <?php echo get_template_part('template-parts/blog-list-grid'); ?>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <h2>記事がありません</h2>
      <?php endif; ?>
    </ul>

  </section>

</main>

<?php get_footer(); ?>