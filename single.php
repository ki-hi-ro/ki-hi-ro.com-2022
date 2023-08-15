<?php get_header(); ?>
<?php  $category = get_the_category(); $cat = $category[0]; ?>
<?php
$posttags = get_the_tags();
if($posttags) {
    $last_position = 4;
    foreach($posttags as $tag) {
        $tag_slug = $tag->slug;
        $tag_name = $tag->name;
    }
} else {
    $last_position = 3;
}
?>
<main class="l-container">
    <div class="l-pc-left --single">
        <article class="post">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php echo get_template_part('template-parts/single-bread'); ?>
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
            <?php comments_template(); ?>
            <?php echo get_template_part('template-parts/single-bread'); ?>
            <?php endif; ?>
            <?php endwhile; endif; ?>

        </article>
    </div>
    <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>