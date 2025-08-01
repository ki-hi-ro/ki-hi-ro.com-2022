<?php get_header();?>
<?php
if(is_tag()) {
  $term = get_queried_object();
  $term_slug = $term->slug;
  $term_name = $term->name;
  $term_desc = $term->description;
}
?>

<main class="front-container">
  <div class="pc-left-container">
    <div class="search-form-wrap --sp">
      <?php get_search_form() ; ?>
    </div>
    <section class="front-sec">
      <h2 class="front-sec__ttl">"<?php echo get_search_query(); ?>" が本文中に含まれている記事</h2>
      <div class="front-sec__text front-sec__flex">
        <?php
        if (have_posts()):
          while(have_posts()) : the_post();
        ?>
          <div class="all-article__link front-sec__flex-item">
            <?php echo get_template_part("template-parts/blog-list"); ?>
          </div>
          <?php
          endwhile;
        else:
          ?>
          <p>該当する記事はありませんでした。</p>
          <?php endif ; ?>
      </div>
      <!-- <a class="front-sec__more" href="<?php echo home_url(); ?>">トップページはこちら</a> -->
    </section>
  </div>
  <div class="pc-right-container">
  <div class="search-form-wrap --pc">
    <?php get_search_form() ; ?>
  </div>

  <!-- <section class="front-sec">
    <h2 class="front-sec__ttl">年月アーカイブ</h2>
    <?php // echo get_template_part("template-parts/date-article-list"); ?>
  </section> -->
  
  <!-- <section class="front-sec">
    <h2 class="front-sec__ttl">タグ</h2>
    <div class="front-sec__text">
      <?php wp_tag_cloud('format=list&smallest=16&largest=16&unit=px&number=0&exclude=116'); ?>
    </div>
  </section> -->

  </div>
</main>

<?php get_footer();?>