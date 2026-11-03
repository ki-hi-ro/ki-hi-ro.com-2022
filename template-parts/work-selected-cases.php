<?php
$index = kihiro_case_study_index();
if (!$index) return;
$cases = get_pages(array('parent' => $index->ID, 'post_status' => 'publish', 'sort_column' => 'post_modified,ID', 'sort_order' => 'DESC'));
$cases = array_slice(array_values(array_filter($cases, function ($case) { return !$case->post_password; })), 0, 3);
if (!$cases) return;
?>
<section class="work-home__section selected-works" id="work-cases" aria-labelledby="work-cases-heading">
  <header class="work-home__heading"><p class="magazine-eyebrow">WORKS</p><h2 id="work-cases-heading">制作実績</h2><p>Web制作と業務自動化の制作実績をご紹介します。</p></header>
  <div class="recent-journal__grid">
    <?php foreach ($cases as $case) :
        $image = kihiro_case_study_image($case);
        $excerpt = $case->post_excerpt ?: $case->post_content;
        $excerpt = wp_html_excerpt(preg_replace('/\s+/u', ' ', wp_strip_all_tags(strip_shortcodes($excerpt))), 90, '…');
    ?>
    <article class="recent-journal__card"><a href="<?php echo esc_url(get_permalink($case)); ?>">
      <span class="recent-journal__thumbnail" aria-hidden="true"><?php echo $image ? wp_kses_post($image) : '<img src="' . esc_url(get_theme_file_uri('/assets/images/case-study-placeholder.svg')) . '" alt="" loading="lazy">'; ?></span>
      <h3><?php echo esc_html(get_the_title($case)); ?></h3>
      <p class="recent-journal__excerpt"><?php echo esc_html($excerpt); ?></p>
      <div class="recent-journal__dates"><time datetime="<?php echo esc_attr(get_the_modified_date('c', $case)); ?>"><?php echo esc_html(get_the_modified_date('Y.m.d', $case)); ?> 更新</time><span aria-hidden="true"> / </span><time datetime="<?php echo esc_attr(get_the_date('c', $case)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $case)); ?> 公開</time></div>
      <span class="recent-journal__read">課題と実装内容を見る <span aria-hidden="true">→</span></span>
    </a></article>
    <?php endforeach; ?>
  </div>
  <p class="work-home__more"><a class="work-home__button" href="<?php echo esc_url(get_permalink($index)); ?>">制作・開発事例をすべて見る →</a></p>
</section>
