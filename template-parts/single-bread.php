<div class="bread">
  <span property="itemListElement" typeof="ListItem">
    <a property="item" typeof="WebPage" title="Go to ki-hi-ro.com." href="<?php echo home_url(); ?>" class="home">
      <span property="name">TOP</span>
    </a>
    <meta property="position" content="1">
  </span> ＞

  <span property="itemListElement" typeof="ListItem">
    <a href="<?php the_permalink(); ?>">
      <span property="name" class="post post-post current-item"><?php the_title(); ?></span>
    </a>
    <meta property="url" content="<?php the_permalink(); ?>">
    <meta property="position" content="<?php echo $position; ?>">
  </span>
</div>