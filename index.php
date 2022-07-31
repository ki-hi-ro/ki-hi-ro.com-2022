<?php get_header();?>

<main class="container">
  <?php
  $term = get_queried_object();
  $term_slug = $term->slug;
  $term_name = $term->name;
  $term_desc = $term->description;
  ?>

	<section class="top-section sidebar__blog sidebar__contents">
		<h4><?php echo $term_name; ?></h4>
		<p><?php echo $term_desc; ?></p>

		<?php
					$args = array(
							'category_name' => $term_slug,
              'post_type' => 'post',
              'posts_per_page' => -1,
          );
          $myposts = get_posts($args); foreach ($myposts as $post): setup_postdata($post); ?>
		<?php echo get_template_part('template-parts/sidebar-blog'); ?>
		<?php
					endforeach;
					wp_reset_postdata();
					?>
	</section>

</main>

<?php get_footer();?>