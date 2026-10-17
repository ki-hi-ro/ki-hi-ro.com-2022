<?php
/** Article discussion using WordPress comment moderation and form handling. */
if (post_password_required()) return;
?>
<section id="comments" class="article-comments" aria-label="コメント">
  <?php if (have_comments()) : ?>
    <h2>コメント</h2>
    <ol class="comment-list">
      <?php wp_list_comments(array('style' => 'ol', 'short_ping' => true, 'avatar_size' => 40)); ?>
    </ol>
    <?php the_comments_pagination(array('prev_text' => '前へ', 'next_text' => '次へ')); ?>
  <?php endif; ?>
  <?php if (comments_open()) : ?>
    <?php comment_form(array('title_reply' => 'コメントを残す', 'label_submit' => 'コメントを送信')); ?>
  <?php elseif (get_comments_number()) : ?>
    <p>コメントの受付は終了しました。</p>
  <?php endif; ?>
</section>
