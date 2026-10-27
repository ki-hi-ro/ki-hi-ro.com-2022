<?php
/** Explicit article-to-experience links share the same mapping as the profile. */
if (post_password_required() || !is_singular('post')) return;
$related_experiences = array();
foreach (kihiro_work_experiences() as $key => $experience) {
    if (in_array(get_the_ID(), array_map('absint', $experience['article_ids'] ?? array()), true)) {
        $related_experiences[$key] = $experience;
    }
}
if (!$related_experiences) return;
$experience_page = get_page_by_path('about');
if (!$experience_page || 'publish' !== $experience_page->post_status || post_password_required($experience_page)) return;
?>
<aside class="article-related-experience" aria-label="関連する実務経験">
  <p class="article-related-experience__label">関連する実務経験</p>
  <?php foreach ($related_experiences as $key => $experience) : ?>
    <a class="article-related-experience__link" href="<?php echo esc_url(get_permalink($experience_page) . '#experience-' . $key); ?>">
      <span class="article-related-experience__title"><?php echo esc_html($experience['title']); ?></span>
      <span class="article-related-experience__meta"><?php echo esc_html($experience['period'] . ' ／ ' . $experience['role']); ?></span>
      <span class="article-related-experience__more">担当範囲・実務での取り組みを見る <span aria-hidden="true">→</span></span>
    </a>
  <?php endforeach; ?>
</aside>
