<?php get_header(); ?>
<?php  $category = get_the_category(); $cat = $category[0]; ?>
<main class="l-container">
    <div class="l-pc-left --single">
        <article class="post">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="bread">
            <!-- Breadcrumb NavXT 7.1.0 -->
            <span property="itemListElement" typeof="ListItem">
                <a property="item" typeof="WebPage" title="Go to ki-hi-ro.com." href="<?php echo home_url(); ?>" class="home">
                    <span property="name">TOP</span>
                </a>
                <meta property="position" content="1"></span> &gt; <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="これまでに書いた記事" href="<?php echo home_url("all-article"); ?>" class="taxonomy category"><span property="name">これまでに書いた記事</span></a><meta property="position" content="2"></span> &gt; <span property="itemListElement" typeof="ListItem"><span property="name" class="post post-post current-item"><?php the_title(); ?></span><meta property="url" content="http://localhost:8888/step-count-january-8-2023/"><meta property="position" content="3"></span></div>
            
            <div class="all-article__date"><?php echo get_the_date('Y.m.d'); ?></div>
            <h1 class="post__ttl"><?php the_title(); ?></h1>
            <?php the_post_thumbnail( array( 366, 244 ), ['class' => 'post__thumb']  );?>
            <?php if(!in_category('record')): ?>
            <h2 id="first-ttl">はじめに</h2>
            <?php endif; ?>
            <div class="post__content">
                <?php
                if(in_category('record')) :
                    get_template_part('template-parts/record');
                else :
                    the_content();
                endif;
                ?>
            </div>

            <?php
            $prevpost = get_adjacent_post(false, '', true);
            $nextpost = get_adjacent_post(false, '', false);
            if( $prevpost or $nextpost) :
            ?>
            <ul class="nav-links">
                <?php if( $prevpost ) : ?>
                <li class="nav-links__nav --pre">
                    <a class="nav-links__link" href="<?php echo get_permalink($prevpost->ID); ?>">
                        ← <?php echo get_the_title( $prevpost->ID ); ?>
                    </a>
                </li>
                <?php endif; ?>
                <?php if( $nextpost ) : ?>
                <li class="nav-links__nav --next">
                    <a class="nav-links__link" href="<?php echo get_permalink($nextpost->ID); ?>">
                        <?php echo get_the_title( $nextpost->ID ); ?> →
                    </a>
                </li>
                <?php endif; ?>
            </ul>
            <?php endif; ?>
            <?php endwhile; endif; ?>

        </article>
    </div>
    <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>