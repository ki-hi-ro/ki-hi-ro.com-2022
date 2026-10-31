<?php /** Work-focused landing page; the journal has its own view. */ ?>
<main id="main-content" class="journal-discovery work-landing">
  <h1 class="screen-reader-text">柴田浩貴 — 相談から仕事をつくる個人事業主</h1>
  <?php if (is_user_logged_in()) : ?>
    <div class="journal-tools">
      <form class="journal-tools__search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <label class="screen-reader-text" for="journal-search">日々のジャーナルを検索</label>
        <input type="hidden" name="post_type" value="post">
        <input id="journal-search" type="search" name="s" placeholder="日々のジャーナルを検索" value="<?php echo esc_attr(get_search_query()); ?>" required>
        <button type="submit">検索</button>
      </form>
      <?php if (current_user_can('edit_posts')) : ?>
        <a class="article-edit__link" href="<?php echo esc_url(kihiro_new_post_url()); ?>"><span aria-hidden="true">＋</span> 新規投稿</a>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <?php get_template_part('template-parts/work-intro'); ?>
</main>
