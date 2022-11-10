  <aside class="l-pc-right">
    <?php echo get_template_part('template-parts/author'); ?>

    <!-- <div class="twitter">
      <a class="twitter-timeline" data-width="100%" data-height="475" data-theme="light" href="https://twitter.com/2021_shibata?ref_src=twsrc%5Etfw">Tweets by 2021_shibata</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div> -->

    <h3 class="sidebar-archive__ttl sidebar-ttl --drink-comparison-record">WEBサイト制作</h3>
    <ul class="sidebar-archive__list-wrap sidebar-archive-list --drink-comparison-record">
      <?php
        $tags = get_tags();
        foreach( $tags as $tag) {
          if($tag->name == 'HTML / CSS' || $tag->name == 'Sass' || $tag->name == 'WordPress' || $tag->name == 'AdSense' || $tag->name == 'FS固定ページ' || $tag->name == 'google検索' || $tag->name == 'Illustrator' || $tag->name == 'jQuery' || $tag->name == 'LPコーディング' || $tag->name == 'SEO' || $tag->name == 'WEBサイト分析' || $tag->name == 'WEBデザイン'  || $tag->name == '迷惑メール対策') {
            echo '<li><a href="'. get_tag_link($tag->term_id) .'">' . $tag->name . '</a>（' . $tag->count . '）</li>';
          }
        }
      ?>
    </ul>

    <h3 class="sidebar-archive__ttl sidebar-ttl --drink-comparison-record">プログラミング</h3>
    <ul class="sidebar-archive__list-wrap sidebar-archive-list --drink-comparison-record">
      <?php
        $tags = get_tags();
        foreach( $tags as $tag) {
          if($tag->name == 'JavaScript' || $tag->name == 'SQL' || $tag->name == 'twig' || $tag->name == 'TypeScript' || $tag->name == 'Vue.js' || $tag->name == 'GitHub') {
            echo '<li><a href="'. get_tag_link($tag->term_id) .'">' . $tag->name . '</a>（' . $tag->count . '）</li>';
          }
        }
      ?>
    </ul>

    <h3 class="sidebar-archive__ttl sidebar-ttl --drink-comparison-record">飲み比べ記録</h3>
    <ul class="sidebar-archive__list-wrap sidebar-archive-list --drink-comparison-record">
      <?php
        $tags = get_tags();
        foreach( $tags as $tag) {
          if($tag->name == 'お酒' || $tag->name == 'コーヒー') {
            echo '<li><a href="'. get_tag_link($tag->term_id) .'">' . $tag->name . '</a>（' . $tag->count . '）</li>';
          }
        }
      ?>
    </ul>

    <h3 class="sidebar-archive__ttl sidebar-ttl --drink-comparison-record">仕事について</h3>
    <ul class="sidebar-archive__list-wrap sidebar-archive-list --drink-comparison-record">
      <?php
        $tags = get_tags();
        foreach( $tags as $tag) {
          if($tag->name == 'コワーキングスペース' || $tag->name == 'マーケティング' || $tag->name == '契約' || $tag->name == '派遣社員') {
            echo '<li><a href="'. get_tag_link($tag->term_id) .'">' . $tag->name . '</a>（' . $tag->count . '）</li>';
          }
        }
      ?>
    </ul>

    <h3 class="sidebar-archive__ttl sidebar-ttl --drink-comparison-record">雑記ブログ</h3>
    <ul class="sidebar-archive__list-wrap sidebar-archive-list --drink-comparison-record">
      <?php
        $tags = get_tags();
        foreach( $tags as $tag) {
          if($tag->name == 'MUJI' || $tag->name == 'YouTube' || $tag->name == 'サウナ' || $tag->name == 'ストレス' || $tag->name == 'スムージー' || $tag->name == '音楽' || $tag->name == '旅行' || $tag->name == '本' || $tag->name == '桜' || $tag->name == '買い物') {
            echo '<li><a href="'. get_tag_link($tag->term_id) .'">' . $tag->name . '</a>（' . $tag->count . '）</li>';
          }
        }
      ?>
    </ul>

    <div class="sidebar-archive">
      <h3 class="sidebar-archive__ttl sidebar-ttl">年月アーカイブ</h3>
      <ul class="sidebar-archive__list-wrap sidebar-archive-list">
        <?php wp_get_archives('post_type=post&type=monthly&show_post_count=1');?>
      </ul>
    </div>

    <div class="sidebar-archive">
      <h3 class="sidebar-archive__ttl sidebar-ttl">タグ一覧</h3>
      <ul class="sidebar-archive__list-wrap sidebar-archive-list">
        <?php
        $tags = get_tags();
        foreach( $tags as $tag) {
          if($tag->name != 'サンプル') {
            echo '<li><a href="'. get_tag_link($tag->term_id) .'">' . $tag->name . '</a>（' . $tag->count . '）</li>';
          }
        }
        ?>
      </ul>
    </div>

    <?php if(is_single()) : ?>
      <div class="blog-article__aside-table-of-contents">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()): ?>
        <?php endif;?>
      </div>
    <?php endif; ?>
  </aside>