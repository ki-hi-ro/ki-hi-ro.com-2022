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
    <p class="magazine-eyebrow">個人事業主・柴田浩貴</p>
    <h2 id="work-intro-heading"><span>自分自身を<i class="work-hero__punctuation">、</i></span><span>更新し続ける<i class="work-hero__punctuation">。</i></span></h2>
    <p class="work-hero__statement">日々、いろんな現実に触れるたび、<br>過去の正解が、正解ではなくなる。<br>だからこそ、考え、試し、自分を更新していきます。</p>
    <p class="work-hero__lead">その過程を、毎日ブログに。<br>人との対話を、新しい仕事のきっかけに。</p>
    <div class="work-home__actions">
      <a class="work-home__button work-home__button--primary" href="<?php echo esc_url(home_url('/contact-us/')); ?>">仕事について相談する</a>
      <a class="work-home__button" href="<?php echo esc_url(kihiro_journal_url()); ?>">毎日更新のブログを読む <span aria-hidden="true">→</span></a>
    </div>
    <p class="work-hero__note">まだ具体的になっていないことも、お聞かせください。メールでお話を伺います。</p>
    <nav class="work-home__nav" aria-label="トップページの案内"><a href="#work-projects">私の経験</a><a href="#work-profile">自己紹介</a><a href="<?php echo esc_url(kihiro_journal_url()); ?>">日々のジャーナル</a></nav>
  </section>

  <?php get_template_part('template-parts/recent-journal'); ?>

  <section class="work-profile" id="work-profile" aria-labelledby="work-profile-heading">
    <div><p class="magazine-eyebrow">ABOUT</p><h2 id="work-profile-heading">柴田 浩貴</h2><p class="work-profile__role">個人事業主 / Webエンジニア</p></div>
    <div><p>Web制作、データ処理の移行、API開発、システム保守などを経験してきました。既存の仕組みや仕様を読み解き、確認しながら改善を進めることを大切にしています。日々の試行錯誤も、このブログに残しています。</p><div class="work-home__profile-links"><?php $about_page = get_page_by_path('about'); if ($about_page && 'publish' === $about_page->post_status) : ?><a href="<?php echo esc_url(get_permalink($about_page)); ?>">自己紹介を読む →</a><?php endif; ?><a href="<?php echo esc_url(kihiro_journal_url()); ?>">日々のジャーナルを読む →</a></div></div>
  </section>

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

  <section class="work-home-contact" aria-labelledby="work-contact-heading"><h2 id="work-contact-heading">まずは、今のお困りごとから。</h2><p>「この作業を減らしたい」「この機能をつくりたい」。<br>要件を確認して、対応可否と個別のお見積もりをご案内します。</p><a class="work-home__button work-home__button--primary" href="<?php echo esc_url(home_url('/contact-us/')); ?>">メールでの相談へ進む <span aria-hidden="true">→</span></a><p class="work-home-contact__note">フォームからお送りいただいた後、メールを中心に、必要に応じてWeb会議も交えてお話を伺います。</p></section>
</div>
