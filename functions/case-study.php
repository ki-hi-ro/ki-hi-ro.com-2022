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
        $body = '<!-- wp:paragraph --><p>顧客の課題に対して、どのように考え、実装したか。Web制作・機能開発・業務自動化の実案件と、業務を想定したサンプルを紹介します。</p><!-- /wp:paragraph -->';
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
    if (isset($_POST['kihiro_publish_portfolio'])) {
        check_admin_referer('kihiro_publish_portfolio');
        $result = kihiro_publish_portfolio_pages();
        if (is_wp_error($result)) echo '<p>' . esc_html($result->get_error_message()) . '</p>';
        else echo '<p>CASE STUDYとARTICLESを公開しました。技術記事145件の掲載分類を追加しました。既存本文・タグは保持しました。</p>';
    }
    echo '<form method="post">';
    wp_nonce_field('kihiro_create_cases');
    submit_button('初期ページを作成', 'primary', 'kihiro_create_cases');
    echo '</form><p>内容を確認して一覧と詳細ページを公開すると、ヘッダーに入口が表示されます。追加事例は親をCASE STUDY、テンプレートを「CASE STUDY — 詳細」に設定し、抜粋に紹介文を入力してください。</p></div>';
    echo '<div class="wrap"><h2>本番への反映</h2><p>CASE STUDY一覧・3事例とARTICLESを作成・公開し、選定した145記事にARTICLES掲載分類だけを追加します。既存の記事本文・タグ・設定は上書きしません。IDとタイトルを全件照合し、不一致があれば開始前に中止します。</p><form method="post">';
    wp_nonce_field('kihiro_publish_portfolio');
    submit_button('CASE STUDY / ARTICLESを公開する', 'primary', 'kihiro_publish_portfolio');
    echo '</form></div>';
}

/** Add only portfolio pages and editorial metadata; never import a database. */
function kihiro_publish_portfolio_pages() {
    $selection = json_decode(file_get_contents(get_template_directory() . '/content/technical-article-selection.json'), true);
    if (!is_array($selection)) return new WP_Error('selection', '掲載設定を読み込めません。');
    foreach ($selection as $item) {
        $post = get_post($item['id']);
        if (!$post || $post->post_type !== 'post' || $post->post_status !== 'publish' || html_entity_decode($post->post_title, ENT_QUOTES, 'UTF-8') !== html_entity_decode($item['title'], ENT_QUOTES, 'UTF-8')) {
            return new WP_Error('article_conflict', '記事ID・タイトルの確認に失敗しました: ' . $item['id'] . '。変更を中止しました。');
        }
    }
    $articles = get_page_by_path('articles', OBJECT, 'page');
    if ($articles && get_page_template_slug($articles) !== 'page-technical-articles.php') return new WP_Error('articles_conflict', 'articlesに別テンプレートの既存ページがあります。');
    $ids = kihiro_create_case_study_pages();
    if (is_wp_error($ids)) return $ids;
    if (!$articles) {
        $article_id = wp_insert_post(array('post_type' => 'page', 'post_status' => 'draft', 'post_name' => 'articles', 'post_title' => 'ARTICLES', 'post_content' => '<!-- wp:paragraph --><p>Python・SQL・Web開発。実装の手順や、開発中の課題をどう解決したかを紹介します。</p><!-- /wp:paragraph -->', 'page_template' => 'page-technical-articles.php'), true);
        if (is_wp_error($article_id)) return $article_id;
        $ids[] = $article_id;
    } else {
        $ids[] = $articles->ID;
    }
    foreach ($selection as $item) {
        foreach ($item['topics'] as $topic) {
            if (!in_array($topic, get_post_meta($item['id'], '_kihiro_article_topic', false), true)) add_post_meta($item['id'], '_kihiro_article_topic', $topic);
        }
    }
    foreach ($ids as $id) {
        if (get_post_status($id) === 'draft') {
            $result = wp_update_post(array('ID' => $id, 'post_status' => 'publish'), true);
            if (is_wp_error($result)) return $result;
        }
    }
    return $ids;
}
