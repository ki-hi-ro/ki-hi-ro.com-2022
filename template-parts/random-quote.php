<?php
$quote = get_random_quote_from_posts();

if ($quote):
?>
<a
  href="<?php echo esc_url($quote['url']); ?>"
  class="quote-box quote-link js-quote-box"
>
  <p class="js-quote-text">
    <?php echo esc_html($quote['text']); ?>
  </p>
</a>
<?php endif; ?>