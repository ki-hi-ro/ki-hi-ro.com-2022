<?php get_header();?>
<?php
if(is_tag()) {
  $term = get_queried_object();
  $term_slug = $term->slug;
  $term_name = $term->name;
  $term_desc = $term->description;
}
?>

<main class="outer-container front-container">
  <div class="article-container">
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
      <a class="front-sec__more" href="<?php echo home_url(); ?>">トップページはこちら</a>
    </section>
  </div>
  <div class="pc-right-container">
    <div class="search-form-wrap --pc">
      <?php get_search_form() ; ?>
    </div>
  </div>
</main>

<?php get_footer();?>