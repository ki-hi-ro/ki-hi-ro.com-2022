<?php
/** Story uses standard hierarchical pages and two opt-in page templates. */
function kihiro_is_story() {
    return is_page_template(array('page-story.php', 'page-story-index.php'));
}

function kihiro_story_period($post_id) {
    $start = get_post_meta($post_id, '_kihiro_story_start', true);
    $end = get_post_meta($post_id, '_kihiro_story_end', true);
    if (!$start && !$end) return;
    echo '<p class="story-period">';
    foreach (array_filter(array($start, $end)) as $index => $date) {
        if ($index && $start) echo '<span aria-hidden="true">—</span>';
        printf('<time datetime="%s">%s</time>', esc_attr($date), esc_html(str_replace('-', '.', $date)));
    }
    echo '</p>';
}

/** Related posts are chosen in each chapter's Shortcode block. */
function kihiro_story_related_posts($attributes) {
    $attributes = shortcode_atts(array('ids' => ''), $attributes, 'story_related_posts');
    $ids = array_slice(array_filter(array_unique(array_map('absint', explode(',', $attributes['ids'])))), 0, 5);
    if (!$ids) return '';
    $posts = get_posts(array('post_type' => 'post', 'post_status' => 'publish', 'post__in' => $ids, 'orderby' => 'post__in', 'posts_per_page' => 5));
    if (!$posts) return '';
    $html = '<aside class="story-related" aria-label="関連するBlog記事"><h3>Related posts</h3><ul>';
    foreach ($posts as $related) {
        $html .= '<li><a href="' . esc_url(get_permalink($related)) . '">' . esc_html($related->post_title) . '</a></li>';
    }
    return $html . '</ul></aside>';
}
add_shortcode('story_related_posts', 'kihiro_story_related_posts');

function kihiro_story_page_support() {
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'kihiro_story_page_support');

function kihiro_story_meta_box() {
    add_meta_box('kihiro-story-period', 'Storyの掲載期間', 'kihiro_story_meta_fields', 'page', 'side');
}
add_action('add_meta_boxes_page', 'kihiro_story_meta_box');

function kihiro_story_meta_fields($post) {
    wp_nonce_field('kihiro_story_meta', 'kihiro_story_nonce');
    echo '<p>Storyテンプレートで使用します。カードの紹介文は「抜粋」で編集できます。</p>';
    foreach (array('start' => '開始日', 'end' => '終了日') as $key => $label) {
        printf('<p><label for="kihiro-story-%1$s">%2$s</label><br><input type="date" id="kihiro-story-%1$s" name="kihiro_story_%1$s" value="%3$s"></p>', esc_attr($key), esc_html($label), esc_attr(get_post_meta($post->ID, '_kihiro_story_' . $key, true)));
    }
}

function kihiro_story_save_meta($post_id) {
    if (empty($_POST['kihiro_story_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['kihiro_story_nonce'])), 'kihiro_story_meta')) return;
    if (!current_user_can('edit_post', $post_id) || wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) return;
    foreach (array('start', 'end') as $key) {
        $value = isset($_POST['kihiro_story_' . $key]) ? sanitize_text_field(wp_unslash($_POST['kihiro_story_' . $key])) : '';
        $date = DateTimeImmutable::createFromFormat('!Y-m-d', $value);
        if ($value === '') delete_post_meta($post_id, '_kihiro_story_' . $key);
        elseif ($date && $date->format('Y-m-d') === $value) update_post_meta($post_id, '_kihiro_story_' . $key, $value);
    }
}
add_action('save_post_page', 'kihiro_story_save_meta');

/** Core already handles document title and canonical. SEO plugins own metadata. */
function kihiro_story_meta_tags() {
    if (!kihiro_is_story() || post_password_required()) return;
    $seo_plugin = defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') || defined('AIOSEO_VERSION') || defined('SEOPRESS_VERSION') || defined('THE_SEO_FRAMEWORK_VERSION') || defined('SLIM_SEO_VERSION');
    if (apply_filters('kihiro_story_has_seo_plugin', $seo_plugin)) return;
    $post = get_queried_object();
    $description = wp_strip_all_tags($post->post_excerpt ?: $post->post_content);
    $description = wp_trim_words(strip_shortcodes($description), 80, '…');
    printf('<meta name="description" content="%s">' . "\n", esc_attr($description));
    $tags = array('og:type' => 'article', 'og:title' => get_the_title($post), 'og:description' => $description, 'og:url' => get_permalink($post), 'og:site_name' => get_bloginfo('name'), 'og:locale' => get_locale());
    $image = get_the_post_thumbnail_url($post, 'large');
    if ($image) $tags['og:image'] = $image;
    foreach ($tags as $property => $value) printf('<meta property="%s" content="%s">' . "\n", esc_attr($property), esc_attr($value));
}
add_action('wp_head', 'kihiro_story_meta_tags', 5);

function kihiro_story_disable_auto_toc($enabled) {
    return kihiro_is_story() ? false : $enabled;
}
add_filter('ez_toc_maybe_apply_the_content_filter', 'kihiro_story_disable_auto_toc');

require_once __DIR__ . '/story-setup.php';
