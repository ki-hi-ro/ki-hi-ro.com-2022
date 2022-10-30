<?php get_header(); ?>
<?php $category = get_the_category();
$cat = $category[0]; ?>
<main class="l-container">
  <div class="l-pc-left">
    <article>
      <div class="breadcrumbs">
        <?php if (function_exists('bcn_display')) {
          bcn_display();
        } ?>
      </div>
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <div class="single-post author calendar single-wrap">
            <div class="post-meta">
              <span class="post-date">投稿日: <?php echo get_the_date('Y.m.d'); ?></span>
              <span class="modify-date">更新日: <?php echo get_the_modified_date('Y.m.d'); ?></span>
            </div>
            <h1><?php the_title(); ?></h1>
            <div class="author__contents">
              <?php the_content(); ?>
            <?php endwhile; ?>
          <?php endif; ?>
          <?php
          $my_query = new WP_Query();
          global $post;
          $post_id = $post->ID;
          $taxonomy = 'post_tag';
          $term = get_the_terms($post_id, $taxonomy);
          $term_slug =  $term[0]->slug;

          $args = array(
            'post_type' => 'post',
            'tag'    => $term_slug,
            'post__not_in'   => array($post->ID),
            'posts_per_page' => 6,
            'orderby' => 'date',
            'order' => 'DESC',
          );
          $my_query->query($args);
          if ($my_query->have_posts()) :
          ?>
            <h4>
              <?php $tags = get_the_tags();
              if ($tags) {
                foreach ($tags as $tag) {
                  echo $tag->name;
                }
              } ?>の記事一覧
            </h4>
            <div class="related-post">
              <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <a class="related-post__link" href="<?php the_permalink(); ?>">
                  <div class="related-post__contents">
                    <span class="related-post__date">
                      <?php echo get_the_date('Y.m.d'); ?>
                    </span>
                    <span class="related-post__tag">
                      <?php
                      $posttags = get_the_tags();
                      foreach ($posttags as $tag) {
                        echo $tag->name . ' ';
                      }
                      ?>
                    </span>
                    <span class="related-post__ttl">
                      <?php the_title(); ?>
                    </span>
                  </div>
                </a>
              <?php endwhile; ?>
            </div>
          <?php
          endif;
          wp_reset_postdata();
          ?>
            </div>
          </div>
    </article>
  </div>
  <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>