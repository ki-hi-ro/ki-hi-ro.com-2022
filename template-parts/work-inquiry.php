<?php
$services_page = kihiro_services_page();
if (!$services_page || post_password_required()) return;
$case_detail = is_page_template('page-case-study.php');
if (!$case_detail && !has_category('技術・開発') && !get_post_meta(get_the_ID(), '_kihiro_article_topic', false)) return;
$case_index = kihiro_case_study_index();
$related_cases = array();
if (!$case_detail && $case_index) {
    $topics = get_post_meta(get_the_ID(), '_kihiro_article_topic', false);
    $subject = get_the_title() . ' ' . implode(' ', $topics);
    $category = preg_match('/Python|SQL|Excel|CSV|ETL|データ|python|sql/u', $subject) ? 'automation' : (preg_match('/Web|WordPress|HTML|CSS|JavaScript|React|web/u', $subject) ? 'web' : '');
    if ($category) {
        foreach (get_pages(array('parent' => $case_index->ID, 'post_status' => 'publish', 'sort_column' => 'post_modified', 'sort_order' => 'DESC')) as $case) {
            if (post_password_required($case) || !in_array($category, kihiro_case_study_categories($case), true)) continue;
            $related_cases[] = $case;
            if (count($related_cases) >= 2) break;
        }
    }
}
?>
<aside class="work-entry" aria-label="開発・制作のご相談">
  <h2><?php echo $case_detail ? '同じような課題をご相談ください' : '技術を、実際の課題解決へ'; ?></h2>
  <p>日々の業務やシステムで、困っていることをお聞かせください。<br>現在の状況を確認し、改善する範囲と進め方を一緒に考えます。</p>
  <p>要件が固まっていない段階でも構いません。<br>内容を確認して、対応可否とお見積もりをメールでご案内します。</p>
  <?php if ($related_cases) : ?>
    <ul class="work-entry__cases"><?php foreach ($related_cases as $case) : ?><li><a href="<?php echo esc_url(get_permalink($case)); ?>"><?php echo esc_html(get_the_title($case)); ?></a></li><?php endforeach; ?></ul>
  <?php endif; ?>
  <div class="work-entry__links">
    <a href="<?php echo esc_url(get_permalink($services_page)); ?>">サービス・ご依頼</a>
    <?php if (!$case_detail && $case_index) : ?><a href="<?php echo esc_url(get_permalink($case_index)); ?>">開発事例を見る</a><?php endif; ?>
    <a href="<?php echo esc_url(home_url('/contact-us/')); ?>">相談する</a>
  </div>
</aside>
