<?php $experiences = kihiro_work_experiences(); ?>
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
      </article>
    <?php endforeach; ?>
  </div>
  <p class="work-experiences__note">2026年10月9日付の職務経歴に基づく概要です。実務への参画経験であり、各プロジェクト全体を単独で担当したものではありません。</p>
</section>
