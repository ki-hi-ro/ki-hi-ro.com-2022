<section
  class="author author-card sidebar__contents"
  itemprop="author"
  itemscope
  itemtype="http://schema.org/Person"
>
  <img
    src="<?php echo get_template_directory_uri(); ?>/assets/img/introduce/2022-04.png"
    class="img-responsive img-circle author__img"
  />
  <h4>
    <span itemprop="name">Shibata Hiroki</span>
  </h4>
  <hr />
  <div class="author__contents">
    <p class="author-text">
      2019年末にプログラミングスクールTECH::EXPERTを受講して以来、フリーランスとして、HTML
      / CSS, WordPress, EC-CUBE, FutureShopなどを使用して、Webサイトの新規制作や改修を行なってきました。
    </p>
  </div>
  <div class="more-link --top-sec">
    <a href="<?php echo home_url('#contact'); ?>">お問い合わせ<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg" /></a>
  </div>
</section>
<style>
  .author-card {
    padding-top: 26px;
    background-color: #f7f7f7;
  }
  .author__img {
    width: 130px;
    margin: 0 auto 20px;
  }
  .author-card h4 {
    text-align: center;
    font-family: "Avenir-Next";
    font-weight: 600;
    margin-top: 35px;
    font-size: 20px;
  }
  .author-card hr {
    border: 1px solid #ddd;
    width: 20%;
  }
  .author-text {
    color: #000;
    font-size: 16px;
    font-weight: 300;
    line-height: 1.8;
    padding: 0 20px;
    margin-top: 40px;
  }
  @media (min-width: 768px) {
    .author-card {
      width: 100%;
      max-width: 100%;
    }
    .author__contents {
        padding-bottom: 30px;
    }
  }
  @media (min-width: 1000px) {
    .author-card {
      margin-top: 50px;
      width: 370px;
    }
  }
  @media (max-width: 767px) {
    .author-card {
      padding-bottom: 20px;
    }
  }
</style>