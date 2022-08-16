<?php

// css
wp_enqueue_style('style', get_template_directory_uri() . '/style.css', [], date("YmdHi"));


// js
wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/6cff6feef5.js', null, null, true);
wp_enqueue_script('jquery', null , null, null, true);
wp_enqueue_script('cdn-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js' , null, null, true);
wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.js' , null, null, true);
wp_enqueue_script('hamburger', get_template_directory_uri() . '/assets/js/hamburger.js' , null, null, true);
wp_enqueue_script('tab', get_template_directory_uri() . '/assets/js/tab.js' , null, null, true);

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

function my_tags_in_cat( $cat_id ){
	// 現在のカテゴリーに属する投稿のIDを配列で取得
	$post_ids = get_objects_in_term( $cat_id, 'category' );

	// 現在のカテゴリーに属する投稿で利用しているタグのオブジェクトを取得
	$tags_object = wp_get_object_terms( $post_ids, 'post_tag' );

	return $tags_object;
}

register_sidebar(array(
  'before_widget' => '<div id=”%1$s” class=”widget %2$s”>',
  'after_widget' => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
));
