<?php if (get_post_type() === 'post' && get_post_status() === 'publish' && !get_post()->post_password) : ?>
<section class="article-like<?php echo isset($args['placement']) && $args['placement'] === 'title' ? ' article-like--title' : ''; ?>" aria-label="この記事へのいいね" data-post-id="<?php echo esc_attr(get_the_ID()); ?>" data-endpoint="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
  <div class="article-like__controls">
    <button type="button" class="article-like__button" aria-label="いいね" aria-pressed="false" disabled>
      <svg class="article-like__heart" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.8-8.6a5.5 5.5 0 0 0 0-7.8Z"/></svg>
    </button>
    <span class="article-like__count" aria-label="いいね数">—</span>
  </div>
  <p class="article-like__status" role="status"></p>
  <noscript>いいねにはJavaScriptを有効にしてください。</noscript>
</section>
<?php endif; ?>
