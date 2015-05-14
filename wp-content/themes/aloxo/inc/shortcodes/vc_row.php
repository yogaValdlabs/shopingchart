<?php
if ( !function_exists( 'vc_theme_vc_row' ) ) {
function vc_theme_vc_row($atts, $content = null) {
	$output = $layout = $el_id = $el_class = $bg_image = $bg_color = $bg_image_repeat = $pos = $font_color = $padding = $margin_bottom = $css = '';
	extract( shortcode_atts( array(
		'el_class'        => '',
		'bg_image'        => '',
		'bg_color'        => '',
		'bg_image_repeat' => '',
		'font_color'      => '',
		'padding'         => '',
		'margin_bottom'   => '',
		'css'             => '',
		'layout'          => '',
		'el_id'           => ''
	), $atts ) );

	//wp_enqueue_style( 'js_composer_front' );
	wp_enqueue_script( 'wpb_composer_front_js' );
	//wp_enqueue_style( 'js_composer_custom_css' );
	if ( $el_id <> '' ) {
		$el_id = 'id ="' . $el_id . '"';
	}
	$el_class = aloxo_getExtraClass( $el_class );

	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row ' . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $atts );

	$style = aloxo_buildStyle( $bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom );
	/*************edit**************/

	if(class_exists('Ultimate_VC_Addons')) {
		$css_addons = " wpb_row";
	}else $css_addons = "";

	if ( $layout == 'boxed' ) {
		$output .= '<div class="container'.$css_addons.'" ' . $el_id . '>';
	} else{
		$output .= '<div class="fullwidth'.$css_addons.'" ' . $el_id . '>';
	}
	/*************end edit**************/
	$output .= '<div class="' . $css_class . '"' . $style . '>';

	if ($layout =='mixing') {
		$output .= '<div class="container">';
	}

	$pos = strpos($css_class, "parallax_effect");
	if ($pos == true) {
		$output .= '<div class="overlay">';
		$output .= wpb_js_remove_wpautop( $content );
		$output .= '</div>';
	}else {
		$output .= wpb_js_remove_wpautop( $content );
	}

	if ($layout =='mixing') {
		$output .= '</div>';
	}

	$output .= '</div>';
	/*************edit**************/
	$output .= '</div>';

	/*************end edit**************/

	return $output;
}
}