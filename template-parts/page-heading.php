<?php
/** Shared heading for interior pages. All text is escaped at output. */
?>
<header class="interior-heading sky-page-heading"><?php get_template_part('template-parts/concept-landscape'); ?>
  <?php if (!empty($args['eyebrow'])) : ?><p class="magazine-eyebrow"><?php echo esc_html($args['eyebrow']); ?></p><?php endif; ?>
  <h1><?php echo esc_html($args['title'] ?? get_the_title()); ?></h1>
  <?php if (!empty($args['description'])) : ?><p class="interior-heading__description"><?php echo esc_html($args['description']); ?></p><?php endif; ?>
</header>
