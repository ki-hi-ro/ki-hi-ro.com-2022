<a class="all-article__post-wrap" href="<?php the_permalink(); ?>">
    <div class="all-article__date">
        <?php echo get_the_date('Y.m.d'); ?>（更新日: <?php echo get_the_modified_date('Y.m.d'); ?>）
    </div>
    <div class="all-article__ttl">
      <?php echo esc_html(get_the_title()); ?>
    </div>
    <div class="pc-flex">
      <?php if (has_post_thumbnail()): ?>
        <div class="all-article__thumb">
          <?php the_post_thumbnail('large'); ?>
        </div>
      <?php endif; ?>
      <div class="all-article__desc">
          <?php echo esc_html(get_the_excerpt()); ?>
      </div>
    </div>
</a>