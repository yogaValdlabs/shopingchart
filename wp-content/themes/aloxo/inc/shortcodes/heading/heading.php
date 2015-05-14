<?php
//////////////////////////////////////////////////////////////////
// heading
//////////////////////////////////////////////////////////////////
add_shortcode( 'title', 'shortcode_title' );

function shortcode_title( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title'              => 'HEADING TEXT',
		'size'               => 'h3',
		'style'              => 'default',
		'textcolor'          => '#000000',
		'mg_bottom'			 => '',
		'custom_mg_bt'		 => '',
		'el_class'           => '',
		'css_animation'      => '',
		'text_align'         => 'left',
		'line_width'		=> 'short',
		'font_heading'       => '',
		'custom_line' => '',
		'custom_font_weight'=> '',
		'line_color' => '#000000',
		'custom_font_size'   => '',
	), $atts ) );
	
	if ($el_class)
		$el_class = ' ' . $el_class;
	$css_animation = aloxo_getCSSAnimation( $css_animation );
	$html = '';
	$css = '';
	$text_align = ' '.$text_align;
	$style = ' '.$style;
	$line_width = ' '.$line_width;
	if($textcolor) {
		$css = 'color:'.$textcolor.';';
	}
	if ($font_heading) {
		$css .= 'font-size:'.$custom_font_size.'px;';
		$css .= 'font-weight:'.$custom_font_weight.';';
	}
	if ($mg_bottom=="custom") {
		$css .= 'margin-bottom:'.$custom_mg_bt.'px;';
	}
	if ($custom_line == "custom") {
		$l_color = $line_color;
	}else {
		$l_color = 'rgba('. implode(",", aloxo_hex2rgb($textcolor) ).', 0.1)';
	}

	if ($style == ' style-04') {
		$css .=  'border-left: 3px solid '.$l_color.';';
	}


	if ($css)
		$css = ' style="'.$css.'"';

	$class_next = "heading_".time() . '-1-' . rand( 0, 1000 );
	$html .= '<div id="'.$class_next.'" class="sc_heading'. $el_class . $css_animation.$text_align.$style.$line_width.'">';
		$html .= '<'.$size.$css.' class="title">'.$title.'</'.$size.'>';

	$html .= '</div>';
	if ($style == ' style-03') {
		$html .= '<style>';
		$html .= '#'.$class_next.'.sc_heading.style-03.wide .title{border-bottom: 1px solid '.$l_color.';}';
		$html .= '#'.$class_next.'.sc_heading.style-03 .title:before{border-bottom: 1px solid '.$l_color.';}';

		$html .= '</style>';
	}
	if ($style == ' style-02') {
		$html .= '<style>';
		$html .= '#'.$class_next.'.sc_heading.style-02 .title:before{border-bottom: 1px solid '.$l_color.'; border-top: 1px solid '.$l_color.';}';
		$html .= '#'.$class_next.'.sc_heading.style-02 .title:after{border-bottom: 1px solid '.$l_color.'; border-top: 1px solid '.$l_color.';}';
		$html .= '</style>';
	}
	if ($style == ' style-01') {
		$html .= '<style>';
		$html .= '#'.$class_next.'.sc_heading.style-01 .title:before{background: '.$l_color.'}';
		$html .= '#'.$class_next.'.sc_heading.style-01 .title:after{background: '.$l_color.'}';
		$html .= '</style>';
	}

	
	return $html;
}