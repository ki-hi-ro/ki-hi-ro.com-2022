<div class="pc-right-container">
    <!-- <nav class="archive-sidebar" id="archive-map" aria-labelledby="archive-map-title">
        <h2 id="archive-map-title">年月</h2>
        <ul class="archive-list">
            <?php
            $archives_by_year = kihiro_get_archive_months();
            $current_year     = (int) get_query_var('year');
            $first_year       = $archives_by_year ? (int) array_key_first($archives_by_year) : 0;
            $open_year        = $current_year ?: $first_year;

            foreach ($archives_by_year as $year => $months) {
                $year = (int) $year;

                echo '<li class="archive-year-item">';
                echo '<details class="archive-year"' . ($year === $open_year ? ' open' : '') . '>';
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
    </nav> -->
</div>
