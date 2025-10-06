<a class="all-article__post-wrap" href="<?php the_permalink(); ?>">
    <div class="all-article__date">
        <?php echo get_the_date('Y.m.d'); ?>（更新日: <?php echo get_the_modified_date('Y.m.d'); ?>）
    </div>
    <div class="all-article__ttl">
      <?php echo esc_html(get_the_title()); ?>
    </div>
    <div class="pc-flex">
      <div class="all-article__thumb">
        <?php if (has_post_thumbnail()): ?>
          <?php the_post_thumbnail('large'); ?>
        <?php else: ?>
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/no-image.png" alt="No image" />
        <?php endif; ?>
      </div>
      <div class="all-article__desc">
          <?php echo esc_html(get_the_excerpt()); ?>
      </div>
    </div>
</a>