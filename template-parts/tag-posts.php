<?php
/**
 * Render posts from the tag archive's main query.
 */

global $wp_query;
$GLOBALS['article_list_rendered_count'] = (int) $wp_query->post_count;

if (have_posts()) :
    while (have_posts()) :
        the_post();
        ?>
        <div class="all-article__link front-sec__flex-item">
            <?php get_template_part('template-parts/blog-list'); ?>
        </div>
        <?php
    endwhile;
else :
    ?>
    <p>該当する記事はありませんでした。</p>
    <?php
endif;
?>

<?php
the_posts_pagination(
    array(
        'mid_size'  => 1,
        'prev_text' => '前へ',
        'next_text' => '次へ',
    )
);
