<?php $bread_location = isset($args['location']) ? sanitize_html_class($args['location']) : 'default'; ?>
<nav class="bread bread--<?php echo esc_attr($bread_location); ?>" aria-label="パンくずリスト">
  <span property="itemListElement" typeof="ListItem">
    <a property="item" typeof="WebPage" title="Go to ki-hi-ro.com." href="<?php echo esc_url(home_url('/')); ?>" class="home">
      <span property="name">TOP</span>
    </a>
    <meta property="position" content="1">
  </span> ＞

  <span property="itemListElement" typeof="ListItem">
    <a href="<?php echo esc_url(get_permalink()); ?>">
      <span property="name" class="post post-post current-item"><?php echo esc_html(get_the_title()); ?></span>
    </a>
    <meta property="url" content="<?php the_permalink(); ?>">
    <meta property="position" content="<?php echo esc_attr(isset($args['position']) ? (int) $args['position'] : 2); ?>">
  </span>
</nav>
