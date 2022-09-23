<?php get_header('top'); ?>

<?php echo get_template_part('template-parts/mv'); ?>

<main class="l-container">
  <?php echo get_template_part('template-parts/author'); ?>

  <!-- これまでの仕事・技術ブログ・学習ブログ・雑記ブログ -->
  <?php
  $cat_id_array = [98, 60, 69, 67];
  foreach ($cat_id_array as $cat_id) :
    $categories = get_categories(array(
      'include' => $cat_id
    ));
    foreach ($categories as $category) {
      $cat_name = $category->name;
      $cat_slug = $category->slug;
      $cat_desc = $category->description;
      $cat_link = get_category_link($category->term_id);
    }
  ?>
    <div id="<?php echo $cat_slug; ?>" class="top-<?php echo $cat_slug; ?>">
      <h2 class="top-<?php echo $cat_slug; ?>__ttl"><?php echo $cat_name; ?></h2>
      <p class="top-<?php echo $cat_slug; ?>__desc"><?php echo  $cat_desc; ?></p>
      <hr class="top-<?php echo $cat_slug; ?>__hr">
      <?php
      $posttags = my_tags_in_cat($cat_id);
      if ($posttags) {
        echo '<ul class="top-' . $cat_slug . '__tag-ul">';
        foreach ($posttags as $tag) {
          if ($tag->count >= 1) {
            echo '<li class="top-' . $cat_slug . '__tag-li" tagslug="' . $tag->slug . '">#' . $tag->name . '</li>';
          }
        }
        echo '</ul>';
      }
      ?>
      <div class="blog-list-scroll">
        <?php
        $args = array('category_name' => $cat_slug, 'post_type' => 'post', 'posts_per_page' => -1);
        $myposts = get_posts($args);
        foreach ($myposts as $post) : setup_postdata($post);
        ?>
          <?php
          $posttags = get_the_tags();
          if ($posttags) :
          ?>
            <?php echo get_template_part('template-parts/blog-list-scroll'); ?>
          <?php
          endif;
          ?>
        <?php
        endforeach;
        wp_reset_postdata();
        ?>
      </div>
      <div class="more-link --top-sec">
        <a href="<?php echo $cat_link; ?>"><?php echo $cat_name; ?>一覧<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg" /></a>
      </div>
    </div>
  <?php endforeach; ?>

  <section class="contact top-section top-contact" id="contact">
    <h4>お問い合わせ</h4>
    <?php echo do_shortcode('[contact-form-7 id="3467" title="お問い合わせ"]'); ?>
  </section>
</main>

<?php get_footer('top'); ?>