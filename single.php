<?php 
get_header(); 

$posttags = get_the_tags();
if($posttags) { $last_position = 4; } else { $last_position = 3; }
?>
<main class="l-container">
  <div class="l-pc-left --single">
    <article class="post">

      <?php if (have_posts()) : while (have_posts()) : the_post(); if($posttags) : ?>
        <div class="post-tags">
          <ul>
            <?php foreach($posttags as $tag): ?>
              <li>
                <a href="<?php echo get_tag_link($tag->term_id); ?>">
                  <?php echo esc_html($tag->name); ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

      <?php 
      else : 
        echo get_template_part('template-parts/single-bread');
      endif; 
      ?>
      
      <div class="all-article__date"><?php echo get_the_date('Y.m.d'); ?>（更新日: <?php echo get_the_modified_date('Y.m.d'); ?>）</div>

      <h1 class="post__ttl"><?php the_title(); ?></h1>

      <?php the_post_thumbnail( array( 366, 244 ), ['class' => 'post__thumb'] );?>

      <h2 id="first-ttl">はじめに</h2>

      <div class="post__content">
        <?php the_content(); ?>
      </div>

      <?php comments_template(); ?>
      
      <?php
      $prevpost = get_adjacent_post(false, '', true);
      $nextpost = get_adjacent_post(false, '', false);
      if( $prevpost or $nextpost) :
      ?>
      <ul class="nav-links">
        
        <?php if( $prevpost ) : ?>
        <li class="nav-links__nav --pre">
          <a class="nav-links__link" href="<?php echo get_permalink($prevpost->ID); ?>">
            ← <?= get_the_title( $prevpost->ID ); ?>
          </a>
        </li>
        <?php endif; ?>

        <?php if( $nextpost ) : ?>
        <li class="nav-links__nav --next">
          <a class="nav-links__link" href="<?php echo get_permalink($nextpost->ID); ?>">
            <?= get_the_title( $nextpost->ID ); ?> →
          </a>
        </li>
        <?php endif; ?>
      </ul>

      <?php 
      echo get_template_part('template-parts/single-bread');

      endif; endwhile; endif; ?>
      <style>
        .post-tags h2 {
          font-size: 1.1em;
          margin-bottom: 10px;
        }
        .post-tags ul {
          list-style: none;
          padding: 0;
          display: flex;
          flex-wrap: wrap;
          gap: 8px;
        }
        .post-tags li a {
          font-family: Noto, Hiragino Sans, Helvetica, Arial, sans-serif;
          display: inline-block;
          padding: 4px 10px;
          background-color: #f0f0f0;
          color: black;
          border-radius: 4px;
          text-decoration: none;
          font-size: 14px;
        }
        .post-tags li a:hover {
          background-color: #e0e0e0;
        }
      </style>
    </article>
  </div>
  <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>