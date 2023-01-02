<?php if(!has_tag('体重')) : ?>
    <h2 class="--record">画像</h2>
    <div class="single-article__record-record-slide-wrap">
        <div id="record-slide" class="single-article__record-record-slide">
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
    <h2 class="--record">感想</h2>
    <?php
    $review = get_field('review');
    if($review) :
    echo '<p class="--record">' . $review . '</p>';
    endif;
    ?>
    <h2 class="--record --purchase">ご購入はこちら</h2>
<?php endif; ?>

<?php the_content(); ?>