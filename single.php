<?php get_header(); ?>

<div class="author col-xs-12 calendar single-wrap" itemprop="author" itemscope itemtype="http://schema.org/Person">
  <h1><?php the_title(); ?></h1>
	<div class="author__contents">
    <?php if(have_posts()): ?>
      <?php while(have_posts()): the_post(); ?>
            <?php if( is_single('schedule') ) : ?>
              <p class="last-modified-date-time">最終更新日時は、<?php the_modified_date("Y年m月d日H時i分"); ?>です。</p>
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
  .single .author.col-xs-12 {
    width: 900px;
  }
  .single h2 {
    background: #f7f7f7;
    padding: 15px;
    color: #000;
    border-left: 6px solid #333;
    line-height: 40px;
    margin-left: 20px;
  }
  .single h3 {
    border-left: 9px solid #000;
    margin-left: 20px;
  }
  .single h4 {
    margin-left: 20px;
  }
  .single article ul {
    margin-top: 10px;
    margin-left: 20px;
  }
  .single ul li {
    color: #000;
  }
  @media (min-width: 768px) {
    .sp-img {
      display: none;
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