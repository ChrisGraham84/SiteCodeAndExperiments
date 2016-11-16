<?php

//Add scripts and styleshets
function decondev_scripts(){
    //wp_enqueue_style ('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', array(), '3.3.6');
    wp_enqueue_style( 'reset', get_template_directory_uri() . '/css/reset.css' );
    wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css' );
    //wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true );
}
add_action('wp_enqueue_scripts', 'decondev_scripts');