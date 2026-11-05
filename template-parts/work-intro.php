<?php
$services_page = kihiro_services_page();
if (!$services_page) return;
$concept_hour = (int) wp_date('G', null, new DateTimeZone('Asia/Tokyo'));
$concept_scene = $concept_hour < 5 || $concept_hour >= 19 ? 'night' : ($concept_hour < 10 ? 'dawn' : ($concept_hour < 17 ? 'day' : 'dusk'));
?>
<div class="work-home">
  <section class="work-hero work-hero--business" data-scene="<?php echo esc_attr($concept_scene); ?>" aria-labelledby="work-intro-heading">
    <?php get_template_part('template-parts/concept-landscape'); ?>
    <p class="work-hero__concept">CONCEPT</p>
    <h2 id="work-intro-heading">自分 × 何か</h2>
    <p class="work-hero__statement">私はこの公式を大事にしています。</p>
    <p class="work-hero__lead"><span class="work-hero__lead-desktop">自分の身体の状態を整える、自分の思考を整える、仕事に必要なスキルを整える。<br>整えた自分で、世界と関わっていく。</span><span class="work-hero__lead-mobile">自分の身体の状態を整える。<br>自分の思考を整える。<br>仕事に必要なスキルを整える。<br>整えた自分で、世界と関わっていく。</span></p>
  </section>

  <?php get_template_part('template-parts/recent-journal'); ?>

  <section class="work-home__section" id="work-services" aria-labelledby="work-services-heading">
    <header class="work-home__heading"><p class="magazine-eyebrow">SERVICES</p><h2 id="work-services-heading">Web制作と業務自動化で、お手伝いします。</h2><p>事業の情報を届けるWebサイトと、日々の手間を減らす仕組み。いま必要なことからご相談ください。</p></header>
    <div class="work-opportunities__grid">
      <a class="work-opportunity work-opportunity--linked" href="<?php echo esc_url(get_permalink($services_page)); ?>"><p class="magazine-eyebrow">WEB</p><?php get_template_part('template-parts/service-illustration', null, array('kind' => 'web')); ?><h3>ホームページをつくる・整える。</h3><p>事業の魅力を伝えるWebサイトを制作・改善します。</p></a>
      <a class="work-opportunity work-opportunity--linked" href="<?php echo esc_url(get_permalink($services_page)); ?>"><p class="magazine-eyebrow">AUTOMATION</p><?php get_template_part('template-parts/service-illustration', null, array('kind' => 'automation')); ?><h3>繰り返す作業を、仕組みにする。</h3><p>Excel・CSVなどの定型作業をPythonで自動化します。</p></a>
    </div>
  </section>

  <?php get_template_part('template-parts/work-selected-cases'); ?>

  <section class="work-profile" id="work-profile" aria-labelledby="work-profile-heading">
    <header class="work-home__heading"><p class="magazine-eyebrow">ABOUT</p><h2 id="work-profile-heading">柴田 浩貴</h2><p class="work-profile__role">個人事業主 / Webエンジニア</p></header>
    <div><p>Web制作、データ処理の移行、API開発、システム保守などを経験してきました。既存の仕組みを読み解き、確認しながら改善することを大切にしています。「自分自身を、更新し続ける」という姿勢で、学びや日々の気づきもブログに記録しています。</p><div class="work-home__profile-links"><?php $about_page = get_page_by_path('about'); if ($about_page && 'publish' === $about_page->post_status) : ?><a href="<?php echo esc_url(get_permalink($about_page)); ?>">自己紹介を読む →</a><?php endif; ?><a href="<?php echo esc_url(kihiro_journal_url()); ?>">日々のジャーナルを読む →</a></div></div>
  </section>

  <section class="work-home-contact work-home-contact--horizon" aria-labelledby="work-contact-heading"><?php get_template_part('template-parts/contact-horizon'); ?><h2 id="work-contact-heading"><span class="work-home-contact__phrase">まずは、</span><span class="work-home-contact__phrase">今のお困りごとから。</span></h2><p><span class="work-home-contact__phrase">「この作業を減らしたい」</span><span class="work-home-contact__phrase">「この機能をつくりたい」。</span><br><span class="work-home-contact__phrase">要件を確認して、</span><span class="work-home-contact__phrase">対応可否と個別のお見積もりを</span><span class="work-home-contact__phrase">ご案内します。</span></p><a class="work-home__button work-home__button--primary" href="<?php echo esc_url(home_url('/contact-us/')); ?>">仕事の相談をする <span aria-hidden="true">→</span></a><p class="work-home-contact__note">フォームからお送りいただいた後、メールを中心に、必要に応じてWeb会議も交えてお話を伺います。</p></section>
</div>
