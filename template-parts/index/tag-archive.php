<?php
$term = get_queried_object();
$tag_description = tag_description();
?>

<?php if ($term instanceof WP_Term) : ?>
  <h1 class="front-sec__ttl<?php echo $tag_description ? '' : ' front-sec__ttl--list-heading'; ?>">
    <?php echo esc_html($term->name); ?>についての記事
  </h1>

  <?php if ($tag_description) : ?>
    <div class="description-class">
      <?php echo wp_kses_post($tag_description); ?>
    </div>
  <?php endif; ?>

  <div class="front-sec__text front-sec__flex article-list">
    <?php get_template_part('template-parts/tag-posts'); ?>
  </div>
<?php endif; ?>
