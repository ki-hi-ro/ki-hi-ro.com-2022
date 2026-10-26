<?php
$services_page = kihiro_services_page();
if (!$services_page) return;
$case_index = kihiro_case_study_index();
?>
<section class="work-intro" aria-labelledby="work-intro-heading">
  <p class="magazine-eyebrow">制作・開発のご相談</p>
  <h2 id="work-intro-heading">Excel・CSVの手作業を、Pythonで仕組みに。</h2>
  <p>毎月のデータ整形・集計・転記にお困りの方へ。PythonによるExcel・CSVデータの整形、集計、業務自動化に対応しています。</p>
  <p class="work-intro__note">要件が固まっていなくても構いません。内容を確認して、対応可否とお見積もりをご案内します。</p>
  <div class="work-entry__links">
    <a href="<?php echo esc_url(get_permalink($services_page)); ?>">サービス・ご依頼</a>
    <?php if ($case_index) : ?><a href="<?php echo esc_url(get_permalink($case_index)); ?>">開発事例を見る</a><?php endif; ?>
    <a href="<?php echo esc_url(home_url('/contact-us/')); ?>">まずは相談する</a>
  </div>
</section>
