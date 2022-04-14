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

<style>
  .single .nav-menu__ul {
    padding: 0;
    margin: 0;
  }
  .single h2 {
    background: #f7f7f7;
    padding: 15px;
    color: #000;
    border-left: 6px solid #333;
    line-height: 40px;
    margin: 60px 20px 40px;
  }
  .single h3 {
    border-left: 9px solid #000;
    margin-left: 20px;
    margin-top: 60px;
    margin-bottom: 40px;
    color: #333;
    font-weight: 600;
    letter-spacing: 1.6px;
    padding: 0px 15px 0px;
    font-size: 20px;
  }
  .single h4 {
    margin-left: 20px;
  }
  .single p {
    margin-bottom: 60px;
  }
  .single p a {
    text-decoration: none;
    font-weight: 600;
  }
  .single article ul {
    margin-top: 10px;
    margin-left: 20px;
  }
  .single ul li {
    color: #000;
  }
  .single pre {
    font-size: 17px;
    background-color: #fafafa;
    padding: 40px 25px;
    color: #5a5a5a;
    font-weight: 500;
    line-height: 1.5;
    outline: 1px solid #f0f0f0;
    border-color: #f0f0f0;
    text-align: left;
    margin: 0 20px 40px;
  }
  .single pre.ml-adjust {
    margin-left: 22px;
  }
  pre code {
    padding: 0;
    font-size: inherit;
    color: inherit;
    background-color: transparent;
    border-radius: 0;
    word-break: normal;
  }
  code {
    font-family: Menlo,Monaco,Consolas,"Courier New",monospace;
  }
  @media (max-width: 999px) and (min-width: 768px) {
    .author.calendar {
        width: 720px;
    }
  }
  @media (min-width: 768px) {
    .sp-img {
      display: none;
    }
    .single .author .wp-block-image.w-50 {
      width: 50%;
      margin: 0 auto;
    }
  }
  @media (min-width: 1024px) {
    .single .author.col-xs-12 {
      width: 900px;
    }
  }
  @media (max-width: 999px) and (min-width: 768px) {
    .header-nav {
      max-width: 720px;
    }
  }
  @media (max-width: 767px) {
    .single h1 {
      margin-top: 0;
    }
    .single h2 {
      margin-left: 0;
      margin-right: 0;
    }
    .single h3 {
      margin-left: 0;
      margin-right: 0;
    }
    .single h4 {
      margin-left: 0;
      margin-right: 0;
    }
    .single article ul {
      margin-left: 0;
    }
    .pc-img {
      display: none;
    }
    .single .author img {
      width: 75%;
    }
    .single pre.ml-adjust {
      margin-left: 0;
    }
  }
  @media (max-width: 500px) {
    .single h1 {
      margin-top: 38px;
    }
    .single .author img {
      width: 100%;
    }
  }
    @media (min-width: 992px) {
    .tb-form {
      display: none;
    }
  }
  @media (max-width: 991px) {
    .pc-form {
      display: none;
    }
  }
  @media (min-width: 768px) {
    .sp-form {
      display: none;
    }
  }
  @media (max-width: 767px) {
    .tb-form {
      display: none;
    }
  }
</style>

<?php get_footer(); ?>