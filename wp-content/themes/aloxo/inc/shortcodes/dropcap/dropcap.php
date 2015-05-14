<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 4/22/14
 * Time: 12:26 AM
 */
//////////////////////////////////////////////////////////////////
// Dropcap shortcode
//////////////////////////////////////////////////////////////////
add_shortcode( 'dropcap', 'shortcode_dropcap' );

function shortcode_dropcap( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'text'      => '',
 		'el_class'  => ''
	), $atts ) );

	return '<span class="dropcap '.$el_class.'">' . $content  . '</span>';
}