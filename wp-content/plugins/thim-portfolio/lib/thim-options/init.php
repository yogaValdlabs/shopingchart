<?php
if( !defined('THIM_PORTFOLIO_OPTION')) {
    define( 'THIM_PORTFOLIO_OPTION', 'thim_portfolio_setting' );
}

if( !defined('THIM_OPTION_PATH')) {
    define( 'THIM_OPTION_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) )."/lib/thim-options");
}

function optionsframework_add_admin() {
	//$of_page = add_theme_page( THEMENAME, 'Theme Options', 'edit_theme_options', 'optionsframework', 'optionsframework_options_page' );
	$of_page = add_submenu_page('edit.php?post_type=portfolio', 'Portfolio Admin', 'Portfolio Settings', 'edit_posts', basename(__FILE__), 'admin_function');
	// Add framework functionally to the head individually
	add_action( "admin_print_scripts-$of_page", 'sr_of_load_only' );
	add_action( "admin_print_styles-$of_page", 'sr_of_style_only' );

}
add_action( 'admin_menu', 'optionsframework_add_admin' );

	/**
	 * Create Options page
	 *
	 * @uses  wp_enqueue_style()
	 *
	 * @since 1.0.0
	 */
	function sr_of_style_only() {
		wp_enqueue_style( 'admin-thim-options-style', CORE_PLUGIN_URL . '/lib/thim-options/css/thim-options.css' );
	}

	/**
	 * Create Options page
	 *
	 * @uses  add_action()
	 * @uses  wp_enqueue_script()
	 *
	 * @since 1.0.0
	 */
	function sr_of_load_only() {
		wp_enqueue_script( 'admin-thim-options-script', CORE_PLUGIN_URL . '/lib/thim-options/js/thim-options.js' , array( 'jquery' ) );
	}

/**
* Build Options page
*
* @since 1.0.0
*/
function admin_function() {
	include_once( 'front-end/options.php' );
}

add_action( 'admin_init', 'thim_register_option' );

/**
 * Register meta boxes via a filter
 * Advantages:
 * - prevents incorrect hook
 * - prevents duplicated global variables
 * - allows users to remove/hide registered meta boxes
 * - no need to check for class existences
 *
 * @return void
 */
function thim_register_option()
{
	global $my_data, $meta_options;
	$meta_options = apply_filters( 'thim_options', array() );
	$my_data = new THIM_Option( $meta_options );
}
global $portfolio_data;
$portfolio_data = get_option(THIM_PORTFOLIO_OPTION);
