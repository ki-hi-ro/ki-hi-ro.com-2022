<?php
$experiences = kihiro_work_experiences();
$technical_category = get_term_by('name', '技術・開発', 'category');
?>
<section class="work-experiences" id="work-experience" aria-labelledby="work-experience-heading">
  <header class="work-home__heading"><p class="magazine-eyebrow">MY EXPERIENCE</p><h2 id="work-experience-heading">私が、現場で取り組んできたこと。</h2><p>実際の業務で、私自身が担当した範囲と、そのときの進め方をまとめています。</p></header>
  <div class="work-experiences__list">
    <?php foreach ($experiences as $key => $experience) : ?>
      <article class="work-experience" id="experience-<?php echo esc_attr($key); ?>">
        <p class="work-experience__period"><?php echo esc_html($experience['period']); ?></p>
        <h3><?php echo esc_html($experience['title']); ?></h3>
        <p class="work-experience__role"><?php echo esc_html($experience['role']); ?></p>
        <p><?php echo esc_html($experience['context']); ?></p>
        <h4>私が担当したこと</h4><ul><?php foreach ($experience['tasks'] as $task) : ?><li><?php echo esc_html($task); ?></li><?php endforeach; ?></ul>
        <h4>そのとき、どう進めたか</h4><p><?php echo esc_html($experience['approach']); ?></p>
        <p class="work-experience__tech"><?php echo esc_html($experience['tech']); ?></p>
        <?php
        $related_articles = !empty($experience['article_ids']) && $technical_category instanceof WP_Term
            ? get_posts(array(
                'post_type' => 'post', 'post_status' => 'publish', 'has_password' => false,
                'post__in' => array_map('absint', $experience['article_ids']),
                'post__not_in' => kihiro_excluded_post_ids(),
                'cat' => $technical_category->term_id,
                'posts_per_page' => 3, 'orderby' => 'post__in', 'ignore_sticky_posts' => true,
            )) : array();
        ?>
        <?php if ($related_articles) : ?>
          <div class="work-experience__articles">
            <h4>関連する技術記事</h4>
            <ul><?php foreach ($related_articles as $related_article) : ?>
              <li><a href="<?php echo esc_url(get_permalink($related_article)); ?>"><?php echo esc_html(get_the_title($related_article)); ?></a><time datetime="<?php echo esc_attr(get_the_date('Y-m-d', $related_article)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $related_article)); ?> 公開</time></li>
            <?php endforeach; ?></ul>
          </div>
        <?php endif; ?>
      </article>
    <?php endforeach; ?>
  </div>
  <p class="work-experiences__note">2026年10月9日付の職務経歴と、本人による補足・訂正に基づく概要です。実務への参画経験であり、各プロジェクト全体を単独で担当したものではありません。</p>
</section>
