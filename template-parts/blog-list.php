<div class="all-article__post-wrap">
    <div class="all-article__main">
      <div class="all-article__text-wrap">
        <div class="all-article__tag-date">
          <?php
          $flag = get_the_tags(); foreach ( (array)$flag as $tag ) {} if($tag) :
          $tag_image = get_template_directory_uri() . "/assets/img/tag/" . $tag -> slug . ".png";
          $tag_image_system = get_template_directory() . "/assets/img/tag/" . $tag -> slug . ".png";
          if(file_exists($tag_image_system)) :
          ?>
            <img src="<?php echo $tag_image; ?>" alt="" class="all-article__tag-icon">
          <?php
            endif;
          endif;
          ?>
          <div class="all-article__tag-date-not-img">
            <div class="all-article__tag"><?php the_tags(''); ?></div>
            <div class="all-article__date"><?php echo get_the_date('Y.m.d'); ?></div>
          </div>
        </div>
        <div class="all-article__text">
          <a class="all-article__href" href="<?php the_permalink(); ?>">
            <div class="all-article__ttl"><?php the_title(); ?></div>
          </a>
          <div class="all-article__desc">
            <p class="all-article__desc-pc"><?php echo custom_excerpt_pc(); ?></p>
            <p class="all-article__desc-sp"><?php echo custom_excerpt_sp(); ?></p>
            <?php if (has_post_thumbnail()) : the_post_thumbnail('',array( 'class' => 'front-sec__flex-item-thumb' )); else : ?>
              <img class="front-sec__flex-item-thumb" src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/no-image.png" alt="no-image">
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
</div>