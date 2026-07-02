<article class="journal-entry">
  <a class="journal-entry__link" href="<?php the_permalink(); ?>">
    <time class="journal-entry__time" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
      <?php echo esc_html(get_the_date('H:i')); ?>
    </time>
    <span class="journal-entry__body">
      <span class="journal-entry__title"><?php echo esc_html(get_the_title()); ?></span>
    </span>
    <span class="journal-entry__arrow" aria-hidden="true">&rsaquo;</span>
  </a>
</article>
