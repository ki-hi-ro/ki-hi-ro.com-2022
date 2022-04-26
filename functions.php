<?php

// css
wp_enqueue_style('style', get_template_directory_uri() . '/style.css', [], date("YmdHi"));


// js
wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/6cff6feef5.js', null, null, true);
wp_enqueue_script('jquery', null , null, null, true);
wp_enqueue_script('cdn-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js' , null, null, true);
wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.js' , null, null, true);
wp_enqueue_script('g-nav', get_template_directory_uri() . '/assets/js/g-nav.js' , null, null, true);
?>

<?php
function my_particle()  {
  if ( is_home() || is_front_page() ) {
    wp_enqueue_script('cdn-particle', 'https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js' , null, null, true);
    wp_enqueue_script('particle', get_template_directory_uri() . '/assets/js/particle.js' , null, null, true);
  }
}
add_action( 'wp_enqueue_scripts', 'my_particle' );
?>

<?php
// body_class()にページスラッグを追加
add_filter( 'body_class', 'add_page_slug_class_name' );
function add_page_slug_class_name( $classes ) {
  if ( is_page() ) {
    $page = get_post( get_the_ID() );
    $classes[] = $page->post_name;
  }
  return $classes;
}

add_theme_support('post-thumbnails');