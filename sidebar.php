  <aside class="l-pc-right">
    <?php if(!is_single()) : ?>
      
    <?php get_search_form() ; ?>

    <?php echo get_template_part('template-parts/author'); ?>

    <div class="sidebar-archive">
      <h3 class="sidebar-archive__ttl sidebar-ttl">過去記事アーカイブ</h3>
      <ul class="sidebar-archive__list-wrap sidebar-archive-list">
        <?php wp_get_archives('post_type=post&type=monthly&show_post_count=1');?>
      </ul>
    </div>

      <div class="tag-list">
        <h3 class="tag-list__ttl">タグ</h3>
        <ul class="tag-list__wrap">
          <?php
          $tags = get_tags();
          foreach( $tags as $tag) {
            if($tag->name != 'サンプル') {
              echo '
                <li class="tag-li">
                  <a href="'. get_tag_link($tag->term_id) .'" class="tag-li__link">
                    ' . $tag->name . '
                  </a>
                </li>';
            }
          }
          ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if(is_single()) : ?>
    <div class="blog-article__aside-table-of-contents">
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()): ?>
      <?php endif;?>
    </div>
    <?php endif; ?>
  </aside>