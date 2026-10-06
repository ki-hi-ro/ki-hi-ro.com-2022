<?php
/** Editable standard pages; initialization is an explicit admin action. */
function kihiro_case_study_index() {
    $page = get_page_by_path('case-study', OBJECT, 'page');
    return $page && $page->post_status === 'publish' && !post_password_required($page) ? $page : null;
}

function kihiro_create_case_study_pages() {
    $items = require get_template_directory() . '/content/case-studies.php';
    $specs = array('case-study' => array('title' => 'CASE STUDY', 'template' => 'page-case-study-index.php'));
    foreach ($items as $slug => $item) $specs['case-study/' . $slug] = array('title' => $item['title'], 'template' => 'page-case-study.php');
    // Check every path before creating anything; never take over an existing page.
    foreach ($specs as $path => $spec) {
        $existing = get_page_by_path($path, OBJECT, 'page');
        if ($existing && get_page_template_slug($existing) !== $spec['template']) return new WP_Error('case_study_conflict', $path . ' に既存ページがあります。');
    }
    $ids = array();
    foreach ($specs as $path => $spec) {
        $page = get_page_by_path($path, OBJECT, 'page');
        if ($page) { $ids[] = $page->ID; continue; }
        $slug = basename($path);
        $is_index = $path === 'case-study';
        $body = '<!-- wp:paragraph --><p>顧客の課題に対して、実際にどのように考え、作ったか。業務を想定したPythonサンプルを紹介します。</p><!-- /wp:paragraph -->';
        if (!$is_index) {
            $item = $items[$slug];
            $body = '<!-- wp:paragraph --><p>' . esc_html($item['tech']) . '</p><!-- /wp:paragraph -->';
            foreach ($item['sections'] as $heading => $text) {
                $body .= '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html($heading) . '</h2><!-- /wp:heading -->';
                foreach (explode("\n", $text) as $paragraph) $body .= '<!-- wp:paragraph --><p>' . esc_html($paragraph) . '</p><!-- /wp:paragraph -->';
            }
            if (!empty($item['repo'])) $body .= '<!-- wp:paragraph --><p><a href="' . esc_url($item['repo']) . '">GitHubでソースコード・READMEを見る</a></p><!-- /wp:paragraph -->';
        }
        $id = wp_insert_post(array('post_type' => 'page', 'post_status' => 'draft', 'post_name' => $slug, 'post_title' => $spec['title'], 'post_parent' => $is_index ? 0 : $ids[0], 'post_content' => $body, 'post_excerpt' => $is_index ? '' : $item['summary'], 'page_template' => $spec['template']), true);
        if (is_wp_error($id)) return $id;
        $ids[] = $id;
    }
    return $ids;
}

add_action('admin_menu', function () {
    add_management_page('CASE STUDYのセットアップ', 'CASE STUDYのセットアップ', 'manage_options', 'kihiro-case-study', 'kihiro_case_study_setup_screen');
});
function kihiro_case_study_setup_screen() {
    if (!current_user_can('manage_options')) return;
    echo '<div class="wrap"><h1>CASE STUDYのセットアップ</h1><p>一覧と事例の詳細を下書きで作成します。既存の本文は上書きしません。</p>';
    if (isset($_POST['kihiro_create_cases'])) {
        check_admin_referer('kihiro_create_cases');
        $result = kihiro_create_case_study_pages();
        if (is_wp_error($result)) echo '<p>' . esc_html($result->get_error_message()) . '</p>';
        else foreach ($result as $id) printf('<p><a href="%s">%sを編集</a></p>', esc_url(get_edit_post_link($id)), esc_html(get_the_title($id)));
    }
    echo '<form method="post">';
    wp_nonce_field('kihiro_create_cases');
    submit_button('初期ページを作成', 'primary', 'kihiro_create_cases');
    echo '</form><p>内容を確認して一覧と詳細ページを公開すると、ヘッダーに入口が表示されます。追加事例は親をCASE STUDY、テンプレートを「CASE STUDY — 詳細」に設定し、抜粋に紹介文を入力してください。</p></div>';
}
