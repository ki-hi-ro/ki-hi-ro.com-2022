  <aside class="l-pc-right">
    <?php echo get_template_part('template-parts/author'); ?>

    <!-- <div class="twitter">
      <a class="twitter-timeline" data-width="100%" data-height="475" data-theme="light" href="https://twitter.com/2021_shibata?ref_src=twsrc%5Etfw">Tweets by 2021_shibata</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div> -->

    <ul class="sidebar-archive__list-wrap sidebar-archive-list">
      <h3 class="sidebar-archive__ttl sidebar-ttl">飲み比べ記録</h3>
      <li><a href="http://localhost:8888/2022/11/">コーヒー</a></li>
      <li><a href="http://localhost:8888/2022/10/">お酒</li>
    </ul>

    <div class="sidebar-archive">
      <h3 class="sidebar-archive__ttl sidebar-ttl">過去記事アーカイブ</h3>
      <ul class="sidebar-archive__list-wrap sidebar-archive-list">
        <?php wp_get_archives('post_type=post&type=monthly&show_post_count=1');?>
      </ul>
    </div>

    <div class="sidebar-archive">
      <h3 class="sidebar-archive__ttl sidebar-ttl">タグ</h3>
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