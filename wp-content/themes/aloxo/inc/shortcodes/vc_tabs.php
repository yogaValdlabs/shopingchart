<?php
add_shortcode( 'vc_tabs', 'shortcode_vc_tabs' );
function shortcode_vc_tabs( $atts, $content = null ) {
	$output = $title = $interval = $el_class = $style = $bg_color_tabs = '';
	extract( shortcode_atts( array(
		'title'         => '',
		'interval'      => 0,
		'style'         => 'style_1',
		'el_class'      => '',
		'bg_color_tabs' => ''
	), $atts ) );

	wp_enqueue_script( 'jquery-ui-tabs' );

	$el_class = aloxo_getExtraClass( $el_class );

	global $vc_manager;
	$element = 'wpb_tabs';
	//$element = 'wpb_tabs';
	//if ( 'vc_tour' == $vc_manager->settings['base'] ) $element = 'wpb_tour';

	// Extract tab titles
	preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
	$tab_titles = array();
	/**
	 * vc_tabs
	 *
	 */
	if ( isset( $matches[1] ) ) {
		$tab_titles = $matches[1];
	}
	$tabs_nav = '';
	if ( $bg_color_tabs <> '' && $style == 'style_3' ) {
		$bg_color_tabs = 'style="background:' . $bg_color_tabs . '"';
	}
	$tabs_nav .= '<ul class="nav nav-tabs wpb_tabs_nav ui-tabs-nav vc_clearfix" ' . $bg_color_tabs . ' role="tablist">';
	foreach ( $tab_titles as $tab ) {
		$tab_atts = shortcode_parse_atts( $tab[0] );
		if ( isset( $tab_atts['title'] ) ) {
			//$tabs_nav .= '<li><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '" ' . $color_text . '><span><i class="fa fa-' . $tab_atts['icon_name'] . '"></i> ' . $tab_atts['title'] . '</span></a></li>';
			$tabs_nav .= '<li><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '"><span>' . $tab_atts['title'] . '</span></a></li>';
			//$tabs_nav .= '<li ' . ( isset( $tab_atts['bg_color_tab'] ) ? 'style =" background:' . $tab_atts['bg_color_tab'] . '!important"' : '' ) . ' ><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '" ' . ( isset( $tab_atts['text_color_tab'] ) ? 'style =" color:' . $tab_atts['text_color_tab'] . '"' : '' ) . ' >' . ( isset( $tab_atts['icon_name'] ) ? '<span><i class="fa fa-' . $tab_atts['icon_name'] . '"></i></span> ' : '' ) . "<span>".$tab_atts['title'] = str_replace( '||', '<br />',  $tab_atts['title'] ). '</span></a></li>';

		}
	}
	$tabs_nav .= '</ul>' . "\n";

	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), 'vc_tabs', $atts );

	$output .= "\n\t" . '<div class="' . $css_class . ' ' . $style . '" data-interval="' . $interval . '">';
	$output .= "\n\t\t" . '<div class="wpb_wrapper wpb_tour_tabs_wrapper_thim ui-tabs vc_clearfix" role="tabpanel">';
	$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => $element . '_heading' ) );
	if ($style=="style_3") {
		// $output .= '<div class="tab-container">';
		// $output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
		// $output .= "</div>";
		// $output .= $tabs_nav;

		//$output .= "\n\t\t\t" . $tabs_nav;
		//$output .= '<div>';
		$output .= '<div class="tab-filter">';
		$output .= $tabs_nav;	
		$output .= '</div>';
		//$output .= '<div class="tab-container">';
		$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
		//$output .= "</div>";
		
		//$output .= '</div>';

	}else {
		$output .= "\n\t\t\t" . $tabs_nav;
		$output .= "\n\t\t\t" . '<div class="tab-content">';
		$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
		$output .= "\n\t\t\t" . '</div>';
	}
	
	$output .= "\n\t\t" . '</div> ';
	$output .= "\n\t" . '</div> ';

	return $output;
}