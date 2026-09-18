<?php
/** Shared article card for the home page, archive and search results. */
global $wp_query;
$card_index = isset($args['index']) ? (int) $args['index'] : (int) $wp_query->current_post;
$cover_style = max(0, $card_index) % 6;
$heading_tag = isset($args['heading_tag']) && 'h3' === $args['heading_tag'] ? 'h3' : 'h2';
?>
          <article class="magazine-card">
            <a class="magazine-card__link" href="<?php the_permalink(); ?>">
              <div class="magazine-card__cover magazine-card__cover--<?php echo esc_attr((string) $cover_style); ?>" aria-hidden="true">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('medium_large', array('class' => 'magazine-card__image', 'alt' => '', 'loading' => 'lazy')); ?>
                <?php else : ?>
                  <span class="magazine-card__cover-label">JOURNAL / <?php echo esc_html(get_the_date('Y')); ?></span>
                  <span class="magazine-card__word"><?php echo esc_html(get_the_date('m.d')); ?></span>
                  <span class="magazine-card__cover-footer"><span>ki-hi-ro.com</span></span>
                <?php endif; ?>
              </div>
              <div class="magazine-card__meta"><time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time></div>
              <<?php echo $heading_tag; ?>><?php echo esc_html(get_the_title()); ?></<?php echo $heading_tag; ?>>
              <p><?php echo esc_html(kihiro_custom_excerpt(70)); ?></p>
              <span class="magazine-card__read">続きを読む <span aria-hidden="true">↗︎</span></span>
            </a>
          </article>
