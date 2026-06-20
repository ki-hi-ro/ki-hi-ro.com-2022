<form action="<?php echo esc_url(home_url('/')); ?>" class="search-form" role="search" method="get">
  <label class="screen-reader-text" for="kihiro-search-field">キーワードで検索する</label>
  <input id="kihiro-search-field" type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="キーワードで検索する" class="search-form__input">
  <button type="submit" class="search-form__btn">
    <img src="<?php echo esc_url(get_theme_file_uri('/assets/img/search-icon.svg')); ?>" alt="" class="search-form__icon-img">
  </button>
</form>
