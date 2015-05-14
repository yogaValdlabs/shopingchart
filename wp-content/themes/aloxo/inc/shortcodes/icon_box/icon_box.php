<?php

/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 4/22/14
 * Time: 12:26 AM
 */
//////////////////////////////////////////////////////////////////
// icon_box
//////////////////////////////////////////////////////////////////

add_shortcode( 'icon_box', 'shortcode_icon_box' );

function shortcode_icon_box( $atts, $content = null ) {
	// $pos = $css_class = $css_animation = $class_icon_box = $icon_border_color_hover = $icon_hover_color = $bg_shortcode_hover = $icon_style = $el_class = $link = $read_more = $icon_type = $icon_border_color = $icon_size
	// 	= $size = $icon = $icon_color = $color_title = $color_description = $background_shortcode = $bg_read_more_text = $read_more_text_color = $border_arrow = $bg_shortcode = $class_css = $read_text = $title = $desc = $icon_img =
	// $color = $icon_bg_color = $icon_effect = $icon_bg_color_hover = $width_box_icon = $heading_style = $text_align_sc = $height_images = $width_images =
	// $custom_width_box_icon = $width_box_font_awesome = $custom_height_box_icon = $box_icon_style = $icon_bg_header = $header_icon_style = $title_style = $border_read_more_text =
	// $bg_images = $custom_width_bg_images = $custom_height_bg_images = $custom_font_size = $custom_font_weight = $custom_font_style = $icon_box_font_heading = '';
	extract( shortcode_atts( array(
		'title'                   => '',
		'size'                    => '',
		'link'                    => '',
		'icon_type'               => '',
		'icon_img'                => '',
		'icon'                    => '',
		'icon_size'               => '',
		'icon_color'              => '',
		'mg_bottom'               => '',
		'color'                   => '',
		'icon_style'              => '',
		//'margin_bt_title'		  => '',
		'icon_border_color'       => '',
		'icon_bg_color'           => '',
		'color_title'             => '',
		'color_description'       => '',
		'bg_read_more_text_hover' => '',
		'pos'                     => '',
		'margin_l_icon'           => '',
		'margin_r_icon'           => '',
		'read_more'               => '',
		'read_text'               => '',
		'el_class'                => '',
		//'text'                    => '',
		'css_animation'           => '',
		"icon_effect"             => "",
		"bg_shortcode"            => '',
		"bg_read_more_text"       => '',
		"read_more_text_color"    => '',

		//"class_icon_box"          => '',

		"icon_border_color_hover" => '',
		"icon_bg_color_hover"     => '',
		"icon_hover_color"        => '',
		//"width_box_icon"          => '',
		//"custom_width_box_icon"   => '',
		"heading_style"           => '',
		"text_align_sc"           => '',
		"height_images"           => '',
		"width_images"            => '',
		"width_box_font_awesome"  => '',
		//"custom_height_box_icon"  => '',
		"box_icon_style"          => '',
		//"icon_bg_header"          => '',
		"border_read_more_text"   => '',
		//"bg_images"               => '',
		//"custom_width_bg_images"  => '',
		//"custom_height_bg_images" => '',
		//"bg_shortcode_hover"      => '',
		'custom_font_size'        => '',
		'custom_font_weight'      => '',
		'custom_font_style'       => '',
		'icon_box_font_family'    => '',
		'icon_box_font_heading'   => ''
	), $atts, 'icon_box' ) );
	/*echo $google_fonts['values']['font_family'];
	echo ($google_fonts);*/

	//$class_icon_box = time() . '-1-' . rand( 0, 1000 );
	$css_class            = "";
	$default_margin_value = "25px";

	if ( $css_animation ) {
		wp_enqueue_script( 'waypoints' );
		$css_animation .= ' animate-element';
		$css_class = 'wpb_animate_when_almost_visible wpb_' . $css_animation;
	}

	/* setup hover color */
	$data_icon_hover_color = $data_icon_border_color_hover = $data_icon_bg_color_hover = $data_bg_read_more_text_hover = "";
	if ( $icon_hover_color ) {
		$data_icon_hover_color = ' data-icon="' . $icon_hover_color . '"';
	}
	if ( $icon_border_color_hover ) {
		$data_icon_border_color_hover = ' data-icon-border="' . $icon_border_color_hover . '"';
	}
	if ( $icon_bg_color_hover ) {
		$data_icon_bg_color_hover = ' data-icon-bg="' . $icon_bg_color_hover . '"';
	}
	if ( $bg_read_more_text_hover ) {
		$data_bg_read_more_text_hover = ' data-btn-bg="' . $bg_read_more_text_hover . '"';
	}
	/* end setup hover color */

	/* title css */
	$title_style = "style='";
	$title_style .= ( $color_title !== '' ) ? 'color: ' . $color_title . ';' : '';
	if ( $icon_box_font_heading <> '' ) {
		$title_style .= ( $custom_font_size !== '' ) ? 'font-size: ' . $custom_font_size . 'px;' : '';
		$title_style .= ( $custom_font_weight !== '' ) ? 'font-weight: ' . $custom_font_weight . ';' : '';
		$title_style .= ( $custom_font_style !== '' ) ? 'font-style: ' . $custom_font_style . ';' : '';
		$title_style .= ( $mg_bottom !== '' ) ? 'margin-bottom: ' . $mg_bottom . 'px;' : '';
		$title_style .= ( $icon_box_font_family !== '' ) ? 'font-family: "' . $icon_box_font_family . '";' : '';
	}
	// if ($margin_bt_title) {
	// 	$title_style .= 'margin-bottom: '.$margin_bt_title.'px;';		
	// }
	$title_style .= "'";
	/* end title css */

	/* desctiptions css */
	$description_style = "style='";
	if ( $color_description <> '' ) {
		$description_style .= 'color: ' . $color_description . ';';
	}
	if ( $icon_box_font_heading <> '' ) {
		$description_style .= ( $icon_box_font_family !== '' ) ? 'font-family: "' . $icon_box_font_family . '";' : '';
	}
	$description_style .= "'";
	/* end desctiptions css */

	/* css boxes_icon*/
	$boxes_icon_style = $boxes_content_style = $read_more_style = 'style="';
	if ( $icon_type == "font-awesome" ) {
		$boxes_icon_style .= ( $width_box_font_awesome !== '' ) ? 'width: ' . $width_box_font_awesome . 'px; height: ' . $width_box_font_awesome . 'px;' : '';
	}
	if ( $icon_type == "custom" ) {
		$boxes_icon_style .= ( $width_images !== '' && $height_images !== '' ) ? 'width: ' . $width_images . 'px; height: ' . $height_images . 'px;' : '';
	}
	// if ( $width_box_icon == 'custom' ) {
	// 	$boxes_icon_style .= ( $custom_width_box_icon !== '' ) ? 'width: ' . $custom_width_box_icon . 'px;' : '';
	// 	$boxes_icon_style .= ( $custom_height_box_icon !== '' ) ? 'height: ' . $custom_height_box_icon . 'px;' : '';
	// }
	// if ($margin_bt_icon)
	// 	$boxes_icon_style .= "margin-bottom: ".$margin_bt_icon."px;";

	$boxes_icon_style .= ( $icon_border_color !== '' ) ? 'border-color: ' . $icon_border_color . ';' : '';
	$boxes_icon_style .= ( $icon_bg_color !== '' ) ? 'background: ' . $icon_bg_color . ';' : '';
	if ( ( $pos == "left" || $pos == "left-middle" ) && $margin_r_icon ) {
		$boxes_icon_style .= "margin-right: " . $margin_r_icon . "px;";
	} else {
		if ( ( $pos == "right" || $pos == "right-middle" ) && $margin_l_icon ) {
			$boxes_icon_style .= "margin-left: " . $margin_l_icon . "px;";
		} else {
		}
	}

	// positions style 2
	if ( $icon_style == "style2" ) {
		$position_top = $padding_top = '';
		$position_top = $width_box_font_awesome / 2;
		$padding_top  = $position_top + 20;
		$boxes_icon_style .= ( $width_box_font_awesome !== '' ) ? 'top:-' . $position_top . 'px; margin-left:-' . $position_top . 'px;' : '';
		$boxes_content_style .= ( $position_top !== '' ) ? 'padding-top:' . $padding_top . 'px;' : '';
	}
	$boxes_icon_style .= '"';

	// Caculate Content Width
	if ( ( $pos == "left" || $pos == "left-middle" ) && $margin_r_icon ) {
		$margin_content = "- " . $margin_r_icon . "px";
	} else {
		if ( ( $pos == "right" || $pos == "right-middle" ) && $margin_l_icon ) {
			$margin_content = "- " . $margin_l_icon . "px";
		} else {
			$margin_content = " - " . $default_margin_value;
		}
	}

	if ( $icon_type == "font-awesome" && $icon_style != "style2" ) {
		$boxes_content_style .= ( $width_box_font_awesome !== '' && $pos != 'top' && $icon != 'none' ) ? 'width: calc( 100% - ' . $width_box_font_awesome . 'px ' . $margin_content . ');' : '';
	}
	if ( $icon_type == 'custom' && $icon_style != "style2" ) {
		$boxes_content_style .= ( $width_images !== '' && $pos != 'top' ) ? 'width: calc( 100% - ' . $width_images . 'px ' . $margin_content . ' );' : '';
	}

	// background shortcode
	$boxes_content_style .= ( $bg_shortcode !== '' ) ? 'background:' . $bg_shortcode . ';' : '';

	$boxes_content_style .= '"';

	// read more button css
	$read_more_style .= ( $border_read_more_text !== '' ) ? 'border-color: ' . $border_read_more_text . ';' : '';
	$read_more_style .= ( $bg_read_more_text !== '' ) ? 'background-color: ' . $bg_read_more_text . ';' : '';
	$read_more_style .= ( $read_more_text_color !== '' ) ? 'color: ' . $read_more_text_color . ';' : '';
	$read_more_style .= '"';
	/* end css boxes_icon */

	$size_bg_imgages = $height_smicon_box = '';
	$class_css       = $css_class . ' ' . $icon_style . ' ' . $el_class . ' ' . $icon_effect . ' ' . $text_align_sc . ' ' . $heading_style;
	$prefix          = '<div class="wapper_box_icon ' . $class_css . '" ' . $data_icon_hover_color . $data_icon_border_color_hover . $data_icon_bg_color_hover . $data_bg_read_more_text_hover . '>';
	$suffix          = '</div>';

	// Set link to Box
	if ( $link !== '' ) {
		if ( $read_more == '' ) {
			$href = vc_build_link( $link );
			if ( $href['url'] ) {
				$prefix .= '<a class="icon-box-link" href="' . esc_url($href['url']) . '">';
				$suffix .= '</a>';
			} else {
				$suffix .= '';
			}
		}
	}

	/* icon position */
	$html = $ex_class = '';
	if ( $pos != '' && $icon_style == "style1" ) {
		$ex_class .= ' icon-' . $pos;
	}
	/* end icon position */

	/* box icon style */
	$arrow_box = '';
	if ( $icon_style == 'style1' ) {
		if ( $box_icon_style == 'square_arrow' ) {
			if ( $icon_bg_color == '' ) {
				$icon_bg_color = "transparent";
			}
			$arrow_box = '<span class="arrow_sq" style="border-top: 9px solid ' . $icon_bg_color . '"></span>';
		}

		$box_icon_style = ' ' . $box_icon_style;
	} else {
		$box_icon_style = '';
	}
	/* End box icon style */

	$html .= '<div class="smicon-box ' . $ex_class . '">';

	$html_icon = $html_content = "";

	/* show icon or custom icon */
	if ( $icon_type == 'font-awesome' ) {
		if ( $icon != 'none' ) {
			$html_icon .= '<div class="boxes_icon' . $box_icon_style . '" ' . $boxes_icon_style . '><span class="inner_icon"><span class="icon">';
			$class = 'fa fa-' . $icon . ' ';
			$style = ( $color == 'custom' ) ? ' color:' . $icon_color . ';' : ' ';
			$style .= ( $icon_size !== '' ) ? ' font-size:' . $icon_size . 'px; line-height:' . $icon_size . 'px;vertical-align: middle;' : ' ';
			$html_icon .= '<i class="' . $class . '" style="' . $style . '"></i>';
			$html_icon .= '</span></span>' . $arrow_box . '</div>';
		}
	} else {
		$img = wp_get_attachment_image_src( $icon_img, 'full' );
		$html_icon .= '<div class="boxes_icon' . $box_icon_style . '" ' . $boxes_icon_style . '><span class="inner_icon"><span class="icon icon-images">';
		$style = ( $icon_size !== '' ) ? ' width="' . $width_images . '" height = "' . $height_images . '"' : ' ';
		$style .= ( $title !== '' ) ? ' alt="' . $title . '"' : 'alt=""';
		$html_icon .= '<img ' . $style . ' src="' . $img[0] . '" />';
		$html_icon .= '</span></span>' . $arrow_box . '</div>';
	}
	/* end show icon or custom icon */

	// set link to read more button 
	if ( $link !== '' ) {
		if ( $read_more == 'more' ) {
			$href = vc_build_link( $link );
			if ( $href['url'] ) {
				$more_link = '<a class="smicon-read sc-btn" href="' . esc_url($href['url']) . '" ' . $read_more_style . ' >';
				$more_link .= $read_text;
				$more_link .= '</a>';
			}
		}
	} else {
		$more_link = '';
	}
	/* show CONTENT*/
	if ( $title !== '' || $content !== '' || $more_link !== '' ) {
		$html_content .= '<div class="boxes_content" ' . $boxes_content_style . '><div class="mask-content">';
	}
	/* Title */
	if ( $title !== '' ) {
		//$html .= '<div class="shortcode_title_icon_box" ' . $header_icon_style . '>';
		$html_content .= '<div class="shortcode_title_icon_box">';
		$html_content .= '<' . $size . ' class = "boxes_title" ' . $title_style . '>';
		$link_prefix = $link_sufix = '';
		// set link to title 
		if ( $link !== '' ) {
			if ( $read_more == 'title' ) {
				$href = vc_build_link( $link );
				if ( $href['url'] ) {
					$link_prefix = '<a class="smicon-box-link" href="' . ($href['url']) . '">';
					$link_sufix  = '</a>';
				}
			}
		}
		// Convert || characters into line break
		$title = str_replace( '||', '<br />', $title );
		$html_content .= $link_prefix . $title . $link_sufix;
		$html_content .= '</' . $size . '></div>';
	}
	/* End Title */
	/* Description */
	$html_content .= '<div class="content_icon_box">';

	if ( $content <> '' ) {
		$html_content .= '<div class="description" ' . $description_style . '>';
		$html_content .= '<p>' . $content . '</p>';
		$html_content .= $more_link;
		$html_content .= '</div>';
	} else {
		$html_content .= $more_link;
	}
	$html_content .= '</div>';
	/* End Description */

	if ( $title !== '' || $content !== '' || $more_link !== '' ) {
		$html_content .= "</div></div>";
	}
	/* End show CONTENT*/

	if ( $pos == "right-middle" ) {
		$html .= $html_content .  $html_icon;
	} else {
		$html .= $html_icon . $html_content;
	}

	$html .= '<div class="clear"></div>';
	$html .= '</div>';
	/* smicon-box */
	$html = $prefix . $html . $suffix;

	return $html;
}

// function param
if ( function_exists( 'add_shortcode_param' ) ) {
	// add param type
	add_shortcode_param( 'icon', 'icon_settings_field' );
	add_shortcode_param( 'number', 'number_settings_field' );
	add_shortcode_param( 'selectimage', 'selectimage_settings_field' );
}
add_action( 'admin_enqueue_scripts', 'icon_admin_styles' );
// Enqueue admin styles
function icon_admin_styles() {
	global $theme_options_data;
	// Get FontAwesome source depending the settings from Theme Options
	// if ( isset( $theme_options_data['font_awesome'] ) && $theme_options_data['font_awesome'] == "font_awesome_cdn" ) {
	// 	wp_enqueue_style( 'aloxo-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '4.2.0' );
	// } else {
	// 	wp_enqueue_style( 'aloxo-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.2.0' );
	// }
	wp_enqueue_style( 'aloxo-awesome', TP_THEME_FRAMEWORK_URI . 'css/font-awesome.min.css', array() );
	wp_enqueue_style( 'icon_box', get_template_directory_uri() . '/less/admin/vc_custom.css' );
}

// Function generate param type "number"
function number_settings_field( $settings, $value ) {
	$dependency = vc_generate_dependencies_attributes( $settings );
	$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
	$type       = isset( $settings['type'] ) ? $settings['type'] : '';
	$min        = isset( $settings['min'] ) ? $settings['min'] : '';
	$max        = isset( $settings['max'] ) ? $settings['max'] : '';
	$suffix     = isset( $settings['suffix'] ) ? $settings['suffix'] : '';
	$class      = isset( $settings['class'] ) ? $settings['class'] : '';
	$output     = '<input type="number" min="' . $min . '" max="' . $max . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" style="max-width:100px; margin-right: 10px;" />' . $suffix;

	return $output;
}


function selectimage_settings_field( $settings, $value ) {
	$dependency = vc_generate_dependencies_attributes( $settings );
	$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
	$radios     = isset( $settings['value'] ) ? $settings['value'] : '';
	$output     = $checked = '';
	$checked    = '';
	var_dump( $value );
	if ( $radios != '' && is_array( $radios ) ) {
		$output .= '<select name="' . $param_name . '" class="" data-option=""' . $dependency . '>';
		foreach ( $radios as $radio => $img ) {
			if ( $radio === $value ) {
				$checked = 'selected="selected"';
			}
			$output .= '<option value="' . $radio . '"  ' . $checked . '>' . $radio . '</option>';
			$checked = '';
		}
		$output .= '</select>';

	}

	return $output;

}

// create icon style attribute
function icon_settings_field( $settings, $value ) {
	$dependency = vc_generate_dependencies_attributes( $settings );
	$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
	$type       = isset( $settings['type'] ) ? $settings['type'] : '';
	$class      = isset( $settings['class'] ) ? $settings['class'] : '';
	$icons      = array( 'none', 'glass', 'music', 'search', 'envelope-o', 'heart', 'star', 'star-o', 'user', 'film', 'th-large', 'th', 'th-list', 'check', 'remove', 'close', 'times', 'search-plus', 'search-minus', 'power-off', 'signal', 'gear', 'cog', 'trash-o', 'home', 'file-o', 'clock-o', 'road', 'download', 'arrow-circle-o-down', 'arrow-circle-o-up', 'inbox', 'play-circle-o', 'rotate-right', 'repeat', 'refresh', 'list-alt', 'lock', 'flag', 'headphones', 'volume-off', 'volume-down', 'volume-up', 'qrcode', 'barcode', 'tag', 'tags', 'book', 'bookmark', 'print', 'camera', 'font', 'bold', 'italic', 'text-height', 'text-width', 'align-left', 'align-center', 'align-right', 'align-justify', 'list', 'dedent', 'outdent', 'indent', 'video-camera', 'photo', 'image', 'picture-o', 'pencil', 'map-marker', 'adjust', 'tint', 'edit', 'pencil-square-o', 'share-square-o', 'check-square-o', 'arrows', 'step-backward', 'fast-backward', 'backward', 'play', 'pause', 'stop', 'forward', 'fast-forward', 'step-forward', 'eject', 'chevron-left', 'chevron-right', 'plus-circle', 'minus-circle', 'times-circle', 'check-circle', 'question-circle', 'info-circle', 'crosshairs', 'times-circle-o', 'check-circle-o', 'ban', 'arrow-left', 'arrow-right', 'arrow-up', 'arrow-down', 'mail-forward', 'share', 'expand', 'compress', 'plus', 'minus', 'asterisk', 'exclamation-circle', 'gift', 'leaf', 'fire', 'eye', 'eye-slash', 'warning', 'exclamation-triangle', 'plane', 'calendar', 'random', 'comment', 'magnet', 'chevron-up', 'chevron-down', 'retweet', 'shopping-cart', 'folder', 'folder-open', 'arrows-v', 'arrows-h', 'bar-chart-o', 'bar-chart', 'twitter-square', 'facebook-square', 'camera-retro', 'key', 'gears', 'cogs', 'comments', 'thumbs-o-up', 'thumbs-o-down', 'star-half', 'heart-o', 'sign-out', 'linkedin-square', 'thumb-tack', 'external-link', 'sign-in', 'trophy', 'github-square', 'upload', 'lemon-o', 'phone', 'square-o', 'bookmark-o', 'phone-square', 'twitter', 'facebook', 'github', 'unlock', 'credit-card', 'rss', 'hdd-o', 'bullhorn', 'bell', 'certificate', 'hand-o-right', 'hand-o-left', 'hand-o-up', 'hand-o-down', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-up', 'arrow-circle-down', 'globe', 'wrench', 'tasks', 'filter', 'briefcase', 'arrows-alt', 'group', 'users', 'chain', 'link', 'cloud', 'flask', 'cut', 'scissors', 'copy', 'files-o', 'paperclip', 'save', 'floppy-o', 'square', 'navicon', 'reorder', 'bars', 'list-ul', 'list-ol', 'strikethrough', 'underline', 'table', 'magic', 'truck', 'pinterest', 'pinterest-square', 'google-plus-square', 'google-plus', 'money', 'caret-down', 'caret-up', 'caret-left', 'caret-right', 'columns', 'unsorted', 'sort', 'sort-down', 'sort-desc', 'sort-up', 'sort-asc', 'envelope', 'linkedin', 'rotate-left', 'undo', 'legal', 'gavel', 'dashboard', 'tachometer', 'comment-o', 'comments-o', 'flash', 'bolt', 'sitemap', 'umbrella', 'paste', 'clipboard', 'lightbulb-o', 'exchange', 'cloud-download', 'cloud-upload', 'user-md', 'stethoscope', 'suitcase', 'bell-o', 'coffee', 'cutlery', 'file-text-o', 'building-o', 'hospital-o', 'ambulance', 'medkit', 'fighter-jet', 'beer', 'h-square', 'plus-square', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-double-down', 'angle-left', 'angle-right', 'angle-up', 'angle-down', 'desktop', 'laptop', 'tablet', 'mobile-phone', 'mobile', 'circle-o', 'quote-left', 'quote-right', 'spinner', 'circle', 'mail-reply', 'reply', 'github-alt', 'folder-o', 'folder-open-o', 'smile-o', 'frown-o', 'meh-o', 'gamepad', 'keyboard-o', 'flag-o', 'flag-checkered', 'terminal', 'code', 'mail-reply-all', 'reply-all', 'star-half-empty', 'star-half-full', 'star-half-o', 'location-arrow', 'crop', 'code-fork', 'unlink', 'chain-broken', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-slash', 'shield', 'calendar-o', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-circle-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-h', 'ellipsis-v', 'rss-square', 'play-circle', 'ticket', 'minus-square', 'minus-square-o', 'level-up', 'level-down', 'check-square', 'pencil-square', 'external-link-square', 'share-square', 'compass', 'toggle-down', 'caret-square-o-down', 'toggle-up', 'caret-square-o-up', 'toggle-right', 'caret-square-o-right', 'euro', 'eur', 'gbp', 'dollar', 'usd', 'rupee', 'inr', 'cny', 'rmb', 'yen', 'jpy', 'ruble', 'rouble', 'rub', 'won', 'krw', 'bitcoin', 'btc', 'file', 'file-text', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-numeric-asc', 'sort-numeric-desc', 'thumbs-up', 'thumbs-down', 'youtube-square', 'youtube', 'xing', 'xing-square', 'youtube-play', 'dropbox', 'stack-overflow', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-square', 'tumblr', 'tumblr-square', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gittip', 'sun-o', 'moon-o', 'archive', 'bug', 'vk', 'weibo', 'renren', 'pagelines', 'stack-exchange', 'arrow-circle-o-right', 'arrow-circle-o-left', 'toggle-left', 'caret-square-o-left', 'dot-circle-o', 'wheelchair', 'vimeo-square', 'turkish-lira', 'try', 'plus-square-o', 'space-shuttle', 'slack', 'envelope-square', 'wordpress', 'openid', 'institution', 'bank', 'university', 'mortar-board', 'graduation-cap', 'yahoo', 'google', 'reddit', 'reddit-square', 'stumbleupon-circle', 'stumbleupon', 'delicious', 'digg', 'pied-piper', 'pied-piper-alt', 'drupal', 'joomla', 'language', 'fax', 'building', 'child', 'paw', 'spoon', 'cube', 'cubes', 'behance', 'behance-square', 'steam', 'steam-square', 'recycle', 'automobile', 'car', 'cab', 'taxi', 'tree', 'spotify', 'deviantart', 'soundcloud', 'database', 'file-pdf-o', 'file-word-o', 'file-excel-o', 'file-powerpoint-o', 'file-photo-o', 'file-picture-o', 'file-image-o', 'file-zip-o', 'file-archive-o', 'file-sound-o', 'file-audio-o', 'file-movie-o', 'file-video-o', 'file-code-o', 'vine', 'codepen', 'jsfiddle', 'life-bouy', 'life-buoy', 'life-saver', 'support', 'life-ring', 'circle-o-notch', 'ra', 'rebel', 'ge', 'empire', 'git-square', 'git', 'hacker-news', 'tencent-weibo', 'qq', 'wechat', 'weixin', 'send', 'paper-plane', 'send-o', 'paper-plane-o', 'history', 'circle-thin', 'header', 'paragraph', 'sliders', 'share-alt', 'share-alt-square', 'bomb', 'soccer-ball-o', 'futbol-o', 'tty', 'binoculars', 'plug', 'slideshare', 'twitch', 'yelp', 'newspaper-o', 'wifi', 'calculator', 'paypal', 'google-wallet', 'cc-visa', 'cc-mastercard', 'cc-discover', 'cc-amex', 'cc-paypal', 'cc-stripe', 'bell-slash', 'bell-slash-o', 'trash', 'copyright', 'at', 'eyedropper', 'paint-brush', 'birthday-cake', 'area-chart', 'pie-chart', 'line-chart', 'lastfm', 'lastfm-square', 'toggle-off', 'toggle-on', 'bicycle', 'bus', 'ioxhost', 'angellist', 'cc', 'shekel', 'sheqel', 'ils', 'meanpath' );
	$output     = '<input type="hidden" name="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" value="' . $value . '" id="trace"/>
					<div class="icon-preview"><i class=" fa fa-' . $value . '"></i></div>';
	$output .= '<input class="search" type="text" placeholder="Search" />';
	$output .= '<div id="icon-dropdown" >';
	$output .= '<ul class="icon-list">';
	$n = 1;
	foreach ( $icons as $icon ) {
		$selected = ( $icon == $value ) ? 'class="selected"' : '';
		$output .= '<li ' . $selected . ' data-icon="' . $icon . '"><i class="icon fa fa-' . $icon . '"></i><label class="icon">' . $icon . '</label></li>';
		$n ++;
	}
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '<script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery(".search").keyup(function(){
                            // Retrieve the input field text and reset the count to zero
                            var filter = jQuery(this).val(), count = 0;
                            // Loop through the icon list
                            jQuery(".icon-list li").each(function(){
                                    // If the list item does not contain the text phrase fade it out
                                    if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
                                            jQuery(this).fadeOut();
                                    } else {
                                            jQuery(this).show();
                                            count++;
                                    }
                            });
                        });
                    });
                    jQuery("#icon-dropdown li").click(function() {
                        jQuery(this).attr("class","selected").siblings().removeAttr("class");
                        var icon = jQuery(this).attr("data-icon");
                        jQuery("#trace").val(icon);
                        jQuery(".icon-preview").html("<i class=\'icon fa fa-"+icon+"\'></i>");
                    });
        </script>';

	return $output;
}