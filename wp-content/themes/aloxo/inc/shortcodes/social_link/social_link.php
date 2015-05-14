<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 4/23/14
 * Time: 5:22 PM
 */

//////////////////////////////////////////////////////////////////
// heading
//////////////////////////////////////////////////////////////////
add_shortcode( 'social_link', 'shortcode_social_link' );

function shortcode_social_link( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'style'			 => '',
		'link_face'      => '',
		'link_twitter'   => '',
		'link_google'    => '',
		'link_dribble'   => '',
		'link_linkedin'  => '',
		'link_pinterest' => '',
		'link_digg'      => '',
		'link_youtube'   => '',
	), $atts ) );

	$html = '<ul class="social_link '.$style.'">';
	if ( $link_face != '' ) {
		$html .= '<li><a class="face" href="' . esc_url($link_face) . '" title="'.__('Facebooks','aloxo').'"><i class="fa fa-facebook-square"></i></a></li>';
	}
	if ( $link_twitter != '' ) {
		$html .= '<li><a class="twitter" href="' . esc_url($link_twitter) . '"  title="'.__('Twitter','aloxo').'"><i class="fa fa-twitter"></i></a></li>';
	}
	if ( $link_pinterest != '' ) {
		$html .= '<li><a class="pinterest" href="' . esc_url($link_pinterest) . '"  title="'.__('Pinterest','aloxo').'"><i class="fa fa-pinterest"></i></a></li>';
	}
	if ( $link_google != '' ) {
		$html .= '<li><a class="google" href="' . esc_url($link_google) . '"  title="'.__('Google','aloxo').'"><i class="fa fa-google-plus"></i></a></li>';
	}
	if ( $link_dribble != '' ) {
		$html .= '<li><a class="dribble" href="' . esc_url($link_dribble) . '"  title="'.__('Dribble','aloxo').'"><i class="fa fa-dribbble"></i></a></li>';
	}
	if ( $link_linkedin != '' ) {
		$html .= '<li><a class="linkedin" href="' . esc_url($link_linkedin) . '"  title="'.__('Linkedin','aloxo').'"><i class="fa fa-linkedin"></i></a></li>';
	}
	if ( $link_digg != '' ) {
		$html .= '<li><a class="digg" href="' . esc_url($link_digg) . '"  title="'.__('Digg','aloxo').'"><i class="fa fa-digg"></i></a></li>';
	}
	if ( $link_youtube != '' ) {
		$html .= '<li><a class="youtube" href="' . esc_url($link_youtube) . '"  title="'.__('Youtube','aloxo').'"><i class="fa fa-youtube"></i></a></li>';
	}
	$html .= '</ul>';

	return $html;
}