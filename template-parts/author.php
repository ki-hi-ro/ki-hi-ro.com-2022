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
    <p class="author-text">自分のパフォーマンスを最大限に出せる時間帯と場所で働きたいと思ったため、フリーランスのWEB制作エンジニアになりました。2019年末にTECH::EXPERTを受講し、現在はWEB制作会社の担当者の方から定期的に仕事のご依頼を受けています。</p>
  </div>
  <div class="more-link --top-sec">
    <a href="<?php echo home_url('self-produce'); ?>">自己紹介<img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/arrow-right.svg" /></a>
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
    margin-bottom: 0;
  }
  @media (min-width: 768px) {
    .author-card {
      width: 100%;
      max-width: 100%;
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