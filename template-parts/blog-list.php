<?php
$post_tags        = get_the_tags();
$visible_tags     = $post_tags ? array_slice($post_tags, 0, 4) : array();
$hidden_tag_count = $post_tags ? max(0, count($post_tags) - count($visible_tags)) : 0;
$tag_slugs        = $post_tags ? wp_list_pluck($post_tags, 'slug') : array();
$default_thumbnail_url = get_theme_file_uri('/assets/img/logbook-default-thumbnail.jpg');
$thumbnail_error_fallback = "this.onerror=null;this.removeAttribute('srcset');this.removeAttribute('sizes');this.src=this.dataset.defaultSrc;this.classList.add('all-article__media-img--default');";
?>

<a class="all-article__post-wrap" href="<?php the_permalink(); ?>" data-logbook-item data-logbook-tags="<?php echo esc_attr(implode(' ', $tag_slugs)); ?>" data-logbook-date="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
  <div class="all-article__date-block">
    <time class="all-article__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
      <?php echo get_the_date('Y.m.d'); ?>
    </time>
  </div>

  <figure class="all-article__media" aria-hidden="true">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('medium_large', array('class' => 'all-article__media-img', 'alt' => '', 'loading' => 'lazy', 'decoding' => 'async', 'data-default-src' => $default_thumbnail_url, 'onerror' => $thumbnail_error_fallback)); ?>
    <?php else : ?>
      <img class="all-article__media-img all-article__media-img--default" src="<?php echo esc_url($default_thumbnail_url); ?>" alt="" width="900" height="900" loading="lazy" decoding="async">
    <?php endif; ?>
  </figure>

  <div class="all-article__content">
    <div class="all-article__ttl">
      <?php echo esc_html(get_the_title()); ?>
    </div>

    <?php if ($visible_tags) : ?>
      <div class="all-article__labels" aria-label="記事タグ">
        <?php foreach ($visible_tags as $post_tag) : ?>
          <span class="all-article__label"># <?php echo esc_html($post_tag->name); ?></span>
        <?php endforeach; ?>
        <?php if ($hidden_tag_count > 0) : ?>
          <span class="all-article__label all-article__label--more">+ <?php echo esc_html(number_format_i18n($hidden_tag_count)); ?></span>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</a>
