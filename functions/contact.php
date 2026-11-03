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

/** Render the dedicated work inquiry form. */
function kihiro_contact_form() {
    // ここは表示だけを担当。入力検証・メール宛先・送信はContact Form 7の設定に委譲。
    // 本文内の[kihiro_contact_form]から呼ばれるため、DB本文とテーマの両方が関係する。
    $form_id = absint(get_option('kihiro_work_contact_form_id'));
    if (!$form_id || !shortcode_exists('contact-form-7')) {
        return '<p>現在、お問い合わせフォームを準備しています。</p>';
    }
    return '<div class="work-contact">'
        . '<div class="work-contact__welcome"><p>内容を確認し、対応できる範囲とお見積もりをご案内します。<br>メールを中心に、必要に応じてWeb会議も活用します。</p></div>'
        . do_shortcode('[contact-form-7 id="' . $form_id . '"]')
        . '</div>';
}
add_shortcode('kihiro_contact_form', 'kihiro_contact_form');
