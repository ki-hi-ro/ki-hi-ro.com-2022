<?php get_header(); ?>

<main id="main-content" class="journal-app journal-app--single">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <?php
      $post_tags       = get_the_tag_list('', ', ');
      ?>
      <article class="journal-panel journal-panel--single db-single">
        <p class="db-back-link"><a href="<?php echo esc_url(kihiro_journal_date_url(get_the_date('Y-m-d'))); ?>">&lsaquo; 一覧へ戻る</a></p>

        <p class="journal-single-date"><?php echo esc_html(kihiro_format_journal_date(new DateTimeImmutable(get_the_date('Y-m-d'), wp_timezone()))); ?> / <?php echo esc_html(get_the_date('H:i')); ?></p>
        <h1><?php echo esc_html(get_the_title()); ?></h1>

        <dl class="db-single__fields">
          <div>
            <dt>最終更新</dt>
            <dd><?php echo esc_html(get_the_modified_date('Y.m.d')); ?></dd>
          </div>
          <?php if ($post_tags) : ?>
            <div>
              <dt>タグ</dt>
              <dd><?php echo wp_kses_post($post_tags); ?></dd>
            </div>
          <?php endif; ?>
        </dl>

        <div class="db-single__content">
          <?php the_content(); ?>
        </div>

        <p class="page-top">
          <a class="page-top__link" href="#page-top" aria-label="ページ上部へ戻る">
            <span aria-hidden="true">&uarr;</span>
          </a>
        </p>
      </article>
    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
