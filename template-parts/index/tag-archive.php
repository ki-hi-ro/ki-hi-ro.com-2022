<?php
$term = get_queried_object();
$tag_description = tag_description();
?>

<?php if ($term instanceof WP_Term) : ?>
  <header class="journal-panel__header">
    <h1 class="journal-date-title"><?php echo esc_html($term->name); ?></h1>
    <p class="journal-panel__lead">このタグが付いた記事</p>
  </header>

  <?php if ($tag_description) : ?>
    <div class="journal-description">
      <?php echo wp_kses_post($tag_description); ?>
    </div>
  <?php endif; ?>

  <div class="journal-list">
    <?php get_template_part('template-parts/tag-posts'); ?>
  </div>
<?php endif; ?>
