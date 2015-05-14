<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 4/22/14
 * Time: 12:26 AM
 */

//////////////////////////////////////////////////////////////////
// SERVICES WE PROVIDE
//////////////////////////////////////////////////////////////////
add_shortcode( 'provide', 'shortcode_provide' );

function shortcode_provide( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title'     => 'HEADING TEXT',
		'size'      => '4',
		'icon'      => '',
		'text'      => '',
		'margintop' => '',
		'el_class'  => ''
	), $atts ) );
	$html   = '';
	$margin = "";
	if ( $margintop <> '' ) {
		$margin = 'style = "margin-top: ' . $margintop . 'px"';
	}
	$html .= '<div class="wapper_provide ' . $el_class . '" >
                <div class="provide_icon" ' . $margin . '><span class="inner_icon"><span class="icon"><i class="fa fa-pencil fa-2x"></i></span></span></div>';
	$html .= '<div class="provide_content"><' . $size . ' class="boxes_title">' . $title . '</' . $size . '><div class="description">' . $content . '</div></div>';
	$html .= '<div class="clear"></div></div>';

	return $html;
}