<?php
/**
 * Text-only list of past posts.
 */

$trail_query = new WP_Query(
    array(
        'post_type'              => 'post',
        'posts_per_page'         => -1,
        'orderby'                => 'date',
        'order'                  => 'DESC',
        'post__not_in'           => kihiro_excluded_post_ids(),
        'ignore_sticky_posts'    => true,
        'no_found_rows'          => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
    )
);
$trail_year = '';
?>

<section class="outer-container thought-trail" aria-labelledby="thought-trail-title">
  <div class="thought-trail__header">
    <p class="section-kicker">Thought trail</p>
    <h1 id="thought-trail-title">思考の軌跡</h1>
    <p><?php echo esc_html($trail_query->post_count); ?>件の記事を、日付とタイトルだけでたどるページ。</p>
  </div>

  <div class="thought-trail__list">
    <?php if ($trail_query->have_posts()) : ?>
      <?php while ($trail_query->have_posts()) : $trail_query->the_post(); ?>
        <?php $current_year = get_the_date('Y'); ?>
        <?php if ($trail_year !== $current_year) : ?>
          <?php if ('' !== $trail_year) : ?>
            </ol>
          <?php endif; ?>
          <h2><?php echo esc_html($current_year); ?></h2>
          <ol>
          <?php $trail_year = $current_year; ?>
        <?php endif; ?>

        <li>
          <a href="<?php the_permalink(); ?>">
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
            <span><?php echo esc_html(get_the_title()); ?></span>
          </a>
        </li>
      <?php endwhile; ?>
      </ol>
    <?php else : ?>
      <p>記事はまだありません。</p>
    <?php endif; ?>
  </div>
</section>

<?php wp_reset_postdata(); ?>
