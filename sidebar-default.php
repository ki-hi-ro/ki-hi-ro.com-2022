<div class="pc-right-container">
    <!-- 検索ボックス -->
    <?php get_template_part('template-parts/search-form'); ?>

    <!-- タグ一覧 -->
    <?php
    $common_names = require locate_template('template-parts/_tag-names.php');

    get_template_part('template-parts/tag-list', null, [
        'container_class' => 'tag-list-sidebar',
        'ul_class'        => 'front-sec__text front-sec__flex',
        'title_tag'       => 'h2',
        'title_text'      => 'タグ',
        'order_mode'      => 'custom',
        'custom_names'    => $common_names,
        'hide_empty'      => false,
    ]);
    ?>

    <!-- 年月 -->
    <div class="archive-sidebar">
        <h2>年月</h2>
        <ul class="archive-list">
            <?php
            global $wpdb;
            $results = $wpdb->get_results("
                SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month
                FROM $wpdb->posts
                WHERE post_type = 'post' AND post_status = 'publish'
                ORDER BY post_date DESC
            ");

            $shown_years = []; // すでに出力した年を記録

            if ($results) {
                foreach ($results as $r) {
                    $year  = (int) $r->year;
                    $month = (int) $r->month;

                    // 2022年以降 → 月別
                    if ($year > 2021) {
                        $url  = get_month_link($year, $month);
                        $text = sprintf('%d年%d月', $year, $month);
                        echo '<li><a href="' . esc_url($url) . '">' . esc_html($text) . '</a></li>';
                    }
                    // 2024年以前 → 年別（同じ年は1回だけ出力）
                    else {
                        if (!in_array($year, $shown_years, true)) {
                            $url  = get_year_link($year);
                            $text = sprintf('%d年', $year);
                            echo '<li><a href="' . esc_url($url) . '">' . esc_html($text) . '</a></li>';
                            $shown_years[] = $year; // 出力済みに追加
                        }
                    }
                }
            }
            ?>
        </ul>
    </div>

</div>
