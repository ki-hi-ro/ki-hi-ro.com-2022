<?php
/** Group the current page of published records by month and day. */
$months = array();
foreach ($args['entries'] ?? array() as $entry) {
    $month = get_the_date('Y-m', $entry);
    $day = get_the_date('Y-m-d', $entry);
    $months[$month][$day][] = $entry;
}
?>
<div class="journal-chronology__months">
  <?php foreach ($months as $month => $days) : ?>
    <?php $first = reset($days)[0]; ?>
    <section class="journal-chronology__month" aria-labelledby="journal-month-<?php echo esc_attr($month); ?>">
      <h2 id="journal-month-<?php echo esc_attr($month); ?>"><?php echo esc_html(get_the_date('Y年n月', $first)); ?></h2>
      <ol class="journal-chronology__days">
        <?php foreach ($days as $day => $entries) : ?>
          <li class="journal-chronology__day">
            <time class="journal-chronology__date" datetime="<?php echo esc_attr($day); ?>"><?php echo esc_html(get_the_date('n月j日', $entries[0])); ?><span><?php echo esc_html(get_the_date('l', $entries[0])); ?></span></time>
            <div class="journal-chronology__entries">
              <?php foreach ($entries as $entry) : ?>
                <?php
                $excerpt = $entry->post_excerpt ?: $entry->post_content;
                $excerpt = wp_html_excerpt(preg_replace('/\s+/u', ' ', wp_strip_all_tags(strip_shortcodes($excerpt))), 110, '…');
                $tags = get_the_tags($entry->ID);
                ?>
                <article class="journal-chronology__entry">
                  <h3><a href="<?php echo esc_url(get_permalink($entry)); ?>"><?php echo esc_html(get_the_title($entry)); ?></a></h3>
                  <?php if ($excerpt) : ?><p class="journal-chronology__excerpt"><?php echo esc_html($excerpt); ?></p><?php endif; ?>
                  <?php if ($tags) : ?>
                    <ul class="journal-chronology__tags" aria-label="記事のタグ">
                      <?php foreach ($tags as $tag) : ?>
                        <li><a href="<?php echo esc_url(add_query_arg(array('view' => 'archive-all', 'article_tag' => $tag->term_id), home_url('/'))); ?>"><?php echo esc_html($tag->name); ?></a></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                </article>
              <?php endforeach; ?>
            </div>
          </li>
        <?php endforeach; ?>
      </ol>
    </section>
  <?php endforeach; ?>
</div>
