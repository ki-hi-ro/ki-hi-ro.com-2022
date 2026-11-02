<?php
$index = kihiro_case_study_index();
if (!$index) return;
$cases = get_pages(array('parent' => $index->ID, 'post_status' => 'publish', 'sort_column' => 'post_modified,ID', 'sort_order' => 'DESC'));
$cases = array_slice(array_values(array_filter($cases, function ($case) { return !$case->post_password; })), 0, 3);
if (!$cases) return;
?>
<section class="work-home__section" id="work-cases" aria-labelledby="work-cases-heading">
  <header class="work-home__heading"><p class="magazine-eyebrow">WORKS</p><h2 id="work-cases-heading"><span class="work-heading-phrase">つくったものと、</span><span class="work-heading-phrase">解決への取り組み。</span></h2><p>Web制作と業務自動化の開発事例をご紹介します。制作案件・個人開発・サンプルそれぞれの背景や担当範囲は、詳細ページにまとめています。</p></header>
  <div class="work-help-grid">
    <?php foreach ($cases as $case) : $image = kihiro_case_study_image($case); ?>
    <article class="work-help-article"><a href="<?php echo esc_url(get_permalink($case)); ?>">
      <span class="work-help-article__image" aria-hidden="true"><?php echo $image ? wp_kses_post($image) : '<img src="' . esc_url(get_theme_file_uri('/assets/images/case-study-placeholder.svg')) . '" alt="" loading="lazy">'; ?></span>
      <div class="work-help-article__body"><h3><?php echo esc_html($case->post_title); ?></h3><p class="work-help-article__summary"><?php echo esc_html(kihiro_case_study_technology($case)); ?></p><span class="work-help-article__more">課題と実装内容を見る <span aria-hidden="true">→</span></span></div>
    </a></article>
    <?php endforeach; ?>
  </div>
  <p class="work-home__more"><a class="work-home__button" href="<?php echo esc_url(get_permalink($index)); ?>">制作・開発事例をすべて見る →</a></p>
</section>
