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
        "個人開発": ["Django×Reactのタスク管理アプリ開発", "FizzBuzz"],
        "プログラミング": ["JavaScript", "Java", "git", "npm", "React", "TypeScript", "Python", "Rails", "Vue.js", "SQL"],
        "旅と人生": ["青春18きっぷ", "まる", "ワンオク"],
        "良質なインプット": ["ゆらぎ", "YouTube", "音楽", "本"],
        "思考・アイディア": ["自分の考え", "ライフハック"],
        "仕事": ["PythonのETL作成", "今後のキャリアプラン", "成果を出すためのTips"],
        // "サイト制作": ["サイト制作", "WordPress"],
    };

    let slugMapping = {
        "Rails": "ruby-on-rails",
        "TypeScript": "typescript",
        "本": "book2",
        "ライフハック": "life-hack",
        "旅行": "a-trip",
        "青春18きっぷ": "b-seishun-18-kippu",
        "サイト制作": "site",
        "Django×Reactのタスク管理アプリ開発": "djangoxreactのタスク管理アプリ開発",
        "YouTube": "youtube",
        "FizzBuzz": "fizzbuzz",
        "JavaScript": "javascript"
    };

    let openCategories = ["個人開発", "仕事", "思考・アイディア", "旅と人生", "プログラミング", "良質なインプット"]; // 最初に開いておきたいカテゴリ
    let container = $("#accordion-container");

    $.each(categories, function(category, tags) {
        let isOpen = openCategories.includes(category);
        let accordion = $('<div class="accordion"></div>');
        let header = $('<div class="accordion-header"><span class="arrow">' + (isOpen ? "－" : "＋") + '</span>' + category + '</div>');
        let content = $('<div class="accordion-content" style="display: ' + (isOpen ? "block" : "none") + ';"></div>');

        $.each(tags, function(index, tag) {
            let slug = slugMapping[tag] ? slugMapping[tag] : encodeURIComponent(tag);
            content.append('<p class="tag-item --mb-0"><a href="/tag/' + slug + '">' + tag + '</a></p>');
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