<?php
/*
Plugin Name: Portfolio By ThimPress
Plugin URI: http://thimpress.com
Description: A plugin that allows you to show off your portfolio.
Author: thimpress
Version: 1.0
Author URI: http://thimpress.com
*/
	
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( !defined('THIM_PORTFOLIO_VERSION')) {
    define( 'THIM_PORTFOLIO_VERSION', '1.0' );
}

if( !defined('CORE_PLUGIN_URL')) {
    define( 'CORE_PLUGIN_URL', untrailingslashit( plugins_url( '/', __FILE__ ) ));
}

if( !defined('CORE_PLUGIN_PATH')) {
    define( 'CORE_PLUGIN_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ));
}

if( !defined('JS_URL')) {
    define( 'JS_URL', untrailingslashit( plugins_url( '/', __FILE__ ) )."/assets/js/" );
}

if( !defined('CSS_URL')) {
    define( 'CSS_URL', untrailingslashit( plugins_url( '/', __FILE__ ) )."/assets/css/" );
}

require_once 'thim-portfolio.php';
require_once CORE_PLUGIN_PATH . "/lib/thim-functions.php";
require_once CORE_PLUGIN_PATH . "/widget/thim-widget-portfolio.php";