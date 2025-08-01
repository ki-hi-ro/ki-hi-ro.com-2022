<div class="pc-right-container">
    <?php get_template_part('template-parts/search-form'); ?>
    <section class="front-sec">

    <?php if (is_tag()) : ?>
    <?php
    $current_tag = get_queried_object();
    if ($current_tag && isset($current_tag->slug)) {
        $current_slug = $current_tag->slug;
        $current_name = $current_tag->name;

        $all_tags = get_tags([
            'hide_empty' => false,
            'orderby' => 'name',
        ]);

        $child_tags = [];
        $parent_tags = [];

        // 子タグ抽出（slugに接頭一致していて、自分より長い）
        foreach ($all_tags as $tag) {
            if ($tag->term_id === $current_tag->term_id) continue;
            if (str_starts_with($tag->slug, $current_slug . '-')) {
                $child_tags[] = [
                    'name' => $tag->name,
                    'link' => get_tag_link($tag->term_id),
                ];
            }
        }

        // 上位タグ抽出（slugを `-` で分割して候補を作る）
        $slug_parts = explode('-', $current_slug);
        if (count($slug_parts) > 1) {
            for ($i = count($slug_parts) - 1; $i > 0; $i--) {
                $parent_slug = implode('-', array_slice($slug_parts, 0, $i));
                foreach ($all_tags as $tag) {
                    if ($tag->slug === $parent_slug) {
                        $parent_tags[] = [
                            'name' => $tag->name,
                            'link' => get_tag_link($tag->term_id),
                        ];
                        break; // 一致したらそれ以上は探さない
                    }
                }
            }
        }
    ?>
    <?php if (!empty($parent_tags)) : ?>
        <section class="tag-parents">
            <h2><?php echo esc_html($current_name); ?> の上位タグ</h2>
            <ul>
                <?php foreach ($parent_tags as $parent) : ?>
                    <li><a href="<?php echo esc_url($parent['link']); ?>"><?php echo esc_html($parent['name']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php endif; ?>

    <?php if (!empty($child_tags)) : ?>
        <section class="tag-children">
            <h2><?php echo esc_html($current_name); ?> の下位タグ</h2>
            <ul>
                <?php foreach ($child_tags as $child) : ?>
                    <li><a href="<?php echo esc_url($child['link']); ?>"><?php echo esc_html($child['name']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php endif; ?>
<?php } ?>
<?php endif; ?>


    <!-- <div class="tag-hierarchy-link-box">
        <a href="<?php echo home_url('タグ一覧'); ?>" class="btn-tag-hierarchy">タグ一覧</a>
    </div> -->

    <style>
    li > a, .tag-hierarchy-link-box > a {
        display: block;
        width: 100%;
    }
    a.btn-tag-hierarchy {
        font-size: 17px;
    }
    .tag-hierarchy-link-box {
        text-align: center;
        margin: -16px 0 151px;
    }
    @media (min-width: 1200px) {
        .tag-hierarchy-link-box {
            text-align: left;
            margin: 0;
        }
    }
    .tag-children, .tag-parents {
        margin: 40px 0;
    }
    @media (min-width: 1200px) {
        .tag-children, .tag-parents {
            margin-bottom: 20px;
        }        
    }
    .tag-children h2, .tag-parents h2 {
        font-size: 1.1em;
        margin-bottom: 10px;
    }
    .tag-children ul, .tag-parents ul {
        list-style: disc;
        padding-left: 20px;
    }
    .tag-children li, .tag-parents li {
        margin-bottom: 5px;
    }
    .tag-children a, .tag-parents a {
        color: #0073aa;
        text-decoration: none;
    }
    </style>

    </section>
</div>