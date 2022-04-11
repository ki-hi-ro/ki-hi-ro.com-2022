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
            <?php the_field('text'); ?>
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
    margin-left: 20px;
    margin-top: 60px;
  }
  .single h3 {
    border-left: 9px solid #000;
    margin-left: 20px;
    margin-top: 60px;
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
    margin-right: 40px;
    margin-bottom: 40px;
    margin-top: 0;
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
</style>

<?php get_footer(); ?>