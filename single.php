<?php get_header(); ?>

<div class="author col-xs-12 calendar single-wrap" itemprop="author" itemscope itemtype="http://schema.org/Person">
  <h1><?php the_title(); ?></h1>
	<div class="author__contents">
    <?php if(have_posts()): ?>
      <?php while(have_posts()): the_post(); ?>
            <?php if( is_single('schedule') ) : ?>
              <?php
              $week_list = ['日','月','火','水','木','金','土'];
              $week_num = date('w');
              $today_week = $week_list[$week_num];
              $minute = intval(date('i'));
              ?>
              <p class="last-modified-date-time">最終更新日時は、<?php the_modified_date("Y年n月j日 ${today_week}曜日 G時${minute}分"); ?>です。</p>
            <?php endif; ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
    <?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>