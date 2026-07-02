<?php
/*
Template Name: タグ一覧
*/

$all_tags = kihiro_get_all_tag_index_tags();
$tags     = kihiro_get_selected_tag_index_tags($all_tags);
$tag_tree = kihiro_get_tag_index_tree($tags);

get_header();
?>

<main class="site-main">
    <div class="outer-container front-container">
        <div class="article-container">
            <section class="tag-index-page" aria-labelledby="tag-index-title">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>
                        <h1 id="tag-index-title" class="front-sec__ttl --sp-center"><?php the_title(); ?></h1>

                        <?php if ('' !== trim(get_the_content())) : ?>
                            <div class="tag-index-page__intro">
                                <?php the_content(); ?>
                            </div>
                        <?php else : ?>
                            <p class="tag-index-page__lead">現実の課題へ戻るために、自分で選んだタグだけを入口として並べます。</p>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <h1 id="tag-index-title" class="front-sec__ttl --sp-center">タグ一覧</h1>
                    <p class="tag-index-page__lead">現実の課題へ戻るために、自分で選んだタグだけを入口として並べます。</p>
                <?php endif; ?>

                <div class="tag-index-page__status" aria-label="タグ一覧の状態">
                    <span><strong><?php echo esc_html(number_format_i18n(count($tags))); ?></strong> 表示中</span>
                    <span><strong><?php echo esc_html(number_format_i18n(count($all_tags))); ?></strong> 全タグ</span>
                </div>

                <?php if ($tag_tree) : ?>
                    <p class="tag-index-page__summary">いま前面に出すタグだけを絞っています。</p>
                    <nav class="tag-index-page__nav" aria-label="タグ一覧">
                        <?php kihiro_render_tag_index_tree($tag_tree); ?>
                    </nav>
                <?php else : ?>
                    <p class="tag-index-page__empty">タグ編集画面で「タグ一覧に表示する」を選ぶと、ここに表示されます。</p>
                <?php endif; ?>
            </section>
        </div>

        <p class="page-top --not-single-sp">
            <a class="page-top__link --not-single-sp" href="#" data-mode="top" aria-label="ページの一番上へ移動">↑</a>
        </p>
    </div>
</main>

<?php get_footer(); ?>
