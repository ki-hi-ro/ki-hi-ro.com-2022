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
    <p class="magazine-eyebrow">個人事業主・Webエンジニア / 柴田浩貴</p>
    <h2 id="work-intro-heading"><span>自分自身を<i class="work-hero__punctuation">、</i></span><span>更新し続ける<i class="work-hero__punctuation">。</i></span></h2>
    <p class="work-hero__statement"><strong>活動の記録から、仕事とサービスが育つ場所。</strong><br>考えたこと、現場で経験したこと、技術でつくったもの。<br>その積み重ねを、新しい仕事と自分のサービスにつなげていきます。</p>
    <p class="work-hero__lead">思想・経験・技術を、ひとつながりに。<br>学び、試し、つくる過程を、毎日ここに残しています。</p>
    <div class="work-home__actions">
      <a class="work-home__button work-home__button--primary" href="<?php echo esc_url(kihiro_journal_url()); ?>">活動の記録を読む <span aria-hidden="true">→</span></a>
      <a class="work-home__button" href="#work-opportunities">仕事とサービスへの取り組み <span aria-hidden="true">→</span></a>
    </div>
  </section>

  <?php get_template_part('template-parts/recent-journal'); ?>

  <section class="work-profile" id="work-profile" aria-labelledby="work-profile-heading">
    <div><p class="magazine-eyebrow">ABOUT</p><h2 id="work-profile-heading">柴田 浩貴</h2><p class="work-profile__role">個人事業主 / Webエンジニア</p></div>
    <div><p>自分の考えを言葉にし、現場の経験から学び、技術で形にする。その往復を大切にしています。Web制作、データ処理の移行、API開発、システム保守の経験を土台に、業務委託の仕事と自分のサービス開発に取り組んでいます。</p><div class="work-home__profile-links"><?php $about_page = get_page_by_path('about'); if ($about_page && 'publish' === $about_page->post_status) : ?><a href="<?php echo esc_url(get_permalink($about_page)); ?>">自己紹介を読む →</a><?php endif; ?><a href="<?php echo esc_url(kihiro_journal_url()); ?>">日々のジャーナルを読む →</a></div></div>
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


  <section class="work-home__section work-opportunities" id="work-opportunities" aria-labelledby="work-opportunities-heading">
    <header class="work-home__heading"><p class="magazine-eyebrow">WORK &amp; BUILD</p><h2 id="work-opportunities-heading">記録を、次の仕事とサービスへ。</h2><p>日々の気づきや試行錯誤を、誰かの課題を解決する仕事と、自分でつくるサービスにつなげています。</p></header>
    <div class="work-opportunities__grid">
      <article class="work-opportunity">
        <p class="magazine-eyebrow">WORK TOGETHER</p><h3>経験と技術を、仕事に生かす。</h3>
        <p>Web制作・改修、Pythonによる業務自動化やデータ処理、API開発。既存の仕組みを読み解き、課題の整理から実装・確認まで取り組みます。</p>
        <p>業務委託での参画や、個別の開発・改善についてご相談ください。</p>
        <a href="<?php echo esc_url(get_permalink($services_page)); ?>">対応内容・ご依頼について見る <span aria-hidden="true">→</span></a>
      </article>
      <article class="work-opportunity">
        <p class="magazine-eyebrow">BUILD MY OWN</p><h3>日々の課題から、サービスをつくる。</h3>
        <p>自分が感じた不便や、現場で出会った課題を出発点に、サービス開発を進めています。考えたこと、試したこと、つくったものを記録し、次の改善へつなげます。</p>
        <p>開発の過程と公開できる成果物から、いまの取り組みをご覧いただけます。</p>
        <div class="work-opportunity__links"><a href="<?php echo esc_url(home_url('/articles/')); ?>">開発の記録を読む <span aria-hidden="true">→</span></a><?php if ($case_index) : ?><a href="<?php echo esc_url(get_permalink($case_index)); ?>">成果物を見る <span aria-hidden="true">→</span></a><?php endif; ?></div>
      </article>
    </div>
  </section>

  <section class="work-home-contact" aria-labelledby="work-contact-heading"><h2 id="work-contact-heading"><span class="work-home-contact__phrase">まずは、</span><span class="work-home-contact__phrase">今のお困りごとから。</span></h2><p><span class="work-home-contact__phrase">「この作業を減らしたい」</span><span class="work-home-contact__phrase">「この機能をつくりたい」。</span><br><span class="work-home-contact__phrase">要件を確認して、</span><span class="work-home-contact__phrase">対応可否と個別のお見積もりを</span><span class="work-home-contact__phrase">ご案内します。</span></p><a class="work-home__button work-home__button--primary" href="<?php echo esc_url(home_url('/contact-us/')); ?>">メールでの相談へ進む <span aria-hidden="true">→</span></a><p class="work-home-contact__note">フォームからお送りいただいた後、メールを中心に、必要に応じてWeb会議も交えてお話を伺います。</p></section>
</div>
