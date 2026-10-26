<?php
/** Template Name: CASE STUDY — 詳細 */
get_header(); ?>

<main id="main-content" class="journal-app journal-app--single case-detail">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <?php
      $post_tags       = get_the_tag_list('', ', ');
      ?>
      <article class="journal-panel journal-panel--single db-single">

        <p class="journal-single-date"><?php echo esc_html(get_the_date('Y年n月j日 G時i分')); ?></p>
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
            <dd><?php echo esc_html(get_the_modified_date('Y年n月j日 G時i分')); ?></dd>
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

        <?php $brief = array(); foreach (kihiro_case_brief_fields() as $key => $label) {
            $value = get_post_meta(get_the_ID(), '_kihiro_case_' . $key, true);
            if (is_string($value) && trim($value) !== '') $brief[$label] = $value;
        } ?>
        <?php if ($brief && !post_password_required()) : ?>
          <section class="case-brief" aria-label="開発事例の概要"><h2>開発事例の概要</h2><dl>
            <?php foreach ($brief as $label => $value) : ?><div><dt><?php echo esc_html($label); ?></dt><dd><?php echo nl2br(esc_html($value)); ?></dd></div><?php endforeach; ?>
          </dl></section>
        <?php endif; ?>
        <div class="db-single__content">
          <?php the_content(); ?>
        </div>

        <?php get_template_part('template-parts/work-inquiry'); ?>
      </article>
    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
