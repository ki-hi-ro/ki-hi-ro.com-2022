<?php
/**
 * Tag index data, routing, and admin controls.
 */

function kihiro_tag_index_visibility_meta_key() {
    return '_kihiro_show_in_tag_index';
}

function kihiro_normalize_tag_index_name($name) {
    $normalized_name = html_entity_decode((string) $name, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $normalized_name = preg_replace('/\x{3000}/u', ' ', $normalized_name);
    $normalized_name = str_replace('＞', '>', $normalized_name);

    return trim(preg_replace('/\s+/u', ' ', $normalized_name));
}

function kihiro_tag_index_name_parts($name) {
    $parts = preg_split('/\s*>\s*/u', kihiro_normalize_tag_index_name($name), -1, PREG_SPLIT_NO_EMPTY);

    return $parts ? $parts : array();
}

function kihiro_is_tag_selected_for_index($tag) {
    if (!$tag instanceof WP_Term) {
        return false;
    }

    return '1' === get_term_meta($tag->term_id, kihiro_tag_index_visibility_meta_key(), true);
}

function kihiro_get_all_tag_index_tags() {
    $tags = get_tags(
        array(
            'hide_empty' => false,
            'orderby'    => 'name',
            'order'      => 'ASC',
        )
    );

    return is_wp_error($tags) ? array() : $tags;
}

function kihiro_get_selected_tag_index_tags($tags = null) {
    if (null === $tags) {
        $tags = kihiro_get_all_tag_index_tags();
    }

    if (!is_array($tags)) {
        return array();
    }

    return array_values(array_filter($tags, 'kihiro_is_tag_selected_for_index'));
}

function kihiro_tag_index_priority_order() {
    return array('プログラミング', 'サイト制作', 'WordPress', 'Python');
}

function kihiro_compare_tag_index_node_names($first_name, $second_name) {
    $priority_order = kihiro_tag_index_priority_order();
    $first_index    = array_search($first_name, $priority_order, true);
    $second_index   = array_search($second_name, $priority_order, true);
    $first_index    = false === $first_index ? PHP_INT_MAX : $first_index;
    $second_index   = false === $second_index ? PHP_INT_MAX : $second_index;

    if ($first_index !== $second_index) {
        return $first_index <=> $second_index;
    }

    return strnatcasecmp($first_name, $second_name);
}

function kihiro_sort_tag_index_nodes(&$nodes) {
    uksort($nodes, 'kihiro_compare_tag_index_node_names');

    foreach ($nodes as &$node) {
        if (!empty($node['_children'])) {
            kihiro_sort_tag_index_nodes($node['_children']);
        }
    }

    unset($node);
}

function kihiro_get_tag_index_tree($tags = null) {
    if (null === $tags) {
        $tags = kihiro_get_selected_tag_index_tags();
    }

    if (!is_array($tags)) {
        return array();
    }

    $tag_tree = array();

    foreach ($tags as $tag) {
        if (!$tag instanceof WP_Term) {
            continue;
        }

        $parts = kihiro_tag_index_name_parts($tag->name);

        if (!$parts) {
            continue;
        }

        $current_level = &$tag_tree;
        $last_index    = count($parts) - 1;

        foreach ($parts as $index => $part) {
            if (!isset($current_level[$part])) {
                $current_level[$part] = array(
                    '_tag'      => null,
                    '_children' => array(),
                );
            }

            if ($index === $last_index) {
                $current_level[$part]['_tag'] = $tag;
            }

            $current_level = &$current_level[$part]['_children'];
        }

        unset($current_level);
    }

    kihiro_sort_tag_index_nodes($tag_tree);

    return $tag_tree;
}

function kihiro_render_tag_index_tree($nodes, $depth = 0) {
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

                <?php kihiro_render_tag_index_tree($data['_children'], $depth + 1); ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
}

function kihiro_add_tag_index_visibility_field($taxonomy = '') {
    wp_nonce_field('kihiro_save_tag_index_visibility', 'kihiro_tag_index_visibility_nonce');
    ?>
    <div class="form-field term-kihiro-show-in-tag-index-wrap">
        <label for="kihiro_show_in_tag_index">
            <input type="checkbox" id="kihiro_show_in_tag_index" name="kihiro_show_in_tag_index" value="1">
            タグ一覧に表示する
        </label>
        <p>現実の課題へ戻る入口として、前面に出したいタグだけを選びます。</p>
    </div>
    <?php
}
add_action('post_tag_add_form_fields', 'kihiro_add_tag_index_visibility_field');

function kihiro_edit_tag_index_visibility_field($term) {
    $is_selected = kihiro_is_tag_selected_for_index($term);
    ?>
    <tr class="form-field term-kihiro-show-in-tag-index-wrap">
        <th scope="row"><label for="kihiro_show_in_tag_index">タグ一覧</label></th>
        <td>
            <?php wp_nonce_field('kihiro_save_tag_index_visibility', 'kihiro_tag_index_visibility_nonce'); ?>
            <label>
                <input type="checkbox" id="kihiro_show_in_tag_index" name="kihiro_show_in_tag_index" value="1" <?php checked($is_selected); ?>>
                タグ一覧に表示する
            </label>
            <p class="description">現実の課題へ戻る入口として、前面に出したいタグだけを選びます。</p>
        </td>
    </tr>
    <?php
}
add_action('post_tag_edit_form_fields', 'kihiro_edit_tag_index_visibility_field');

function kihiro_save_tag_index_visibility($term_id) {
    if (!current_user_can('manage_categories')) {
        return;
    }

    $nonce = isset($_POST['kihiro_tag_index_visibility_nonce'])
        ? sanitize_text_field(wp_unslash($_POST['kihiro_tag_index_visibility_nonce']))
        : '';

    if (!wp_verify_nonce($nonce, 'kihiro_save_tag_index_visibility')) {
        return;
    }

    $is_selected = isset($_POST['kihiro_show_in_tag_index']) ? '1' : '0';
    update_term_meta((int) $term_id, kihiro_tag_index_visibility_meta_key(), $is_selected);
}
add_action('created_post_tag', 'kihiro_save_tag_index_visibility');
add_action('edited_post_tag', 'kihiro_save_tag_index_visibility');

function kihiro_tag_index_paths() {
    return array('tags', 'tag-list', 'tag-hierarchy');
}

function kihiro_tag_index_url() {
    return home_url('/tags/');
}

function kihiro_current_request_path() {
    $request_uri = isset($_SERVER['REQUEST_URI'])
        ? wp_unslash($_SERVER['REQUEST_URI'])
        : '';
    $request_path = wp_parse_url($request_uri, PHP_URL_PATH);

    if (!is_string($request_path)) {
        return '';
    }

    $home_path = wp_parse_url(home_url('/'), PHP_URL_PATH);

    if (is_string($home_path) && '/' !== $home_path) {
        $home_path = untrailingslashit($home_path);

        if (0 === strpos($request_path, $home_path . '/')) {
            $request_path = substr($request_path, strlen($home_path));
        }
    }

    return trim($request_path, '/');
}

function kihiro_is_tag_index_request() {
    return in_array(kihiro_current_request_path(), kihiro_tag_index_paths(), true);
}

function kihiro_prepare_tag_index_query($wp_query) {
    $wp_query->is_404       = false;
    $wp_query->is_single    = false;
    $wp_query->is_page      = false;
    $wp_query->is_attachment = false;
    $wp_query->is_singular  = false;
    $wp_query->is_archive   = false;
    $wp_query->is_home      = false;
    $wp_query->is_search    = false;
}

function kihiro_prevent_tag_index_404($preempt, $wp_query) {
    if (!kihiro_is_tag_index_request() || !empty($wp_query->posts)) {
        return $preempt;
    }

    kihiro_prepare_tag_index_query($wp_query);

    return true;
}
add_filter('pre_handle_404', 'kihiro_prevent_tag_index_404', 10, 2);

function kihiro_load_tag_index_template($template) {
    global $wp_query;

    if (!kihiro_is_tag_index_request() || is_page() || !empty($wp_query->posts)) {
        return $template;
    }

    $tag_index_template = locate_template('page-tag-hierarchy.php');

    if (!$tag_index_template) {
        return $template;
    }

    kihiro_prepare_tag_index_query($wp_query);
    status_header(200);

    return $tag_index_template;
}
add_filter('template_include', 'kihiro_load_tag_index_template');

function kihiro_add_tag_index_body_class($classes) {
    if (kihiro_is_tag_index_request()) {
        $classes[] = 'page-template-page-tag-hierarchy';
        $classes[] = 'tag-index';
    }

    return $classes;
}
add_filter('body_class', 'kihiro_add_tag_index_body_class');

function kihiro_filter_tag_index_document_title($title) {
    if (kihiro_is_tag_index_request()) {
        $title['title'] = 'タグ一覧';
    }

    return $title;
}
add_filter('document_title_parts', 'kihiro_filter_tag_index_document_title');
