<section class="front-sec --mb-adjust">
  <h2 class="front-sec__ttl">過去の記事</h2>
  <div class="archive-accordion">
    <?php
    function display_archive_accordion( $year, $open_years = array() ) {
        $is_open = in_array($year, $open_years);
        echo "<div class='accordion-item'>";
        echo "<button class='accordion-header' data-year='{$year}'>";
        echo "{$year}年 <span class='icon'>" . ($is_open ? "×" : "+") . "</span>";
        echo "</button>";
        echo "<div class='accordion-content' id='accordion-content-{$year}' style='display: " . ($is_open ? "block" : "none") . ";'>";

        $filter_function = function ( $where ) use ( $year ) {
            return $where . " AND YEAR(post_date) = {$year}";
        };

        add_filter( 'getarchives_where', $filter_function );
        wp_get_archives(
            array(
                'type'            => 'monthly',
                'show_post_count' => true,
                'year'            => $year,
            )
        );
        remove_filter( 'getarchives_where', $filter_function );

        echo "</div>";
        echo "</div>";
    }

    $latest_year = date('Y');
    $open_years = array();
    if ($latest_year >= 2025) {
        $open_years[] = 2025;
    }
    $open_years[] = 2024;

    for ($year = $latest_year; $year >= 2022; $year--) {
        display_archive_accordion($year, $open_years);
    }
    ?>
  </div>
</section>