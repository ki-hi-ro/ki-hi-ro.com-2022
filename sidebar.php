  <aside class="l-pc-right">
    <?php 
    if(!is_page('vue-js-study-plan')) {
      get_search_form() ; 
    }
    ?>

    <?php echo get_template_part('template-parts/author'); ?>

    <!-- <div class="sidebar-archive">
      <h3 class="sidebar-archive__ttl sidebar-ttl">過去記事アーカイブ</h3>
      <ul class="sidebar-archive__list-wrap sidebar-archive-list">
        <?php wp_get_archives('post_type=post&type=monthly&show_post_count=1');?>
      </ul>
    </div> -->

    <!-- <div class="sidebar-archive">
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
    </div> -->

    <?php if(is_single()) : ?>
      <div class="blog-article__aside-table-of-contents">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()): ?>
        <?php endif;?>
      </div>
    <?php endif; ?>
  </aside>