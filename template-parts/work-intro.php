<?php
$services_page = kihiro_services_page();
if (!$services_page) return;
?>
<div class="work-home">
  <section class="work-hero work-hero--business" aria-labelledby="work-intro-heading">
    <p class="magazine-eyebrow">個人事業主・Webエンジニア / 柴田浩貴</p>
    <h2 id="work-intro-heading"><span>小さな事業の、</span><span>WebとITをシンプルに。</span></h2>
    <p class="work-hero__statement">個人事業主・小規模事業者向けに、ホームページ制作や日々の業務を効率化する仕組みづくりをお手伝いします。</p>
    <p class="work-hero__lead">新しくつくることも、いまある仕組みを改善することも。<br>お困りごとを伺い、必要な対応を一緒に整理します。</p>
    <div class="work-home__actions">
      <a class="work-home__button work-home__button--primary" href="<?php echo esc_url(home_url('/contact-us/')); ?>">仕事の相談をする <span aria-hidden="true">→</span></a>
      <a class="work-home__button" href="#work-services">依頼できることを見る <span aria-hidden="true">→</span></a>
    </div>
  </section>
  <?php get_template_part('template-parts/recent-journal'); ?>

  <section class="work-profile" id="work-profile" aria-labelledby="work-profile-heading">
    <div><p class="magazine-eyebrow">ABOUT</p><h2 id="work-profile-heading">柴田 浩貴</h2><p class="work-profile__role">個人事業主 / Webエンジニア</p></div>
    <div><p>Web制作、データ処理の移行、API開発、システム保守などを経験してきました。既存の仕組みを読み解き、確認しながら改善することを大切にしています。「自分自身を、更新し続ける」という姿勢で、学びや日々の気づきもブログに記録しています。</p><div class="work-home__profile-links"><?php $about_page = get_page_by_path('about'); if ($about_page && 'publish' === $about_page->post_status) : ?><a href="<?php echo esc_url(get_permalink($about_page)); ?>">自己紹介を読む →</a><?php endif; ?><a href="<?php echo esc_url(kihiro_journal_url()); ?>">日々のジャーナルを読む →</a></div></div>
  </section>

  <section class="work-home__section" id="work-services" aria-labelledby="work-services-heading">
    <header class="work-home__heading"><p class="magazine-eyebrow">SERVICES</p><h2 id="work-services-heading">Web制作と業務自動化で、お手伝いします。</h2><p>事業の情報を届けるWebサイトと、日々の手間を減らす仕組み。いま必要なことからご相談ください。</p></header>
    <div class="work-opportunities__grid">
      <article class="work-opportunity"><p class="magazine-eyebrow">WEB</p><h3>ホームページをつくる・整える。</h3><p>事業やサービスを伝えるホームページの制作、WordPressの実装・改修、既存サイトの保守や不具合対応。使う方と運用する方の両方を考えて整えます。</p><a href="<?php echo esc_url(get_permalink($services_page)); ?>">お手伝いできることを見る →</a></article>
      <article class="work-opportunity"><p class="magazine-eyebrow">AUTOMATION</p><h3>繰り返す作業を、仕組みにする。</h3><p>Excel・CSVの集計や整形、データの照合・転記、Pythonによる自動化。現在の手順を確認し、手作業を減らせる範囲と進め方をご案内します。</p><a href="<?php echo esc_url(home_url('/contact-us/')); ?>">業務の困りごとを相談する →</a></article>
    </div>
  </section>

  <?php get_template_part('template-parts/work-selected-cases'); ?>

  <section class="work-home-contact" aria-labelledby="work-contact-heading"><h2 id="work-contact-heading"><span class="work-home-contact__phrase">まずは、</span><span class="work-home-contact__phrase">今のお困りごとから。</span></h2><p><span class="work-home-contact__phrase">「この作業を減らしたい」</span><span class="work-home-contact__phrase">「この機能をつくりたい」。</span><br><span class="work-home-contact__phrase">要件を確認して、</span><span class="work-home-contact__phrase">対応可否と個別のお見積もりを</span><span class="work-home-contact__phrase">ご案内します。</span></p><a class="work-home__button work-home__button--primary" href="<?php echo esc_url(home_url('/contact-us/')); ?>">仕事の相談をする <span aria-hidden="true">→</span></a><p class="work-home-contact__note">フォームからお送りいただいた後、メールを中心に、必要に応じてWeb会議も交えてお話を伺います。</p></section>
</div>
