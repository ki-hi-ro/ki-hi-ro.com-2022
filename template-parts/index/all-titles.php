<?php
/** All published article titles, from oldest to newest. */
global $wp_query;
$current_month = '';
?>
<main id="main-content" class="article-timeline all-article-titles">
  <header class="all-article-titles__header">
    <h1>すべての記事</h1>
    <p>公開日の古い順に、<?php echo esc_html(number_format_i18n(count($wp_query->posts))); ?>記事をたどれます。</p>
    <?php get_search_form(); ?>
  </header>
  <?php foreach ($wp_query->posts as $entry) : ?>
    <?php $month = get_the_date('Y-m', $entry); ?>
    <?php if ($month !== $current_month) : ?>
      <?php if ('' !== $current_month) : ?></ul></section><?php endif; ?>
      <section class="all-article-titles__month">
        <h2><?php echo esc_html(get_the_date('Y年n月', $entry)); ?></h2>
        <ul>
      <?php $current_month = $month; ?>
    <?php endif; ?>
      <li>
        <time datetime="<?php echo esc_attr(get_the_date('c', $entry)); ?>"><?php echo esc_html(get_the_date('n月j日', $entry)); ?></time>
        <a href="<?php echo esc_url(get_permalink($entry)); ?>"><?php echo esc_html(get_the_title($entry)); ?></a>
      </li>
  <?php endforeach; ?>
  <?php if ('' !== $current_month) : ?></ul></section><?php endif; ?>
</main>
