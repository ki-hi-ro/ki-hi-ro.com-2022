<div class="pc-right-container">    
    <!-- 検索ボックス -->
    <?php get_template_part('template-parts/search-form'); ?>
    
    <?php
    global $wp_query;
    $rendered_article_count = isset($GLOBALS['article_list_rendered_count'])
        ? (int) $GLOBALS['article_list_rendered_count']
        : (isset($wp_query) ? min(24, (int) $wp_query->post_count) : 0);
    $sidebar_random_count = $rendered_article_count > 0
        ? (int) ceil($rendered_article_count / 5) + 1
        : 0;
    ?>

    <?php if ($sidebar_random_count > 0) : ?>
        <section class="sidebar-random-content" aria-labelledby="sidebar-random-content-title">
            <h2 id="sidebar-random-content-title">ランダム</h2>
            <div class="sidebar-random-content__list">
                <?php for ($random_index = 1; $random_index <= $sidebar_random_count; $random_index++) : ?>
                    <?php get_template_part('template-parts/random-insert', null, ['insert_index' => $random_index + 99]); ?>
                <?php endfor; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- 年月 -->
    <div class="archive-sidebar">
        <h2>年月</h2>
        <ul class="archive-list">
            <?php
            $archives_by_year = kihiro_get_archive_months();

            foreach ($archives_by_year as $year => $months) {
                echo '<li class="archive-year-item">';
                echo '<details class="archive-year" open>';
                echo '<summary>' . esc_html(sprintf('%d年', $year)) . '</summary>';
                echo '<ul class="archive-month-list">';

                foreach (array_unique($months) as $month) {
                    $url = get_month_link($year, $month);
                    echo '<li><a href="' . esc_url($url) . '">' . esc_html(sprintf('%d月', $month)) . '</a></li>';
                }

                echo '</ul>';
                echo '</details>';
                echo '</li>';
            }
            ?>
        </ul>
    </div>

</div>
