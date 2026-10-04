<?php
/** Contact page and email contact details. */
function kihiro_create_contact_page() {
    if (get_option('kihiro_contact_page_id')) {
        return;
    }
    $page = get_page_by_path('contact-us');
    if ($page) {
        update_option('kihiro_contact_page_id', $page->ID, false);
        return;
    }
    $page_id = wp_insert_post(array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_title' => 'お問い合わせ',
        'post_name' => 'contact-us',
        'post_content' => '[kihiro_contact_form]',
        'comment_status' => 'closed',
    ), true);
    if (!is_wp_error($page_id) && $page_id) {
        update_option('kihiro_contact_page_id', $page_id, false);
    }
}
add_action('init', 'kihiro_create_contact_page');

/** Keep the existing page shortcode working as a mail contact notice. */
function kihiro_contact_form() {
    return '<p>お問い合わせはメールでお願いいたします。</p>'
        . '<p><a href="mailto:hiroki.hiroki@icloud.com">hiroki.hiroki@icloud.com</a></p>';
}
add_shortcode('kihiro_contact_form', 'kihiro_contact_form');
