<?php get_header(); ?>

<div class="top-box col-xs-12">
	<section class="author" itemprop="author" itemscope itemtype="http://schema.org/Person">
		<img src="https://ki-hi-ro.com/ki-hi-ro.com-2022/wp-content/uploads/2022/01/2022-profile.png" class="img-responsive img-circle">
		<h4>
			<span itemprop="name">Shibata Hiroki</span>
		</h4>
		<hr>
		<div class="author__contents">
			<?php
				$my_postid = 1824;
				$content_post = get_post($my_postid);
				$content = $content_post->post_content;
				$content = apply_filters('the_content', $content);
				$content = str_replace(']]>', ']]＆gt;', $content);
				echo $content;
			?>
		</div>

	</section>

	<section class="skill-blog" id="skill-blog">
		<h2 class="skill-blog__sec-ttl">技術ブログ</h2>
		<?php
			$args = array (
					'category_name' => 'skill-blog',
					'post_type' => 'post',
					'posts_per_page' => 10,
			);
			$myposts = get_posts( $args );
			foreach( $myposts as $post ):
			setup_postdata($post);
		?>
		<a class="skill-blog__link" href="<?php the_permalink(); ?>">
			<div class="skill-blog__contents">
				<span class="skill-blog__date">
					<?php echo get_the_date( 'Y.m.d' ); ?>
				</span>
				<?php
				$posttags = get_the_tags();
				if( $posttags ) :
				?>
				<span class="skill-blog__tag">
					<?php
					foreach ( $posttags as $tag ) {
						echo $tag->name.' ';
					}
					?>
				</span>
				<?php endif; ?>
				<span class="skill-blog__ttl">
					<?php the_title(); ?>
				</span>
			</div>
		</a>

		<?php
			endforeach;
			wp_reset_postdata();
		?>

		<!-- <button class="skill-blog__btn">
			<a class="skill-blog-btn__link" href="">技術ブログ一覧</a>
		</button> -->

	</section>

		<section class="study-blog" id="study-blog">
		<?php
			$args = array (
				'category_name' => 'study-blog',
				'post_type' => 'post',
				'posts_per_page' => 10,
				'post_status' => 'publish'
			);
			$myposts = get_posts( $args );
			if($myposts) :
		?>
		<h2 class="study-blog__sec-ttl">学習ブログ</h2>
		<?php
			foreach( $myposts as $post ):
			setup_postdata($post);
		?>
		<a class="study-blog__link" href="<?php the_permalink(); ?>">
			<div class="study-blog__contents">
				<span class="study-blog__date">
					<?php echo get_the_date( 'Y.m.d' ); ?>
				</span>
				<?php
				$posttags = get_the_tags();
				if( $posttags ) :
				?>
				<span class="study-blog__tag">
					<?php
					foreach ( $posttags as $tag ) {
						echo $tag->name.' ';
					}
					?>
				</span>
				<?php endif; ?>
				<span class="study-blog__ttl">
					<?php the_title(); ?>
				</span>
			</div>
		</a>

		<?php
			endforeach;
			endif;
			wp_reset_postdata();
		?>

		<!-- <button class="study-blog__btn">
			<a class="study-blog-btn__link" href="">学習ブログ一覧</a>
		</button> -->

	</section>

		<section class="random-blog" id="random-blog">
		<?php
			$args = array (
				'category_name' => 'random-blog',
				'post_type' => 'post',
				'posts_per_page' => 10,
				'post_status' => 'publish'
			);
			$myposts = get_posts( $args );
			if($myposts) :
		?>
		<h2 class="random-blog__sec-ttl">雑記ブログ</h2>
		<?php
			foreach( $myposts as $post ):
			setup_postdata($post);
		?>
		<a class="random-blog__link" href="<?php the_permalink(); ?>">
			<div class="random-blog__contents">
				<span class="random-blog__date">
					<?php echo get_the_date( 'Y.m.d' ); ?>
				</span>
				<?php
				$posttags = get_the_tags();
				if( $posttags ) :
				?>
				<span class="random-blog__tag">
					<?php
					foreach ( $posttags as $tag ) {
						echo $tag->name.' ';
					}
					?>
				</span>
				<?php endif; ?>
				<span class="random-blog__ttl">
					<?php the_title(); ?>
				</span>
			</div>
		</a>

		<?php
			endforeach;
			endif;
			wp_reset_postdata();
		?>

		<!-- <button class="random-blog__btn">
			<a class="random-blog-btn__link" href="">雑記ブログ一覧</a>
		</button> -->

	</section>

	<section class="twitter">
		<h2 class="twitter__ttl">Twitter</h2>
		<a class="twitter-timeline" data-width="300" data-height="600" data-theme="light" href="https://twitter.com/2021_shibata?ref_src=twsrc%5Etfw">Tweets by 2021_shibata</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	</section>
</div>

<style>
	.author img {
    width: 130px;
    margin: 40px auto 0;
	}
	.img-responsive {
    display: block;
    max-width: 100%;
    height: auto;
	}
	.author h4 {
    text-align: center;
    font-family: "Avenir-Next";
    font-weight: 600;
    margin-top: 35px;
		font-size: 20px;
	}
	.author hr {
    width: 20%;
	}
	.author p {
    color: #7B7B7B;
    font-size: 12px;
    line-height: 25px;
    padding-left: 20px;
    padding-right: 20px;
    margin-top: 40px;
	}
	.home .author p {
    color: #000;
    font-size: 16px;
		font-weight: 300;
	}
	.skill-blog__sec-ttl {
		text-align: center;
	}
	.skill-blog__contents {
    max-width: 648px;
    margin: 0 auto;
		border: 1px solid #d2d2d2;
    padding: 5px 10px;
    color: #000;
	}
	.skill-blog__link:hover {
    text-decoration: none;
	}
	.skill-blog__tag {
		width: 24%;
		border: 1px solid #d2d2d2;
    padding: 0px 20px;
    text-align: center;
    display: inline-block;
    margin: 3px 10px;
	}
	.random-blog__sec-ttl {
		text-align: center;
	}
	.random-blog__contents {
    max-width: 648px;
    margin: 0 auto;
		border: 1px solid #d2d2d2;
    padding: 5px 10px;
    color: #000;
	}
	.random-blog__link:hover {
    text-decoration: none;
	}
	.random-blog__tag {
		width: 24%;
		border: 1px solid #d2d2d2;
    padding: 0px 20px;
    text-align: center;
    display: inline-block;
    margin: 3px 10px;
	}
	.study-blog__sec-ttl {
		text-align: center;
	}
	.study-blog__contents {
    max-width: 648px;
    margin: 0 auto;
		border: 1px solid #d2d2d2;
    padding: 5px 10px;
    color: #000;
	}
	.study-blog__link:hover {
    text-decoration: none;
	}
	.study-blog__tag {
		width: 24%;
		border: 1px solid #d2d2d2;
    padding: 0px 20px;
    text-align: center;
    display: inline-block;
    margin: 3px 10px;
	}
	@media (min-width: 768px) {
		.top-schedule {
			display: none;
		}
		.skill-blog {
			padding-left: 20px;
			padding-right: 20px;
		}
		.study-blog {
			padding-left: 20px;
			padding-right: 20px;
		}
		.random-blog {
			padding-left: 20px;
			padding-right: 20px;
		}
	}
	@media (max-width: 767px) {
		.home .main-contents .author {
			padding-bottom: 20px;
		}
		.home .author p {
			padding: 0;
		}
		.author__contents ul {
			padding-left: 20px;
		}
		.top-schedule p:nth-of-type(1) {
			margin-top: 20px;
		}
		.skill-blog__sec-ttl {
			margin-top: 50px;
		}
		.skill-blog__tag {
			display: none;
		}
		.skill-blog__ttl {
    	margin-left: 10px;
		}
		.random-blog__sec-ttl {
			margin-top: 50px;
		}
		.random-blog__tag {
			display: none;
		}
		.random-blog__ttl {
    	margin-left: 10px;
		}
		.study-blog__sec-ttl {
			margin-top: 50px;
		}
		.study-blog__tag {
			display: none;
		}
		.study-blog__ttl {
    	margin-left: 10px;
		}
	}
</style>

<?php get_footer(); ?>
