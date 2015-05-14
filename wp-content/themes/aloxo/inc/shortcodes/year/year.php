<?php
/**
 * @author kien16.
 * Countdown shortcode
 */
add_shortcode( 'year', 'shortcode_year' );

function shortcode_year( $atts, $content = null ) {
	// extract( shortcode_atts( array(
	// ), $atts ) );

	$output = get_the_time('Y');
	return $output;
}