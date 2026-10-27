<?php
/** 本人の記事にある考え方を、ご依頼への向き合い方として要約する。 */
$reasons = array(
    array(
        'title' => '相談相手と、つくる人が同じです。',
        'text' => '個人事業主として、ご相談から実装・確認まで私が直接対応します。作業の背景や細かな意図を共有し、必要な範囲を相談しながら進められます。',
        'articles' => array(4296 => '所要時間を見積もる方法'),
    ),
    array(
        'title' => '1,900件以上、考えを言葉にしてきました。',
        'text' => '技術の学びも、日々の試行錯誤も、このブログに書き続けています。曖昧なことを分解して言葉にする習慣を、課題の整理や仕様・進捗の説明に生かします。',
        'articles' => array(20551 => '私がブログを書く理由'),
    ),
    array(
        'title' => '自分で決めたことに、責任を持ちます。',
        'text' => '自分の人生を自分で選ぶ姿勢を、仕事にもつなげています。対応できる範囲を正直に伝え、進め方や完了の基準をすり合わせる。うまくいかなかったことも振り返り、次の改善に生かします。',
        'articles' => array(34584 => '仕事の責任についての考え方', 13777 => '完了報告の粒度について'),
    ),
);
?>
<section class="work-home__section work-reasons" id="work-reasons" aria-labelledby="work-reasons-heading">
  <header class="work-home__heading"><p class="magazine-eyebrow">WHY WORK WITH ME</p><h2 id="work-reasons-heading">私にご相談いただく、3つの理由。</h2><p>個人として直接向き合うこと。考えを言葉にすること。自分の判断に責任を持つこと。<br>日々大切にしている姿勢を、ご依頼にもつなげます。</p></header>
  <div class="work-reasons-grid">
    <?php foreach ($reasons as $index => $reason) : ?>
      <article class="work-reason">
        <span class="work-service__number" aria-hidden="true"><?php echo esc_html(sprintf('%02d', $index + 1)); ?></span>
        <h3><?php echo esc_html($reason['title']); ?></h3>
        <p><?php echo esc_html($reason['text']); ?></p>
        <div class="work-reason__articles">
          <?php foreach ($reason['articles'] as $article_id => $label) :
              $article = get_post($article_id);
              if (!$article || 'publish' !== $article->post_status || $article->post_password) continue;
          ?>
            <a href="<?php echo esc_url(get_permalink($article)); ?>"><?php echo esc_html($label); ?> <span aria-hidden="true">→</span></a>
          <?php endforeach; ?>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
