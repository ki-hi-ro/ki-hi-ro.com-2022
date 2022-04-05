
		<?php
			// LPページ用のカスタマイズ
			if ( !is_page_template( 'page_lp.php' ) && !is_home() && !is_page('career') ) {
				get_sidebar();
			}
		?>
	</div> <!-- end onf row -->
</div> <!-- end onf container -->

</main><!-- end main -->

<?php
wp_reset_query();
// if ( !is_home() ) {
//   get_template_part( 'breadcrumb' );
// }
?>

<footer id="footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

	<!-- <div class="footer__contents container">
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<h4>About</h4>
				<hr>
				<div style="clear:both"></div>
				<?php // $profile_description = esc_html(get_option(ORIGINAL_FIELD_PROFILE_DESCRIPTION, '')); ?>
				<p><?php // echo nl2br($profile_description); ?></p>
			</div>

			<div class="col-xs-12 col-sm-4">
				<h4>Portfolio</h4>
				<hr>
				<div style="clear:both"></div>
				<ul class="list-unstyled">
					<?php
						wp_nav_menu( array(
							'menu_class'      => '',
							'theme_location'    => 'footer-navigation',
							'container'         => false,
							'items_wrap' => '%3$s',
							'depth'           => 1,
						) );
					?>
				</ul>
			</div>

			<?php $twitter_id_footer = esc_html(get_option(ORIGINAL_FIELD_TWITTER_ID_FOOTER, 'manabubannai')); ?>
			<div class="col-xs-12 col-sm-4">
				<h4>Twitter</h4>
				<hr class="twitter">
				<div style="clear:both"></div>
				<a class="twitter-timeline" height="570" href="https://twitter.com/<?php echo $twitter_id_footer; ?>?ref_src=twsrc%5Etfw">Tweets by <?php echo $twitter_id_footer; ?> </a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
		</div>
	</div>

	<div class="container-fluid credit">
		<div class="to-top row" @click="toTop">
			<p class="col-xs-12 text-center"><i class="fas fa-caret-up mr-3"></i>To Top</p>
		</div>
		<div class="row">
			<p class="col-xs-12 text-center">Shibata Hiroki</p>
		</div>
	</div> -->

</footer>

</body>
<!--
<script src="<?php echo get_template_directory_uri(); ?>/scripts/min/myscripts-min.js"></script>
<script type="text/javascript">
function downloadJSAtOnload() {
	var element = document.createElement("script");
	element.src = "<?php echo get_template_directory_uri(); ?>/scripts/min/defer-min.js";
	document.body.appendChild(element);
}
if (window.addEventListener)
	window.addEventListener("load", downloadJSAtOnload, false);
else if (window.attachEvent)
	window.attachEvent("onload", downloadJSAtOnload);
else window.onload = downloadJSAtOnload;

(function () {
	$(function(){
		$('ul.navbar-nav li:has(ul.sub-menu)').addClass('dropdown');
		$('.dropdown .sub-menu').addClass('dropdown-menu');
		$('.dropdown > a').replaceWith(function() {
			var tag_href = $(this).attr("href");
			if ( tag_href == null ) {
				var tag_href_plus =[];
			} else {
				var tag_href_plus = 'href="'+tag_href+'"';
			}
			$(this).replaceWith('<a '+tag_href_plus+' itemprop="url" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'+$(this).html()+'<span class="caret"></span></a>')
		});
		$('#footer ul a').replaceWith(function() {
			var tag_href = $(this).attr("href");
			if ( tag_href == null ) {
				var tag_href_plus =[];
			} else {
				var tag_href_plus = 'href="'+tag_href+'"';
			}
			$(this).replaceWith('<a '+tag_href_plus+' target="new" rel="nofollow">'+$(this).text()+'<span class="caret"></span></a>')
		});
	});
})(jQuery);
</script> -->

<?php wp_footer(); ?>
</html>