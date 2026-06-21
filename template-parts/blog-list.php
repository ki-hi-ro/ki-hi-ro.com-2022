<?php
$article_labels = array();

foreach (get_the_category() as $category) {
  $article_labels[] = $category->name;
}

$post_tags = get_the_tags();
if ($post_tags) {
  foreach ($post_tags as $tag) {
    $article_labels[] = $tag->name;
  }
}

$article_labels = array_slice(array_unique($article_labels), 0, 3);
?>

<a class="all-article__post-wrap" href="<?php the_permalink(); ?>">
  <div class="all-article__date-block">
    <time class="all-article__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
      <?php echo get_the_date('Y.m.d'); ?>
    </time>
    <time class="all-article__modified" datetime="<?php echo esc_attr(get_the_modified_date('c')); ?>">
      更新日：<?php echo get_the_modified_date('Y.m.d'); ?>
    </time>
  </div>

  <div class="all-article__content">
    <div class="all-article__ttl">
      <?php echo esc_html(get_the_title()); ?>
    </div>

    <?php if ($article_labels) : ?>
      <div class="all-article__labels" aria-label="カテゴリとタグ">
        <?php foreach ($article_labels as $article_label) : ?>
          <span class="all-article__label"><?php echo esc_html($article_label); ?></span>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="all-article__arrow" aria-hidden="true">
    →
  </div>
</a>
