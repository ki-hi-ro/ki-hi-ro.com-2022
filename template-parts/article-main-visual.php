<?php
/** Use the article's own visual, before its title and reading columns. */
if (post_password_required()) return;
$image = '';
if (has_post_thumbnail()) {
    $image = get_the_post_thumbnail(get_the_ID(), 'full', array('loading' => 'eager', 'fetchpriority' => 'high', 'decoding' => 'async', 'sizes' => '(max-width: 1180px) 100vw, 1180px'));
} elseif ('page-case-study.php' === get_page_template_slug()) {
    $image = kihiro_case_study_image(get_post());
} elseif (preg_match('/<img\b[^>]*\bsrc=["\']([^"\']+)["\'][^>]*>/iu', get_the_content(), $match)) {
    $image = '<img src="' . esc_url(html_entity_decode($match[1], ENT_QUOTES, 'UTF-8')) . '" alt="' . esc_attr(get_the_title()) . '" fetchpriority="high" decoding="async">';
}
if (!$image) return;
?>
<figure class="article-main-visual"><?php echo wp_kses_post($image); ?></figure>
