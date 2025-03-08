<?php 
get_header();
if(is_tag()) { $term = get_queried_object(); } 
?>
<?php if (is_date() && get_query_var('year') == 2025 && get_query_var('monthnum') == 3) : ?>
  <div class="callender-img front-container">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/202503.jpeg" alt="2025年3月のカレンダー画像">
  </div>
<?php endif; ?>  
<main class="front-container">
  <div class="pc-left-container">
    <div class="search-form-wrap --sp">
      <?php get_search_form() ; ?>
    </div>
    <section class="front-sec">
      <?php if (is_search()) : ?>
      <h2 class="front-sec__ttl">"<?php echo get_search_query(); ?>" が本文中に含まれている記事</h2>
      <div class="front-sec__text front-sec__flex">
        <?php if (have_posts()): while(have_posts()) : the_post(); ?>
        <div class="all-article__link front-sec__flex-item">
          <?php echo get_template_part("template-parts/blog-list"); ?>
        </div>
        <?php
          endwhile;
        else:
          ?>
        <p>該当する記事はありませんでした。</p>
        <?php endif; ?>
        <?php endif; ?>
        <?php
          if(is_page("all-article")) {
            $article_list_ttl = "すべての";
          } else if(is_tag()) {
            $article_list_ttl = $term->name."についての";
          } else if (is_date()) {
              if (get_query_var('monthnum')) {
                  // 月が存在する場合
                  $article_list_ttl = get_query_var('year') . '年' . get_query_var('monthnum') . '月の';
              } else {
                  // 月が存在しない場合（年のみ）
                  $article_list_ttl = get_query_var('year') . '年の';
              }
          }
          ?>

        <?php if ( is_home() || is_front_page() ) : ?>
          <?php echo get_template_part("template-parts/front-posts"); ?>
        <?php endif; ?>

        <?php if ( !(is_home() || is_front_page() || is_search() ) ) : ?>
        <h2 class="front-sec__ttl <?php if(is_tag()): ?>tag_article_ttl<?php endif; ?>"><?php echo $article_list_ttl; ?>記事<?php if(is_tag()): ?>（<?php echo $term->count; ?>）<?php endif; ?></h2>
        <div class="front-sec__text front-sec__flex">
          <?php
              if(is_date()) {
                echo get_template_part("template-parts/blog-list-thumb-desc-date");
              } else {
                echo get_template_part("template-parts/blog-list-thumb-desc");
              }
              ?>
        </div>
        <?php endif; ?>
        <?php if ( (is_home() || is_front_page()) ) : ?>
        <a class="front-sec__more" href="<?php echo home_url("all-article"); ?>">すべての記事はこちら</a>
        <?php else : ?>
        <a class="front-sec__more" href="<?php echo home_url(); ?>">トップページはこちら</a>
        <?php endif; ?>
    </section>
  </div>
  <div class="pc-right-container">
    <div class="search-form-wrap --pc">
      <?php get_search_form() ; ?>
    </div>
    <section class="front-sec">
      <section class="front-sec --mb-adjust">
        <h2 class="front-sec__ttl">過去の記事</h2>
        <div class="archive-accordion">
          <?php
// アコーディオンの親と子を表示する関数
function display_archive_accordion( $year, $open_years = array() ) {
    // 初期状態で開くかどうかを判定
    $is_open = in_array($year, $open_years);

    // 親要素（年単位のアーカイブ）
    echo "<div class='accordion-item'>";
    echo "<button class='accordion-header' data-year='{$year}'>";
    echo "{$year}年 <span class='icon'>" . ($is_open ? "×" : "+") . "</span>";
    echo "</button>";
    echo "<div class='accordion-content' id='accordion-content-{$year}' style='display: " . ($is_open ? "block" : "none") . ";'>";

    // 子要素（月単位のアーカイブ）
    // フィルター関数を変数化
    $filter_function = function ( $where ) use ( $year ) {
        return $where . " AND YEAR(post_date) = {$year}";
    };

    add_filter( 'getarchives_where', $filter_function );
    wp_get_archives(
        array(
            'type'            => 'monthly',
            'show_post_count' => true,
            'year'            => $year,
        )
    );
    remove_filter( 'getarchives_where', $filter_function );

    echo "</div>"; // .accordion-content
    echo "</div>"; // .accordion-item
}

// 取得可能な最も新しい年を動的に取得（例えば最新の投稿から）
$latest_year = date('Y');

// 初期状態で開きたい年を配列で指定
$open_years = array();
if ($latest_year >= 2025) {
    $open_years[] = 2025;
}
$open_years[] = 2024; // 2024年を追加

// 最新のアーカイブを表示
for ($year = $latest_year; $year >= 2022; $year--) {
    display_archive_accordion($year, $open_years);
}

          ?>
        </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  jQuery(document).ready(function ($) {
    $(".accordion-header").click(function () {
      var content = $(this).next(".accordion-content");
      var icon = $(this).find(".icon");

      // アコーディオンの開閉とアイコンの切り替え
      if (content.is(":visible")) {
        content.slideUp(); // 閉じる
        icon.text("+"); // プラスに戻す
      } else {
        $(".accordion-content").slideUp(); // 他のアコーディオンを閉じる
        $(".accordion-header .icon").text("+"); // 他のアイコンをリセット

        content.slideDown(); // 開く
        icon.text("×"); // ばつに切り替え
      }
    });
  });
</script>

<style>
  .archive-accordion {
      margin: 20px 0;
  }
  .accordion-item {
      margin-bottom: 10px;
  }
  .accordion-header {
      background-color: #f0f0f0;
      color: #000;
      border: 1px solid #ddd;
      cursor: pointer;
      padding: 10px;
      text-align: left;
      font-weight: bold;
      font-size: 16px;
      width: 100%;
      box-sizing: border-box;
      display: flex;
      align-items: center;
      justify-content: space-between;
  }
  .accordion-header:hover {
      background-color: #e0e0e0;
  }
  .accordion-header .icon {
      font-size: 18px;
      font-weight: bold;
      margin-left: 10px;
  }
  .accordion-content {
      padding: 10px;
      border: 1px solid #ddd;
      border-top: none;
  }
</style>


      </section>
      <section class="front-sec">
        <h2 class="front-sec__ttl --mt-0">タグ</h2>
        <div class="front-sec__text">          
          <?php
          // タグのデータを取得
          $tags = get_terms( array(
              'taxonomy' => 'post_tag',
              'hide_empty' => true, // 空のタグを除外
              'orderby' => 'count',   // 投稿数で並び替え
              'order' => 'DESC'      // 降順（多い順）
          ) );

          // タグごとの名前と投稿数をリスト表示
          if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
              echo '<div class="date-article-list">'; // <div> タグの開始
              foreach ( $tags as $tag ) {
                  echo '<li><a href="' . get_term_link( $tag ) . '">' . $tag->name . '</a>&nbsp;(' . $tag->count . ')</li>';
              }
              echo '</div>'; // <div> タグの終了
          }
          ?>
        </div>
      </section>
    </section>
  </div>
</main>
<?php get_footer();?>