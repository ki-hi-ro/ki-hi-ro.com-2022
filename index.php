<?php get_header(); ?>

<?php
$selected_date  = kihiro_selected_journal_date();
$selected_ymd   = $selected_date->format('Y-m-d');
$month_start    = $selected_date->modify('first day of this month')->setTime(0, 0);
$calendar_start = $month_start->modify('-' . ((int) $month_start->format('N') - 1) . ' days');
$month_days     = kihiro_month_post_days((int) $selected_date->format('Y'), (int) $selected_date->format('n'));
$prev_month     = $month_start->modify('-1 month');
$next_month     = $month_start->modify('+1 month');
$day_posts      = kihiro_posts_for_journal_date($selected_ymd);
?>

<main class="journal-app">
  <aside class="journal-sidebar" aria-label="カレンダー">
    <div class="journal-month">
      <a class="journal-month__nav" href="<?php echo esc_url(kihiro_journal_date_url($prev_month->format('Y-m-01'))); ?>" aria-label="前の月へ">&lsaquo;</a>
      <h2 class="journal-month__title"><?php echo esc_html($selected_date->format('Y年n月')); ?></h2>
      <a class="journal-month__nav" href="<?php echo esc_url(kihiro_journal_date_url($next_month->format('Y-m-01'))); ?>" aria-label="次の月へ">&rsaquo;</a>
    </div>

    <div class="journal-calendar">
      <div class="journal-calendar__week">月</div>
      <div class="journal-calendar__week">火</div>
      <div class="journal-calendar__week">水</div>
      <div class="journal-calendar__week">木</div>
      <div class="journal-calendar__week">金</div>
      <div class="journal-calendar__week">土</div>
      <div class="journal-calendar__week">日</div>

      <?php for ($i = 0; $i < 42; $i++) : ?>
        <?php
        $cell_date      = $calendar_start->modify('+' . $i . ' days');
        $cell_ymd       = $cell_date->format('Y-m-d');
        $is_this_month  = $cell_date->format('Y-m') === $selected_date->format('Y-m');
        $is_selected    = $cell_ymd === $selected_ymd;
        $has_post       = $is_this_month && isset($month_days[(int) $cell_date->format('j')]);
        $day_classes    = array('journal-calendar__day');
        $day_classes[]  = $is_this_month ? 'is-current-month' : 'is-outside-month';

        if ($is_selected) {
            $day_classes[] = 'is-selected';
        }

        if ($has_post) {
            $day_classes[] = 'has-post';
        }
        ?>
        <a class="<?php echo esc_attr(implode(' ', $day_classes)); ?>" href="<?php echo esc_url(kihiro_journal_date_url($cell_ymd)); ?>" <?php echo $is_selected ? 'aria-current="date"' : ''; ?>>
          <span class="journal-calendar__number"><?php echo esc_html($cell_date->format('j')); ?></span>
          <?php if ($has_post) : ?>
            <span class="journal-calendar__dot" aria-label="記事がある日"></span>
          <?php endif; ?>
        </a>
      <?php endfor; ?>
    </div>

    <p class="journal-legend"><span aria-hidden="true"></span>記事がある日</p>

    <nav class="journal-nav" aria-label="表示切り替え">
      <a class="journal-nav__link" href="<?php echo esc_url(kihiro_journal_date_url(wp_date('Y-m-d'))); ?>">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M7 3v3m10-3v3M4 9h16M5 5h14v15H5z" />
        </svg>
        <span>今日</span>
      </a>
      <a class="journal-nav__link" href="<?php echo esc_url(kihiro_all_articles_url()); ?>">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M5 7h14M5 12h14M5 17h14" />
        </svg>
        <span>すべての記事</span>
      </a>
    </nav>

    <p class="journal-copyright">&copy; <?php echo esc_html(wp_date('Y')); ?> Euphoria</p>
  </aside>

  <section class="journal-panel" aria-label="記事一覧">
    <?php if (is_search()) : ?>
      <?php get_template_part('template-parts/index/search-results'); ?>
    <?php elseif (is_tag()) : ?>
      <?php get_template_part('template-parts/index/tag-archive'); ?>
    <?php elseif (kihiro_is_all_articles_view()) : ?>
      <?php get_template_part('template-parts/index/post-index'); ?>
    <?php else : ?>
      <header class="journal-panel__header">
        <h1 class="journal-date-title"><?php echo esc_html(kihiro_format_journal_date($selected_date)); ?></h1>
      </header>

      <div class="journal-list">
        <?php if ($day_posts) : ?>
          <?php foreach ($day_posts as $post) : ?>
            <?php setup_postdata($post); ?>
            <?php get_template_part('template-parts/blog-list'); ?>
          <?php endforeach; ?>
          <?php wp_reset_postdata(); ?>
        <?php else : ?>
          <p class="journal-empty">この日の記事はありません。</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </section>
</main>

<?php get_footer(); ?>
