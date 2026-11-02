<?php
/** Service stories grounded in published case studies and technical writing. */
$services = array(
    array(
        'id' => 'web', 'label' => 'WEB DESIGN & DEVELOPMENT', 'name' => 'Web制作',
        'heading' => '事業の魅力を、<br>伝わるWebサイトに。',
        'lead' => '初めて訪れた人に、何をしている事業か、何を相談できるか。情報の整理から画面の実装まで、事業の入口をつくります。',
        'case' => 'design-to-interactive-web-page',
        'caption' => '制作事例：デザインデータからのWeb実装・レスポンシブ対応・グラフ機能',
        'benefits' => array('伝えたいことが、迷わず届く。' => 'サービスや強み、相談までの流れを整理。見た目と情報の順序を一緒に考えます。', 'スマートフォンでも、使いやすく。' => '画面幅に合わせた表示と操作を確認し、読む・探す・問い合わせる流れを整えます。', '公開した後も、育てられる。' => 'WordPressの構築・改修や既存サイトの不具合対応など、運用に必要な範囲をご相談いただけます。'),
        'scope' => array('ホームページの設計・制作', 'デザインデータからのHTML / CSS実装', 'WordPressの構築・改修', 'フォーム・表示不具合の調査と修正'),
        'delivery' => 'Webページ・実装コード・合意した機能の動作確認。更新や運用に必要な手順も、依頼内容に合わせて整理します。',
        'posts' => array(3666),
    ),
    array(
        'id' => 'automation', 'label' => 'WORKFLOW AUTOMATION', 'name' => '業務自動化',
        'heading' => '繰り返す作業を、<br>事業を進める時間に。',
        'lead' => '毎月のExcel修正、CSVの取り込み、確認と転記。いまの業務を読み解き、繰り返す部分を小さな仕組みに置き換えます。',
        'case' => 'excel-data-cleaner',
        'caption' => '開発サンプル：売上Excelの表記ゆれを整え、正常データとエラー一覧を出力',
        'benefits' => array('毎回の手直しを、決めたルールで。' => '日付や金額の表記をそろえるなど、同じ判断を繰り返す工程をPythonで処理します。', '確認する場所が、わかる。' => '正常データと確認が必要なデータを分け、問題のある行と理由を一覧に。人が判断する作業を支えます。', 'いまの仕事に、合わせてつくる。' => '実際のファイルと処理手順を確認し、入力・処理・出力のルールと確認方法を決めて実装します。'),
        'scope' => array('Excelの整形・チェック・集計', 'CSVの新規・更新判定と取り込み', 'ファイル処理・転記作業の自動化', '既存のデータ処理の調査・改善'),
        'delivery' => '処理プログラム・出力ファイル・実行手順・合意した条件での検証結果。日常の運用で使うところまでを考えます。',
        'posts' => array(21845, 28408),
    ),
);
?>
<nav class="service-switch" aria-label="お手伝いできること"><a href="#web">Web制作 <span aria-hidden="true">↘</span></a><a href="#automation">業務自動化 <span aria-hidden="true">↘</span></a></nav>
<?php foreach ($services as $service) :
    $case = get_page_by_path('case-study/' . $service['case']);
    if (!$case || 'publish' !== $case->post_status || $case->post_password) $case = null;
?>
<section class="service-story" id="<?php echo esc_attr($service['id']); ?>" aria-labelledby="<?php echo esc_attr($service['id']); ?>-heading">
  <div class="service-story__intro">
    <p class="magazine-eyebrow"><?php echo esc_html($service['label']); ?></p>
    <p class="service-story__name"><?php echo esc_html($service['name']); ?></p>
    <h2 id="<?php echo esc_attr($service['id']); ?>-heading"><?php echo wp_kses($service['heading'], array('br' => array())); ?></h2>
    <p class="service-story__lead"><?php echo esc_html($service['lead']); ?></p>
    <a class="service-cta" href="<?php echo esc_url(home_url('/contact-us/')); ?>">仕事の相談をする <span aria-hidden="true">→</span></a>
  </div>
  <?php if ($case) : ?>
  <figure class="service-story__visual"><a href="<?php echo esc_url(get_permalink($case)); ?>" aria-label="<?php echo esc_attr(get_the_title($case) . 'を見る'); ?>"><?php echo wp_kses_post(kihiro_case_study_image($case)); ?></a><figcaption><?php echo esc_html($service['caption']); ?><a href="<?php echo esc_url(get_permalink($case)); ?>">詳しく見る →</a></figcaption></figure>
  <?php endif; ?>
  <div class="service-benefits">
    <?php foreach ($service['benefits'] as $heading => $text) : ?><div><h3><?php echo esc_html($heading); ?></h3><p><?php echo esc_html($text); ?></p></div><?php endforeach; ?>
  </div>
  <div class="service-detail">
    <div><p class="magazine-eyebrow">WHAT I CAN DO</p><h3>ご相談いただけること</h3><ul><?php foreach ($service['scope'] as $scope) : ?><li><?php echo esc_html($scope); ?></li><?php endforeach; ?></ul></div>
    <div><p class="magazine-eyebrow">DELIVERABLES</p><h3>お渡しするもの</h3><p><?php echo esc_html($service['delivery']); ?></p>
    <?php if ($case) : ?><a class="service-text-link" href="<?php echo esc_url(get_permalink($case)); ?>">実装内容・確認方法を見る →</a><?php endif; ?></div>
  </div>
  <div class="service-evidence"><h3>取り組みを、記録から。</h3><div class="service-evidence__grid">
  <?php foreach ($service['posts'] as $post_id) : $entry = get_post($post_id); if (!$entry || 'publish' !== $entry->post_status || $entry->post_password) continue; ?>
    <a href="<?php echo esc_url(get_permalink($entry)); ?>"><span class="service-evidence__image" aria-hidden="true"><?php echo kihiro_article_thumbnail($entry->ID, 'medium_large'); ?></span><span><small>技術ブログ</small><strong><?php echo esc_html(get_the_title($entry)); ?></strong><span class="service-text-link">記事を読む →</span></span></a>
  <?php endforeach; ?>
  </div></div>
</section>
<?php endforeach; ?>
<section class="service-investment" aria-labelledby="service-investment-heading">
  <p class="magazine-eyebrow">START WITH A CONVERSATION</p><h2 id="service-investment-heading">まずは、小さく。<br>必要なところから。</h2>
  <p>Webサイトも、自動化も。最初に「何を良くしたいか」を整理します。<br>必要な範囲と費用を確かめてから、進め方を決めていただけます。</p>
  <ol><li><strong>01　現状を伺う</strong><span>サイトや作業ファイル、困っていることを確認します。</span></li><li><strong>02　範囲と費用を決める</strong><span>対応内容・成果物・納期・確認方法を整理し、個別にお見積もりします。</span></li><li><strong>03　つくり、確かめる</strong><span>合意後に着手。実装と動作確認を行い、運用方法を共有します。</span></li></ol>
  <a class="service-cta" href="<?php echo esc_url(home_url('/contact-us/')); ?>">仕事の相談をする <span aria-hidden="true">→</span></a>
  <p class="service-investment__note">メールを中心に、必要に応じてWeb会議も活用します。掲載サンプルは実際の受託・導入実績とは区別しています。効果・費用・納期は依頼内容と確認結果によって異なります。</p>
</section>
