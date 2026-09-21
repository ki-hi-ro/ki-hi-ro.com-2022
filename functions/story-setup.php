<?php
/** Explicit, idempotent setup: never insert pages during a front-end request. */
function kihiro_story_paragraphs($paragraphs) {
    $html = '';
    foreach ($paragraphs as $text) {
        $html .= "<!-- wp:paragraph -->\n<p>" . nl2br(esc_html($text), false) . "</p>\n<!-- /wp:paragraph -->\n";
    }
    return $html;
}

function kihiro_story_group($class, $content, $anchor = '') {
    $attributes = array('tagName' => 'section', 'className' => $class);
    if ($anchor) $attributes['anchor'] = $anchor;
    return '<!-- wp:group ' . wp_json_encode($attributes) . ' -->' . "\n<section" . ($anchor ? ' id="' . esc_attr($anchor) . '"' : '') . ' class="wp-block-group ' . esc_attr($class) . '">' . $content . "</section>\n<!-- /wp:group -->\n";
}

function kihiro_story_initial_content($copy) {
    $intro = kihiro_story_paragraphs($copy['intro']);
    $intro .= '<!-- wp:paragraph {"className":"story-editorial-note"} --><p class="story-editorial-note">' . esc_html($copy['editorial_note']) . '</p><!-- /wp:paragraph -->';
    $content = kihiro_story_group('story-intro', $intro);
    $nav = '<nav class="story-chapters-nav" aria-label="Storyの章"><ol>';
    foreach ($copy['chapters'] as $index => $chapter) {
        $nav .= '<li><a href="#chapter-' . ($index + 1) . '">' . sprintf('%02d', $index + 1) . ' — ' . esc_html($chapter['keyword']) . '</a></li>';
    }
    $content .= "<!-- wp:html -->\n" . $nav . "</ol></nav>\n<!-- /wp:html -->\n";
    foreach ($copy['chapters'] as $index => $chapter) {
        $body = '<!-- wp:paragraph {"className":"story-chapter__meta"} --><p class="story-chapter__meta">' . sprintf('%02d', $index + 1) . ' — ' . esc_html($chapter['keyword']) . ' / ' . esc_html($chapter['period']) . '</p><!-- /wp:paragraph -->';
        $body .= '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html($chapter['title']) . '</h2><!-- /wp:heading -->';
        foreach ($chapter['events'] as $event) {
            $body .= '<!-- wp:heading {"level":3,"className":"story-event__heading"} --><h3 class="wp-block-heading story-event__heading">' . esc_html($event['date']) . '<br>' . esc_html($event['title']) . '</h3><!-- /wp:heading -->';
            $body .= kihiro_story_paragraphs($event['paragraphs']);
        }
        $quote = $chapter['quote'];
        $source = $copy['sources'][$quote['source']];
        $body .= '<!-- wp:quote {"className":"story-quote"} --><blockquote class="wp-block-quote story-quote">' . kihiro_story_paragraphs(array($quote['text'])) . '<cite><a href="' . esc_url($source['url']) . '">' . esc_html($source['date'] . '｜' . $source['title']) . '</a></cite></blockquote><!-- /wp:quote -->';
        $related = '<aside class="story-related" aria-label="この章の出典記事"><h3>この章の出典記事</h3><ul>';
        foreach ($chapter['references'] as $id) {
            $source = $copy['sources'][$id];
            $related .= '<li><a href="' . esc_url($source['url']) . '"><time datetime="' . esc_attr($source['date']) . '">' . esc_html($source['date']) . '</time>' . esc_html($source['title']) . '</a></li>';
        }
        $body .= '<!-- wp:html -->' . $related . '</ul></aside><!-- /wp:html -->';
        $content .= kihiro_story_group('story-chapter', $body, 'chapter-' . ($index + 1));
    }
    return $content . kihiro_story_group('story-ending', kihiro_story_paragraphs($copy['ending']));
}

function kihiro_create_story_pages($status = 'draft') {
    if (!in_array($status, array('draft', 'publish'), true)) return new WP_Error('story_status', 'ページ状態が不正です。');
    $parent = get_page_by_path('story', OBJECT, 'page');
    if ($parent && get_page_template_slug($parent) !== 'page-story-index.php') return new WP_Error('story_exists', '/story/ に既存のページがあります。既存ページを確認してください。');
    if (!$parent) {
        $id = wp_insert_post(array('post_type' => 'page', 'post_status' => $status, 'post_title' => 'Story', 'post_name' => 'story', 'post_content' => kihiro_story_paragraphs(array('日々の記録をつなぎ、ひとつの物語へ。', '過去の出来事と、そのとき考えたこと。変化の道のりを、ここにまとめていきます。')), 'post_excerpt' => '日々のBlogから編み直した、仕事・技術・生活の物語。', 'page_template' => 'page-story-index.php'), true);
        if (is_wp_error($id)) return $id;
        $parent = get_post($id);
    }
    $child = get_page_by_path('story/100-days', OBJECT, 'page');
    if ($child && get_page_template_slug($child) !== 'page-story.php') return new WP_Error('story_child_exists', '/story/100-days/ に既存のページがあります。上書きは行いません。');
    if (!$child) {
        $copy = require get_template_directory() . '/content/story-100-days.php';
        $id = wp_insert_post(array('post_type' => 'page', 'post_status' => $status, 'post_parent' => $parent->ID, 'post_title' => $copy['title'], 'post_name' => '100-days', 'post_excerpt' => $copy['summary'], 'post_content' => kihiro_story_initial_content($copy), 'page_template' => 'page-story.php', 'meta_input' => array('_kihiro_story_start' => $copy['start'], '_kihiro_story_end' => $copy['end'])), true);
        if (is_wp_error($id)) return $id;
        $child = get_post($id);
    }
    return array('index' => $parent->ID, 'story' => $child->ID);
}

function kihiro_story_setup_menu() {
    add_management_page('Storyのセットアップ', 'Storyのセットアップ', 'manage_options', 'kihiro-story', 'kihiro_story_setup_screen');
}
add_action('admin_menu', 'kihiro_story_setup_menu');

function kihiro_story_setup_screen() {
    if (!current_user_can('manage_options')) return;
    echo '<div class="wrap"><h1>Storyのセットアップ</h1><p>Story一覧と100日Storyを下書きで作成します。既存の本文は上書きしません。</p>';
    if (isset($_POST['kihiro_create_story'])) {
        check_admin_referer('kihiro_create_story');
        $result = kihiro_create_story_pages();
        if (is_wp_error($result)) echo '<p>' . esc_html($result->get_error_message()) . '</p>';
        else foreach ($result as $id) printf('<p><a href="%s">%sを編集</a></p>', esc_url(get_edit_post_link($id)), esc_html(get_the_title($id)));
    }
    echo '<form method="post">';
    wp_nonce_field('kihiro_create_story');
    submit_button('初期ページを作成', 'primary', 'kihiro_create_story');
    echo '</form><p>内容を確認し、親・子ページの両方を公開するとナビゲーションにStoryが表示されます。</p><p>次のStoryは新しい固定ページを作り、親をStory、テンプレートを「Story — 本編」に設定してください。</p><p>初期Storyの出典リンクは各章末のHTMLブロックで編集できます。関連記事を追加する場合はショートコードも使えます。例：<code>[story_related_posts ids="123,456"]</code>（最大5件、公開済みの投稿のみ）</p></div>';
}
