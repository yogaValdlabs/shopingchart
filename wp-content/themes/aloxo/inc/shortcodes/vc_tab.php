<?php
add_shortcode('vc_tab', 'shortcode_vc_tab');
function shortcode_vc_tab($atts, $content = null) {
	$output = $title = $tab_id = $icon_name = $bg_color_tab = $text_color_tab = '';
//    $atts = '';
//    $content = "";
	extract(shortcode_atts(array(
		'title' => '',
		'tab_id' => '',
		'icon_name' => '',
		'bg_color_tab' => '',
		'text_color_tab' => ''
	), $atts));

	wp_enqueue_script('jquery_ui_tabs_rotate');

	$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix', 'vc_tab', $atts);
	
	$output .= "\n\t\t\t" . '<div id="tab-' . ( empty($tab_id) ? sanitize_title($title) : $tab_id ) . '" class="tab-pane ' . $css_class . $icon_name . '">';
	$output .= ( $content == '' || $content == ' ' ) ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
	$output .= "\n\t\t\t" . '</div> ';

	return $output;
}