<?php
/**
 * Simplified admin bar for editors.
 */

function kihiro_clear_admin_bar($wp_admin_bar, $except = array()) {
    $nodes = $wp_admin_bar->get_nodes();

    if (!$nodes) {
        return;
    }

    foreach ($nodes as $node) {
        if (!in_array($node->id, $except, true)) {
            $wp_admin_bar->remove_node($node->id);
        }
    }
}

function kihiro_customize_admin_bar($wp_admin_bar) {
    if (!is_user_logged_in()) {
        return;
    }

    if (is_tag()) {
        kihiro_clear_admin_bar($wp_admin_bar);
        $term = get_queried_object();

        if ($term instanceof WP_Term && current_user_can('edit_term', $term->term_id)) {
            $wp_admin_bar->add_node(
                array(
                    'id'    => 'edit-tag',
                    'title' => 'タグを編集',
                    'href'  => get_edit_term_link($term->term_id, 'post_tag'),
                )
            );
        }
        return;
    }

    if (is_search()) {
        kihiro_clear_admin_bar($wp_admin_bar, array('wp-logo'));
        return;
    }

    kihiro_clear_admin_bar($wp_admin_bar);

    if (is_admin()) {
        $wp_admin_bar->add_node(
            array(
                'id'    => 'view-site',
                'title' => 'サイトを見る',
                'href'  => home_url('/'),
            )
        );
        return;
    }

    if ((is_front_page() || is_home()) && current_user_can('edit_posts')) {
        $wp_admin_bar->add_node(
            array(
                'id'    => 'admin-logo',
                'title' => '<span class="ab-icon"></span><span class="ab-label">管理画面</span>',
                'href'  => admin_url(),
                'meta'  => array(
                    'title' => '管理画面トップへ移動',
                    'class' => 'admin-logo-link',
                ),
            )
        );
        $wp_admin_bar->add_node(
            array(
                'id'    => 'new-post',
                'title' => '新規投稿',
                'href'  => admin_url('post-new.php'),
            )
        );
        return;
    }

    if (is_single()) {
        $post_id = get_queried_object_id();

        if ($post_id && current_user_can('edit_post', $post_id)) {
            $wp_admin_bar->add_node(
                array(
                    'id'    => 'edit-post',
                    'title' => '投稿を編集',
                    'href'  => get_edit_post_link($post_id),
                )
            );
        }
    }
}
add_action('admin_bar_menu', 'kihiro_customize_admin_bar', 999);
