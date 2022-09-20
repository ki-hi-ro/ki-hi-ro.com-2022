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
}

if (is_front_page() || is_home()) {
  $mv_text = 'WEB制作のコーディングで<span class="sp-none">、</span><br class="only-sp">価値を提供する';
  $class_block = 'front-page';
} else if (is_archive()) {
  $mv_text = $term_name;
  $class_block = 'blog-archive';
}
?>
<div class="mv">
  <div class="mv__text-wrap <?php echo $modify; ?> mv-text-wrap">
    <div class="mv-text"><?php echo $mv_text; ?></div>
  </div>
  <img class="pc-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/<?php echo $mv_pc; ?>.png?20220823-1" alt="PCのメインビジュアル">
  <img class="sp-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/top/<?php echo $mv_sp; ?>.png?20220823-1" alt="スマホのメインビジュアル">
  <div class="<?php echo $class_block; ?>__scroll scrolldown1">
    <span class="<?php echo $class_block; ?>__scroll-text">Scroll</span>
  </div>
</div>