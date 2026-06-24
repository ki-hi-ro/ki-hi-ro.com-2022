<?php
/**
 * Render the home or date-archive post list.
 */

global $wp_query;

$post_query      = $wp_query;
$is_custom_query = false;

// A static front page does not receive the posts query used by the blog index.
if (is_front_page() && !is_home()) {
    $post_query = new WP_Query(
        array(
            'post_type'           => 'post',
            'posts_per_page'      => 20,
            'orderby'             => 'modified',
            'order'               => 'DESC',
            'post__not_in'        => kihiro_excluded_post_ids(),
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
        )
    );
    $is_custom_query = true;
}

$GLOBALS['article_list_rendered_count'] = (int) $post_query->post_count;

if (is_date()) {
    $year          = (int) get_query_var('year');
    $month         = (int) get_query_var('monthnum');
    $archive_title = $month
        ? sprintf('%d年%d月の記事', $year, $month)
        : sprintf('%d年の記事', $year);
    ?>
    <h1 class="front-sec__ttl front-sec__ttl--list-heading archive-title --sp-center">
        <?php echo esc_html($archive_title); ?>
        <span class="archive-count">（<?php echo esc_html($post_query->found_posts); ?>）</span>
    </h1>
    <?php
}
?>

<div class="front-sec__text front-sec__flex article-list">
    <?php if ($post_query->have_posts()) : ?>
        <?php while ($post_query->have_posts()) : $post_query->the_post(); ?>
            <div class="all-article__link front-sec__flex-item">
                <?php get_template_part('template-parts/blog-list'); ?>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <p>該当する記事はありませんでした。</p>
    <?php endif; ?>
</div>

<?php if (!$is_custom_query && $post_query->max_num_pages > 1) : ?>
    <?php
    the_posts_pagination(
        array(
            'mid_size'  => 1,
            'prev_text' => '前へ',
            'next_text' => '次へ',
        )
    );
    ?>
<?php endif; ?>

<?php if ($is_custom_query) : ?>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
