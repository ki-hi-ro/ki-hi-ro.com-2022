<?php /** Work-focused landing page; the journal has its own view. */ ?>
<main id="main-content" class="journal-discovery work-landing">
  <h1 class="screen-reader-text">柴田浩貴 — 相談から仕事をつくる個人事業主</h1>
  <?php if (is_user_logged_in() && current_user_can('edit_posts')) : ?>
    <div class="article-create"><a class="article-edit__link" href="<?php echo esc_url(kihiro_new_post_url()); ?>"><span aria-hidden="true">＋</span> 新規投稿</a></div>
  <?php endif; ?>
  <?php get_template_part('template-parts/work-intro'); ?>
</main>
