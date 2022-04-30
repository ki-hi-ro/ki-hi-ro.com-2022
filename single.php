<?php get_header(); ?>

<div class="author col-xs-12 calendar single-wrap" itemprop="author" itemscope itemtype="http://schema.org/Person">
  <h1><?php the_title(); ?></h1>
	<div class="author__contents">
    <?php if(have_posts()): ?>
      <?php while(have_posts()): the_post(); ?>
            <?php if( is_single('schedule') ) : ?>
              <?php
              $week_list = ['日','月','火','水','木','金','土'];
              $week_num = date('w');
              $today_week = $week_list[$week_num];
              $minute = intval(date('i'));
              ?>
              <p class="last-modified-date-time">最終更新日時は、<?php the_modified_date("Y年n月j日 ${today_week}曜日 G時${minute}分"); ?>です。</p>
            <?php endif; ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
    <?php endif; ?>
    <h4>関連記事</h4>
    <?php
        $my_query = new WP_Query();
        global $post;
        $post_id = $post->ID;
        $taxonomy = 'post_tag';
        $term = get_the_terms($post_id, $taxonomy);
        $term_slug =  $term[0]->slug;

        $args = array(
          'post_type' => 'post',
          'tag'    => $term_slug,
          'post__not_in'   => array( $post->ID ),
          'posts_per_page' => 6,
          'orderby' => 'date',
          'order' => 'DESC',
        );
        $my_query->query( $args ); //データ取得
    ?>
    <?php if( $my_query->have_posts() ): while( $my_query->have_posts() ) : $my_query->the_post();?>
        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
    <?php endwhile; endif; wp_reset_postdata(); ?>

	</div>
</div>

<?php get_footer(); ?>