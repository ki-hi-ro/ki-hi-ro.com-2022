<?php

// css
wp_enqueue_style('style', get_template_directory_uri() . '/style.css', [], date("YmdHi"));


// js
wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/6cff6feef5.js', null, null, true);
wp_enqueue_script('jquery', null , null, null, true);
wp_enqueue_script('cdn-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js' , null, null, true);
wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.js' , null, null, true);
wp_enqueue_script('hamburger', get_template_directory_uri() . '/assets/js/hamburger.js' , null, null, true);

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

function new_excerpt_more($more) {
        return ' ... ';
}
add_filter('excerpt_more', 'new_excerpt_more');