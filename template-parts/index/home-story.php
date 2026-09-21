<?php
$story_index = get_page_by_path('story');
$featured_stories = $story_index && $story_index->post_status === 'publish'
    ? get_posts(array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_parent' => $story_index->ID,
        'posts_per_page' => 1,
        'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'),
        'has_password' => false,
    )) : array();
?>
<section id="home-story" class="home-story" aria-labelledby="home-story-heading">
  <div class="home-story__intro">
    <p class="magazine-eyebrow">STORY</p>
    <h2 id="home-story-heading">日々の記録を、<br>ひとつの物語へ。</h2>
    <p>つくること、働くこと、生きること。<br>選択と変化の道のりを振り返ります。</p>
    <a class="magazine-text-link" href="<?php echo esc_url(home_url('/story/')); ?>">Story一覧へ <span aria-hidden="true">→</span></a>
  </div>
  <div class="home-story__feature">
    <?php foreach ($featured_stories as $featured_story) : ?>
      <p class="magazine-eyebrow">FEATURED STORY</p>
      <h3><a href="<?php echo esc_url(get_permalink($featured_story)); ?>"><?php echo esc_html($featured_story->post_title); ?></a></h3>
      <?php kihiro_story_period($featured_story->ID); ?>
      <?php if ($featured_story->post_excerpt) : ?><p class="home-story__excerpt"><?php echo esc_html($featured_story->post_excerpt); ?></p><?php endif; ?>
      <a class="magazine-text-link" href="<?php echo esc_url(get_permalink($featured_story)); ?>">このStoryを読む <span aria-hidden="true">→</span></a>
    <?php endforeach; ?>
    <?php if (!$featured_stories) : ?><p>Storyは準備中です。</p><?php endif; ?>
  </div>
</section>
