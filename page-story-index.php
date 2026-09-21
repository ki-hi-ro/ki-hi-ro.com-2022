<?php
/** Template Name: Story — 一覧 */
get_header();
?>
<main id="main-content" class="story-page story-index">
  <?php while (have_posts()) : the_post(); ?>
    <header class="story-hero">
      <p class="story-eyebrow">STORY</p>
      <h1><?php the_title(); ?></h1>
      <div class="story-intro"><?php the_content(); ?></div>
    </header>
    <?php $stories = get_pages(array('parent' => get_the_ID(), 'sort_column' => 'menu_order,post_title', 'post_status' => 'publish')); ?>
    <div class="story-index__list">
      <?php foreach ($stories as $story) : ?>
        <article class="story-card">
          <p class="story-eyebrow"><?php echo esc_html(substr(get_post_meta($story->ID, '_kihiro_story_start', true), 0, 4)); ?></p>
          <h2><a href="<?php echo esc_url(get_permalink($story)); ?>"><?php echo esc_html($story->post_title); ?></a></h2>
          <?php kihiro_story_period($story->ID); ?>
          <p><?php echo esc_html($story->post_excerpt); ?></p>
          <a class="story-read" href="<?php echo esc_url(get_permalink($story)); ?>" aria-label="<?php echo esc_attr($story->post_title . 'を読む'); ?>">Read Story <span aria-hidden="true">→</span></a>
        </article>
      <?php endforeach; ?>
      <?php if (!$stories) : ?><p>Storyは準備中です。</p><?php endif; ?>
    </div>
  <?php endwhile; ?>
</main>
<?php get_footer(); ?>
