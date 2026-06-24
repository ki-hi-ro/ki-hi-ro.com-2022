<?php
/**
 * Image-led home introduction.
 */

$serendipity_images = kihiro_get_serendipity_images(7);
$serendipity_quotes = kihiro_get_quote_candidates();

if ($serendipity_quotes) {
    shuffle($serendipity_quotes);
}

if (!$serendipity_quotes) {
    $serendipity_quotes = array(
        array(
            'text'  => '移動するほど、考えは少しずつ自分の輪郭を取り戻す',
            'url'   => home_url('/'),
            'title' => 'ki-hi-ro.com',
        ),
        array(
            'text'  => '偶然に出会った景色が、あとから必要だった言葉になる',
            'url'   => home_url('/'),
            'title' => 'ki-hi-ro.com',
        ),
        array(
            'text'  => 'よく働き、よく歩き、よく考えるために記録を残す',
            'url'   => home_url('/'),
            'title' => 'ki-hi-ro.com',
        ),
    );
}

$hero_quotes = array_slice($serendipity_quotes, 0, 4);
?>

<section class="outer-container site-hero serendipity-hero" aria-labelledby="site-hero-title">
  <div class="serendipity-hero__copy">
    <p class="site-hero__eyebrow">Nature / Serendipity / Philosophy</p>
    <h1 id="site-hero-title" class="site-hero__title">ki-hi-ro.com</h1>
    <p class="site-hero__lead">自然、セレンディピティ、哲学</p>
    <div class="site-hero__actions">
      <a class="site-hero__primary" href="#latest-notes">最新の記事<span aria-hidden="true">↘</span></a>
      <a class="site-hero__secondary" href="<?php echo esc_url(kihiro_thought_trail_url()); ?>">思考の軌跡</a>
    </div>
  </div>

  <div class="serendipity-hero__field" aria-label="ランダムに選ばれた写真と言葉">
    <?php foreach (array_slice($serendipity_images, 0, 5) as $image_index => $image) : ?>
      <a class="serendipity-card serendipity-card--photo serendipity-card--photo-<?php echo esc_attr($image_index + 1); ?>" href="<?php echo esc_url($image['link']); ?>">
        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" loading="<?php echo 0 === $image_index ? 'eager' : 'lazy'; ?>" decoding="async">
        <span>Scene <?php echo esc_html(str_pad((string) ($image_index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
      </a>
    <?php endforeach; ?>

    <?php foreach (array_slice($hero_quotes, 0, 3) as $quote_index => $quote) : ?>
      <a class="serendipity-card serendipity-card--quote serendipity-card--quote-<?php echo esc_attr($quote_index + 1); ?>" href="<?php echo esc_url($quote['url']); ?>">
        <span>Random quote</span>
        <p><?php echo esc_html($quote['text']); ?></p>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<section class="outer-container serendipity-quotes" aria-labelledby="serendipity-quotes-title">
  <div class="serendipity-quotes__intro">
    <p class="section-kicker">Philosophy cards</p>
    <h2 id="serendipity-quotes-title">今日の名言集</h2>
  </div>
  <div class="serendipity-quotes__grid">
    <?php foreach ($hero_quotes as $quote_index => $quote) : ?>
      <a class="serendipity-quote" href="<?php echo esc_url($quote['url']); ?>">
        <span><?php echo esc_html(sprintf('No. %02d', $quote_index + 1)); ?></span>
        <p><?php echo esc_html($quote['text']); ?></p>
        <small><?php echo esc_html($quote['title']); ?></small>
      </a>
    <?php endforeach; ?>
  </div>
</section>
