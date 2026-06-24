<a class="all-article__post-wrap" href="<?php the_permalink(); ?>">
  <div class="all-article__media">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('medium_large', array('class' => 'all-article__media-img', 'loading' => 'lazy')); ?>
    <?php else : ?>
      <span class="all-article__media-fallback" aria-hidden="true">
        <span class="all-article__media-orb"></span>
        <span class="all-article__media-line"></span>
        <span class="all-article__media-label">KIHIRO / NOTE</span>
      </span>
    <?php endif; ?>
  </div>

  <div class="all-article__date-block">
    <time class="all-article__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
      <?php echo get_the_date('Y.m.d'); ?>
    </time>
    <time class="all-article__modified" datetime="<?php echo esc_attr(get_the_modified_date('c')); ?>">
      更新日：<?php echo get_the_modified_date('Y.m.d'); ?>
    </time>
  </div>

  <div class="all-article__content">
    <div class="all-article__ttl">
      <?php echo esc_html(get_the_title()); ?>
    </div>
  </div>

  <div class="all-article__arrow" aria-hidden="true">
    →
  </div>
</a>
