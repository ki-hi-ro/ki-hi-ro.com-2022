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
            <h2>お問い合わせ</h2>
            <p>私は普段、HTML / CSS やWordPress、EC-CUBEなどを使用したコーディングをメインで行っています。</p>
          <p>WEBサイトの更新などでフリーランスのエンジニアをお探しの方は、ぜひお気軽に、<br>下記フォームからご連絡ください。</p>
          <iframe class="pc-form" src="https://docs.google.com/forms/d/e/1FAIpQLSc5ir6fbnFHcuVu0EZtuRBCGEVOp7hxcUlKKZyxfW-UsMF2jw/viewform?embedded=true" width="868" height="830" frameborder="0" marginheight="0" marginwidth="0">読み込んでいます…</iframe>
          <iframe class="tb-form" src="https://docs.google.com/forms/d/e/1FAIpQLSc5ir6fbnFHcuVu0EZtuRBCGEVOp7hxcUlKKZyxfW-UsMF2jw/viewform?embedded=true" width="690" height="830" frameborder="0" marginheight="0" marginwidth="0">読み込んでいます…</iframe>
          <iframe class="sp-form" src="https://docs.google.com/forms/d/e/1FAIpQLSc5ir6fbnFHcuVu0EZtuRBCGEVOp7hxcUlKKZyxfW-UsMF2jw/viewform?embedded=true" width="100%" height="700" frameborder="0" marginheight="0" marginwidth="0">読み込んでいます…</iframe>
        <?php endwhile; ?>
    <?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>