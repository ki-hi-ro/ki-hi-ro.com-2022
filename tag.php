<?php get_header(); ?>
<?php
$term = get_queried_object();
$term_slug = $term->slug;
$term_name = $term->name;
$term_desc = $term->description;
?>
<?php if($term_slug == "basic-info") : ?>
  <div class="basic-info">
    <h2 class="basic-info__ttl">合格しました！（2023年5月21日 追記）</h2>
    <div class="basic-info__img">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/goukaku.png" alt="基本情報技術者 合格">
    </div>
    <p class="basic-info__p l-container">これまでに書いた基本情報技術者についての記事一覧はこちら</p>
  </div>
<?php endif; ?>
<?php
$tag_mv = get_template_directory_uri() . "/assets/img/tag/tag-mv-" . $term_slug . ".png";
error_reporting(0);
if(exif_imagetype($tag_mv)) :
?>
<div class="tag-mv l-container">
  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/tag/tag-mv-<?php echo $term_slug; ?>.png" alt="<?php echo $term_name; ?>の一覧ページのメイン画像">
  <h1><?php echo $term_name; ?></h1>
  <div class="overlay"></div>
</div>
<?php endif; ?>
<main class="l-container">
  <div class="l-pc-left">
    <!-- <section class="front-sec">
        <h2 class="front-sec__ttl"><?php echo $term_name; ?>についての記事</h2>
    </section> -->
    <div class="front-sec__text front-sec__flex">
      <?php echo get_template_part("template-parts/blog-list-thumb-desc"); ?>
    </div>
  </div>
  <?php get_sidebar();?>
</main>
<?php get_footer(); ?>