<?php 
get_header();
$term = null;
if(is_tag()) { 
    $term = get_queried_object(); 
} 
?>

<main class="front-container">
  <div class="pc-left-container">
    <section class="front-sec">
      <?php if (is_search()) : ?>
        <h2 class="front-sec__ttl">"<?php echo get_search_query(); ?>" が本文中に含まれている記事</h2>
        <div class="front-sec__text front-sec__flex">
          <?php if (have_posts()): while(have_posts()) : the_post(); ?>
            <div class="all-article__link front-sec__flex-item">
              <?php get_template_part("template-parts/blog-list"); ?>
            </div>
          <?php endwhile; else: ?>
            <p>該当する記事はありませんでした。</p>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <div class="search-form-wrap --sp">
        <?php get_search_form(); ?>
      </div>      

      <?php 
      $is_front = is_home() || is_front_page();
      if ($is_front) : 
        get_template_part("template-parts/front-posts");
      endif;
      ?>

      <?php if (is_tag() && $term) :
        $article_list_ttl = esc_html($term->name) . "についての記事"; ?>

        <h2 class="front-sec__ttl --sp-center"><?php echo $article_list_ttl; ?></h2>
        <div class="front-sec__text front-sec__flex">
          <?php get_template_part("template-parts/blog-list-thumb-desc"); ?>
        </div>

      <?php endif; ?>
      
    </section>    
    
  </div>

  <?php get_sidebar('front'); ?>
</main>

<?php get_footer(); ?>