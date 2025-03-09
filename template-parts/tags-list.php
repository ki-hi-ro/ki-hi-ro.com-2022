<section class="front-sec">
  <h2 class="front-sec__ttl">タグ</h2>
  <div class="front-sec__text">
    <div id="accordion-container">
      <!-- アコーディオンリストがここに挿入される -->
    </div>
  </div>
</section>

<!-- jQuery アコーディオン動作 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let categories = {
        "旅行": ["旅行", "青春18きっぷ"],
        "プロジェクト": ["タスク管理アプリ開発"],
        "音楽": ["ワンオク"],
        "データベース": ["SQL", "データ処理"],
        "未分類": ["windows", "ITソリューション", "レジの店員さんとの接し方", "クラウド", "テクノロジー", "Power BI", "プロジェクト", "WEBアプリ開発", "プログラミング学習記録", "正規表現", "タスク管理アプリ", "プログラミング", "Excel VBA", "React", "Vue.js", "サイト制作", "HTML / CSS", "jQuery", "Linkin Park", "ミセス", "絢香", "音楽", "AmPm", "claquepot", "ノイズ", "UVER", "刈谷", "刈谷市", "数学", "カラオケ", "サウナ", "仕事", "タスク管理", "職場", "リモートワーク", "ミーティング", "フリーランス", "通勤", "サプライズマインドセット", "自分の考え", "考え方", "決意", "悩み", "困りごと", "疑問", "TOEIC", "基本情報技術者", "宇宙", "植物", "信号のない横断歩道", "レシピ", "スマホ", "ライフハック", "睡眠", "暮らし", "ポートフォリオ", "転職", "読書メモ", "京都", "熊本", "景色", "ホテル", "美術館", "駅", "サードプレイス", "ChatGPT", "テイスティング", "発見", "反省", "履き心地のいい靴下", "読書", "pentaho", "Rails", "便利ツール", "Heroku", "TypeScript", "世の中にあるシステム", "Storybook", "CI/CD", "Django", "パッケージ管理システム", "クラウドサービス", "IT資格", "ITパスポート", "Java", "projava", "JavaScript", "Python", "git", "Excel", "openpyxl", "本", "スマホを落とした", "WordPress", "まる", "静岡", "現代文", "課題", "マイファス", "生産性", "スクレイピング", "企画", "linux", "原因と対策", "ショートカットキー", "ひとり焼肉", "ファッション", "ウーバー", "ターミナル", "体験", "お金", "出来事", "健康", "無料スポット", "フェス", "ブログを書くことについて", "自然", "家事", "食事", "Power Query", "ミス", "弱み", "WEBサイト", "生き物", "猫", "IntelliJ IDEA", "職務経歴", "すれ違い", "税金", "路線", "上手くいった原因", "恋愛", "災害", "PC", "日記", "振り返りと目標", "起業アイディア", "社会", "社会問題", "人間関係", "コミュニケーション", "サービス", "chocoZAP", "YouTube", "コワーキングスペース", "映画", "飲食店", "遊び", "Apple Watch", "googleスプレッドシート", "Word", "googleアドセンス", "釣り", "トラブルシューティング", "ピアノ", "マーケティング", "引っ越し", "孤独", "病気", "歩数"]
    };

    let openCategories = ["旅行", "プロジェクト", "音楽", "データベース"]; // 最初に開いておきたいカテゴリ

    let container = $("#accordion-container");

    $.each(categories, function(category, tags) {
        let isOpen = openCategories.includes(category); // このカテゴリが開くべきか判定
        let accordion = $('<div class="accordion"></div>');
        let header = $('<div class="accordion-header"><span class="arrow">' + (isOpen ? "－" : "＋") + '</span>' + category + '</div>');
        let content = $('<div class="accordion-content" style="display: ' + (isOpen ? "block" : "none") + ';"></div>');

        $.each(tags, function(index, tag) {
            content.append('<p class="tag-item --mb-0"><a href="/tag/' + encodeURIComponent(tag) + '">' + tag + '</a></p>');
        });

        accordion.append(header).append(content);
        container.append(accordion);
    });

    $(".accordion-header").click(function() {
        $(this).next(".accordion-content").slideToggle();
        let arrow = $(this).find(".arrow");
        arrow.text(arrow.text() === "＋" ? "－" : "＋");
    });
});
</script>

<!-- スッキリしたアコーディオンデザイン -->
<style>
  .accordion {
      border: 1px solid #ddd;
      border-radius: 4px;
      margin-bottom: 8px; /* 各アコーディオンの間隔を少し広げる */
      overflow: hidden;
  }
  .accordion-header {
      background-color: #f9f9f9;
      padding: 8px 12px; /* 余白を少し増やす */
      cursor: pointer;
      font-weight: normal;
      border-bottom: 1px solid #ddd;
      display: flex;
      align-items: center;
      font-size: 14px;
  }
  .accordion-content {
      display: none;
      padding: 8px 12px; /* コンテンツ内の余白も調整 */
      background-color: #fff;
      font-size: 13px;
  }
  .tag-item {
      margin: 4px 0; /* タグの余白を少し広げる */
  }
  .tag-item.--mb-0 {
      margin-bottom: 2px; /* タグリストの最後の余白を調整 */
  }
  .arrow {
      display: inline-block;
      margin-right: 10px;
      font-size: 14px;
  }
</style>