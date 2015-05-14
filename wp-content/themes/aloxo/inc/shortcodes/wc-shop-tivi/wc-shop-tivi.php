<?php
add_shortcode( 'wc_shop_tivi', 'shortcode_wc_shop_tivi' );
function shortcode_wc_shop_tivi( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'shop_icon'		=> '',
		'shop_style'	=> '',
		'shop_text'		=> '',
		'shop_link'       => '',
	), $atts ) );
	if ($shop_icon) {
		$shop_icon = '<i class="fa fa-'.$shop_icon.' fa-lg"></i> ';
	}

	$html =  '<div class="ps-tivi '.$shop_style.'">';
	$html .=  '<div class="ps-tivi-inner">';
	$html .=  '<a href="'.esc_url($shop_link).'">'.$shop_icon.$shop_text.'</a>';
	$html .=  '</div>';
	$html .=  '</div>';

	return $html;
}