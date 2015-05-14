<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 5/19/14
 * Time: 1:51 PM
 */
//////////////////////////////////////////////////////////////////
// counters_box
//////////////////////////////////////////////////////////////////
add_shortcode( 'counters_box', 'shortcode_counters_box' );

function shortcode_counters_box( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'counters_label' => '',
		'counters_value' => '',
		'el_class'       => ''
	), $atts ) );
	$html = '';
	$html .= '<div class="counter-box">';
 	if ( $counters_value != '' ) {
		$html .= '<div class="content-box-percentage"><span class="display-percentage" data-percentage="' . $counters_value . '">' . $counters_value . '</span></div>';
	}
	if ( $counters_label != '' ) {
		$html .= '<div class="counter-box-content">' . $counters_label . '</div>';
	}
	$html .= '</div>';
	return $html;
}