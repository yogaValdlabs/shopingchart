<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 4/22/14
 * Time: 12:27 AM
 */
//////////////////////////////////////////////////////////////////
// Highlight shortcode
//////////////////////////////////////////////////////////////////
add_shortcode( 'highlight', 'shortcode_highlight' );

function shortcode_highlight( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'color' => 'yellow',
		), $atts );

	if ( $atts['color'] == 'black' ) {
		return '<span class="highlight2" style="background-color:' . $atts['color'] . ';">' . do_shortcode( $content ) . '</span>';
	} else {
		return '<span class="highlight1" style="background-color:' . $atts['color'] . ';">' . do_shortcode( $content ) . '</span>';
	}
}