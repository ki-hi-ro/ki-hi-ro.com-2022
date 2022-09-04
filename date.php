<?php get_header(); ?>

<main class="container">
  <div class="mv">
    <div class="mv-text-wrap">
      <div class="mv-text"><?php echo get_the_date('Y年n月'); ?></div>
    </div>
    <img class="pc-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-pc.png?20220823-1" alt="PCのメインビジュアル">
    <img class="sp-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/mv-sp.png?20220823-1" alt="スマホのメインビジュアル">
    <div class="scrolldown1"><span>Scroll</span></div>
  </div>

  <h1><?php echo get_the_date('Y年n月'); ?>の記事一覧</h1>
  <section class="top-section sidebar__blog sidebar__contents">
    <?php
    $current_url =  get_pagenum_link(get_query_var('paged'));
    $uri = rtrim($current_url, '/');
    $uri = substr($uri, strrpos($uri, '/') + 1);
    $uri = abs($uri);
    $args = array(
      'tag__not_in'   => array(116),
      'monthnum' => $uri,
    );
    $query = new WP_Query($args);
    ?>
    <?php if (have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
        <?php echo get_template_part('template-parts/sidebar-blog'); ?>
    <?php endwhile;
    endif;
    wp_reset_postdata(); ?>
  </section>

</main>

<?php get_footer(); ?>