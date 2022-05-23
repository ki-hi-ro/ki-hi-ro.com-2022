<?php get_header(); ?>

<div class="author col-xs-12 calendar single-wrap" itemprop="author" itemscope itemtype="http://schema.org/Person">
  <h1><?php the_title(); ?>のお知らせ</h1>
	<div class="author__contents">
    <?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>
          <?php $minute = intval(date('i')); ?>
          <p class="last-modified-date-time">最終更新日時は、<?php the_modified_date("Y年n月j日 G時${minute}分"); ?>です。</p>

          <div class="g-callendar --pc">
            <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FTokyo&amp;showNav=1&amp;mode=WEEK&amp;showTabs=0&amp;showPrint=0&amp;showDate=0&amp;showCalendars=1&amp;showTz=0&amp;showTitle=0&amp;src=a2hpcm8yMTM4QGdtYWlsLmNvbQ&amp;color=%23039BE5" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>
          </div>

          <div class="g-callendar --sp">
            <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FTokyo&amp;showTabs=0&amp;showDate=1&amp;showPrint=0&amp;showTitle=0&amp;showNav=0&amp;showCalendars=0&amp;mode=AGENDA&amp;showTz=0&amp;src=a2hpcm8yMTM4QGdtYWlsLmNvbQ&amp;color=%23039BE5" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>
            <p>※safariで閲覧すると「私はロボットではありません」という表示が出て、カレンダーが表示されない現象が起こる場合があります。カレンダーを表示させるには、Chromeなどの別のブラウザでご覧いただくか、設定 &gt; Safariの「サイト越えトラッキングを防ぐ」の設定をOFFしてください。</p>
          </div>

          <p>「想定の1.5〜2倍の時間を取る」、「前後にバッファーを設ける」という2点を意識して、</p>
          <p>スケジュール内容に100%集中できるようにしていこうと思います。</p>

        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>

<?php get_footer(); ?>