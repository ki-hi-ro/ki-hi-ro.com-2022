<section class="front-sec">
  <h2 class="front-sec__ttl --mt-0">タグ</h2>
  <div class="front-sec__text">          
    <?php
    $tags = get_terms( array(
        'taxonomy' => 'post_tag',
        'hide_empty' => true,
        'orderby' => 'count',
        'order' => 'DESC'
    ) );

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