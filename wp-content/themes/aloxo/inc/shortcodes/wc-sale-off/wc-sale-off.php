<?php
/**
 * Created by PhpStorm.
 * User: longpq
 * Date: 12/16/14
 * Time: 10:14 AM
 */
add_shortcode( 'sale_off_products', 'shortcode_sale_off_products' );

function shortcode_sale_off_products( $atts, $content = null ) {
	global $woocommerce;
	extract( shortcode_atts( array(
		//'number' => 5,
		'title'              => '',
		'title_color'        => '',
		'title_size'         => '',
		'sub_title'          => '',
		'sub_title_color'    => '',
		'sub_title_size'     => '',
		'button_title'       => '',
		'button_title_color' => '',
		'button_title_size'  => '',
		'bg_button'          => '',
		'link'               => '',
		'image'              => '',
		//'css_animation'      => '',
		'el_class'           => ''
	), $atts ) );
 	$html = $css_title = $css_sub_title = $css_button = $more_link = $css_animation = '';
	$css_animation .= ' ' . $el_class;
//	$css_animation .= aloxo_getCSSAnimation( $css_animation );

	// title
	$title = $title ? $title : '';
	$css_title .= $title_color ? 'color:' . $title_color . '; ' : 'color:#169f85;';
	$css_title .= $title_size ? 'font-size:' . $title_size . 'px;' : 'font-size:13px;';

	// sub title
	$sub_title = $sub_title ? $sub_title : '';
	$css_sub_title .= $sub_title_color ? 'color:' . $sub_title_color . ';' : '#000';
	$css_sub_title .= $sub_title_size ? 'font-size:' . $sub_title_size . 'px;' : 'font-size:13px;';

	// button
	$button_title = $button_title ? $button_title : 'button name';
	$css_button .= $button_title_color ? 'color:' . $button_title_color . '; ' : 'color:#000;';
	$css_button .= $button_title_size ? 'font-size:' . $button_title_size . 'px;' : 'font-size:13px;';
	$css_button .= $title_color ? 'border:2px solid ' . $title_color . ';' : 'border:2px solid #169f85;';
	$css_button .= $bg_button ? 'background-color:' . $bg_button . ';' : '';

	// link
	$link = $link ? $link : '#';
	if ( $link !== '' ) {
		$href = vc_build_link( $link );
		if ( $href['url'] ) {
			$more_link = $href['url'];
		}

	} else {
		$more_link = '';
	}

	// image
	$image_id  = $image ? $image : '';
	$image_src = $image_id; // For the default value
	if ( is_numeric( $image_id ) ) {
		$imageAttachment = wp_get_attachment_image_src( $image_id, 'medium' );
		$image_src       = $imageAttachment[0];
	}

	// css
	$css_title     = $css_title ? 'style="' . $css_title . '"' : '';
	$css_sub_title = $css_sub_title ? 'style="' . $css_sub_title . '"' : '';
	$css_button    = $css_button ? 'style="' . $css_button . '"' : '';


	$html .= '<div class="wc_sale_off_product' . $css_animation . '">';
	$html .= '<ul>';
	$html .= '<li>';
	$html .= '<div class="item-product">';
	$html .= '<a ' . $css_title . ' class="product-name" href="' . esc_url($more_link) . '" title="' . $title . '">' . $title . '</a>';
	$html .= '<span ' . $css_sub_title . ' class="product-sale-off">' . $sub_title . '</span>';
	$html .= '<a ' . $css_button . ' class="product-button" href="' . esc_url($more_link) . '" title="' . $title . '">' . $button_title . '</a>';
	//$html .= '<img class="wp-post-image" src="'. $image_src .'" />';
	$html .= '</div>';

	if ( $image_src <> '' ) {
		$width          = $image_src_size = '';
		$image_src_size = @getimagesize( $image_src );
		$width          = $image_src_size[3];
		$html .= '<div class="image-product">';
		$html .= '<img src="' . $image_src . '" ' . $width . ' alt="' . $title . '" />';
		$html .= '</div>';
	}


	$html .= '</li>';
	$html .= '</ul>';
	$html .= '<div style="clear: both;"></div> </div>';

	return $html;
}
