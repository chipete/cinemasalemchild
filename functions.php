<?php
/**
 * Created by PhpStorm.
 * User: Chris
 * Date: 1/23/16
 * Time: 10:01 PM
 */


add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    // Theme stylesheet
    wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );
}
