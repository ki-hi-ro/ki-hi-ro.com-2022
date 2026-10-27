<?php
$guides = require get_template_directory() . '/content/article-guides.php';
$articles = array();
foreach ($guides as $article_id => $guide) {
    $article = get_post($article_id);
    if ($article && 'post' === $article->post_type && 'publish' === $article->post_status && !$article->post_password) {
        $articles[] = array('post' => $article, 'guide' => $guide);
    }
}
if (!$articles) return;
?>
<section class="work-home__section work-help" id="work-help" aria-labelledby="work-help-heading">
  <header class="work-home__heading"><p class="magazine-eyebrow">FROM THE JOURNAL</p><h2 id="work-help-heading">こんなお悩みは、ありませんか。</h2><p>私が実際に向き合った課題と、学んだことを記事にまとめています。<br>近いお悩みから、解決の糸口を探してみてください。</p></header>
  <div class="work-help-grid">
    <?php foreach ($articles as $item) : $article = $item['post']; $guide = $item['guide']; ?>
      <article class="work-help-article">
        <a href="<?php echo esc_url(get_permalink($article)); ?>">
          <span class="work-help-article__image" aria-hidden="true"><?php echo kihiro_article_thumbnail($article->ID, 'medium_large'); ?></span>
          <div class="work-help-article__body">
            <p class="work-help-article__topic"><?php echo esc_html($guide['topic']); ?></p>
            <h3><?php if (!empty($guide['heading_parts'])) : ?><?php foreach ($guide['heading_parts'] as $part) : ?><span class="work-help-article__phrase"><?php echo esc_html($part); ?></span><?php endforeach; ?><?php else : ?><?php echo esc_html($guide['heading']); ?><?php endif; ?></h3>
            <p class="work-help-article__summary"><?php echo esc_html($guide['summary']); ?></p>
            <span class="work-help-article__more">記事を読む <span aria-hidden="true">→</span></span>
          </div>
        </a>
      </article>
    <?php endforeach; ?>
  </div>
</section>
