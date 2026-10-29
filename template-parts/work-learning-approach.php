<?php
$about_page = get_page_by_path('about');
$etl_article = get_post(25448);
?>
<section class="work-home__section work-learning" id="work-learning" aria-labelledby="work-learning-heading">
  <header class="work-home__heading">
    <p class="magazine-eyebrow">LEARN &amp; BUILD</p>
    <h2 id="work-learning-heading">技術が違っても、まずはご相談ください。</h2>
    <p>いま使っている言語や製品、細かな仕様も含めて。<br>必要なことを学び、確かめながら、改善の方法を考えます。</p>
  </header>
  <div class="work-learning__columns">
    <article>
      <h3>既存の仕組みを読み解き、新しい技術へ。</h3>
      <p>Pentaho ETLをPython ETLへ置き換えるプロジェクトでは、既存フローや入出力、共通テンプレートを読み解きながら、Pythonによる処理の実装とテスト、不具合修正を担当しました。</p>
      <p>分からない点を整理して確認し、実行結果を一つずつ確かめる。その積み重ねで、新しい環境や処理への理解を深めてきました。</p>
      <p>これまで扱ったことのない言語・ライブラリ・製品についても、既存のコードや資料、公式ドキュメントを調べ、小さな検証を通して対応できる範囲と実現方法をご提案します。</p>
      <div class="work-learning__evidence">
        <?php if ($about_page && 'publish' === $about_page->post_status && !post_password_required($about_page)) : ?><a href="<?php echo esc_url(get_permalink($about_page) . '#experience-etl'); ?>">移行プロジェクトでの担当範囲を見る →</a><?php endif; ?>
        <?php if ($etl_article && 'publish' === $etl_article->post_status && !$etl_article->post_password) : ?><a href="<?php echo esc_url(get_permalink($etl_article)); ?>">当時の取り組みの記録を読む →</a><?php endif; ?>
      </div>
    </article>
    <article>
      <h3>AIを積極的に活用し、私自身が確かめます。</h3>
      <p>仕様の読み解き、実装案の比較、コードの作成、テスト観点の整理などに、AIを積極的に活用します。共有できる情報の範囲を確認したうえで、調査や試作を効率よく進めます。</p>
      <p>AIの回答をそのまま成果物にはせず、既存の仕様と照らし合わせ、実際に動かして確認します。対応できること、追加の調査が必要なこと、難しいことを分けてお伝えします。</p>
      <p>まずは調査や小さな試作で、任せられるかを判断していただける形に。調査・検証の範囲、必要な時間と費用を着手前に相談し、得られた理解は手順や記録に残して、次の改善にもつなげます。</p>
    </article>
  </div>
  <aside class="work-learning__timing" aria-label="お急ぎの案件について">
    <h3>お急ぎの場合は、経験豊富な方へのご依頼をおすすめします。</h3>
    <p>短い納期での対応が最優先の場合は、その技術の実務経験が豊富な方を探されることをおすすめします。調査・検証の時間を確保し、状況を共有しながら少しずつ改善していける案件で、お力になりたいと考えています。</p>
  </aside>
  <div class="work-learning__invitation"><p>小さな課題から、継続して改善できる関係を。<br>まずは、いまのシステムと困っていることをお聞かせください。</p><a class="work-home__button work-home__button--primary" href="<?php echo esc_url(home_url('/contact-us/')); ?>">調査・検証から相談する <span aria-hidden="true">→</span></a></div>
</section>
