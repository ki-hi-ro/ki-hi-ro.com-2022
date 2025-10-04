<a class="all-article__post-wrap" href="<?php the_permalink(); ?>">
    <div class="all-article__date">
        <?php echo get_the_date('Y.m.d'); ?>（更新日: <?php echo get_the_modified_date('Y.m.d'); ?>）
    </div>
    <div class="all-article__ttl">
        <?php echo esc_html(get_the_title()); ?>
    </div>

    <!-- <?php if (has_post_thumbnail()): ?>
        <div class="all-article__thumb">
            <?php the_post_thumbnail('large'); ?>
        </div>
    <?php endif; ?> -->

    <div class="all-article__desc">
        <?php echo esc_html(get_the_excerpt()); ?>
    </div>
</a>

<style>
/* 全体のカード */
.all-article__post-wrap {
  display: block;
  /* margin-bottom: 40px; */
  padding-bottom: 26px; 
  border-bottom: 1px solid #eee;
  text-decoration: none;
  color: inherit;
  transition: background 0.2s ease;
}

/* 日付 */
.all-article__date {
  font-size: 0.9rem;
  margin-bottom: 6px;
}

/* タイトル */
.all-article__ttl {
  font-size: 1.25rem;
  color: #337ab7;
  line-height: 1.5;
  margin-bottom: 12px;
}

/* サムネイル */
.all-article__thumb {
  margin-bottom: 12px;
  border-radius: 8px;
height: 300px;
}

.all-article__thumb img {
  display: block;
  transition: transform 0.3s ease;
  height: 100%;
  width: auto;
  object-fit: contain;
}

/* ディスクリプション */
.all-article__desc {
  font-size: 1rem;
  line-height: 1.8;
  display: -webkit-box;
  -webkit-line-clamp: 3; /* PCでは3行で省略 */
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}

/* スマホ対応 */
@media (max-width: 768px) {
  .all-article__desc {
    -webkit-line-clamp: 5; /* スマホは5行に拡張 */
  }
}
</style>