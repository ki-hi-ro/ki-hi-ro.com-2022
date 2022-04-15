<?php

// css
wp_enqueue_style('style', get_template_directory_uri() . '/style.css');

// js
wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/6cff6feef5.js', null, null, true);
wp_enqueue_script('jquery', null , null, null, true);
wp_enqueue_script('cdn-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js' , null, null, true);
wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.js' , null, null, true);
