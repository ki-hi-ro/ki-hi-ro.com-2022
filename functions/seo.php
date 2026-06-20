<?php
/**
 * Open Graph and Twitter metadata.
 */

if (!defined('KIHIRO_SITE_TAGLINE')) {
    define('KIHIRO_SITE_TAGLINE', 'My blog, my life');
}

function kihiro_filter_document_title_parts($title) {
    if (is_front_page() || is_home()) {
        $title['tagline'] = KIHIRO_SITE_TAGLINE;
    }

    return $title;
}
add_filter('document_title_parts', 'kihiro_filter_document_title_parts');

function kihiro_output_social_meta() {
    if (!is_front_page() && !is_home() && !is_singular()) {
        return;
    }

    $is_home = is_front_page() || is_home();
    $title   = $is_home ? get_bloginfo('name') : get_the_title();
    $description = $is_home ? KIHIRO_SITE_TAGLINE : mb_substr(get_the_excerpt(), 0, 90);
    $url     = $is_home ? home_url('/') : get_permalink();
    $type    = $is_home ? 'website' : 'article';
    $image   = get_theme_file_uri('/assets/img/no-image-20251006.png');

    if (is_singular() && has_post_thumbnail()) {
        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');

        if ($thumbnail) {
            $image = $thumbnail[0];
        }
    }
    ?>
    <meta property="og:url" content="<?php echo esc_url($url); ?>">
    <meta property="og:type" content="<?php echo esc_attr($type); ?>">
    <meta property="og:title" content="<?php echo esc_attr($title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($description); ?>">
    <meta property="og:image" content="<?php echo esc_url($image); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@2021_shibata">
    <?php
}
add_action('wp_head', 'kihiro_output_social_meta');
