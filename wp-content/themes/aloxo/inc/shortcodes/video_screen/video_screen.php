<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 4/22/14
 * Time: 12:26 AM
 */
//////////////////////////////////////////////////////////////////
// Video Screen
//////////////////////////////////////////////////////////////////
add_shortcode( 'video_screen', 'shortcode_video_screen' );

function shortcode_video_screen( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'linkvideo_mp4'      => '',
 		'linkvideo_ogg'  => ''
	), $atts ) );
	$html ='<div class="screen_video">
		<video  autoplay="autoplay" loop>';
	if($linkvideo_mp4<>''){
		$html .='<source src="'.$linkvideo_mp4.'" type="video/mp4">';
	}if($linkvideo_ogg<>''){
		$html .='<source src="'.$linkvideo_ogg.'" type="video/mp4">';
	}
	$html .='</video></div>';
	return $html;
}