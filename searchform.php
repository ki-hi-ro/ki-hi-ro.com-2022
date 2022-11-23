<form action="<?php echo home_url(); ?>" method="get" class="search-form">
  <input type="text" name="s" placeholder="キーワードで検索する" class="search-form__input">
  <button type="submit" class="search-form__btn">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/search-icon.svg" alt="検索アイコン" class="search-form__icon-img">
  </button>
</form>