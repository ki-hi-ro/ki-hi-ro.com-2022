<?php
/** Template Name: CASE STUDY — 詳細 */
get_header(); ?>

<main id="main-content" class="journal-app journal-app--single case-detail article-detail-layout">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <?php
      $post_tags       = get_the_tag_list('', ', ');
      ?>
        <header class="article-detail-heading">
        <p class="journal-single-date"><?php echo esc_html(get_the_date('Y年n月j日 G時i分')); ?></p>
        <h1><?php echo esc_html(get_the_title()); ?></h1>
        <p class="article-updated-date">最終更新：<?php echo esc_html(get_the_modified_date('Y年n月j日 G時i分')); ?></p>
        </header>
      <?php if (current_user_can('manage_options')) : ?>
        <div class="article-edit article-edit--actions">
          <?php if (current_user_can('edit_post', get_the_ID())) : ?><a class="article-edit__link" href="<?php echo esc_url(get_edit_post_link(get_the_ID(), 'raw')); ?>">記事を編集</a><?php endif; ?>
        </div>
      <?php endif; ?>
      <?php get_template_part('template-parts/article-main-visual'); ?>
      <article class="journal-panel journal-panel--single db-single">


        <div class="db-single__content">
          <?php the_content(); ?>
        </div>

        <?php if ($post_tags) : ?><p class="article-end-tags">タグ：<?php echo wp_kses_post($post_tags); ?></p><?php endif; ?>

        <?php get_template_part('template-parts/work-inquiry'); ?>
      </article>
    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
