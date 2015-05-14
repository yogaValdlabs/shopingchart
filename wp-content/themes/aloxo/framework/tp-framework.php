<?php

/**
 * ThimPress Framework
 *
 * A flexible Wordpress Framework, created by Tuannv
 *
 * This file includes the superobject class and loads the parameters neccessary for the backend pages.
 *
 * @author		Tuannv  
 * @copyright	
 * @link		http://thimpress.com
 * @since		Version 1.0
 * @package 	TPFramework
 * @version 	1.0

 */
//add script for admin
function custom_framework_enqueue( ) {
	wp_enqueue_style( 'thim-admin-custom-framework', TP_THEME_FRAMEWORK_URI . 'css/custom-framework.css' );
	wp_enqueue_script( 'thim-admin-custom-framewor', TP_THEME_FRAMEWORK_URI . 'js/custom-framework.js', array( 'jquery' ), '1.0', true );
}
add_action('admin_enqueue_scripts', 'custom_framework_enqueue');

//add script for frontend
function frontend_framework_enqueue( ) {
	wp_enqueue_script( 'framework-bootstrap', TP_THEME_FRAMEWORK_URI . 'js/bootstrap.min.js', array( 'jquery' ), false, true );
	wp_enqueue_style( 'thim-awesome', TP_THEME_FRAMEWORK_URI . 'css/font-awesome.min.css', array() );
}
add_action('wp_enqueue_scripts', 'frontend_framework_enqueue');

define('TP_FRAMEWORK_VERSION', "1.0");
include 'libs/tp-config.php';
