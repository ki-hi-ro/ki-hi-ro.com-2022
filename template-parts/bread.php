<div class="bread">
    <?php 
    if (function_exists('bcn_display')) :
        if(!in_category('vue-js')) :
            bcn_display();
        else :
    ?>
            <div class="bread">
                <!-- Breadcrumb NavXT 7.1.0 -->
                <span property="itemListElement" typeof="ListItem">
                    <a property="item" typeof="WebPage" title="Go to ki-hi-ro.com." href="http://localhost:8888" class="home"><span property="name">TOP</span></a>
                    <meta property="position" content="1">
                </span> &gt; <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to the Vue.js カテゴリー archives." href="http://localhost:8888/vue-js-study-plan/" class="taxonomy category"><span property="name">Vue.jsの学習計画</span></a>
                    <meta property="position" content="2">
                </span> &gt; <span property="itemListElement" typeof="ListItem"><span property="name" class="post post-post current-item">vue.jsとは？</span>
                    <meta property="url" content="http://localhost:8888/what-is-vue-js/">
                    <meta property="position" content="3">
                </span>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>