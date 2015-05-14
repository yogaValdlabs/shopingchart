<?php
add_shortcode( 'text_rotator', 'shortcode_text_rotator' );

function shortcode_text_rotator( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'style'      => ''
	), $atts ) );
	if ( $style <> '' ) {
		$style = 'text_rotator_' . $style;
	} else {
		$style = 'text_rotator_spin';
	}
	$html = str_replace("text_rotator", $style, $content);

	wp_enqueue_script( 'aloxo-jquery.simple-text-rotator', get_template_directory_uri() . '/inc/shortcodes/text_rotator/jquery.simple-text-rotator.js', array('jquery'), '', false );
	wp_enqueue_style('simpletextrotator', get_template_directory_uri() . '/inc/shortcodes/text_rotator/simpletextrotator.css');
	
	return $html;
}
?>