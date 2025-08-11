<div class="pc-right-container">
    <?php get_template_part('template-parts/search-form'); ?>

    <?php
    $common_names = require locate_template('template-parts/_tag-names.php');

    get_template_part('template-parts/tag-list', null, [
        'container_class' => 'tag-list-sidebar',
        'ul_class'        => 'front-sec__text front-sec__flex',
        'title_tag'       => 'h2',
        'title_text'      => 'タグ一覧',
        'order_mode'      => 'custom',           // 'custom' / 'name' / 'count' / 'rand'
        'custom_names'    => $common_names,         // ★名前指定        
        'hide_empty'      => false,
    ]);
    ?>

</div>