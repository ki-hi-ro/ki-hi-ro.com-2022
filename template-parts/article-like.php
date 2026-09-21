<?php if (get_post_type() === 'post' && get_post_status() === 'publish' && !get_post()->post_password) : ?>
<section class="article-like" aria-label="この記事へのいいね" data-post-id="<?php echo esc_attr(get_the_ID()); ?>" data-endpoint="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
  <p>この記事がよかったら、いいねで応援してください。</p>
  <button type="button" class="article-like__button" aria-pressed="false" disabled>
    <span aria-hidden="true">♡</span> <span class="article-like__label">いいね</span> <span class="article-like__count">—</span>
  </button>
  <p class="article-like__status" role="status"></p>
  <noscript>いいねにはJavaScriptを有効にしてください。</noscript>
</section>
<?php endif; ?>
