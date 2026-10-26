<?php
/** Work inquiries sit alongside the journal without changing its editorial scope. */
function kihiro_services_page() {
    $page = get_page_by_path('services', OBJECT, 'page');
    return $page && 'publish' === $page->post_status && !post_password_required($page) ? $page : null;
}

function kihiro_work_experiences() {
    return require get_template_directory() . '/content/work-experiences.php';
}

function kihiro_case_brief_fields() {
    return array('problem' => '課題', 'solution' => '解決方法', 'outcome' => '成果', 'similar' => '依頼できる類似作業', 'role' => '担当範囲', 'deliverables' => '成果物', 'testing' => 'テスト・確認内容', 'feedback' => '顧客評価（掲載許可のある内容）');
}
add_action('add_meta_boxes_page', function ($post) {
    if ('page-case-study.php' !== get_page_template_slug($post)) return;
    add_meta_box('kihiro-case-brief', '開発事例の概要', function ($post) {
        wp_nonce_field('kihiro_case_brief', 'kihiro_case_brief_nonce');
        echo '<p>確認できる内容だけを入力してください。空欄の項目は公開ページに表示しません。サンプルは実案件と区別して記載してください。</p>';
        foreach (kihiro_case_brief_fields() as $key => $label) {
            printf('<p><label for="case-brief-%1$s">%2$s</label><br><textarea id="case-brief-%1$s" name="kihiro_case_brief[%1$s]" rows="3" class="widefat">%3$s</textarea></p>', esc_attr($key), esc_html($label), esc_textarea(get_post_meta($post->ID, '_kihiro_case_' . $key, true)));
        }
    }, 'page', 'normal');
});
add_action('save_post_page', function ($post_id) {
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id) || !current_user_can('edit_post', $post_id)) return;
    if (!isset($_POST['kihiro_case_brief_nonce']) || !is_scalar($_POST['kihiro_case_brief_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['kihiro_case_brief_nonce'])), 'kihiro_case_brief')) return;
    $values = isset($_POST['kihiro_case_brief']) && is_array($_POST['kihiro_case_brief']) ? wp_unslash($_POST['kihiro_case_brief']) : array();
    foreach (kihiro_case_brief_fields() as $key => $label) {
        if (isset($values[$key]) && is_scalar($values[$key])) update_post_meta($post_id, '_kihiro_case_' . $key, sanitize_textarea_field($values[$key]));
    }
});
