<?php
$args = [
  'post_type' => 'news',
  'posts_per_page' => 3,
];
$my_query = new WP_Query($args);
if ($my_query->have_posts()) :
?>
  <section class="top-news">
    <ul class="slider">
      <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <span><?php echo get_the_date('Y.m.d'); ?></span><?php the_title(); ?>
          </a>
        </li>
      <?php endwhile; ?>
    </ul>
  </section>
<?php endif; wp_reset_postdata(); ?>