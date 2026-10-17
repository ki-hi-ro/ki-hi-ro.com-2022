<?php
/**
 * リンクカードは親記事と別のiframe文書として描画される。
 * スタイルはembed_headから読み込むembed.cssで調整する。
 * 抜粋はタグを除去してエスケープし、本文HTMLやスクリプトをカードに持ち込まない。
 */
?>
<div <?php post_class('wp-embed'); ?>>
  <?php if (!post_password_required()) : ?>
    <div class="wp-embed-featured-image">
      <a href="<?php the_permalink(); ?>" target="_top" tabindex="-1" aria-hidden="true"><?php echo wp_kses_post(kihiro_article_thumbnail(get_the_ID(), 'large')); ?></a>
    </div>
  <?php endif; ?>
  <p class="wp-embed-heading"><a href="<?php the_permalink(); ?>" target="_top"><?php the_title(); ?></a></p>
  <div class="wp-embed-excerpt"><p><?php
    $preview = post_password_required() ? 'この記事はパスワードで保護されています。' : wp_trim_words(wp_strip_all_tags(strip_shortcodes(get_the_content(''))), 70, '…');
    echo esc_html($preview);
  ?></p></div>
</div>
