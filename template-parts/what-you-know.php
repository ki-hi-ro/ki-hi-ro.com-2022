<?php the_post_thumbnail( array( 366, 244 ), ['class' => 'post__thumb']  );?>
<h2>この記事を読むと分かること</h2>
<ul>
    <?php while(have_rows('what-you-know')): the_row(); ?>
    <li><?php the_sub_field('text'); ?></li>
    <?php endwhile; ?>
</ul>
<?php if(!in_category('exercise-record')) : ?>
    <h2>はじめに</h2>
<?php elseif(in_category('exercise-record')) : ?>
    <h2>目次</h2>
<?php endif; ?>