<?php
$services_page = kihiro_services_page();
if (!$services_page) return;
$case_index = kihiro_case_study_index();
$home_cases = array();
foreach (array('excel-data-cleaner' => '業務自動化のサンプル', 'csv-update-detection' => '実務の処理を個人環境で再現', 'design-to-interactive-web-page' => 'Web制作の実案件・再制作') as $slug => $label) {
    $case = get_page_by_path('case-study/' . $slug, OBJECT, 'page');
    if ($case && 'publish' === $case->post_status && !post_password_required($case)) $home_cases[] = array('post' => $case, 'label' => $label);
}
?>
<div class="work-home">
  <section class="work-hero" aria-labelledby="work-intro-heading">
    <p class="magazine-eyebrow">PYTHON / WEB DEVELOPMENT</p>
    <h2 id="work-intro-heading">Excel・CSVの手作業を減らす。<br>必要なWeb機能を、形にする。</h2>
    <p class="work-hero__lead">データの整形・集計・転記を繰り返す方へ。<br class="work-hero__desktop-break">Pythonによる業務自動化と、デザインをもとにしたWeb実装で、<br class="work-hero__desktop-break">日々の作業やサイトの課題を解決する仕組みをつくります。</p>
    <div class="work-home__actions">
      <a class="work-home__button work-home__button--primary" href="<?php echo esc_url(home_url('/contact-us/')); ?>">仕事について相談する</a>
      <a class="work-home__button" href="#work-projects">開発事例を見る <span aria-hidden="true">↓</span></a>
    </div>
    <p class="work-hero__note">要件が固まっていなくても構いません。対応可否とお見積もりをメールでご案内します。</p>
    <nav class="work-home__nav" aria-label="トップページの案内"><a href="#work-services">対応できる仕事</a><a href="#work-projects">開発事例</a><a href="#work-profile">自己紹介</a><a href="#year-latest">日々のジャーナル</a></nav>
  </section>

  <section class="work-home__section" id="work-services" aria-labelledby="work-services-heading">
    <header class="work-home__heading"><p class="magazine-eyebrow">SERVICES</p><h2 id="work-services-heading">こんな作業を、ご相談ください。</h2><p>使う技術よりも、まずは今の「困ったこと」から。</p></header>
    <div class="work-services-grid">
      <article class="work-service"><span class="work-service__number" aria-hidden="true">01</span><h3>Excel・CSVの整形と集計</h3><p>表記ゆれの修正、必須項目のチェック、エラー一覧の作成。集計に使えるデータへ整えます。</p><details><summary>対応する処理・技術</summary><p>Python / pandas / openpyxl。日付・金額・列名の正規化、データの照合、月別・年間集計、指定Excelへの転記を扱います。</p></details></article>
      <article class="work-service"><span class="work-service__number" aria-hidden="true">02</span><h3>繰り返し作業の自動化</h3><p>毎回すべてのファイルを処理する作業を見直し、新規・更新ファイルの判定などを仕組みにします。</p><details><summary>対応する処理・技術</summary><p>Python / SQL / SQLite。ファイルの更新日時と処理履歴の比較、対象データの抽出など、現在の業務ルールを確認して実装します。</p></details></article>
      <article class="work-service"><span class="work-service__number" aria-hidden="true">03</span><h3>Webページの実装と改善</h3><p>ご用意いただいたデザインの実装、スマートフォン対応、グラフ表示や既存サイトの機能改善を行います。</p><details><summary>対応する処理・技術</summary><p>HTML / CSS / JavaScript / WordPress / Chart.js。Webデザインの制作は含まず、ご用意いただくデザインや既存環境をもとに対応範囲を確認します。</p></details></article>
    </div>
    <p class="work-home__more"><a href="<?php echo esc_url(get_permalink($services_page)); ?>">進め方・料金について見る <span aria-hidden="true">→</span></a></p>
  </section>

  <?php if ($home_cases) : ?>
  <section class="work-home__section" id="work-projects" aria-labelledby="work-projects-heading">
    <header class="work-home__heading"><p class="magazine-eyebrow">SELECTED WORK</p><h2 id="work-projects-heading">課題を、どう形にしたか。</h2><p>実案件と、業務を想定したサンプルを紹介します。</p></header>
    <div class="work-projects-grid">
      <?php foreach ($home_cases as $item) : $case = $item['post']; ?>
      <article class="work-project">
        <a class="work-project__image" href="<?php echo esc_url(get_permalink($case)); ?>" aria-label="<?php echo esc_attr(get_the_title($case)); ?>"><?php echo wp_kses_post(kihiro_case_study_image($case)); ?></a>
        <p class="work-project__label"><?php echo esc_html($item['label']); ?></p>
        <h3><a href="<?php echo esc_url(get_permalink($case)); ?>"><?php echo esc_html(get_the_title($case)); ?></a></h3>
        <p class="work-project__summary"><?php echo esc_html(get_post_meta($case->ID, '_kihiro_case_problem', true)); ?></p>
        <a class="work-project__link" href="<?php echo esc_url(get_permalink($case)); ?>">解決方法と成果を見る <span aria-hidden="true">→</span></a>
      </article>
      <?php endforeach; ?>
    </div>
    <?php if ($case_index) : ?><p class="work-home__more"><a href="<?php echo esc_url(get_permalink($case_index)); ?>">すべての開発事例を見る <span aria-hidden="true">→</span></a></p><?php endif; ?>
  </section>
  <?php endif; ?>

  <section class="work-profile" id="work-profile" aria-labelledby="work-profile-heading">
    <div><p class="magazine-eyebrow">ABOUT</p><h2 id="work-profile-heading">柴田 浩貴</h2><p class="work-profile__role">WEBエンジニア</p></div>
    <div><p>Webの実装と、Pythonによるデータ処理・業務自動化に取り組んでいます。つくったものだけでなく、試行錯誤や日々の気づきもこのブログに残しています。</p><div class="work-home__profile-links"><?php $about_page = get_page_by_path('about'); if ($about_page && 'publish' === $about_page->post_status) : ?><a href="<?php echo esc_url(get_permalink($about_page)); ?>">自己紹介を読む →</a><?php endif; ?><a href="#year-latest">日々のジャーナルを読む ↓</a></div></div>
  </section>

  <section class="work-home-contact" aria-labelledby="work-contact-heading"><h2 id="work-contact-heading">まずは、今のお困りごとから。</h2><p>「この作業を減らしたい」「この機能をつくりたい」。<br>要件を確認して、対応可否と個別のお見積もりをご案内します。</p><a class="work-home__button work-home__button--primary" href="<?php echo esc_url(home_url('/contact-us/')); ?>">メールでの相談へ進む <span aria-hidden="true">→</span></a><p class="work-home-contact__note">フォームからお送りいただき、メールでやりとりします。</p></section>
</div>
