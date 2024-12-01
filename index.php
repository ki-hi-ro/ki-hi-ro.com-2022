<?php 
get_header();
if(is_tag()) { $term = get_queried_object(); } 
?>
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
        <h2 class="front-sec__ttl">最近書いた記事</h2>
        <div class="front-sec__text front-sec__flex">
          <?php echo get_template_part("template-parts/blog-list-thumb-desc-new"); ?>
        </div>
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
        <div class="front-container --date-article-list">
          <div class="date-article-list">
          <?php
          // カスタムフィルタ: 指定した年の投稿を絞り込む
          function filter_archives_by_specific_year( $where, $args ) {
              if ( isset( $args['year'] ) ) {
                  $year = intval( $args['year'] ); // 年を安全に整数に変換
                  $where .= " AND YEAR(post_date) = {$year}";
              }
              return $where;
          }

          // リンクテキストをカスタマイズするフィルタ
          function customize_archive_link_text( $link_html ) {
              return preg_replace( '/>(\d{4})</', '>\1年<', $link_html );
          }

          // 特定の年とその月を表示する関数
          function display_year_and_month_archives( $year ) {
              // 年単位のアーカイブ
              add_filter( 'getarchives_where', 'filter_archives_by_specific_year', 10, 2 );
              add_filter( 'get_archives_link', 'customize_archive_link_text' );
              wp_get_archives(
                  array(
                      'type'            => 'yearly',
                      'show_post_count' => true,
                      'year'            => $year,
                  )
              );
              remove_filter( 'getarchives_where', 'filter_archives_by_specific_year' );
              remove_filter( 'get_archives_link', 'customize_archive_link_text' );

              // 月単位のアーカイブ
              add_filter( 'getarchives_where', 'filter_archives_by_specific_year', 10, 2 );
              wp_get_archives(
                  array(
                      'type'            => 'monthly',
                      'show_post_count' => true,
                      'year'            => $year, // 年を指定
                  )
              );
              remove_filter( 'getarchives_where', 'filter_archives_by_specific_year' );
          }

          // 2024年のアーカイブを表示
          display_year_and_month_archives( 2024 );          

          // 2023年のアーカイブを表示
          display_year_and_month_archives( 2023 );

          // 2022年のアーカイブを表示
          display_year_and_month_archives( 2022 );
          ?>
          </div>
        </div>
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
              'order' => 'DESC',      // 降順（多い順）
              'number' => 10,       // 上位10個だけ取得
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