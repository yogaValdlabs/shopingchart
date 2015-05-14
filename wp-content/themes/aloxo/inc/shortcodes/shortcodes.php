<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// include shortcode
//require_once TP_THEME_DIR .'inc/shortcodes/example/example.php';


//////////////////////////////////////////////////////////////////
// Remove extra P tags
//////////////////////////////////////////////////////////////////
function aloxo_shortcodes_formatter( $content ) {
	$block = join( "|", array( "icon_box" ) );
	// opening tag
	$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );
	// closing tag
	$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)/", "[/$2]", $rep );

	return $rep;
}

add_filter( 'the_content', 'aloxo_shortcodes_formatter' );
add_filter( 'widget_text', 'aloxo_shortcodes_formatter' );

if ( function_exists( 'add_shortcode_param' ) ) {
	add_shortcode_param( 'radioimage', 'radioimage_settings_field' );
	// Function generate param type "radioimage"
	function radioimage_settings_field( $settings, $value ) {
		$dependency = vc_generate_dependencies_attributes( $settings );
		$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$type       = isset( $settings['type'] ) ? $settings['type'] : '';
		$radios     = isset( $settings['options'] ) ? $settings['options'] : '';
		$class      = isset( $settings['class'] ) ? $settings['class'] : '';
		$output     = '<input type="hidden" name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '_field ' . $class . '" value="' . $value . '"  ' . $dependency . ' />';
		$output .= '<div id="' . $param_name . '_wrap" class="icon_style_wrap '.$class.'" >';
		if ( $radios != '' && is_array( $radios ) ) {
			$i = 0;
			foreach ( $radios as $key => $image_url ) {
				$class   = ( $key == $value ) ? ' class="selected" ' : '';
				$image   = '<img id="' . $param_name . $i . '_img' . $key . '" src="' . $image_url . '" ' . $class . '/>';
				$checked = ( $key == $value ) ? ' checked="checked" ' : '';
				$output .= '<input name="' . $param_name . '_option" id="' . $param_name . $i . '" value="' . $key . '" type="radio" '
					. 'onchange="document.getElementById(\'' . $param_name . '\').value=this.value;'
					. 'jQuery(\'#' . $param_name . '_wrap img\').removeClass(\'selected\');'
					. 'jQuery(\'#' . $param_name . $i . '_img' . $key . '\').addClass(\'selected\');" '
					. $checked . ' style="display:none;" />';
				$output .= '<label for="' . $param_name . $i . '">' . $image . '</label>';
				$i ++;
			}
		}
		$output .= '</div>';

		return $output;
	}

	// Function generate param type "heading"
	add_shortcode_param( 'heading_title', 'heading_title_settings_field' );
	function heading_title_settings_field( $settings, $value ) {
		$dependency = vc_generate_dependencies_attributes( $settings );
		return ' <div class="heading" style="text-align: center;padding: 20px;color: white;background: green;text-transform: uppercase;margin: 0 -15px;">' . $settings['value'] . '
  		<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value ' . $settings['param_name'] . ' ' . $settings['type'] . '_field"  type="hidden" value="' . $value . '" ' . $dependency . '/></div>';
	}

	// Function generate param type "preview"
	add_shortcode_param( 'preview', 'preview_settings_field' );
	function preview_settings_field( $settings, $value ) {
		$dependency = vc_generate_dependencies_attributes( $settings );
		return ' <div class="images_preview" ><img src="' . $value . '"/>
  		<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value ' . $settings['param_name'] . ' ' . $settings['type'] . '_field"  type="hidden" value="' . $value . '" ' . $dependency . '/></div>';
	}

	// Function generate param type "preview"
	add_shortcode_param( 'custom_before', 'custom_before_settings_field' );
	function custom_before_settings_field( $settings, $value ) {
		$dependency = vc_generate_dependencies_attributes( $settings );
  		return '<div class="box_before" >';
	}

	add_shortcode_param( 'custom_after', 'custom_after_settings_field' );
	function custom_after_settings_field( $settings, $value ) {
		return '<div class="clear"></div></div>';
	}
}
// Link to shortcodes
require_once( get_template_directory() . '/inc/shortcodes/dropcap/dropcap.php' );
require_once( get_template_directory() . '/inc/shortcodes/heading/heading.php' );
require_once( get_template_directory() . '/inc/shortcodes/highlight/highlight.php' );
require_once( get_template_directory() . '/inc/shortcodes/icon_box/icon_box.php' );
require_once( get_template_directory() . '/inc/shortcodes/provide/provide.php' );
//require_once( get_template_directory() . '/inc/shortcodes/testimonials/testimonials.php' );
require_once( get_template_directory() . '/inc/shortcodes/portfolio/portfolio.php' );
//require_once( get_template_directory() . '/inc/shortcodes/our_team/our_team.php' );
require_once( get_template_directory() . '/inc/shortcodes/video_screen/video_screen.php' );
require_once( get_template_directory() . '/inc/shortcodes/posts_display/posts_display.php' );
require_once( get_template_directory() . '/inc/shortcodes/counters_box/counters_box.php' );
require_once( get_template_directory() . '/inc/shortcodes/social_link/social_link.php' );
require_once( get_template_directory() . '/inc/shortcodes/text_rotator/text_rotator.php' );
require_once( get_template_directory() . '/inc/shortcodes/year/year.php' );
require_once( get_template_directory() . '/inc/shortcodes/twitter/twitter.php' );
require_once( get_template_directory() . '/inc/shortcodes/google_map/google_map.php' );
require_once( get_template_directory() . '/inc/shortcodes/wc-shop-tivi/wc-shop-tivi.php' );

if (class_exists( 'WooCommerce' ) ) {
    require_once( get_template_directory() . '/inc/shortcodes/wc-best-sellers/wc-best-sellers.php' );
	require_once( get_template_directory() . '/inc/shortcodes/wc-top-rated/wc-top-rated.php' );
	require_once( get_template_directory() . '/inc/shortcodes/wc-products/wc-products.php' );
	require_once( get_template_directory() . '/inc/shortcodes/wc-sale-off/wc-sale-off.php' );
	require_once( get_template_directory() . '/inc/shortcodes/wc-top-products/wc-top-products.php' );
	require_once( get_template_directory() . '/inc/shortcodes/wc-category/wc-category.php' );
	require_once( get_template_directory() . '/inc/shortcodes/wc-products-slider/wc-products-slider.php' );
	require_once( get_template_directory() . '/inc/shortcodes/wc-category-showcase/wc-category-showcase.php' );
	require_once( get_template_directory() . '/inc/shortcodes/wc-countdown/wc-countdown.php' );
	require_once( get_template_directory() . '/inc/shortcodes/wc-product-search/wc-product-search.php' );

}
