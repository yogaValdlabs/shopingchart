<?php
add_shortcode( 'vc_row_inner', 'shortcode_vc_row_inner' );
function shortcode_vc_row_inner( $atts, $content = null ) {
	$output = $layout = $el_class = $bg_image = $bg_color = $bg_image_repeat = $pos = $padding = $margin_bottom = $css = '';
	extract( shortcode_atts( array(
		'el_class'        => '',
		'bg_image'        => '',
		'bg_color'        => '',
		'bg_image_repeat' => '',
		'padding'         => '',
		'margin_bottom'   => '',
		'css'             => '',
		'layout'          => '',
	), $atts ) );

	wp_enqueue_style( 'js_composer_front' );
	wp_enqueue_script( 'wpb_composer_front_js' );
	wp_enqueue_style( 'js_composer_custom_css' );

	$el_class = aloxo_getExtraClass( $el_class );

	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row ' . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $atts );

	$style = aloxo_buildStyle( $bg_image, $bg_color, $bg_image_repeat, $padding, $margin_bottom );
	/*************edit**************/
	if ( $layout == 'boxed' ) {
		$output .= '<div class="container">';
	} else {
		$output .= '<div class="fullwidth">';
	}
	/*************end edit**************/
	$output .= '<div class="' . $css_class . '"' . $style . '>';

	$pos = strpos($css_class, "parallax_effect");
	if ($pos == true) {
		$output .= '<div class="overlay">';
		$output .= wpb_js_remove_wpautop( $content );
		$output .= '</div>';
	}else {
		$output .= wpb_js_remove_wpautop( $content );
	}

	$output .= '</div>';
	/*************edit**************/
	$output .= '</div>';

	/*************end edit**************/

	return $output;
}