<?php
$index = kihiro_case_study_index();
if (!$index) return;
$cases = get_pages(array('parent' => $index->ID, 'post_status' => 'publish', 'sort_column' => 'post_modified,ID', 'sort_order' => 'DESC'));
$cases = array_values(array_filter($cases, function ($case) { return !$case->post_password; }));
$featured_cases = array();
foreach (array('web' => 'WEB', 'automation' => 'AUTOMATION') as $category => $label) {
    foreach ($cases as $case) {
        if (in_array($category, kihiro_case_study_categories($case), true)) {
            $featured_cases[] = array('case' => $case, 'label' => $label);
            break;
        }
    }
}
if (!$featured_cases) return;
?>
<section class="work-home__section selected-works featured-preview works-by-service" id="work-cases" aria-labelledby="work-cases-heading">
  <header class="work-home__heading"><p class="magazine-eyebrow">WORKS</p><h2 id="work-cases-heading">制作実績</h2><p>Web制作と業務自動化の制作実績をご紹介します。</p></header>
  <div class="work-opportunities__grid">
    <?php foreach ($featured_cases as $featured_case) :
        $case = $featured_case['case'];
        $image = kihiro_case_study_image($case);
        $excerpt = $case->post_excerpt ?: $case->post_content;
        $excerpt = wp_html_excerpt(preg_replace('/\s+/u', ' ', wp_strip_all_tags(strip_shortcodes($excerpt))), 110, '…');
    ?>
    <article class="work-opportunity work-case-preview">
      <p class="magazine-eyebrow"><?php echo esc_html($featured_case['label']); ?></p>
      <a class="work-case-preview__image" href="<?php echo esc_url(get_permalink($case)); ?>" aria-label="<?php echo esc_attr(get_the_title($case)); ?>"><?php echo $image ? wp_kses_post($image) : '<img src="' . esc_url(get_theme_file_uri('/assets/images/case-study-placeholder.svg')) . '" alt="" loading="lazy">'; ?></a>
      <h3><?php echo esc_html(get_the_title($case)); ?></h3>
      <p class="recent-journal__excerpt"><?php echo esc_html($excerpt); ?></p>
      <div class="recent-journal__dates"><time datetime="<?php echo esc_attr(get_the_modified_date('c', $case)); ?>"><?php echo esc_html(get_the_modified_date('Y.m.d', $case)); ?> 更新</time><span aria-hidden="true"> / </span><time datetime="<?php echo esc_attr(get_the_date('c', $case)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $case)); ?> 公開</time></div>
      <a href="<?php echo esc_url(get_permalink($case)); ?>">詳しく見る →</a>
    </article>
    <?php endforeach; ?>
  </div>
  <p class="work-home__more"><a class="work-home__button" href="<?php echo esc_url(get_permalink($index)); ?>"><span class="featured-preview__more-desktop">制作・開発事例をすべて見る</span><span class="featured-preview__more-mobile">すべての制作実績を見る</span> <span aria-hidden="true">→</span></a></p>
</section>
