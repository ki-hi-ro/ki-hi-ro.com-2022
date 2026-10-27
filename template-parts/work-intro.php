<?php
$services_page = kihiro_services_page();
if (!$services_page) return;
$case_index = kihiro_case_study_index();
$experiences = kihiro_work_experiences();
$about_page = get_page_by_path('about');
$experience_url = $about_page && 'publish' === $about_page->post_status ? get_permalink($about_page) : '';
?>
<div class="work-home">
  <section class="work-hero" aria-labelledby="work-intro-heading">
    <p class="magazine-eyebrow">PYTHON / BUSINESS AUTOMATION</p>
    <h2 id="work-intro-heading"><span><span>Excel・CSVの</span><span>手作業を減らす</span></span><span>仕組みをつくります。</span></h2>
    <p class="work-hero__lead">毎月繰り返すデータの整形・集計・突合を、Pythonで効率化。</p>
    <p class="work-hero__lead">手作業にかかる時間を減らし、本来の業務に集中できる環境づくりをお手伝いします。</p>
    <div class="work-home__actions">
      <a class="work-home__button work-home__button--primary" href="<?php echo esc_url(home_url('/contact-us/')); ?>">仕事について相談する</a>
      <a class="work-home__button" href="#work-projects">私が取り組んできたこと <span aria-hidden="true">↓</span></a>
    </div>
    <p class="work-hero__note">要件が固まっていなくても構いません。対応可否とお見積もりをメールでご案内します。</p>
    <nav class="work-home__nav" aria-label="トップページの案内"><a href="#work-services">ご相談できること</a><a href="#work-projects">私の経験</a><a href="#work-profile">自己紹介</a><a href="<?php echo esc_url(kihiro_journal_url()); ?>">日々のジャーナル</a></nav>
  </section>

  <section class="work-home__section" id="work-services" aria-labelledby="work-services-heading">
    <header class="work-home__heading"><p class="magazine-eyebrow">HOW I CAN HELP</p><h2 id="work-services-heading">課題が、言葉になっていなくても。</h2><p>特定の技術や作業を決める前に、現場の状況から一緒に考えます。</p></header>
    <div class="work-services-grid">
      <article class="work-service"><span class="work-service__number" aria-hidden="true">01</span><h3>課題を整理する</h3><p>何に時間がかかり、どこで困っているのか。作業の流れや既存の資料・システムを確認し、目指す状態と改善する範囲を整理します。</p><details><summary>ご相談の進め方</summary><p>現在の手順、お困りごと、変えたいことを伺います。仕様や解決方法が決まっていなくても構いません。確認すべきことから一緒に整理します。</p></details></article>
      <article class="work-service"><span class="work-service__number" aria-hidden="true">02</span><h3>必要な仕組みをつくる</h3><p>整理した課題に合わせて、必要な機能や処理を具体化します。既存環境や使う方の手順に合わせ、実装と動作確認を進めます。</p><details><summary>ご相談の進め方</summary><p>対応内容・成果物・確認方法を相談し、費用と納期に合意してから着手します。私の経験で対応できることと、追加の確認が必要なことをお伝えします。</p></details></article>
      <article class="work-service"><span class="work-service__number" aria-hidden="true">03</span><h3>いまある仕組みを改善する</h3><p>不具合や使いにくさ、移行に伴う問題を、既存の仕様とデータから確認します。影響範囲を確かめながら、必要な修正と検証に取り組みます。</p><details><summary>ご相談の進め方</summary><p>データ、設定、処理の流れなどを分けて原因を調べます。既存の仕組みを生かせるか、新しくする必要があるかも含めて確認します。</p></details></article>
    </div>
    <p class="work-home__more"><a href="<?php echo esc_url(get_permalink($services_page)); ?>">進め方・料金について見る <span aria-hidden="true">→</span></a></p>
  </section>

  <?php get_template_part('template-parts/work-reasons'); ?>

  <?php if ($experience_url) : ?>
  <section class="work-home__section" id="work-projects" aria-labelledby="work-projects-heading">
    <header class="work-home__heading"><p class="magazine-eyebrow">MY EXPERIENCE</p><h2 id="work-projects-heading">私が現場で、向き合ってきた課題。</h2><p>実際の業務で経験した課題と、私が担当した対応内容をご紹介します。</p></header>
    <div class="work-projects-grid">
      <?php foreach (array('etl', 'api', 'bi') as $key) : $experience = $experiences[$key]; ?>
      <article class="work-project work-project--experience">
        <p class="work-project__label"><?php echo esc_html($experience['period']); ?> ／ 実務経験</p>
        <h3><a href="<?php echo esc_url($experience_url . '#experience-' . $key); ?>"><?php echo esc_html($experience['title']); ?></a></h3>
        <p class="work-project__summary"><?php echo esc_html($experience['approach']); ?></p>
        <p class="work-project__technology"><?php echo esc_html($experience['tech']); ?></p>
        <a class="work-project__link" href="<?php echo esc_url($experience_url . '#experience-' . $key); ?>">私の担当範囲・進め方を見る <span aria-hidden="true">→</span></a>
      </article>
      <?php endforeach; ?>
    </div>
    <div class="work-home__experience-links"><a href="<?php echo esc_url($experience_url . '#work-experience'); ?>">Web制作・保守・仕様書改版を含む6つの経験を見る →</a><?php if ($case_index) : ?><a href="<?php echo esc_url(get_permalink($case_index)); ?>">公開できる成果物・開発事例を見る →</a><?php endif; ?></div>
  </section>
  <?php endif; ?>

  <?php get_template_part('template-parts/work-help-articles'); ?>

  <section class="work-profile" id="work-profile" aria-labelledby="work-profile-heading">
    <div><p class="magazine-eyebrow">ABOUT</p><h2 id="work-profile-heading">柴田 浩貴</h2><p class="work-profile__role">WEBエンジニア</p></div>
    <div><p>Web制作、データ処理の移行、API開発、システム保守などを経験してきました。既存の仕組みや仕様を読み解き、確認しながら改善を進めることを大切にしています。日々の試行錯誤も、このブログに残しています。</p><div class="work-home__profile-links"><?php $about_page = get_page_by_path('about'); if ($about_page && 'publish' === $about_page->post_status) : ?><a href="<?php echo esc_url(get_permalink($about_page)); ?>">自己紹介を読む →</a><?php endif; ?><a href="<?php echo esc_url(kihiro_journal_url()); ?>">日々のジャーナルを読む →</a></div></div>
  </section>

  <section class="work-home-contact" aria-labelledby="work-contact-heading"><h2 id="work-contact-heading">まずは、今のお困りごとから。</h2><p>「この作業を減らしたい」「この機能をつくりたい」。<br>要件を確認して、対応可否と個別のお見積もりをご案内します。</p><a class="work-home__button work-home__button--primary" href="<?php echo esc_url(home_url('/contact-us/')); ?>">メールでの相談へ進む <span aria-hidden="true">→</span></a><p class="work-home-contact__note">フォームからお送りいただき、メールでやりとりします。</p></section>
</div>
