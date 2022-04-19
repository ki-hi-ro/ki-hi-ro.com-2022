<?php get_header(); ?>

<div class="top-box col-xs-12">
  <figure class="page-mv">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service-mv.png" alt="サービス メイン画像">
		<h1>サービス一覧</h1>
  </figure>

	<div class="page__contents-container">
		<section class="web-update" id="web-update">
			<h2 class="web-update__sec-ttl">WEBサイトの更新サポート</h2>
			<p class="web-update__text">
				WEBマーケティングの過程で発生したコーディングの対応が可能です。<br>
				お申し込みは<a href="<?php echo home_url('service-apply#web-update');?>">こちら</a>
			</p>

			<h3 class="web-update__list-ttl">主な対応項目と料金</h3>
			<ul class="web-update__ul">
				<li>文言変更・項目削除など・・・2,000円(税抜)</li>
				<li>新規セクション追加・・・4,000円(税抜)</li>
				<li>新規ページ追加・・・7,500円(税抜)</li>
			</ul>

			<h3 class="web-update__list-ttl">対応経験のあるCMS</h3>
			<ul class="web-update__ul">
				<li>WordPress</li>
				<li>EC-CUBE</li>
				<li>FutureShop</li>
			</ul>

		</section>

		<section class="new-site-coding" id="new-site-coding">
			<h2 class="new-site-coding__sec-ttl">新規サイトコーディング</h2>
			<p class="new-site-coding__text">
				HTML / CSSコーディング、LPコーディング、WordPressサイト構築が対応可能です。<br>
				お申し込みは<a href="<?php echo home_url('service-apply#new-site-coding');?>">こちら</a>
			</p>
			<h3 class="new-site-coding__list-ttl">主な対応項目と料金</h3>
			<ul class="new-site-coding__ul">
				<li>HTML / CSSコーディング・・・10,000円(税抜)</li>
				<li>LPコーディング・・・30,000円(税抜)</li>
				<li>WordPressサイト構築・・・100,000円(税抜)</li>
			</ul>
		</section>
	</div>

<?php get_footer();?>
