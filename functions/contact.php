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
        . '<p class="work-contact__lead">Web制作・機能改善・Pythonによる業務自動化のご相談を承ります。</p>'
        . '<p class="work-contact__scope">Web制作は、ご用意いただいたデザインをもとにした実装（コーディング）を承ります。Webデザインの制作は行っていません。</p>'
        . '<p class="work-contact__intro">「手作業を減らしたい」「既存サイトを改善したい」など、現在のお困りごとをお聞かせください。要件やご予算が決まっていない段階でもご相談いただけます。</p>'
        . '<p class="work-contact__note">まずは下のフォームから、現在のお困りごとだけでもお聞かせください。要件を確認して、対応可否とお見積もりをご案内します。ご連絡はメールで行います。</p>'
        . do_shortcode('[contact-form-7 id="' . $form_id . '"]')
        . '</div>';
}
add_shortcode('kihiro_contact_form', 'kihiro_contact_form');
