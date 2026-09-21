<?php
/** Template Name: Story — 本編 */
get_header();
?>
<main id="main-content" class="story-page">
  <?php while (have_posts()) : the_post(); ?>
    <?php
    $parent_id = wp_get_post_parent_id(get_the_ID());
    $story_index_url = $parent_id ? get_permalink($parent_id) : home_url('/story/');
    $title_parts = explode('、', get_the_title(), 2);
    ?>
    <article>
      <header class="story-hero">
        <a class="story-back" href="<?php echo esc_url($story_index_url); ?>">← Story</a>
        <p class="story-eyebrow">STORY</p>
        <h1>
          <span><?php echo esc_html($title_parts[0] . (count($title_parts) > 1 ? '、' : '')); ?></span>
          <?php if (isset($title_parts[1])) : ?><span><?php echo esc_html($title_parts[1]); ?></span><?php endif; ?>
        </h1>
        <?php kihiro_story_period(get_the_ID()); ?>
      </header>
      <div class="story-body"><?php the_content(); ?></div>
      <nav class="story-end-nav" aria-label="Storyを読み終えたら">
        <a href="<?php echo esc_url($story_index_url); ?>">Story一覧へ</a>
        <a href="<?php echo esc_url(kihiro_all_articles_url()); ?>">日々のBlogを読む →</a>
      </nav>
    </article>
  <?php endwhile; ?>
</main>
<?php get_footer(); ?>
