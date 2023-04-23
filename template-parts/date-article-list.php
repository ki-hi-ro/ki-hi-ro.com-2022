<div class="front-container --date-article-list">
  <div class="date-article-list">
    <?php
    wp_get_archives(
      array(
      'show_post_count'=>true,
      )
    )
    ?>
  </div>
</div>