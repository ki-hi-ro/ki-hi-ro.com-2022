<div class="bread">
  <!-- Breadcrumb NavXT 7.1.0 -->
  <span property="itemListElement" typeof="ListItem">
    <a property="item" typeof="WebPage" title="Go to ki-hi-ro.com." href="<?php echo home_url(); ?>" class="home">
      <span property="name">TOP</span>
    </a>
    <meta property="position" content="1">
  </span> &gt;

  <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="これまでに書いた記事" href="<?php echo home_url("all-article"); ?>" class="taxonomy category"><span property="name">過去の記事一覧</span></a>
    <meta property="position" content="2">
  </span> &gt;

  <?php $posttags = get_the_tags(); ?>
  <?php if($posttags) : ?>
  <?php if($posttags) {
    $last_position = 4;
    foreach($posttags as $tag) {
        $tag_slug = $tag->slug;
        $tag_name = $tag->name;
    }
    } else {
        $last_position = 3;
    }
  ?>
  <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="<?php echo $tag_name; ?>" href="<?php echo home_url("tag/{$tag_slug}"); ?>" class="taxonomy category"><span property="name"><?php echo $tag_name; ?></span></a>
    <meta property="position" content="3">
  </span> &gt;
  <?php endif; ?>

  <span property="itemListElement" typeof="ListItem"><a href="<?php the_permalink(); ?>"><span property="name" class="post post-post current-item"><?php the_title(); ?></span></a>
    <meta property="url" content="http://localhost:8888/step-count-january-8-2023/">
    <meta property="position" content="<?php echo $last_position; ?>">
  </span>
</div>