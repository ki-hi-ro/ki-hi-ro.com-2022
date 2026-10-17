<?php get_header(); ?>

<main id="main-content" class="journal-app journal-app--single">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <?php
      $post_tags       = get_the_tag_list('', ', ');
      ?>
      <article class="journal-panel journal-panel--single db-single">

        <p class="journal-single-date"><?php echo esc_html(kihiro_format_journal_date(new DateTimeImmutable(get_the_date('Y-m-d'), wp_timezone()))); ?> / <?php echo esc_html(get_the_date('H:i')); ?></p>
        <h1><?php echo esc_html(get_the_title()); ?></h1>
        <?php if (is_user_logged_in() && current_user_can('edit_post', get_the_ID())) : ?>
          <?php $edit_url = get_edit_post_link(get_the_ID(), 'raw'); ?>
          <?php if ($edit_url) : ?>
            <p class="article-edit"><a class="article-edit__link" href="<?php echo esc_url($edit_url); ?>">記事を編集</a></p>
          <?php endif; ?>
        <?php endif; ?>

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

        <?php if (has_post_thumbnail() && !post_password_required()) : ?>
          <figure class="article-featured-image">
            <?php the_post_thumbnail('full', array('loading' => 'eager', 'fetchpriority' => 'high', 'decoding' => 'async', 'sizes' => '(max-width: 900px) 100vw, 900px')); ?>
          </figure>
        <?php endif; ?>

        <div class="db-single__content">
          <?php the_content(); ?>
        </div>

        <?php get_template_part('template-parts/article-like'); ?>

        <?php if (comments_open() || get_comments_number()) : ?>
          <?php comments_template(); ?>
        <?php endif; ?>

        <?php
        $previous_post = get_previous_post();
        $next_post = get_next_post();
        ?>
        <?php if ($previous_post instanceof WP_Post || $next_post instanceof WP_Post) : ?>
          <nav class="article-navigation" aria-label="前後の記事">
            <?php if ($previous_post instanceof WP_Post) : ?>
              <a class="article-navigation__link article-navigation__link--previous" href="<?php echo esc_url(get_permalink($previous_post)); ?>" rel="prev">
                <span class="article-navigation__label"><span aria-hidden="true">&larr;</span> 前の記事</span>
                <span class="article-navigation__title"><?php echo esc_html(get_the_title($previous_post)); ?></span>
                <time datetime="<?php echo esc_attr(get_the_date('c', $previous_post)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $previous_post)); ?></time>
              </a>
            <?php endif; ?>
            <?php if ($next_post instanceof WP_Post) : ?>
              <a class="article-navigation__link article-navigation__link--next" href="<?php echo esc_url(get_permalink($next_post)); ?>" rel="next">
                <span class="article-navigation__label">次の記事 <span aria-hidden="true">&rarr;</span></span>
                <span class="article-navigation__title"><?php echo esc_html(get_the_title($next_post)); ?></span>
                <time datetime="<?php echo esc_attr(get_the_date('c', $next_post)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $next_post)); ?></time>
              </a>
            <?php endif; ?>
          </nav>
        <?php endif; ?>

      </article>
    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
