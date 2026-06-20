<a class="all-article__post-wrap all-article__post-wrap--editorial" href="<?php the_permalink(); ?>">
  <div class="all-article__date-block">
    <div class="all-article__date">
      <?php echo get_the_date('Y.m.d'); ?>
    </div>
    <div class="all-article__modified">
      更新日：<?php echo get_the_modified_date('Y.m.d'); ?>
    </div>
  </div>

  <div class="all-article__content">
    <div class="all-article__ttl">
      <?php echo esc_html(get_the_title()); ?>
    </div>
  </div>

  <div class="all-article__arrow">
    &gt;
  </div>
</a>
