<?php $search_field_id = wp_unique_id('kihiro-search-field-'); ?>
<form action="<?php echo esc_url(home_url('/')); ?>" class="search-form" role="search" method="get">
  <label class="screen-reader-text" for="<?php echo esc_attr($search_field_id); ?>">キーワードで検索する</label>
  <button type="submit" class="search-form__btn" aria-label="検索">
    <svg class="search-form__icon" viewBox="0 0 24 24" aria-hidden="true">
      <path d="m21 21-4.35-4.35m2.35-5.15a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
    </svg>
  </button>
  <input id="<?php echo esc_attr($search_field_id); ?>" type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="検索" class="search-form__input">
</form>
