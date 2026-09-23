<?php
/** Magazine landing page, using the normal paginated WordPress posts query. */
?>
<main id="main-content" class="magazine-home">
  <?php if (!is_paged()) : ?>
    <section class="magazine-hero" aria-labelledby="magazine-heading">
      <figure class="magazine-hero__photo">
        <img
          src="<?php
            $profile_image = '/assets/images/hiroki-shibata.jpg';
            echo esc_url(
              get_theme_file_uri($profile_image)
              . '?v='
              . filemtime(get_theme_file_path($profile_image))
            );
          ?>"
          width="4032"
          height="3024"
          alt="柴田浩貴のプロフィール写真"
          fetchpriority="high"
          decoding="async"
        >
      </figure>
      <div class="magazine-hero__copy">
        <p class="magazine-eyebrow">HIROKI SHIBATA / PERSONAL BLOG</p>
        <h1 id="magazine-heading"><span class="magazine-hero__role">自律型WEBクリエイター</span>柴田浩貴のブログ</h1>
        <p class="magazine-hero__statement">自分で考え、つくり、道をひらく。</p>
        <p class="magazine-hero__lead">WEB制作とAIの実践、日々の気づき。<br>試行錯誤しながら、自分の働き方と暮らしをつくる記録です。</p>
        <div class="magazine-hero__actions">
          <a class="magazine-text-link" href="#home-story">Storyを読む <span aria-hidden="true">→</span></a>
          <a class="magazine-text-link" href="#latest-stories">最近の記事 <span aria-hidden="true">↓</span></a>
        </div>
      </div>
    </section>
    <?php get_template_part('template-parts/index/home-story'); ?>
  <?php endif; ?>

  <section id="latest-stories" class="magazine-stories" aria-labelledby="latest-heading">
    <div class="magazine-section-heading">
      <div><p class="magazine-eyebrow">LATEST POSTS</p><?php $latest_heading_tag = is_paged() ? 'h1' : 'h2'; ?><<?php echo $latest_heading_tag; ?> id="latest-heading">最近の記事<?php if (is_paged()) : ?> <span class="magazine-page-label">/ <?php echo esc_html((string) get_query_var('paged')); ?>ページ目</span><?php endif; ?></<?php echo $latest_heading_tag; ?>></div>
      <a class="magazine-text-link" href="<?php echo esc_url(kihiro_all_articles_url()); ?>">すべての記事 <span aria-hidden="true">↗︎</span></a>
    </div>
    <div class="magazine-grid">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <?php get_template_part('template-parts/article-card', null, array('heading_tag' => 'h3')); ?>
        <?php endwhile; ?>
      <?php else : ?>
        <p class="journal-empty">まだ記事がありません。</p>
      <?php endif; ?>
    </div>
    <?php if (is_paged()) : ?>
      <?php the_posts_pagination(array('mid_size' => 1, 'prev_text' => '前へ', 'next_text' => '次へ')); ?>
    <?php endif; ?>
  </section>
  <a class="magazine-archive-note" href="<?php echo esc_url(kihiro_journal_date_url(kihiro_latest_post_date())); ?>" aria-labelledby="archive-heading">
    <span class="magazine-archive-note__icon" aria-hidden="true">
      <svg viewBox="0 0 32 32" fill="none"><rect x="5" y="7" width="22" height="21" rx="3"/><path d="M10 4v6m12-6v6M5 14h22M10 19h3m6 0h3m-12 5h3"/></svg>
    </span>
    <div class="magazine-archive-note__copy"><p class="magazine-eyebrow">ARCHIVE</p><h2 id="archive-heading">過去の記事</h2><p class="magazine-archive-note__description">投稿日から記事を探せます。</p></div>
    <span class="magazine-archive-note__action">日付で探す <span aria-hidden="true">→</span></span>
  </a>
</main>
