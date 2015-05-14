<?php
add_shortcode( 'vc_accordion', 'shortcode_vc_accordion' );
function shortcode_vc_accordion( $atts, $content = null ) {
	wp_enqueue_script( 'jquery-ui-accordion' );
	$output = $title = $interval = $el_class = $collapsible = $active_tab = $style = '';
 	extract( shortcode_atts( array(
		'title'       => '',
		'style'       => '',
		'interval'    => 0,
		'el_class'    => '',
		'collapsible' => 'no',
		'active_tab'  => '1'
	), $atts ) );

	$el_class  = aloxo_getExtraClass( $el_class );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion wpb_content_element ' . $el_class . ' not-column-inherit','vc_accordion', $atts );

	$output .= "\n\t" . '<div class="' . $css_class . ' ' . $style . '" data-collapsible=' . $collapsible . ' data-active-tab="' . $active_tab . '">'; //data-interval="'.$interval.'"
	$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_accordion_heading' ) );

	$output .= "\n\t\t" . '<div class="wpb_wrapper wpb_accordion_wrapper ui-accordion">';

	$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
	$output .= "\n\t\t" . '</div>';
	$output .= "\n\t" . '</div> ';
	return $output;
}