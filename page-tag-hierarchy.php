<?php
/*
Template Name: タグ一覧
*/

$all_tags = get_tags(
    array(
        'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    )
);

if (is_wp_error($all_tags)) {
    $all_tags = array();
}

$tags = array_values(array_filter($all_tags, 'kihiro_is_tag_selected_for_index'));
$tag_tree = array();

foreach ($tags as $tag) {
    $parts = kihiro_tag_index_name_parts($tag->name);

    if (!$parts) {
        continue;
    }

    $current_level = &$tag_tree;

    foreach ($parts as $index => $part) {
        if (!isset($current_level[$part])) {
            $current_level[$part] = array(
                '_tag'      => null,
                '_children' => array(),
            );
        }

        if ($index === count($parts) - 1) {
            $current_level[$part]['_tag'] = $tag;
        }

        $current_level = &$current_level[$part]['_children'];
    }

    unset($current_level);
}

$sort_tag_nodes = function (&$nodes) use (&$sort_tag_nodes) {
    $priority_order = array('プログラミング', 'サイト制作', 'WordPress', 'Python');

    uksort(
        $nodes,
        function ($first_name, $second_name) use ($priority_order) {
            $first_index  = array_search($first_name, $priority_order, true);
            $second_index = array_search($second_name, $priority_order, true);
            $first_index  = false === $first_index ? PHP_INT_MAX : $first_index;
            $second_index = false === $second_index ? PHP_INT_MAX : $second_index;

            if ($first_index !== $second_index) {
                return $first_index <=> $second_index;
            }

            return strnatcasecmp($first_name, $second_name);
        }
    );

    foreach ($nodes as &$node) {
        if (!empty($node['_children'])) {
            $sort_tag_nodes($node['_children']);
        }
    }

    unset($node);
};

$sort_tag_nodes($tag_tree);

$render_tag_tree = function ($nodes, $depth = 0) use (&$render_tag_tree) {
    if (empty($nodes)) {
        return;
    }
    ?>
    <ul class="tag-tree tag-tree--level-<?php echo esc_attr((string) $depth); ?>">
        <?php foreach ($nodes as $name => $data) : ?>
            <li class="tag-tree__item">
                <?php if ($data['_tag'] instanceof WP_Term) : ?>
                    <a class="tag-tree__link<?php echo (int) $data['_tag']->count > 0 ? '' : ' tag-tree__link--empty'; ?>" href="<?php echo esc_url(get_tag_link($data['_tag']->term_id)); ?>">
                        <span class="tag-tree__name"># <?php echo esc_html($name); ?></span>
                        <span class="tag-tree__count"><?php echo esc_html(number_format_i18n((int) $data['_tag']->count)); ?>件</span>
                    </a>
                <?php else : ?>
                    <span class="tag-tree__group"><?php echo esc_html($name); ?></span>
                <?php endif; ?>

                <?php $render_tag_tree($data['_children'], $depth + 1); ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
};

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
                        <?php $render_tag_tree($tag_tree); ?>
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
