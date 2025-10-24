<?php
global $post_ids;
$post_ids = $post_ids ?? array(); // 未定義なら空配列で初期化

$term_slug  = "";
$tag_query  = array(); // タグ条件のための配列
$date_query = array(); // 年月アーカイブ用の配列

// タグページのとき
if (is_tag()) {
    $term = get_queried_object();
    $term_slug = $term->slug;

    if (!empty($term_slug)) {
        $tag_query = array('tag_slug__in' => array($term_slug));
    }
}

// 年月アーカイブページのとき
$archive_title = "最近更新した記事"; // デフォルトタイトル
if (is_date()) {
    $year  = get_query_var('year');      // 例: 2025
    $month = get_query_var('monthnum');  // 例: 10

    // 年月が揃っていればタイトルを変更
    if ($year && $month) {
        $archive_title = sprintf("%d年%d月の記事", $year, $month);
    } elseif ($year) {
        $archive_title = sprintf("%d年の記事", $year);
    }

    $date_query = array(
        array(
            'year'  => $year,
            'month' => $month,
        ),
    );
}

// クエリのパラメータを定義
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'post__not_in'   => !empty($post_ids) ? array_merge(array(3874), $post_ids) : array(3874),
);

// トップページの場合のみ
if (is_home() || is_front_page()) {
    $args['posts_per_page'] = 73;
    $args['orderby'] = 'modified';
}

// タグ条件を追加
if (!empty($tag_query)) {
    $args = array_merge($args, $tag_query);
}

// 年月条件を追加
if (!empty($date_query)) {
    $args['date_query'] = $date_query;
}

$my_query = new WP_Query($args);
?>

<h2 class="front-sec__ttl --sp-center"><?php echo esc_html($archive_title); ?></h2>

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