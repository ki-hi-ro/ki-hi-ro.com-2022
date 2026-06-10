<div class="all-article__post-wrap">
    <div class="all-article__main">
      <div class="all-article__text-wrap">
        <a class="all-article__href" href="<?php the_permalink(); ?>">
          <div class="all-article__text">
            <div class="all-article__date"><?php echo get_the_date('Y.m.d'); ?>（更新日: <?php echo get_the_modified_date('Y.m.d'); ?>）</div>
            <div class="all-article__ttl"><?php the_title(); ?></div>
            </div>
          </div>
        </a>
      </div>
</div>