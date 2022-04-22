<?php get_header(); ?>

<div class="top-box col-xs-12">
  <figure class="page-mv">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/consultation/consultation-mv.png" alt="無料相談 メイン画像">
		<h1>無料相談<span>実施中</span></h1>
  </figure>

	<div class="page__contents-container">
		<section class="web-update" id="web-update">
      <p>
        WEBに関して、<br>
        あなたが抱えている悩みをご記入ください<br>
        WEBエンジニアの私が解決策のご提案をさせていただきます。<br>
        (可能な範囲で)
      </p>
      <?php the_content(); ?>
		</section>
	</div>

<?php get_footer();?>
