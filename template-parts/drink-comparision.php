<h2 class="--drink-comparison">画像</h2>
<div class="single-article__drink-comparison-record-slide-wrap">
    <div id="drink-comparision-slide" class="single-article__drink-comparison-record-slide">
        <?php
        $img_arr = ['item-img','item-img-2', 'price', 'place'];
            foreach($img_arr as $img_value) :
            $img_variable = get_field($img_value);
            if($img_variable){echo '<img src="'.$img_variable.'">';}
            endforeach;
        ?>
    </div>
    <div class="thumbs_dots"></div>
</div>
<h2 class="--drink-comparison">感想</h2>
<?php
$review = get_field('review');
if($review) : 
  echo '<p class="--drink-comparison">' . $review . '</p>';
endif;
?>
<h2 class="--drink-comparison --purchase">ご購入はこちら</h2>
<?php the_content(); ?>