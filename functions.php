<?php

// css
wp_enqueue_style('style', get_template_directory_uri() . '/style.css', [], date("YmdHi"));
wp_enqueue_style('kihiro-common', get_template_directory_uri() . '/assets/css/kihiro-common.css', [], date("YmdHi"));
wp_enqueue_style('header', get_template_directory_uri() . '/assets/css/header.css', [], date("YmdHi"));
wp_enqueue_style('blog-list-grid', get_template_directory_uri() . '/assets/css/blog-list-grid.css', [], date("YmdHi"));
wp_enqueue_style('blog-list-scroll', get_template_directory_uri() . '/assets/css/blog-list-scroll.css', [], date("YmdHi"));
wp_enqueue_style('single', get_template_directory_uri() . '/assets/css/single.css', [], date("YmdHi"));
wp_enqueue_style('top-skill-blog', get_template_directory_uri() . '/assets/css/top-skill-blog.css', [], date("YmdHi"));
wp_enqueue_style('top-study-blog', get_template_directory_uri() . '/assets/css/top-study-blog.css', [], date("YmdHi"));
wp_enqueue_style('top-random-blog', get_template_directory_uri() . '/assets/css/top-random-blog.css', [], date("YmdHi"));
wp_enqueue_style('top-what-i-did', get_template_directory_uri() . '/assets/css/top-what-i-did.css', [], date("YmdHi"));
wp_enqueue_style('layout', get_template_directory_uri() . '/assets/css/layout.css', [], date("YmdHi"));
wp_enqueue_style('blog-archive', get_template_directory_uri() . '/assets/css/blog-archive.css', [], date("YmdHi"));
wp_enqueue_style('front-page', get_template_directory_uri() . '/assets/css/front-page.css', [], date("YmdHi"));
wp_enqueue_style('mv', get_template_directory_uri() . '/assets/css/mv.css', [], date("YmdHi"));
wp_enqueue_style('top-contact', get_template_directory_uri() . '/assets/css/top-contact.css', [], date("YmdHi"));
wp_enqueue_style('news-ticker', 'https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.css', [], date("YmdHi"));
wp_enqueue_style('top-news', get_template_directory_uri() . '/assets/css/top-news.css', [], date("YmdHi"));
wp_enqueue_style('index-template', get_template_directory_uri() . '/assets/css/index-template.css', [], date("YmdHi"));
wp_enqueue_style('author', get_template_directory_uri() . '/assets/css/author.css', [], date("YmdHi"));
wp_enqueue_style('page-top', get_template_directory_uri() . '/assets/css/page-top.css', [], date("YmdHi"));
wp_enqueue_style('single-post', get_template_directory_uri() . '/assets/css/single-post.css', [], date("YmdHi"));
wp_enqueue_style('sidebar-archive', get_template_directory_uri() . '/assets/css/sidebar-archive.css', [], date("YmdHi"));
wp_enqueue_style('twitter', get_template_directory_uri() . '/assets/css/twitter.css', [], date("YmdHi"));
wp_enqueue_style('html-tag', get_template_directory_uri() . '/assets/css/html-tag.css', [], date("YmdHi"));
wp_enqueue_style('single-article', get_template_directory_uri() . '/assets/css/single-article.css', [], date("YmdHi"));
wp_enqueue_style('wp-pagenavi', get_template_directory_uri() . '/assets/css/wp-pagenavi.css', [], date("YmdHi"));

// js
wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/6cff6feef5.js', null, null, true);
wp_enqueue_script('jquery', null, null, null, true);
wp_enqueue_script('cdn-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', null, null, true);
wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.js', null, null, true);
wp_enqueue_script('hamburger', get_template_directory_uri() . '/assets/js/hamburger.js', null, date("YmdHi"), true);
wp_enqueue_script('tag', get_template_directory_uri() . '/assets/js/tag.js', null, date("YmdHi"), true);
wp_enqueue_script('view-port', get_template_directory_uri() . '/assets/js/view-port.js', null, date("YmdHi"), true);
wp_enqueue_script('smoothscroll', get_template_directory_uri() . '/assets/js/smoothscroll.js', null, date("YmdHi"), true);
wp_enqueue_script('page-link', get_template_directory_uri() . '/assets/js/page-link.js', null, date("YmdHi"), true);
wp_enqueue_script('bxSlider', 'https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.js', null, null, true);
wp_enqueue_script('top-news', get_template_directory_uri() . '/assets/js/top-news.js', null, date("YmdHi"), true);
wp_enqueue_script('page-top', get_template_directory_uri() . '/assets/js/page-top.js', null, date("YmdHi"), true);

// body_class()にページスラッグを追加
add_filter('body_class', 'add_page_slug_class_name');
function add_page_slug_class_name($classes)
{
  if (is_page()) {
    $page = get_post(get_the_ID());
    $classes[] = $page->post_name;
  }
  return $classes;
}

add_theme_support('post-thumbnails');

function new_excerpt_more($more)
{
  return ' ... ';
}
add_filter('excerpt_more', 'new_excerpt_more');

function my_tags_in_cat($cat_id)
{
  // 現在のカテゴリーに属する投稿のIDを配列で取得
  $post_ids = get_objects_in_term($cat_id, 'category');

  // 現在のカテゴリーに属する投稿で利用しているタグのオブジェクトを取得
  $tags_object = wp_get_object_terms($post_ids, 'post_tag');

  return $tags_object;
}

register_sidebar(array(
  'before_widget' => '<div id=”%1$s” class=widjet %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
));
