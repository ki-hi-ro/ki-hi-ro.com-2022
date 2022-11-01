<?php get_header();?>

<div class="zoom-slider" id="slider">
  <h1 class="zoom-slider__text">名古屋</h1>
</div>

<div class="fadein">
  <h2 class="fadein__ttl">名古屋で撮影した写真</h2>
  <div class="fadein__contents">
    <?php for( $i = 1; $i <= 6; $i++) : ?>
	    <img class="fadein__img" src="<?php echo get_template_directory_uri(); ?>/assets/img/fade-in-zoom/nagoya-0<?php echo $i; ?>.jpg" alt="名古屋の写真<?php echo $i; ?>">
    <?php endfor; ?>
  </div>
</a>
</div>

<?php get_footer();?>