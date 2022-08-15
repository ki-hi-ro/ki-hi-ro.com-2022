<?php get_header();?>

<main class="container">
  <?php
  $term = get_queried_object();
  $term_slug = $term->slug;
  $term_name = $term->name;
  $term_desc = $term->description;
  ?>

	<section class="top-section sidebar__blog sidebar__contents">
		<h4><?php echo $term_name; ?>の記事一覧</h4>
		<p><?php echo $term_desc; ?></p>
  <?php
  $current_tag = single_tag_title('', false);
  $args = array(
    'posts_per_page' => -1,
    'tag' => $current_tag
  );
  $the_query = new WP_Query($args);
  if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
		<?php echo get_template_part('template-parts/sidebar-blog'); ?>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
    <?php else: ?>
	<h2>記事がありません</h2>
  <?php endif; ?>

	</section>

</main>

<?php get_footer();?>