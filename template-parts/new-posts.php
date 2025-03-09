<?php
global $post_ids;
$post_ids = $post_ids ?? array(); // 未定義なら空配列で初期化

$term_slug = "";
$tag_query = array(); // タグ条件のための配列

if (is_tag()) {
    $term = get_queried_object();
    $term_slug = $term->slug;

    if (!empty($term_slug)) {
        $tag_query = array('tag_slug__in' => array($term_slug));
    }
}

// クエリのパラメータを定義
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 1,
    'orderby'        => 'date',
    'post__not_in'   => !empty($post_ids) ? array_merge(array(3874), $post_ids) : array(3874),
);

// タグの条件がある場合のみ追加
if (!empty($tag_query)) {
    $args = array_merge($args, $tag_query);
}

$my_query = new WP_Query($args);
?>

<h2 class="front-sec__ttl">最近書いた記事</h2>
<div class="front-sec__text front-sec__flex">
<?php
if ($my_query->have_posts()) :
    while ($my_query->have_posts()) :
        $my_query->the_post();
        
        global $post_ids; // ここでもグローバル変数として明示
        $post_ids[] = get_the_ID(); // IDを保存
?>

    <div class="all-article__link front-sec__flex-item">
      <?php get_template_part("template-parts/blog-list"); ?>
    </div>
<?php
    endwhile;
endif;
wp_reset_postdata();
?>
</div>