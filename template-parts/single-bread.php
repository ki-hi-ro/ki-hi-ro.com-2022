<?php
$bread_location = isset($args['location']) ? sanitize_html_class($args['location']) : 'default';
$post_tags      = get_the_tags();
$primary_tag    = $post_tags && !is_wp_error($post_tags) ? reset($post_tags) : null;
$primary_tag_url = $primary_tag ? get_tag_link($primary_tag) : '';

if (is_wp_error($primary_tag_url)) {
    $primary_tag_url = '';
}

$post_position = $primary_tag && $primary_tag_url ? 3 : 2;
?>
<nav class="bread bread--<?php echo esc_attr($bread_location); ?>" aria-label="パンくずリスト">
  <span property="itemListElement" typeof="ListItem">
    <a property="item" typeof="WebPage" title="Go to ki-hi-ro.com." href="<?php echo esc_url(home_url('/')); ?>" class="home">
      <span property="name">TOP</span>
    </a>
    <meta property="position" content="1">
  </span> ＞

  <?php if ($primary_tag && $primary_tag_url) : ?>
    <span property="itemListElement" typeof="ListItem">
      <a property="item" typeof="WebPage" href="<?php echo esc_url($primary_tag_url); ?>">
        <span property="name"><?php echo esc_html($primary_tag->name); ?></span>
      </a>
      <meta property="url" content="<?php echo esc_url($primary_tag_url); ?>">
      <meta property="position" content="2">
    </span> ＞
  <?php endif; ?>

  <span property="itemListElement" typeof="ListItem">
    <a href="<?php echo esc_url(get_permalink()); ?>">
      <span property="name" class="post post-post current-item"><?php echo esc_html(get_the_title()); ?></span>
    </a>
    <meta property="url" content="<?php the_permalink(); ?>">
    <meta property="position" content="<?php echo esc_attr(isset($args['position']) ? (int) $args['position'] : $post_position); ?>">
  </span>
</nav>
