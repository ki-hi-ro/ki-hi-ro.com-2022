<?php

// css
wp_enqueue_style('style', get_template_directory_uri() . '/style.css', [], date("YmdHi"));
wp_enqueue_style('vegas', 'https://cdnjs.cloudflare.com/ajax/libs/vegas/2.4.4/vegas.min.css', [], date("YmdHi"));


// js
wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/6cff6feef5.js', null, null, true);
wp_enqueue_script('jquery', null, null, null, true);
wp_enqueue_script('cdn-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', null, null, true);
wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.js', null, date("YmdHi"), true);
wp_enqueue_script('hamburger', get_template_directory_uri() . '/assets/js/hamburger.js', null, date("YmdHi"), true);
wp_enqueue_script('tag', get_template_directory_uri() . '/assets/js/tag.js', null, date("YmdHi"), true);
wp_enqueue_script('view-port', get_template_directory_uri() . '/assets/js/view-port.js', null, date("YmdHi"), true);
wp_enqueue_script('smoothscroll', get_template_directory_uri() . '/assets/js/smoothscroll.js', null, date("YmdHi"), true);
wp_enqueue_script('bxSlider', 'https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.js', null, null, true);
wp_enqueue_script('vegas', 'https://cdnjs.cloudflare.com/ajax/libs/vegas/2.4.4/vegas.min.js', [], date("YmdHi"));
wp_enqueue_script('fade-in-zoom', get_template_directory_uri() . '/assets/js/fade-in-zoom.js', null, date("YmdHi"), true);
wp_enqueue_script('cdn-vue', 'https://unpkg.com/vue@3/dist/vue.global.js', null, null, true);
wp_enqueue_script('my-vue', get_template_directory_uri() . '/assets/js/my-vue.js', null, date("YmdHi"), true);
wp_enqueue_script('cdn-matchHeight', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js', null, null, true);
wp_enqueue_script('my-match-height', get_template_directory_uri() . '/assets/js/my-match-height.js', null, null, true);
wp_enqueue_script('loading', get_template_directory_uri() . '/assets/js/loading.js', null, null, true);
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

function my_meta_ogp() {
  if( is_front_page() || is_home() || is_singular() ){
    global $post;
    $ogp_title = '';
    $ogp_descr = '';
    $ogp_url = '';
    $ogp_img = '';
    $insert = '';

    if( is_front_page() || is_home() ) {
      $ogp_title = get_bloginfo('name');
      $ogp_descr = get_bloginfo('description');
      $ogp_url = home_url();
    } elseif ( is_singular() ) {
      setup_postdata($post);
      $ogp_title = $post->post_title;
      $ogp_descr = mb_substr(get_the_excerpt(), 0, 90);
      $ogp_url = get_permalink();
      wp_reset_postdata();
    }

    $ogp_type = ( is_front_page() || is_home() ) ? 'website' : 'article';

    if ( is_singular() && has_post_thumbnail() ) {
       $ps_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
       $ogp_img = $ps_thumb[0];
    } else {
     $ogp_img = 'https://ki-hi-ro.com/ki-hi-ro.com-2022/wp-content/themes/ki-hi-ro.com-2022/assets/img/blog/no-image.png';
    }

    //OGP
    $insert .= '<meta property="og:url" content="'.esc_url($ogp_url).'" />';
    $insert .= '<meta property="og:type" content="'.$ogp_type.'" />';
    $insert .= '<meta property="og:title" content="'.esc_attr($ogp_title).'" />';
    $insert .= '<meta property="og:description" content="'.esc_attr($ogp_descr).'" />';
    $insert .= '<meta property="og:image" content="'.esc_url($ogp_img).'" />';
    $insert .= '<meta property="og:site_name" content="'.esc_attr(get_bloginfo('name')).'" />';

    //Twitter
    $insert .= '<meta name="twitter:card" content="summary" />';
    $insert .= '<meta name="twitter:site" content="@2021_shibata" />';

    echo $insert;
  }
}
add_action('wp_head','my_meta_ogp');

   function custom_excerpt_pc($length = 170) {
      global $post;

      $suffix = '...';

      $content = mb_substr(strip_tags($post->post_excerpt),0,$length);

      if (!$content) {
        $content =  $post->post_content;
        $content =  strip_shortcodes($content);
        $content =  strip_tags($content);
        // $content =  str_replace(' ', '', $content);
        $content =  html_entity_decode($content, ENT_QUOTES, 'UTF-8');

        if (mb_strlen($content, 'UTF-8') > $length) {
          $content =  mb_substr($content, 0, $length, 'UTF-8');
          $content .= $suffix;
        }
      }

      return $content;
    }

    function custom_excerpt_sp($length = 100) {
      global $post;

      $suffix = '...';

      $content = mb_substr(strip_tags($post->post_excerpt),0,$length);

      if (!$content) {
        $content =  $post->post_content;
        $content =  strip_shortcodes($content);
        $content =  strip_tags($content);
        // $content =  str_replace(' ', '', $content);
        $content =  html_entity_decode($content, ENT_QUOTES, 'UTF-8');

        if (mb_strlen($content, 'UTF-8') > $length) {
          $content =  mb_substr($content, 0, $length, 'UTF-8');
          $content .= $suffix;
        }
      }

      return $content;
    }

    function customize_admin_bar($wp_admin_bar) {
      if (!is_user_logged_in()) return;
  
      global $post;
  
      // -------------------------
      // タグページ：タグを編集だけ表示
      // -------------------------
      if (is_tag()) {
          $wp_admin_bar->remove_menu('wp-logo');
          $all_nodes = $wp_admin_bar->get_nodes();
          if ($all_nodes && (is_array($all_nodes) || is_object($all_nodes))) {
              foreach ($all_nodes as $node) {
                  $wp_admin_bar->remove_node($node->id);
              }
          }
  
          $term = get_queried_object();
          if ($term && isset($term->term_id)) {
              $edit_url = admin_url('term.php?taxonomy=post_tag&tag_ID=' . $term->term_id);
              if (current_user_can('edit_term', $term->term_id)) {
                  $wp_admin_bar->add_node([
                      'id'    => 'edit-tag',
                      'title' => 'タグを編集',
                      'href'  => $edit_url,
                  ]);
              }
          }
          return;
      }
  
      // -------------------------
      // 検索結果ページ：Wロゴのみ表示
      // -------------------------
      if (is_search()) {
          $all_nodes = $wp_admin_bar->get_nodes();
          if ($all_nodes && (is_array($all_nodes) || is_object($all_nodes))) {
              foreach ($all_nodes as $node) {
                  if ($node->id !== 'wp-logo') {
                      $wp_admin_bar->remove_node($node->id);
                  }
              }
          }
          return;
      }
  
      // -------------------------
      // その他のページ：初期化
      // -------------------------
      $all_nodes = $wp_admin_bar->get_nodes();
      if ($all_nodes && (is_array($all_nodes) || is_object($all_nodes))) {
          foreach ($all_nodes as $node) {
              $wp_admin_bar->remove_node($node->id);
          }
      }
  
      // -------------------------
      // 管理画面：TOPページへのリンクのみ
      // -------------------------
      if (is_admin()) {
          $wp_admin_bar->add_node([
              'id'    => 'view-site',
              'title' => 'サイトを見る',
              'href'  => home_url('/'),
          ]);
          return;
      }
  
      // -------------------------
      // トップページ：新規投稿リンク
      // -------------------------
      if (is_front_page() || is_home()) {
          if (current_user_can('edit_posts')) {
              $wp_admin_bar->add_node([
                  'id'    => 'new-post',
                  'title' => '新規投稿',
                  'href'  => admin_url('post-new.php'),
              ]);
          }
      }
  
      // -------------------------
      // 個別投稿ページ：投稿を編集
      // -------------------------
      elseif (is_single() && isset($post) && isset($post->ID)) {
          if (current_user_can('edit_post', $post->ID)) {
              $wp_admin_bar->add_node([
                  'id'    => 'edit-post',
                  'title' => '投稿を編集',
                  'href'  => get_edit_post_link($post->ID),
              ]);
          }
      }
  }
  add_action('admin_bar_menu', 'customize_admin_bar', 999);
  
  function prevent_admin_bar_focus_styles() {
    echo '<style>
      #wpadminbar .ab-item:focus,
      #wpadminbar .ab-item:active {
        background: none !important;
        box-shadow: none !important;
        color: inherit !important;
        outline: none !important;
      }
    </style>';
  }
  add_action('wp_head', 'prevent_admin_bar_focus_styles');
  add_action('admin_head', 'prevent_admin_bar_focus_styles');  
  
  
    
  
  