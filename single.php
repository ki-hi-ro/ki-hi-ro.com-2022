<?php get_header(); ?>
<?php $category = get_the_category();
$cat = $category[0]; ?>
<main class="l-container <?php echo $cat->slug; ?>">
  <div class="l-pc-left">
    <article class="single-article">
      <div class="single-article__bread breadcrumbs">
        <?php if (function_exists('bcn_display')) {
          bcn_display();
        } ?>
      </div>
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <div class="single-article__post author calendar single-wrap">
            <div class="single-article__post-meta post-meta">
              <span class="post-date">投稿日: <?php echo get_the_date('Y.m.d'); ?></span>
              <span class="modify-date">更新日: <?php echo get_the_modified_date('Y.m.d'); ?></span>
            </div>
            <h1><?php the_title(); ?></h1>
            <div class="author__contents">
              <?php the_content(); ?>
            </div>
          </div>
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
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
          );
          $my_query->query($args);
          if ($my_query->have_posts()) :
          ?>
            <div class="related-post">
              <h4 class="related-post__ttl">
                その他の「<?php $tags = get_the_tags(); if ($tags) { foreach ($tags as $tag) { echo $tag->name; }} ?>」に関する記事はこちら
              </h4>
              <ul class="blog-list-grid">
                <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                  <?php echo get_template_part('template-parts/blog-list-grid'); ?>
                <?php endwhile; ?>
              </ul>
            </div>
          <?php
          endif;
          wp_reset_postdata();
          ?>
    </article>
  </div>
  <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>