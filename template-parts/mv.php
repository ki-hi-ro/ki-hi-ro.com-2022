<?php
$term = get_queried_object();
$term_slug = $term->slug;
$term_name = $term->name;
$term_desc = $term->description;
$mv_text = '';
$mv_pc = 'mv-pc';
$mv_sp = 'mv-sp';
if ($term_name == '技術ブログ') {
  $mv_pc = 'mv-pc-skill';
  $mv_sp = 'mv-sp-skill';
  $modify = '--blog --skill';
} else if ($term_name == '学習ブログ') {
  $mv_pc = 'mv-pc-study';
  $mv_sp = 'mv-sp-study';
  $modify = '--blog --study';
} else if ($term_name == '雑記ブログ') {
  $mv_pc = 'mv-pc-random';
  $mv_sp = 'mv-sp-random';
  $modify = '--blog --random';
} else if ($term_name == 'これまでの仕事') {
  $mv_pc = 'mv-pc';
  $mv_sp = 'mv-sp';
  $modify = '--what-i-did';
}

if (is_front_page() || is_home()) {
  $mv_text = 'WEB制作のコーディングで<span class="sp-none">、</span><br class="only-sp">価値を提供する';
  $class_block = 'front-page';
} else if (is_archive() && !is_tag()) {
  $mv_text = $term_name;
  $class_block = 'blog-archive';
} else if (is_page('what-i-did')) {
  $mv_text = 'これまでの仕事';
  $class_block = 'page-what-i-did';
} else if (is_tag()) {
  $mv_text = $term_name;
  $class_block = 'tag';
  $modify = '--tag';
}
?>
<div class="mv">
  <div class="mv__text-wrap <?php echo $modify; ?> mv-text-wrap">
    <div class="mv__text <?php echo $modify; ?> mv-text"><?php echo $mv_text; ?></div>
  </div>
  <img class="pc-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/<?php echo $mv_pc; ?>.png?20220823-1" alt="PCのメインビジュアル">
  <img class="sp-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/<?php echo $mv_sp; ?>.png?20220823-1" alt="スマホのメインビジュアル">
  <div class="mv__scroll <?php echo $class_block; ?>__scroll <?php echo $modify; ?>">
    <span class="mv__scroll-text <?php echo $class_block; ?>__scroll-text <?php echo $modify; ?>">Scroll</span>
  </div>
</div>