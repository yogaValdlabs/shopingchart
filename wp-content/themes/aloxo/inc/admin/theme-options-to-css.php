<?php

function customcss() {
	$thim_options = get_theme_mods();
	$custom_css   = "";

	/* Sticky Config */
	if ( isset( $thim_options['thim_config_att_sticky'] ) && $thim_options['thim_config_att_sticky'] == 'sticky_custom' ) {
		// Background Color
		$custom_css .= '.site-header.sticky_custom .navigation.affix {background:' . $thim_options['thim_sticky_bg_main_menu_color'] . ';}';

		// Text Color
		$custom_css .= '.site-header.sticky_custom .navigation.affix .main_menu_container .nav>li>a, .site-header.sticky_custom .navigation.affix .main_menu_container .nav>li>span.disable_link{color: ' . $thim_options['thim_sticky_main_menu_text_color'] . ';}';

		// Text hover color the same with active
		$custom_css .= '.site-header.sticky_custom .navigation.affix #main_menu .nav > li.current-menu-item > a, #main_menu .nav > li:hover > a{color:' . $thim_options['thim_sticky_main_menu_text_hover_color'] . '}';
		$custom_css .= '.site-header.sticky_custom .navigation.affix .main_menu_container .nav>li>a.nav-active{color:' . $thim_options['thim_sticky_main_menu_text_hover_color'] . '}';

		/* Top Border Color for Submenu */
		// border top submenu color
		$custom_css .= '.site-header.sticky_custom .navigation.affix #main_menu ul.navbar-nav > li.menu-item-has-children > ul.sub-menu{border-top: 3px solid ' . $thim_options['thim_sticky_sub_menu_border_top_color'] . '}';
		$custom_css .= '.site-header.sticky_custom .navigation.affix .navbar-nav > li.menu-item-has-children > a:after,.site-header.sticky_custom .navigation.affix .navbar-nav > li.menu-item-has-children > span.disable_link:after{border-bottom: 7px solid ' . $thim_options['thim_sticky_sub_menu_border_top_color'] . '}';

		$custom_css .= '.site-header.sticky_custom .navigation.affix .navbar-nav > li.menu-item-has-children:first-child >a:after{border-left: 7px solid ' . $thim_options['thim_sticky_sub_menu_border_top_color'] . ';border-bottom: transparent;}';

		// c2
		$custom_css .= '.site-header.sticky_custom .navigation.affix #main_menu .nav > li.standard > .sub-menu > li .sub-menu {border-top: 3px solid ' . $thim_options['thim_sticky_sub_menu_border_top_color'] . ';margin-top: -3px;}';
	}
	/* End sticky config */

	/* Main Menu */
	// Background
	$custom_css .= '.navigation {background:' . $thim_options['thim_bg_main_menu_color'] . ';}';
	// border color
	if ( $thim_options['thim_border_main_menu'] ) {
		$custom_css .= '.navigation {border-top: 4px ' . $thim_options['thim_border_main_menu'] . ' solid;}';
	}
	// Text color, font-weight, font-size
	//$custom_css .= '.main_menu_container .nav>li>a,.main_menu_container .nav>li>span.disable_link{color: ' . $thim_options['thim_main_menu_text_color'] . '; font-weight: ' . $thim_options['thim_font_weight_main_menu'] . '; font-size: ' . $thim_options['thim_font_size_main_menu'] . 'px}';
	$custom_css .= '.main_menu_container .nav>li>a,.main_menu_container .nav>li>span.disable_link{color: ' . $thim_options['thim_main_menu_text_color'] . '; font-size: ' . $thim_options['thim_font_size_main_menu'] . '}';

	// hover text color
	$custom_css .= '#main_menu .nav > li.current-menu-item > a, #main_menu .nav > li:hover > a{color:' . $thim_options['thim_main_menu_text_hover_color'] . '}';
	$custom_css .= '#main_menu .nav:hover > li.current-menu-item > a{color:' . $thim_options['thim_main_menu_text_color'] . '}';

	$custom_css .= '#main_menu .nav > li.current-menu-item > a, #main_menu .nav > li.current-menu-item:hover > a{color:' . $thim_options['thim_main_menu_text_hover_color'] . '}';
	$custom_css .= '.main_menu_container .nav>li>a.nav-active{color:' . $thim_options['thim_main_menu_text_hover_color'] . '}';

	// background hover item
	if ( isset( $thim_options['thim_main_menu_text_hover_bg_color'] ) && $thim_options['thim_main_menu_text_hover_bg_color'] <> '' ) {
		$custom_css .= '#main_menu .nav:hover > li.current-menu-item > a{background: transparent;}';
		$custom_css .= '#main_menu .nav > li:hover >a,
                        #main_menu .nav > li.current-menu-item > a, #main_menu .nav > li.current-menu-item:hover > a,
                        #main_menu .nav > li.current-menu-item > a, #main_menu .nav > li.current-menu-item:hover > a{background: ' . $thim_options['thim_main_menu_text_hover_bg_color'] . ';}';
		$custom_css .= '#masthead .header_boxed .navigation.affix-top {margin-left: 15px;margin-right: 15px;}';
		$custom_css .= '#masthead .header_boxed .navigation.affix {margin-left: auto;margin-right: auto;}';
	}
	$custom_css .= '#masthead .navigation .nav.navbar-nav {padding-left: 38px;}';

	// border top item when hover item in menu
	if ( isset( $thim_options['thim_main_menu_text_hover_border_color'] ) && $thim_options['thim_main_menu_text_hover_border_color'] <> '' ) {
		$custom_css .= '#main_menu .nav > li >a{margin-top: -4px;border-top: 4px solid transparent;}';
		$custom_css .= '#main_menu .nav:hover > li.current-menu-item > a{border-color: transparent;}';
		$custom_css .= '#main_menu .nav > li:hover >a,
                        #main_menu .nav > li.current-menu-item > a, #main_menu .nav > li.current-menu-item:hover > a,
                        #main_menu .nav > li.current-menu-item > a, #main_menu .nav > li.current-menu-item:hover > a{border-color: ' . $thim_options['thim_main_menu_text_hover_border_color'] . ';}';
	}

	// border top submenu color
	$custom_css .= '#main_menu ul.navbar-nav > li.menu-item-has-children > ul.sub-menu{border-top: 3px solid ' . $thim_options['thim_border_sub_menu'] . '}';
	$custom_css .= '.navbar-nav > li.menu-item-has-children > a:after,.navbar-nav > li.menu-item-has-children > span.disable_link:after{border-bottom: 7px solid ' . $thim_options['thim_border_sub_menu'] . '}';

	$custom_css .= '.navbar-nav > li.menu-item-has-children:first-child >a:after{border-left: 7px solid ' . $thim_options['thim_border_sub_menu'] . '}';
	// c2
	$custom_css .= '#main_menu .nav > li.standard > .sub-menu > li .sub-menu {border-top: 3px solid ' . $thim_options['thim_border_sub_menu'] . ';margin-top: -3px;}';

	// opacity parent menu
	$menu_hover_opacity = $thim_options['thim_opacity_parent_menu'] / 100;

//	$bg_menu_opacity   = aloxo_hex2rgb( $thim_options['thim_bg_main_menu_color'] );
//	$menu_opacity = 'rgba(' . $bg_menu_opacity[0] . ',' . $bg_menu_opacity[1] . ',' . $bg_menu_opacity[2] . ','.$menu_hover_opacity.')';

	$custom_css .= '#main_menu .nav:hover > li > a{-moz-opacity: ' . $menu_hover_opacity . ';-khtml-opacity: ' . $menu_hover_opacity . ';-webkit-opacity: ' . $menu_hover_opacity . ';opacity: ' . $menu_hover_opacity . '; }';
	$custom_css .= '#main_menu .nav > li:hover > a{-moz-opacity: 1;-khtml-opacity: 1;-webkit-opacity: 1;opacity: 1; }';
	//$custom_css .='.navigation{background: '.$menu_opacity.' }';
	/* End Main Menu */


	/* Header */
	// margin top
	if ( isset( $thim_options['thim_margin_header_top'] ) && $thim_options['thim_margin_header_top'] <> '' ) {
		if ( isset( $thim_options['thim_header_position'] ) && $thim_options['thim_header_position'] == 'overlay_header' ) {
			$custom_css .= ' .overlay_header.site-header{top: ' . $thim_options['thim_margin_header_top'] . 'px; }';
		} else {
			$custom_css .= ' .site-header{z-index: 99998;margin-top: ' . $thim_options['thim_margin_header_top'] . 'px; }';
		}
	}

	// top header
	// $drawer_link = aloxo_hex2rgb($thim_options['thim_bg_drawer_color']);
	// $bg_drawer_link = 'rgba(' . $drawer_link[0] . ',' . $drawer_link[1] . ',' . $drawer_link[2] . ',0.5)';
	if ( ! $thim_options['thim_drawer_column'] ) {
		$thim_options['thim_drawer_column'] = 2;
	}
	$width_drawer = 100 / $thim_options['thim_drawer_column'];

	$custom_css .= '#masthead .top-header{border-bottom: 1px solid ' . $thim_options['thim_border_top_color'] . '; background:' . $thim_options['thim_bg_top_color'] . '; color: ' . $thim_options['thim_top_header_text_color'] . ' }';
	$custom_css .= '#masthead .top-header i,#masthead .top-header a{color: ' . $thim_options['thim_top_header_text_color'] . ' }
    #masthead .top-header a:hover{color: ' . $thim_options['thim_top_header_link_color'] . '}
    #rt-drawer .drawer_link a,#rt-drawer .widget-title,#rt-drawer .drawer_link a:hover{color: ' . $thim_options['thim_drawer_text_color'] . '}
    #masthead .top-header .aloxo_social_link li a,#rt-drawer .drawer_link a.collapsed{color: ' . $thim_options['thim_top_header_text_color'] . '!important}
    #masthead .top-header{font-size:' . $thim_options['thim_font_size_top_header'] . ';}
    #masthead .top-header .aloxo_social_link a{font-size:' . ( $thim_options['thim_font_size_top_header'] + 3 ) . '}

    #rt-drawer{background: ' . $thim_options['thim_bg_drawer_color'] . '; color: ' . $thim_options['thim_drawer_text_color'] . ' }
    #rt-drawer a{color: ' . $thim_options['thim_drawer_text_color'] . ' }
    #rt-drawer .drawer_link{background: ' . $thim_options['thim_bg_drawer_color'] . ';}
    #rt-drawer.style2 .drawer_link{ border-color: transparent ' . $thim_options['thim_bg_drawer_color'] . ' transparent transparent !important;}
    #rt-drawer #collapseDrawer .widget{ width: ' . $width_drawer . '%;}';

	/* End Header */

	/* Patten */
	if ( isset( $thim_options['thim_user_bg_pattern'] ) && $thim_options['thim_user_bg_pattern'] == '1' ) {
		$custom_css .= ' body{background-image: url("' . $thim_options['thim_bg_pattern'] . '"); }
        		.boxed_area{background-color:' . $thim_options['thim_body_bg_color'] . '}
        ';
	}
	if ( isset( $thim_options['thim_bg_pattern_upload'] ) && $thim_options['thim_bg_pattern_upload'] <> '' ) {
		$custom_css .= 'body{background-image: url("' . $thim_options['thim_bg_pattern_upload'] . '"); }
                        body{
                             background-repeat: ' . $thim_options['thim_bg_repeat'] . ';
                             background-position: ' . $thim_options['thim_bg_position'] . ';
                             background-attachment: ' . $thim_options['thim_bg_attachment'] . ';
                             background-size: ' . $thim_options['thim_bg_size'] . ';
                        }
        ';
	}
	/* End Patten */

	/* Widget Search */
	$custom_css .= '.ob_list_search li.ob_selected a{color: ' . $thim_options['thim_body_primary_color'] . ';}';

	//Header v_1
	if ( isset( $thim_options['thim_header_style'] ) && $thim_options['thim_header_style'] == 'header_v1' ) {
		$custom_css .= '.wapper_logo {padding: 10px 0;}';
		$custom_css .= '.navbar-nav > li > a, .navbar-nav > li > span{padding: 16px 30px;}';
	}

	/* Footer */
	// Border top
	if ( $thim_options['thim_copyright_border_top_color'] ) {
		$custom_css .= 'footer#colophon .copyright_area .container .copyright_inner{border-top: 1px ' . $thim_options['thim_copyright_border_top_color'] . ' solid;}';
	}

	// sale
	$background = base64_encode( '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50.917px" height="45.417px" viewBox="-12.917 -15.167 50.917 45.417" enable-background="new -12.917 -15.167 50.917 45.417" xml:space="preserve"><circle fill="' . $thim_options['thim_body_primary_color'] . '" cx="15.271" cy="7.667" r="22.208"/><path fill="' . $thim_options['thim_body_primary_color'] . '" d="M-2.563,20.902c-3.73,4.735-9.687,3.348-9.687,3.348s3.126,6.656,17.271,3.12"/></svg>' );
	$custom_css .= '
    .woocommerce-page.single-product #content > div.type-product.sale .onsale:after,
    .woocommerce ul.products li.product .onsale:after, .woocommerce-page ul.products li.product .onsale:after {
        content: "";
        display: block;
        background-image: url("data:image/svg+xml;base64,' . $background . '");
        position: absolute;
        background-repeat: no-repeat;
        background-position: center;
        top: 0;
        left: 5px;
        right: 0;
        bottom: 0;
        z-index: -1;
        -webkit-transform: scaleX(-1);
        -moz-transform: scaleX(-1);
        -ms-transform: scaleX(-1);
        -o-transform: scaleX(-1);
        transform: scaleX(-1);
    }';
	$custom_css .= '
    .woocommerce-page.single-product #content > div.type-product.sale .onsale:after{
        content: "";
        display: block;
        background-image: url("data:image/svg+xml;base64,' . $background . '");
        position: absolute;
        background-repeat: no-repeat;
        background-position: center;
        top: -18px;
        left: 4px;
        right: 0;
        bottom: 0;
        z-index: -1;
        -webkit-transform: scaleX(-1);
        -moz-transform: scaleX(-1);
        -ms-transform: scaleX(-1);
        -o-transform: scaleX(-1);
        transform: scaleX(-1);
    }';

	$drawer_link     = aloxo_hex2rgb( $thim_options['thim_body_primary_color'] );
	$primary_opacity = 'rgba(' . $drawer_link[0] . ',' . $drawer_link[1] . ',' . $drawer_link[2] . ',0.1)';

//    $custom_css .= '.item-product .product-hover .product-button {
//        background: ' . $primary_opacity . '!important;
//    }';
	// $custom_css .= '.item-product .product-hover .product-button .box-button .item_button .quick-view:hover,
	// .item-product .product-hover .product-button .box-button .item_button .compare:hover,
	// .item-product .product-hover .product-button .box-button .item_button a.button:hover {
	//     background: '.$thim_options['thim_body_primary_color'].'!important;
	// }';


	// Portfolio
	$portfolio_opacity = 'rgba(' . $drawer_link[0] . ',' . $drawer_link[1] . ',' . $drawer_link[2] . ',0.4)';
	$custom_css .= '.wapper_portfolio.text.effects_zoom_02 .portfolio-hover .thumb-bg,
    .wapper_portfolio.classic.effects_zoom_02 .portfolio-hover .thumb-bg{
        background-color: ' . $portfolio_opacity . '!important;
    }';
	// Custom Css
	$custom_css .= $thim_options['thim_custom_css'];

	return $custom_css;
}

function themeoptions_variation( $data ) {
	WP_Filesystem();
	global $wp_filesystem;

	$theme_options = array(
		'thim_body_bg_color',
		'thim_body_primary_color',
		// 'thim_body_text_color',
		// header
		'thim_font_size_top_header',
		'thim_bg_top_color',
		'thim_bg_top_opacity',
		'thim_top_header_text_color',
		'thim_top_header_link_color',
		'thim_width_left_top',
		'thim_border_top_color',
		// footer
		'thim_copyright_bg_color',
		'thim_copyright_text_color',
		'thim_copyright_text_size',
		//'thim_copyright_text_align',
		'thim_footer_text_font',
		'thim_footer_title_font',
		'thim_footer_bg_color',
		'thim_font_body',
		'thim_font_title',
		'thim_font_h1',
		'thim_font_h2',
		'thim_font_h3',
		'thim_font_h4',
		'thim_font_h5',
		'thim_font_h6',
		//sub_menu
		'thim_bg_sub_menu_color',
		'thim_bg_sub_menu_color_hover',
		'thim_border_sub_menu',
		'thim_sub_menu_text_color',
		'thim_sub_menu_text_color_hover',
		// mobile menu
		'thim_bg_mobile_menu_color',
		'thim_mobile_menu_text_color',
		'thim_mobile_menu_text_hover_color',
		'thim_font_size_mobile_menu',
		'thim_bg_mobile_border'
	);

	$config_less = '';
	foreach ( $theme_options AS $key ) {
		$option_data = $data[@$key];
		//data[key] is serialize
		if ( is_serialized( $data[@$key] ) || is_array( $data[@$key] ) ) {
			$config_less .= convert_font_to_variable( $data[@$key], $key );
		} else {
			$config_less .= "@{$key}: {$option_data};\n";
		}
	}

//	// Write it down to config.less file
//	$fileout = TP_THEME_DIR . "less/config.less";
//	if ( ! $wp_filesystem->put_contents( $fileout, $config_less, FS_CHMOD_FILE ) ) {
//		echo LINE . _e( "Can't write the file \"", 'aloxo' ) . $fileout . $config_less . "\"";
//	}
	// Write it down to config.less file
	$fileout = TP_THEME_DIR . "less/config.less";
	if ( !file_put_contents( $fileout, $config_less, LOCK_EX ) ) {
		@chmod( $fileout, 0777 );
		file_put_contents( $fileout, $config_less, LOCK_EX );
	}
}

function convert_font_to_variable( $data, $tag ) {
	//is_serialized
	$value = '';
	if ( is_serialized( $data ) ) {
		$data = unserialize( $data );
	}
	if ( isset( $data['font-family'] ) ) {
		$value = "@{$tag}_font_family: {$data['font-family']};\n";
	}
	if ( isset( $data['color-opacity'] ) ) {
		$value .= "@{$tag}_color: {$data['color-opacity']};\n";
	}
	if ( isset( $data['font-weight'] ) ) {

		$value .= "@{$tag}_font_weight: {$data['font-weight']};\n";
	}
	if ( isset( $data['font-style'] ) ) {
		$value .= "@{$tag}_font_style: {$data['font-style']};\n";
	}
	if ( isset( $data['text-transform'] ) ) {
		$value .= "@{$tag}_text_transform: {$data['text-transform']};\n";
	}
	if ( isset( $data['font-size'] ) ) {
		$value .= "@{$tag}_font_size: {$data['font-size']};\n";
	}
	if ( isset( $data['line-height'] ) ) {
		$value .= "@{$tag}_line_height: {$data['line-height']};\n";
	}

	return $value;
}
