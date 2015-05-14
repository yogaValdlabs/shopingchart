<?php
add_shortcode( 'vc_button', 'shortcode_vc_button' );
function shortcode_vc_button( $atts, $content = null ) {

extract( shortcode_atts( array(
	'color' => 'wpb_button',
	'size' => '',
	'icon' => 'none',
	'target' => '_self',
	'href' => '',
	'el_class' => '',
	'bg_color'=> '',
	'custom_mr' => '',
	'mr_btn' => '',
	'title' => __( 'Text on the button', "js_composer" ),
	'position' => ''
), $atts ) );
$a_class = '';
$output = "";

if ( $target == 'same' || $target == '_self' ) {
	$target = '';
}
$target = ( $target != '' ) ? ' target="' . $target . '"' : '';

$icon = ( $icon != '' && $icon != 'none' ) ? '' . $icon : '';
$i_icon = ( $icon != '' ) ? ' <i class="fa fa-'.$icon.'"> </i>' : '';

if ($custom_mr == "custom") {
	$custom_mr = ' style="margin:'.$mr_btn.'px;"';
}else $custom_mr ='';

if ($color=="custom") {
	if ($bg_color)
		$bg = ' style="background: '.$bg_color.';"';
	else
		$bg = "";
}

$output = '<a class="sc-btn ' . $color ." ".$size. '" title="' . $title . '" href="' . $href . '"' . $target . $custom_mr.$bg.'><span>' . $i_icon . '<span>'.$title . '</span>'.'</span></a>';
return $output;

}