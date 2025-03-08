<section class="front-sec">
  <h2 class="front-sec__ttl">タグ</h2>
  <div class="front-sec__text">          
    <?php
    $custom_order = array("タスク管理アプリ開発", "自分の考え", "仕事", "ライフハック"); // 並び順を指定するタグ名
    $tags = get_terms(array(
        'taxonomy'   => 'post_tag',
        'hide_empty' => true,
    ));

    // 指定したタグ名だけに絞り込む
    $tags = array_filter($tags, function($tag) use ($custom_order) {
        return in_array($tag->name, $custom_order);
    });

    // 取得後にカスタム順序で並び替え
    usort($tags, function($a, $b) use ($custom_order) {
        return array_search($a->name, $custom_order) - array_search($b->name, $custom_order);
    });

    if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
        echo '<div class="date-article-list">';
        foreach ( $tags as $tag ) {
            echo '<li><a href="' . get_term_link( $tag ) . '">' . $tag->name . '</a>&nbsp;(' . $tag->count . ')</li>';
        }
        echo '</div>';
    }
    ?>
  </div>
</section>