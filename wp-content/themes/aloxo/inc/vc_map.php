<?php

$add_css_animation = array(
	"type" => "dropdown",
	"heading" => __("CSS Animation", "aloxo"),
	"param_name" => "css_animation",
	"admin_label" => true,
	"value" => array(__("No", "aloxo") => '', __("Top to bottom", "aloxo") => "top-to-bottom", __("Bottom to top", "aloxo") => "bottom-to-top", __("Left to right", "aloxo") => "left-to-right", __("Right to left", "aloxo") => "right-to-left", __("Appear from center", "aloxo") => "appear"),
	"description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "aloxo")
);

$add_css_animation_woo = array(
	"type" => "dropdown",
	"heading" => __("CSS Animation", "aloxo"),
	"param_name" => "css_animation",
	"admin_label" => true,
	"value" => array(__("No", "aloxo") => '', __("ScaleIn Effect", "aloxo") => "animated"),
	"description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "aloxo")
);
$display_pro_cates =array();
$product_categories           = get_terms( 'product_cat', array( 'hide_empty' => 0, 'orderby' => 'ASC' ) );
if ( is_array( $product_categories ) ) {
	foreach ( $product_categories as $cat ) {
		$display_pro_cates[$cat->name." (".$cat->slug.")"] = $cat->term_id;
	}
}

$posts_categories = get_terms( 'category', array('hide_empty' => 0, 'orderby' => 'ASC') );
$cate['All Posts'] = '';
if ( is_array( $posts_categories ) ) {
	foreach ( $posts_categories as $cat ) {
		$cate[$cat->name] = $cat->term_id;
	}
}

/////////////////////////////////////
/////// headings
////////////////////////////////////
vc_map( array(
	"name"        => __( "Headings", "aloxo" ),
	"base"        => "title",
	"class"       => "",
	//"icon"     => "icon-wpb-ui-custom_heading",
	"category"    => __( 'Aloxo Shortcodes', 'aloxo' ),
	'description' => __( 'Add heading text', 'js_composer' ),
	"params"      => array(
		array(
			"type"       => "textfield",
			"holder"     => "div",
			"class"      => "",
			"heading"    => __( "Heading Text", "aloxo" ),
			"param_name" => "title",
			"value"      => __( "Default value", "aloxo" )
		),
		array(
			"type"        => "colorpicker",
			"heading"     => __( "Text Heading color", "aloxo" ),
			"param_name"  => "textcolor",
			"admin_label" => true,
			"value"       => '#333', //Default Red color
			"description" => __( "Choose text color", 'aloxo' )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Size Heading", "aloxo" ),
			"param_name"  => "size",
			"admin_label" => true,
			"value"       => array( __( "h3", "aloxo" ) => "h3", __( "h1", "aloxo" ) => "h1", __( "h2", "aloxo" ) => "h2",  __( "h4", "aloxo" ) => "h4", __( "h5", "aloxo" ) => "h5", __( "h6", "aloxo" ) => "h6" ),
			"description" => __( "Select size heading.", "aloxo" )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Font Heading", "aloxo" ),
			"param_name"  => "font_heading",
			"admin_label" => true,
			"value"       => array( __( "Default", "aloxo" ) => "", __( "Custom", "aloxo" ) => "custom" ),
			"description" => __( "Select Font heading.", "aloxo" )
		),
		array(
			"type"        => "number",
			"heading"     => __( "Font Size", "aloxo" ),
			"param_name"  => "custom_font_size",
			"value"       => 0,
			"min"         => 0,
			"max"         => 100,
			"suffix"      => "px",
			"description" => __( "custom font size", "aloxo" ),
			"dependency"  => Array( 'element' => "font_heading", 'value' => array( 'custom' ) )
		),
		array(
				"type"        => "dropdown",
				"heading"     => __( "Custom Font Weight", "Aloxo" ),
				"param_name"  => "custom_font_weight",
				"admin_label" => true,
				"value"       => array(
					__( "Normal", "Aloxo" ) => "normal",
					__( "Bold", "Aloxo" )   => "bold",
					__( "100", "Aloxo" )    => "100",
					__( "200", "Aloxo" )    => "200",
					__( "300", "Aloxo" )    => "300",
					__( "400", "Aloxo" )    => "400",
					__( "500", "Aloxo" )    => "500",
					__( "600", "Aloxo" )    => "600",
					__( "700", "Aloxo" )    => "700",
					__( "800", "Aloxo" )    => "800",
					__( "900", "Aloxo" )    => "900",
				),
				"description" => __( "Select Custom Font Weight", "Aloxo" ),
				"dependency"  => Array( 'element' => "font_heading", 'value' => array( 'custom' ) )
			),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Margin Bottom", "aloxo" ),
			"param_name"  => "mg_bottom",
			"admin_label" => true,
			"value"       => array( __( "Default", "aloxo" ) => "", __( "Custom", "aloxo" ) => "custom" ),
			"description" => __( "Select Font heading.", "aloxo" )
		),
		array(
			"type"        => "number",
			"heading"     => __( "Margin Bottom Value", "aloxo" ),
			"param_name"  => "custom_mg_bt",
			"value"       => 0,
			"suffix"      => "px",
			"dependency"  => Array( 'element' => "mg_bottom", 'value' => array( 'custom' ) )
		),
		array(
			"type"       => "dropdown",
			"class"      => "",
			"heading"    => __( "Text Align:", "aloxo" ),
			"param_name" => "text_align",
			"value"      => array(
				"Text at Left"   => "left",
				"Text at Right"  => "right",
				"Text at Center" => "center"
			),
		),
		array(
			"type"        => "radioimage",
			"heading"     => __( "Style", "aloxo" ),
			"param_name"  => "style",
			"class"       => "style_header_select",
			"options"     => array(
				"default" => get_template_directory_uri() . '/images/admin/heading/heading_default.jpg',
				"style-01"  => get_template_directory_uri() . '/images/admin/heading/heading_style_3.jpg',
				"style-02"  => get_template_directory_uri() . '/images/admin/heading/heading_style_4.jpg',
				"style-03"  => get_template_directory_uri() . '/images/admin/heading/heading_style_5.jpg',
				"style-04"  => get_template_directory_uri() . '/images/admin/heading/heading_style_1.jpg',
			),
			"value"       => "default",
			"description" => __( "Select style heading.", "aloxo" )
		),
		array(
			"type"       => "dropdown",
			"class"      => "",
			"heading"    => __( "Line Width:", "aloxo" ),
			"param_name" => "line_width",
			"value"      => array(
				"Short Line"   => "short",
				"Wide Line"  => "wide",
			),
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Custom Line Color", "aloxo" ),
			"param_name"  => "custom_line",
			"admin_label" => true,
			"value"       => array( __( "Default", "aloxo" ) => "", __( "Custom", "aloxo" ) => "custom" )
		),
		array(
			"type"        => "colorpicker",
			"heading"     => __( "Line Color", "aloxo" ),
			"param_name"  => "line_color",
			"value"		  => "#000000",
			"dependency"  => Array( 'element' => "custom_line", 'value' => array( 'custom' ) )
		),
		$add_css_animation,
		array(
			"type"        => "textfield",
			"heading"     => __( "Extra class name", "aloxo" ),
			"param_name"  => "el_class",
			"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "aloxo" ),
		)

	)
) );


/////////////////////////////////////
/////// Provide
////////////////////////////////////
vc_map( array(
	"name"     => __( "Services We Provide", "aloxo" ),
	"base"     => "provide",
	"class"    => "",
	"icon"     => "icon-wpb-aloxo",
	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params"   => array(
		array(
			"type"       => "textfield",
			"holder"     => "div",
			"class"      => "",
			"heading"    => __( "Heading Text", "aloxo" ),
			"param_name" => "title",
			"value"      => __( "Default value", "aloxo" )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Size Heading", "aloxo" ),
			"param_name"  => "size",
			"admin_label" => true,
			"value"       => array( __( "h1", "aloxo" ) => "h1", __( "h2", "aloxo" ) => "h2", __( "h3", "aloxo" ) => "h3", __( "h4", "aloxo" ) => "h4", __( "h5", "aloxo" ) => "h5", __( "h6", "aloxo" ) => "h6" ),
			"description" => __( "Select size heading.", "aloxo" )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Icon", "aloxo" ),
			"param_name"  => "icon",
			"admin_label" => true,
			"value"       => array( __( "Game", "aloxo" ) => "game", __( "Style 02", "aloxo" ) => "icon2", __( "Style 03", "aloxo" ) => "icon3", __( "Style 04", "aloxo" ) => "icon4" ),
			"description" => __( "Select icon.", "aloxo" )
		),
		array(
			"type"       => "textfield",
			"heading"    => __( "Margin Top Box Icon (px)", "aloxo" ),
			"param_name" => "margintop",
			"class"      => "",
			"value"      => __( "", "aloxo" )
		),
		array(
			"type"       => "textarea_html",
			"holder"     => "div",
			"heading"    => __( "Text", "aloxo" ),
			"param_name" => "content",
			"value"      => __( "<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>", "aloxo" )
		), array(
			"type"        => "textfield",
			"heading"     => __( "Extra class name", "aloxo" ),
			"param_name"  => "el_class",
			"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "aloxo" ),
		)
	)
) );
/////////////////////////////////////
/////// Dropcap
////////////////////////////////////
vc_map( array(
	"name"     => __( "Dropcap", "aloxo" ),
	"base"     => "dropcap",
	"class"    => "",
	"icon"     => "icon-wpb-icon_dropcap",
	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params"   => array(
		array(
			"type"       => "textarea_html",
			"holder"     => "div",
			"heading"    => __( "Text", "aloxo" ),
			"param_name" => "content",
			"value"      => __( "<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>", "aloxo" )
		), array(
			"type"        => "textfield",
			"heading"     => __( "Extra class name", "aloxo" ),
			"param_name"  => "el_class",
			"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "aloxo" ),
		)
	)
) );
/////////////////////////////////////
///////Testimonials
////////////////////////////////////
// vc_map( array(
// 	"name"     => __( "Testimonials", "aloxo" ),
// 	"base"     => "testimonials",
// 	"class"    => "",
// 	"icon"     => "icon-wpb-icon_testimonials",
// 	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
// 	"params"   => array(
// 		array(
// 			"type"       => "textfield",
// 			"holder"     => "div",
// 			"class"      => "",
// 			"heading"    => __( "Heading Text", "aloxo" ),
// 			"param_name" => "title",
// 		),
// 		array(
// 			"type"        => "dropdown",
// 			"heading"     => __( "Size Heading", "aloxo" ),
// 			"param_name"  => "size",
// 			"admin_label" => true,
// 			"value"       => array( __( "h1", "aloxo" ) => "h1", __( "h2", "aloxo" ) => "h2", __( "h3", "aloxo" ) => "h3", __( "h4", "aloxo" ) => "h4", __( "h5", "aloxo" ) => "h5", __( "h6", "aloxo" ) => "h6" ),
// 			"description" => __( "Select size heading.", "aloxo" )
// 		),
// 		array(
// 			"type"        => "dropdown",
// 			"heading"     => __( "Style", "aloxo" ),
// 			"param_name"  => "style",
// 			"admin_label" => true,
// 			"value"       => array( __( "Default", "aloxo" ) => "default", __( "Style 01", "aloxo" ) => "style1" ),
// 			"description" => __( "Select style heading.", "aloxo" )
// 		),
// 		array(
// 			"type"        => "textfield",
// 			"heading"     => __( "Number Posts", "aloxo" ),
// 			"param_name"  => "number",
// 			"value"       => __( "4", "aloxo" ),
// 			"description" => __( "Number Posts", "aloxo" ),
// 		),
// 		array(
// 			"type"        => "dropdown",
// 			"heading"     => __( "Layout", "aloxo" ),
// 			"param_name"  => "layout",
// 			"admin_label" => true,
// 			"value"       => array( __( "Layout 01", "aloxo" ) => "layout1", __( "Layout 02", "aloxo" ) => "layout2" ),
// 			"description" => __( "Select Layout.", "aloxo" )
// 		),
// 		array(
// 			"type"       => "colorpicker",
// 			"holder"     => "div",
// 			"class"      => "",
// 			"heading"    => __( "Background Color", "aloxo" ),
// 			"param_name" => "bg_color",
// 			"dependency" => Array( 'element' => "layout", 'value' => array( 'layout2' ) )
// 		),
// 		array(
// 			"type"       => "colorpicker",
// 			"holder"     => "div",
// 			"class"      => "",
// 			"heading"    => __( "Text Color", "aloxo" ),
// 			"param_name" => "text_color",
// 			"dependency" => Array( 'element' => "layout", 'value' => array( 'layout2' ) )
// 		),
// 		array(
// 			"type"        => "textfield",
// 			"heading"     => __( "Extra class name", "aloxo" ),
// 			"param_name"  => "el_class",
// 			"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "aloxo" ),
// 		)
// 	)
// ) );

/////////////////////////////////////
///////Portfolio
////////////////////////////////////

//$cat_id = array(__("Select Category", "aloxo") => "default");
//
//$terms = get_terms('portfolio_category');
//if (is_array($terms)) {
//    foreach ($terms as $term) {
//        $cat_id[$term->name] = $term->name;
//    }
//}
vc_map( array(
	"name"     => __( "Portfolio", "aloxo" ),
	"base"     => "portfolio",
	"class"    => "",
	"icon"     => "icon-wpb-icon_portfolio",
	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params"   => array(
		
		array(
			"type"       => "dropdown",
			"heading"    => __( "Column", "aloxo" ),
			"param_name" => "column",
			"std"        => "three",
			"value"      => array(
				__( "One Columns", "aloxo" )   => "one",
				__( "Two Columns", "aloxo" )   => "two",
				__( "Three Columns", "aloxo" )   => "three",
				__( "Four Columns", "aloxo" )   => "four",
				__( "Five Columns", "aloxo" )   => "five",
			),
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Items Style", "aloxo" ),
			"param_name"  => "item_style",
			"admin_label" => true,
			"value"       => array(
				__( "Text", "aloxo" ) => "text",
				__( "Classic", "aloxo" )  => "classic",
				
			),
		),
		array(
			'type'       => 'checkbox',
			'heading'    => __( 'Enable gutter for Items', 'aloxo' ),
			'param_name' => 'gutter',
			'value'      => array( __( 'Yes, please', 'aloxo' ) => true ),
		),
		array(
			"type"       => "dropdown",
			"heading"    => __( "Items Size", "aloxo" ),
			"param_name" => "item_size",
			"std"        => 4,
			"value"      => array(
				__( "Multigrid", "aloxo" )   => "multigrid",
				__( "Masonry", "aloxo" )   => "masonry",
				__( "Same size", "aloxo" )   => "same"
			),
		),
		// Add link to existing content or to another resource
		// array(
		// 	"type"        => "vc_link",
		// 	"class"       => "",
		// 	"heading"     => __( "VIEW ALL PROJECTS", "aloxo" ),
		// 	"param_name"  => "linkcustom",
		// 	"value"       => __( "", "aloxo" ),
		// 	"description" => __( "Provide the link that will show view all projects button.", "aloxo" )
		// ),
		array(
			"type"        => "textfield",
			"heading"     => __( "Category Portfolio ID", "aloxo" ),
			"param_name"  => "category",
			"description" => __( "Enter category portfolio ID Example: 1, 2", "aloxo" ),
		),
		array(
			"type"       => "dropdown",
			"heading"    => __( "Images Hover Effects", "aloxo" ),
			"param_name" => "item_effect",
			"std"        => "classic",
			"value"      => array(
				__( "Classic", "aloxo" )   => "effects_classic",
				__( "Zoom In 01", "aloxo" )   => "effects_zoom_01",
				__( "Zoom In 02", "aloxo" )   => "effects_zoom_02"
			),
		),
		array(
			"type"       => "dropdown",
			"heading"    => __( "Filters", "aloxo" ),
			"param_name" => "filter_hiden",
			"std"        => "1",
			"value"      => array(
				__( "Show", "aloxo" )   => "0",
				__( "Hide", "aloxo" )   => "1",
			),
		),
		array(
			"type"       => "dropdown",
			"heading"    => __( "Filter Style", "aloxo" ),
			"param_name" => "filter_style",
			"std"        => "style-01",
			"value"      => array(
				__( "Style-01", "aloxo" )   => "style-01",
				__( "Style-02", "aloxo" )   => "style-02",
				
			),
			"dependency" => Array( "element" => "filter_hiden", "value" => array("0") ),
		),
		array(
			"type"       => "dropdown",
			"heading"    => __( "Filter Position", "aloxo" ),
			"param_name" => "filter_position",
			"std"        => "center",
			"value"      => array(
				__( "Left", "aloxo" )   => "left",
				__( "Center", "aloxo" )   => "center",
				__( "Right", "aloxo" )   => "right",
			),
			"dependency" => Array( "element" => "filter_hiden", "value" => array("0") ),
		),

		array(
			"type"       => "dropdown",
			"heading"    => __( "Pagination Styles", "aloxo" ),
			"param_name" => "paging",
			"std"        => "select-toggle_limit",
			"value"      => array(
				__( "Show All", "aloxo" )   => "all",
				__( "Limit Items", "aloxo" )   => "limit",
				__( "Paging", "aloxo" )   => "paging",
				__( "Infinite Scroll", "aloxo" )   => "infinite_scroll",
			),
		),
		array(
			"type"        => "number",
			"heading"     => __( "Items per View", "aloxo" ),
			"param_name"  => "num_per_view",
			"value"      => 4,
			"dependency"  => Array( 'element' => "paging", 'value' => array( 'limit', 'paging', 'infinite_scroll' ) ),
		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Extra class name", "aloxo" ),
			"param_name"  => "el_class",
			"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "aloxo" ),
		), $add_css_animation
	)
) );
/////////////////////////////////////
///////our team
////////////////////////////////////

// vc_map( array(
// 	"name"     => __( "Our Team", "aloxo" ),
// 	"base"     => "our_team",
// 	"class"    => "",
// 	"icon"     => "icon-wpb-icon_our_team",
// 	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
// 	"params"   => array(
// 		array(
// 			"type"        => "textfield",
// 			"heading"     => __( "Number Posts", "aloxo" ),
// 			"param_name"  => "number",
// 			"value"       => __( "8", "aloxo" ),
// 			"description" => __( "Number Posts", "aloxo" ),
// 		),
// 		array(
// 			"type"        => "dropdown",
// 			"heading"     => __( "Layout", "aloxo" ),
// 			"param_name"  => "layout",
// 			"value"       => array( __( "Lists", "aloxo" ) => "lists", __( "Slider", "aloxo" ) => "slider" ),
// 			//"description" => __( "Select bar background color.", "aloxo" ),
// 			"admin_label" => true
// 		),
// 		array(
// 			"type"       => "dropdown",
// 			"heading"    => __( "Column", "aloxo" ),
// 			"param_name" => "column",
// 			//"description" => __( "Select custom background color for heading.", "aloxo" ),
// 			"value"      => array( __( "3", "aloxo" ) => "3", __( "4", "aloxo" ) => "4" ),
// 			"dependency" => Array( 'element' => "layout", 'value' => array( 'lists' ) )
// 		),
// 		array(
// 			"type"        => "textfield",
// 			"heading"     => __( "Extra class name", "aloxo" ),
// 			"param_name"  => "el_class",
// 			"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "aloxo" ),
// 		),
// 	)
// ) );

/////////////////////////////////////
/////// video html 5
////////////////////////////////////

vc_map( array(
	"name"     => __( "Full Screen Video", "aloxo" ),
	"base"     => "video_screen",
	"class"    => "",
	"icon"     => "icon-wpb-icon_full_screen_video",
	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params"   => array(
		array(
			"type"       => "textfield",
			"heading"    => __( "Link Video (.mp4)", "aloxo" ),
			"param_name" => "linkvideo_mp4",
			"value"      => __( "", "aloxo" ),
		),
		array(
			"type"       => "textfield",
			"heading"    => __( "Link Video (.ogg)", "aloxo" ),
			"param_name" => "linkvideo_ogg",
			"value"      => __( "", "aloxo" ),
		),
	)
) );
/////////////////////////////////////
/////// Icon Box
////////////////////////////////////
$google_fonts = array(
    ""                        => "Select Font",
    "ABeeZee"                  => "ABeeZee",
    "Abel"                     => "Abel",
    "Abril Fatface"            => "Abril Fatface",
    "Aclonica"                 => "Aclonica",
    "Acme"                     => "Acme",
    "Actor"                    => "Actor",
    "Adamina"                  => "Adamina",
    "Advent Pro"               => "Advent Pro",
    "Aguafina Script"          => "Aguafina Script",
    "Akronim"                  => "Akronim",
    "Aladin"                   => "Aladin",
    "Aldrich"                  => "Aldrich",
    "Alegreya"                 => "Alegreya",
    "Alegreya SC"              => "Alegreya SC",
    "Alex Brush"               => "Alex Brush",
    "Alfa Slab One"            => "Alfa Slab One",
    "Alice"                    => "Alice",
    "Alike"                    => "Alike",
    "Alike Angular"            => "Alike Angular",
    "Allan"                    => "Allan",
    "Allerta"                  => "Allerta",
    "Allerta Stencil"          => "Allerta Stencil",
    "Allura"                   => "Allura",
    "Almendra"                 => "Almendra",
    "Almendra Display"         => "Almendra Display",
    "Almendra SC"              => "Almendra SC",
    "Amarante"                 => "Amarante",
    "Amaranth"                 => "Amaranth",
    "Amatic SC"                => "Amatic SC",
    "Amethysta"                => "Amethysta",
    "Anaheim"                  => "Anaheim",
    "Andada"                   => "Andada",
    "Andika"                   => "Andika",
    "Angkor"                   => "Angkor",
    "Annie Use Your Telescope" => "Annie Use Your Telescope",
    "Anonymous Pro"            => "Anonymous Pro",
    "Antic"                    => "Antic",
    "Antic Didone"             => "Antic Didone",
    "Antic Slab"               => "Antic Slab",
    "Anton"                    => "Anton",
    "Arapey"                   => "Arapey",
    "Arbutus"                  => "Arbutus",
    "Arbutus Slab"             => "Arbutus Slab",
    "Architects Daughter"      => "Architects Daughter",
    "Archivo Black"            => "Archivo Black",
    "Archivo Narrow"           => "Archivo Narrow",
    "Arimo"                    => "Arimo",
    "Arizonia"                 => "Arizonia",
    "Armata"                   => "Armata",
    "Artifika"                 => "Artifika",
    "Arvo"                     => "Arvo",
    "Asap"                     => "Asap",
    "Asset"                    => "Asset",
    "Astloch"                  => "Astloch",
    "Asul"                     => "Asul",
    "Atomic Age"               => "Atomic Age",
    "Aubrey"                   => "Aubrey",
    "Audiowide"                => "Audiowide",
    "Autour One"               => "Autour One",
    "Average"                  => "Average",
    "Average Sans"             => "Average Sans",
    "Averia Gruesa Libre"      => "Averia Gruesa Libre",
    "Averia Libre"             => "Averia Libre",
    "Averia Sans Libre"        => "Averia Sans Libre",
    "Averia Serif Libre"       => "Averia Serif Libre",
    "Bad Script"               => "Bad Script",
    "Balthazar"                => "Balthazar",
    "Bangers"                  => "Bangers",
    "Basic"                    => "Basic",
    "Battambang"               => "Battambang",
    "Baumans"                  => "Baumans",
    "Bayon"                    => "Bayon",
    "Belgrano"                 => "Belgrano",
    "Belleza"                  => "Belleza",
    "BenchNine"                => "BenchNine",
    "Bentham"                  => "Bentham",
    "Berkshire Swash"          => "Berkshire Swash",
    "Bevan"                    => "Bevan",
    "Bigelow Rules"            => "Bigelow Rules",
    "Bigshot One"              => "Bigshot One",
    "Bilbo"                    => "Bilbo",
    "Bilbo Swash Caps"         => "Bilbo Swash Caps",
    "Bitter"                   => "Bitter",
    "Black Ops One"            => "Black Ops One",
    "Bokor"                    => "Bokor",
    "Bonbon"                   => "Bonbon",
    "Boogaloo"                 => "Boogaloo",
    "Bowlby One"               => "Bowlby One",
    "Bowlby One SC"            => "Bowlby One SC",
    "Brawler"                  => "Brawler",
    "Bree Serif"               => "Bree Serif",
    "Bubblegum Sans"           => "Bubblegum Sans",
    "Bubbler One"              => "Bubbler One",
    "Buda"                     => "Buda",
    "Buenard"                  => "Buenard",
    "Butcherman"               => "Butcherman",
    "Butterfly Kids"           => "Butterfly Kids",
    "Cabin"                    => "Cabin",
    "Cabin Condensed"          => "Cabin Condensed",
    "Cabin Sketch"             => "Cabin Sketch",
    "Caesar Dressing"          => "Caesar Dressing",
    "Cagliostro"               => "Cagliostro",
    "Calligraffitti"           => "Calligraffitti",
    "Cambo"                    => "Cambo",
    "Candal"                   => "Candal",
    "Cantarell"                => "Cantarell",
    "Cantata One"              => "Cantata One",
    "Cantora One"              => "Cantora One",
    "Capriola"                 => "Capriola",
    "Cardo"                    => "Cardo",
    "Carme"                    => "Carme",
    "Carrois Gothic"           => "Carrois Gothic",
    "Carrois Gothic SC"        => "Carrois Gothic SC",
    "Carter One"               => "Carter One",
    "Caudex"                   => "Caudex",
    "Cedarville Cursive"       => "Cedarville Cursive",
    "Ceviche One"              => "Ceviche One",
    "Changa One"               => "Changa One",
    "Chango"                   => "Chango",
    "Chau Philomene One"       => "Chau Philomene One",
    "Chela One"                => "Chela One",
    "Chelsea Market"           => "Chelsea Market",
    "Chenla"                   => "Chenla",
    "Cherry Cream Soda"        => "Cherry Cream Soda",
    "Cherry Swash"             => "Cherry Swash",
    "Chewy"                    => "Chewy",
    "Chicle"                   => "Chicle",
    "Chivo"                    => "Chivo",
    "Cinzel"                   => "Cinzel",
    "Cinzel Decorative"        => "Cinzel Decorative",
    "Clicker Script"           => "Clicker Script",
    "Coda"                     => "Coda",
    "Coda Caption"             => "Coda Caption",
    "Codystar"                 => "Codystar",
    "Combo"                    => "Combo",
    "Comfortaa"                => "Comfortaa",
    "Coming Soon"              => "Coming Soon",
    "Concert One"              => "Concert One",
    "Condiment"                => "Condiment",
    "Content"                  => "Content",
    "Contrail One"             => "Contrail One",
    "Convergence"              => "Convergence",
    "Cookie"                   => "Cookie",
    "Copse"                    => "Copse",
    "Corben"                   => "Corben",
    "Courgette"                => "Courgette",
    "Cousine"                  => "Cousine",
    "Coustard"                 => "Coustard",
    "Covered By Your Grace"    => "Covered By Your Grace",
    "Crafty Girls"             => "Crafty Girls",
    "Creepster"                => "Creepster",
    "Crete Round"              => "Crete Round",
    "Crimson Text"             => "Crimson Text",
    "Croissant One"            => "Croissant One",
    "Crushed"                  => "Crushed",
    "Cuprum"                   => "Cuprum",
    "Cutive"                   => "Cutive",
    "Cutive Mono"              => "Cutive Mono",
    "Damion"                   => "Damion",
    "Dancing Script"           => "Dancing Script",
    "Dangrek"                  => "Dangrek",
    "Dawning of a New Day"     => "Dawning of a New Day",
    "Days One"                 => "Days One",
    "Delius"                   => "Delius",
    "Delius Swash Caps"        => "Delius Swash Caps",
    "Delius Unicase"           => "Delius Unicase",
    "Della Respira"            => "Della Respira",
    "Denk One"                 => "Denk One",
    "Devonshire"               => "Devonshire",
    "Didact Gothic"            => "Didact Gothic",
    "Diplomata"                => "Diplomata",
    "Diplomata SC"             => "Diplomata SC",
    "Domine"                   => "Domine",
    "Donegal One"              => "Donegal One",
    "Doppio One"               => "Doppio One",
    "Dorsa"                    => "Dorsa",
    "Dosis"                    => "Dosis",
    "Dr Sugiyama"              => "Dr Sugiyama",
    "Droid Sans"               => "Droid Sans",
    "Droid Sans Mono"          => "Droid Sans Mono",
    "Droid Serif"              => "Droid Serif",
    "Duru Sans"                => "Duru Sans",
    "Dynalight"                => "Dynalight",
    "EB Garamond"              => "EB Garamond",
    "Eagle Lake"               => "Eagle Lake",
    "Eater"                    => "Eater",
    "Economica"                => "Economica",
    "Electrolize"              => "Electrolize",
    "Elsie"                    => "Elsie",
    "Elsie Swash Caps"         => "Elsie Swash Caps",
    "Emblema One"              => "Emblema One",
    "Emilys Candy"             => "Emilys Candy",
    "Engagement"               => "Engagement",
    "Englebert"                => "Englebert",
    "Enriqueta"                => "Enriqueta",
    "Erica One"                => "Erica One",
    "Esteban"                  => "Esteban",
    "Euphoria Script"          => "Euphoria Script",
    "Ewert"                    => "Ewert",
    "Exo"                      => "Exo",
    "Expletus Sans"            => "Expletus Sans",
    "Fanwood Text"             => "Fanwood Text",
    "Fascinate"                => "Fascinate",
    "Fascinate Inline"         => "Fascinate Inline",
    "Faster One"               => "Faster One",
    "Fasthand"                 => "Fasthand",
    "Federant"                 => "Federant",
    "Federo"                   => "Federo",
    "Felipa"                   => "Felipa",
    "Fenix"                    => "Fenix",
    "Finger Paint"             => "Finger Paint",
    "Fjalla One"               => "Fjalla One",
    "Fjord One"                => "Fjord One",
    "Flamenco"                 => "Flamenco",
    "Flavors"                  => "Flavors",
    "Fondamento"               => "Fondamento",
    "Fontdiner Swanky"         => "Fontdiner Swanky",
    "Forum"                    => "Forum",
    "Francois One"             => "Francois One",
    "Freckle Face"             => "Freckle Face",
    "Fredericka the Great"     => "Fredericka the Great",
    "Fredoka One"              => "Fredoka One",
    "Freehand"                 => "Freehand",
    "Fresca"                   => "Fresca",
    "Frijole"                  => "Frijole",
    "Fruktur"                  => "Fruktur",
    "Fugaz One"                => "Fugaz One",
    "GFS Didot"                => "GFS Didot",
    "GFS Neohellenic"          => "GFS Neohellenic",
    "Gabriela"                 => "Gabriela",
    "Gafata"                   => "Gafata",
    "Galdeano"                 => "Galdeano",
    "Galindo"                  => "Galindo",
    "Gentium Basic"            => "Gentium Basic",
    "Gentium Book Basic"       => "Gentium Book Basic",
    "Geo"                      => "Geo",
    "Geostar"                  => "Geostar",
    "Geostar Fill"             => "Geostar Fill",
    "Germania One"             => "Germania One",
    "Gilda Display"            => "Gilda Display",
    "Give You Glory"           => "Give You Glory",
    "Glass Antiqua"            => "Glass Antiqua",
    "Glegoo"                   => "Glegoo",
    "Gloria Hallelujah"        => "Gloria Hallelujah",
    "Goblin One"               => "Goblin One",
    "Gochi Hand"               => "Gochi Hand",
    "Gorditas"                 => "Gorditas",
    "Goudy Bookletter 1911"    => "Goudy Bookletter 1911",
    "Graduate"                 => "Graduate",
    "Grand Hotel"              => "Grand Hotel",
    "Gravitas One"             => "Gravitas One",
    "Great Vibes"              => "Great Vibes",
    "Griffy"                   => "Griffy",
    "Gruppo"                   => "Gruppo",
    "Gudea"                    => "Gudea",
    "Habibi"                   => "Habibi",
    "Hammersmith One"          => "Hammersmith One",
    "Hanalei"                  => "Hanalei",
    "Hanalei Fill"             => "Hanalei Fill",
    "Handlee"                  => "Handlee",
    "Hanuman"                  => "Hanuman",
    "Happy Monkey"             => "Happy Monkey",
    "Headland One"             => "Headland One",
    "Henny Penny"              => "Henny Penny",
    "Herr Von Muellerhoff"     => "Herr Von Muellerhoff",
    "Holtwood One SC"          => "Holtwood One SC",
    "Homemade Apple"           => "Homemade Apple",
    "Homenaje"                 => "Homenaje",
    "IM Fell DW Pica"          => "IM Fell DW Pica",
    "IM Fell DW Pica SC"       => "IM Fell DW Pica SC",
    "IM Fell Double Pica"      => "IM Fell Double Pica",
    "IM Fell Double Pica SC"   => "IM Fell Double Pica SC",
    "IM Fell English"          => "IM Fell English",
    "IM Fell English SC"       => "IM Fell English SC",
    "IM Fell French Canon"     => "IM Fell French Canon",
    "IM Fell French Canon SC"  => "IM Fell French Canon SC",
    "IM Fell Great Primer"     => "IM Fell Great Primer",
    "IM Fell Great Primer SC"  => "IM Fell Great Primer SC",
    "Iceberg"                  => "Iceberg",
    "Iceland"                  => "Iceland",
    "Imprima"                  => "Imprima",
    "Inconsolata"              => "Inconsolata",
    "Inder"                    => "Inder",
    "Indie Flower"             => "Indie Flower",
    "Inika"                    => "Inika",
    "Irish Grover"             => "Irish Grover",
    "Istok Web"                => "Istok Web",
    "Italiana"                 => "Italiana",
    "Italianno"                => "Italianno",
    "Jacques Francois"         => "Jacques Francois",
    "Jacques Francois Shadow"  => "Jacques Francois Shadow",
    "Jim Nightshade"           => "Jim Nightshade",
    "Jockey One"               => "Jockey One",
    "Jolly Lodger"             => "Jolly Lodger",
    "Josefin Sans"             => "Josefin Sans",
    "Josefin Slab"             => "Josefin Slab",
    "Joti One"                 => "Joti One",
    "Judson"                   => "Judson",
    "Julee"                    => "Julee",
    "Julius Sans One"          => "Julius Sans One",
    "Junge"                    => "Junge",
    "Jura"                     => "Jura",
    "Just Another Hand"        => "Just Another Hand",
    "Just Me Again Down Here"  => "Just Me Again Down Here",
    "Kameron"                  => "Kameron",
    "Karla"                    => "Karla",
    "Kaushan Script"           => "Kaushan Script",
    "Kavoon"                   => "Kavoon",
    "Keania One"               => "Keania One",
    "Kelly Slab"               => "Kelly Slab",
    "Kenia"                    => "Kenia",
    "Khmer"                    => "Khmer",
    "Kite One"                 => "Kite One",
    "Knewave"                  => "Knewave",
    "Kotta One"                => "Kotta One",
    "Koulen"                   => "Koulen",
    "Kranky"                   => "Kranky",
    "Kreon"                    => "Kreon",
    "Kristi"                   => "Kristi",
    "Krona One"                => "Krona One",
    "La Belle Aurore"          => "La Belle Aurore",
    "Lancelot"                 => "Lancelot",
    "Lato"                     => "Lato",
    "League Script"            => "League Script",
    "Leckerli One"             => "Leckerli One",
    "Ledger"                   => "Ledger",
    "Lekton"                   => "Lekton",
    "Lemon"                    => "Lemon",
    "Libre Baskerville"        => "Libre Baskerville",
    "Life Savers"              => "Life Savers",
    "Lilita One"               => "Lilita One",
    "Limelight"                => "Limelight",
    "Linden Hill"              => "Linden Hill",
    "Lobster"                  => "Lobster",
    "Lobster Two"              => "Lobster Two",
    "Londrina Outline"         => "Londrina Outline",
    "Londrina Shadow"          => "Londrina Shadow",
    "Londrina Sketch"          => "Londrina Sketch",
    "Londrina Solid"           => "Londrina Solid",
    "Lora"                     => "Lora",
    "Love Ya Like A Sister"    => "Love Ya Like A Sister",
    "Loved by the King"        => "Loved by the King",
    "Lovers Quarrel"           => "Lovers Quarrel",
    "Luckiest Guy"             => "Luckiest Guy",
    "Lusitana"                 => "Lusitana",
    "Lustria"                  => "Lustria",
    "Macondo"                  => "Macondo",
    "Macondo Swash Caps"       => "Macondo Swash Caps",
    "Magra"                    => "Magra",
    "Maiden Orange"            => "Maiden Orange",
    "Mako"                     => "Mako",
    "Marcellus"                => "Marcellus",
    "Marcellus SC"             => "Marcellus SC",
    "Marck Script"             => "Marck Script",
    "Margarine"                => "Margarine",
    "Marko One"                => "Marko One",
    "Marmelad"                 => "Marmelad",
    "Marvel"                   => "Marvel",
    "Mate"                     => "Mate",
    "Mate SC"                  => "Mate SC",
    "Maven Pro"                => "Maven Pro",
    "McLaren"                  => "McLaren",
    "Meddon"                   => "Meddon",
    "MedievalSharp"            => "MedievalSharp",
    "Medula One"               => "Medula One",
    "Megrim"                   => "Megrim",
    "Meie Script"              => "Meie Script",
    "Merienda"                 => "Merienda",
    "Merienda One"             => "Merienda One",
    "Merriweather"             => "Merriweather",
    "Merriweather Sans"        => "Merriweather Sans",
    "Metal"                    => "Metal",
    "Metal Mania"              => "Metal Mania",
    "Metamorphous"             => "Metamorphous",
    "Metrophobic"              => "Metrophobic",
    "Michroma"                 => "Michroma",
    "Milonga"                  => "Milonga",
    "Miltonian"                => "Miltonian",
    "Miltonian Tattoo"         => "Miltonian Tattoo",
    "Miniver"                  => "Miniver",
    "Miss Fajardose"           => "Miss Fajardose",
    "Modern Antiqua"           => "Modern Antiqua",
    "Molengo"                  => "Molengo",
    "Molle"                    => "Molle",
    "Monda"                    => "Monda",
    "Monofett"                 => "Monofett",
    "Monoton"                  => "Monoton",
    "Monsieur La Doulaise"     => "Monsieur La Doulaise",
    "Montaga"                  => "Montaga",
    "Montez"                   => "Montez",
    "Montserrat"               => "Montserrat",
    "Montserrat Alternates"    => "Montserrat Alternates",
    "Montserrat Subrayada"     => "Montserrat Subrayada",
    "Moul"                     => "Moul",
    "Moulpali"                 => "Moulpali",
    "Mountains of Christmas"   => "Mountains of Christmas",
    "Mouse Memoirs"            => "Mouse Memoirs",
    "Mr Bedfort"               => "Mr Bedfort",
    "Mr Dafoe"                 => "Mr Dafoe",
    "Mr De Haviland"           => "Mr De Haviland",
    "Mrs Saint Delafield"      => "Mrs Saint Delafield",
    "Mrs Sheppards"            => "Mrs Sheppards",
    "Muli"                     => "Muli",
    "Mystery Quest"            => "Mystery Quest",
    "Neucha"                   => "Neucha",
    "Neuton"                   => "Neuton",
    "New Rocker"               => "New Rocker",
    "News Cycle"               => "News Cycle",
    "Niconne"                  => "Niconne",
    "Nixie One"                => "Nixie One",
    "Nobile"                   => "Nobile",
    "Nokora"                   => "Nokora",
    "Norican"                  => "Norican",
    "Nosifer"                  => "Nosifer",
    "Nothing You Could Do"     => "Nothing You Could Do",
    "Noticia Text"             => "Noticia Text",
    "Noto Sans"                => "Noto Sans",
    "Noto Serif"               => "Noto Serif",
    "Nova Cut"                 => "Nova Cut",
    "Nova Flat"                => "Nova Flat",
    "Nova Mono"                => "Nova Mono",
    "Nova Oval"                => "Nova Oval",
    "Nova Round"               => "Nova Round",
    "Nova Script"              => "Nova Script",
    "Nova Slim"                => "Nova Slim",
    "Nova Square"              => "Nova Square",
    "Numans"                   => "Numans",
    "Nunito"                   => "Nunito",
    "Odor Mean Chey"           => "Odor Mean Chey",
    "Offside"                  => "Offside",
    "Old Standard TT"          => "Old Standard TT",
    "Oldenburg"                => "Oldenburg",
    "Oleo Script"              => "Oleo Script",
    "Oleo Script Swash Caps"   => "Oleo Script Swash Caps",
    "Open Sans"                => "Open Sans",
    "Open Sans Condensed"      => "Open Sans Condensed",
    "Oranienbaum"              => "Oranienbaum",
    "Orbitron"                 => "Orbitron",
    "Oregano"                  => "Oregano",
    "Orienta"                  => "Orienta",
    "Original Surfer"          => "Original Surfer",
    "Oswald"                   => "Oswald",
    "Over the Rainbow"         => "Over the Rainbow",
    "Overlock"                 => "Overlock",
    "Overlock SC"              => "Overlock SC",
    "Ovo"                      => "Ovo",
    "Oxygen"                   => "Oxygen",
    "Oxygen Mono"              => "Oxygen Mono",
    "PT Mono"                  => "PT Mono",
    "PT Sans"                  => "PT Sans",
    "PT Sans Caption"          => "PT Sans Caption",
    "PT Sans Narrow"           => "PT Sans Narrow",
    "PT Serif"                 => "PT Serif",
    "PT Serif Caption"         => "PT Serif Caption",
    "Pacifico"                 => "Pacifico",
    "Paprika"                  => "Paprika",
    "Parisienne"               => "Parisienne",
    "Passero One"              => "Passero One",
    "Passion One"              => "Passion One",
    "Patrick Hand"             => "Patrick Hand",
    "Patrick Hand SC"          => "Patrick Hand SC",
    "Patua One"                => "Patua One",
    "Paytone One"              => "Paytone One",
    "Peralta"                  => "Peralta",
    "Permanent Marker"         => "Permanent Marker",
    "Petit Formal Script"      => "Petit Formal Script",
    "Petrona"                  => "Petrona",
    "Philosopher"              => "Philosopher",
    "Piedra"                   => "Piedra",
    "Pinyon Script"            => "Pinyon Script",
    "Pirata One"               => "Pirata One",
    "Plaster"                  => "Plaster",
    "Play"                     => "Play",
    "Playball"                 => "Playball",
    "Playfair Display"         => "Playfair Display",
    "Playfair Display SC"      => "Playfair Display SC",
    "Podkova"                  => "Podkova",
    "Poiret One"               => "Poiret One",
    "Poller One"               => "Poller One",
    "Poly"                     => "Poly",
    "Pompiere"                 => "Pompiere",
    "Pontano Sans"             => "Pontano Sans",
    "Port Lligat Sans"         => "Port Lligat Sans",
    "Port Lligat Slab"         => "Port Lligat Slab",
    "Prata"                    => "Prata",
    "Preahvihear"              => "Preahvihear",
    "Press Start 2P"           => "Press Start 2P",
    "Princess Sofia"           => "Princess Sofia",
    "Prociono"                 => "Prociono",
    "Prosto One"               => "Prosto One",
    "Puritan"                  => "Puritan",
    "Purple Purse"             => "Purple Purse",
    "Quando"                   => "Quando",
    "Quantico"                 => "Quantico",
    "Quattrocento"             => "Quattrocento",
    "Quattrocento Sans"        => "Quattrocento Sans",
    "Questrial"                => "Questrial",
    "Quicksand"                => "Quicksand",
    "Quintessential"           => "Quintessential",
    "Qwigley"                  => "Qwigley",
    "Racing Sans One"          => "Racing Sans One",
    "Radley"                   => "Radley",
    "Raleway"                  => "Raleway",
    "Raleway Dots"             => "Raleway Dots",
    "Rambla"                   => "Rambla",
    "Rammetto One"             => "Rammetto One",
    "Ranchers"                 => "Ranchers",
    "Rancho"                   => "Rancho",
    "Rationale"                => "Rationale",
    "Redressed"                => "Redressed",
    "Reenie Beanie"            => "Reenie Beanie",
    "Revalia"                  => "Revalia",
    "Ribeye"                   => "Ribeye",
    "Ribeye Marrow"            => "Ribeye Marrow",
    "Righteous"                => "Righteous",
    "Risque"                   => "Risque",
    "Roboto"                   => "Roboto",
    "Roboto Condensed"         => "Roboto Condensed",
    "Roboto Slab"              => "Roboto Slab",
    "Rochester"                => "Rochester",
    "Rock Salt"                => "Rock Salt",
    "Rokkitt"                  => "Rokkitt",
    "Romanesco"                => "Romanesco",
    "Ropa Sans"                => "Ropa Sans",
    "Rosario"                  => "Rosario",
    "Rosarivo"                 => "Rosarivo",
    "Rouge Script"             => "Rouge Script",
    "Ruda"                     => "Ruda",
    "Rufina"                   => "Rufina",
    "Ruge Boogie"              => "Ruge Boogie",
    "Ruluko"                   => "Ruluko",
    "Rum Raisin"               => "Rum Raisin",
    "Ruslan Display"           => "Ruslan Display",
    "Russo One"                => "Russo One",
    "Ruthie"                   => "Ruthie",
    "Rye"                      => "Rye",
    "Sacramento"               => "Sacramento",
    "Sail"                     => "Sail",
    "Salsa"                    => "Salsa",
    "Sanchez"                  => "Sanchez",
    "Sancreek"                 => "Sancreek",
    "Sansita One"              => "Sansita One",
    "Sarina"                   => "Sarina",
    "Satisfy"                  => "Satisfy",
    "Scada"                    => "Scada",
    "Schoolbell"               => "Schoolbell",
    "Seaweed Script"           => "Seaweed Script",
    "Sevillana"                => "Sevillana",
    "Seymour One"              => "Seymour One",
    "Shadows Into Light"       => "Shadows Into Light",
    "Shadows Into Light Two"   => "Shadows Into Light Two",
    "Shanti"                   => "Shanti",
    "Share"                    => "Share",
    "Share Tech"               => "Share Tech",
    "Share Tech Mono"          => "Share Tech Mono",
    "Shojumaru"                => "Shojumaru",
    "Short Stack"              => "Short Stack",
    "Siemreap"                 => "Siemreap",
    "Sigmar One"               => "Sigmar One",
    "Signika"                  => "Signika",
    "Signika Negative"         => "Signika Negative",
    "Simonetta"                => "Simonetta",
    "Sintony"                  => "Sintony",
    "Sirin Stencil"            => "Sirin Stencil",
    "Six Caps"                 => "Six Caps",
    "Skranji"                  => "Skranji",
    "Slackey"                  => "Slackey",
    "Smokum"                   => "Smokum",
    "Smythe"                   => "Smythe",
    "Sniglet"                  => "Sniglet",
    "Snippet"                  => "Snippet",
    "Snowburst One"            => "Snowburst One",
    "Sofadi One"               => "Sofadi One",
    "Sofia"                    => "Sofia",
    "Sonsie One"               => "Sonsie One",
    "Sorts Mill Goudy"         => "Sorts Mill Goudy",
    "Source Code Pro"          => "Source Code Pro",
    "Source Sans Pro"          => "Source Sans Pro",
    "Special Elite"            => "Special Elite",
    "Spicy Rice"               => "Spicy Rice",
    "Spinnaker"                => "Spinnaker",
    "Spirax"                   => "Spirax",
    "Squada One"               => "Squada One",
    "Stalemate"                => "Stalemate",
    "Stalinist One"            => "Stalinist One",
    "Stardos Stencil"          => "Stardos Stencil",
    "Stint Ultra Condensed"    => "Stint Ultra Condensed",
    "Stint Ultra Expanded"     => "Stint Ultra Expanded",
    "Stoke"                    => "Stoke",
    "Strait"                   => "Strait",
    "Sue Ellen Francisco"      => "Sue Ellen Francisco",
    "Sunshiney"                => "Sunshiney",
    "Supermercado One"         => "Supermercado One",
    "Suwannaphum"              => "Suwannaphum",
    "Swanky and Moo Moo"       => "Swanky and Moo Moo",
    "Syncopate"                => "Syncopate",
    "Tangerine"                => "Tangerine",
    "Taprom"                   => "Taprom",
    "Tauri"                    => "Tauri",
    "Telex"                    => "Telex",
    "Tenor Sans"               => "Tenor Sans",
    "Text Me One"              => "Text Me One",
    "The Girl Next Door"       => "The Girl Next Door",
    "Tienne"                   => "Tienne",
    "Tinos"                    => "Tinos",
    "Titan One"                => "Titan One",
    "Titillium Web"            => "Titillium Web",
    "Trade Winds"              => "Trade Winds",
    "Trocchi"                  => "Trocchi",
    "Trochut"                  => "Trochut",
    "Trykker"                  => "Trykker",
    "Tulpen One"               => "Tulpen One",
    "Ubuntu"                   => "Ubuntu",
    "Ubuntu Condensed"         => "Ubuntu Condensed",
    "Ubuntu Mono"              => "Ubuntu Mono",
    "Ultra"                    => "Ultra",
    "Uncial Antiqua"           => "Uncial Antiqua",
    "Underdog"                 => "Underdog",
    "Unica One"                => "Unica One",
    "UnifrakturCook"           => "UnifrakturCook",
    "UnifrakturMaguntia"       => "UnifrakturMaguntia",
    "Unkempt"                  => "Unkempt",
    "Unlock"                   => "Unlock",
    "Unna"                     => "Unna",
    "VT323"                    => "VT323",
    "Vampiro One"              => "Vampiro One",
    "Varela"                   => "Varela",
    "Varela Round"             => "Varela Round",
    "Vast Shadow"              => "Vast Shadow",
    "Vibur"                    => "Vibur",
    "Vidaloka"                 => "Vidaloka",
    "Viga"                     => "Viga",
    "Voces"                    => "Voces",
    "Volkhov"                  => "Volkhov",
    "Vollkorn"                 => "Vollkorn",
    "Voltaire"                 => "Voltaire",
    "Waiting for the Sunrise"  => "Waiting for the Sunrise",
    "Wallpoet"                 => "Wallpoet",
    "Walter Turncoat"          => "Walter Turncoat",
    "Warnes"                   => "Warnes",
    "Wellfleet"                => "Wellfleet",
    "Wendy One"                => "Wendy One",
    "Wire One"                 => "Wire One",
    "Yanone Kaffeesatz"        => "Yanone Kaffeesatz",
    "Yellowtail"               => "Yellowtail",
    "Yeseva One"               => "Yeseva One",
    "Yesteryear"               => "Yesteryear",
    "Zeyada"                   => "Zeyada"
);
$class_icon_box = time() . '-1-' . rand( 0, 100 );

vc_map(
	array(
		"name"                    => __( "Icon Box", "Aloxo" ),
		"base"                    => "icon_box",
		"custom_markup"           => "Aloxo",
		"icon"                    => "vc_icon_box",
		"class"                   => "icon_box",
		"category"                => __( 'Aloxo Shortcodes', "Aloxo" ),
		"description"             => "Adds icon box with font-awesome icons",
		"controls"                => "full",
		"show_settings_on_create" => true,
		"params"                  => array(
			// Icon Box Heading
			array(
				"type"        => "textfield",
				"class"       => "",
				"heading"     => __( "Title", "Aloxo" ),
				"param_name"  => "title",
				"admin_label" => true,
				"value"       => "This is an icon box.",
				"description" => __( "Provide the title for this icon box.", "Aloxo" ),
			),
			array(
				"type"       => "colorpicker",
				"class"      => "",
				"heading"    => __( "Color Title", "Aloxo" ),
				"param_name" => "color_title",
			),
			array(
				"type"        => "dropdown",
				"heading"     => __( "Size Heading", "Aloxo" ),
				"param_name"  => "size",
				"admin_label" => true,
				"value"       => array(__( "h2", "Aloxo" ) => "h2", __( "h3", "Aloxo" ) => "h3", __( "h4", "Aloxo" ) => "h4", __( "h5", "Aloxo" ) => "h5", __( "h6", "Aloxo" ) => "h6" ),
				"description" => __( "Select size heading.", "Aloxo" )
			),
			// array(
			// 	"type"        => "number",
			// 	"heading"     => __( "Margin Bottom", "Aloxo" ),
			// 	"param_name"  => "margin_bt_title",
			// 	"suffix"      => "px",
			// ),
			array(
				"type"        => "dropdown",
				"heading"     => __( "Font Heading", "Aloxo" ),
				"param_name"  => "icon_box_font_heading",
				"admin_label" => true,
				"value"       => array( __( "Default", "Aloxo" ) => "", __( "Custom", "Aloxo" ) => "custom" ),
				"description" => __( "Select Font heading.", "Aloxo" )
			),
			// array(
	  //           'type' => 'google_fonts',
	  //           'param_name' => 'google_fonts',
	  //           'value' => '',// Not recommended, this will override 'settings'. 'font_family:'.rawurlencode('Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic').'|font_style:'.rawurlencode('900 bold italic:900:italic'),
	  //           'settings' => array(
	  //               //'no_font_style' // Method 1: To disable font style
	  //               //'no_font_style'=>true // Method 2: To disable font style
	  //               'fields'=>array(
	  //                   'font_family'=>'Roboto:regular', //'Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',// Default font family and all available styles to fetch
	  //                   'font_style'=>'400 regular:400:normal', // Default font style. Name:weight:style, example: "800 bold regular:800:normal"
	  //                   'font_family_description' => __('Select font family.','js_composer'),
	  //                   'font_style_description' => __('Select font styling.','js_composer')
	  //               )
	  //           ),
	  //          // 'description' => __( '', 'js_composer' ),
	  //       ),
			
			array(
				"type"        => "dropdown",
				"heading"     => __( "Custom Font Family", "Aloxo" ),
				"param_name"  => "icon_box_font_family",
				"admin_label" => true,
				"value"       => $google_fonts,
				"description" => __( "Select Font.", "Aloxo" ),
				"dependency"  => Array( 'element' => "icon_box_font_heading", 'value' => array( 'custom' ) )
			),
			array(
				"type"        => "number",
				"heading"     => __( "Font Size", "Aloxo" ),
				"param_name"  => "custom_font_size",
				"value"       => 0,
				"min"         => 0,
				"max"         => 100,
				"suffix"      => "px",
				"description" => __( "custom font size", "Aloxo" ),
				"dependency"  => Array( 'element' => "icon_box_font_heading", 'value' => array( 'custom' ) )
			),
			array(
				"type"        => "dropdown",
				"heading"     => __( "Custom Font Weight", "Aloxo" ),
				"param_name"  => "custom_font_weight",
				"admin_label" => true,
				"value"       => array(
					__( "Normal", "Aloxo" ) => "normal",
					__( "Bold", "Aloxo" )   => "bold",
					__( "100", "Aloxo" )    => "100",
					__( "200", "Aloxo" )    => "200",
					__( "300", "Aloxo" )    => "300",
					__( "400", "Aloxo" )    => "400",
					__( "500", "Aloxo" )    => "500",
					__( "600", "Aloxo" )    => "600",
					__( "700", "Aloxo" )    => "700",
					__( "800", "Aloxo" )    => "800",
					__( "900", "Aloxo" )    => "900",
				),
				"description" => __( "Select Custom Font Weight", "Aloxo" ),
				"dependency"  => Array( 'element' => "icon_box_font_heading", 'value' => array( 'custom' ) )
			),
			array(
				"type"        => "dropdown",
				"heading"     => __( "Custom Font Style", "Aloxo" ),
				"param_name"  => "custom_font_style",
				"admin_label" => true,
				"value"       => array(
					__( "inherit", "Aloxo" ) => "inherit",
					__( "initial", "Aloxo" ) => "initial",
					__( "italic", "Aloxo" )  => "italic",
					__( "normal", "Aloxo" )  => "normal",
					__( "oblique", "Aloxo" ) => "oblique",
				),
				"description" => __( "Select Custom Font Style", "Aloxo" ),
				"dependency"  => Array( 'element' => "icon_box_font_heading", 'value' => array( 'custom' ) )
			),
			array(
				"type"        => "number",
				"heading"     => __( "Margin Bottom", "aloxo" ),
				"param_name"  => "mg_bottom",
				"value"       => 0,
				"min"         => 0,
				"max"         => 100,
				"suffix"      => "px",
  				"description" => __( "Select Font heading.", "aloxo" ),
				"dependency"  => Array( 'element' => "icon_box_font_heading", 'value' => array( 'custom' ) )
			),
			// Heading Style
			array(
				"type"       => "radioimage",
				"class"      => "style_header_select",
				"heading"    => __( "Heading Style:", "Aloxo" ),
				"param_name" => "heading_style",
				"options"    => array(
					"heading_style1" => get_template_directory_uri() . '/images/admin/icon-box/heading-style1.jpg',
					"heading_style2" => get_template_directory_uri() . '/images/admin/icon-box/heading-style2.jpg',
					"heading_style3" => get_template_directory_uri() . '/images/admin/icon-box/heading-style3.jpg',
					"heading_style4" => get_template_directory_uri() . '/images/admin/icon-box/heading-style4.jpg',
				),
				"value"      => "heading_style1",
			),
			array(
				"type"        => "textarea_html",
				"class"       => "",
				"heading"     => __( "Description", "Aloxo" ),
				"param_name"  => "content",
				"value"       => "Write a short description, that will describe the title or something informational and useful.",
				"description" => __( "Provide the description for this icon box.", "Aloxo" )
			),
			array(
				"type"       => "colorpicker",
				"heading"    => __( "Color Description", "Aloxo" ),
				"param_name" => "color_description",
			),
			// Add link to existing content or to another resource
			array(
				"type"        => "vc_link",
				"class"       => "",
				"heading"     => __( "Add Link", "Aloxo" ),
				"param_name"  => "link",
				"value"       => "",
				"description" => __( "Provide the link that will be applied to this icon box.", "Aloxo" )
			),
			// Select link option - to box or with read more text
			array(
				"type"        => "dropdown",
				"class"       => "",
				"heading"     => __( "Apply link to:", "Aloxo" ),
				"param_name"  => "read_more",
				"value"       => array(
					"Complete Box"      => "",
					"Box Title"         => "title",
					"Display Read More" => "more",
				),
				"description" => __( "Select whether to use color for icon or not.", "Aloxo" )
			),
			// Link to traditional read more
			array(
				"type"        => "textfield",
				"class"       => "",
				"heading"     => __( "Read More Text", "Aloxo" ),
				"param_name"  => "read_text",
				"value"       => "Read More",
				"description" => __( "Customize the read more text.", "Aloxo" ),
				"dependency"  => Array( "element" => "read_more", "value" => array( "more" ) ),
			),
			array(
				"type"        => "colorpicker",
				"class"       => "",
				"heading"     => __( "Border Color Read More Text:", "Aloxo" ),
				"param_name"  => "border_read_more_text",
				"description" => __( "Select whether to use border color for Read More Text or none.", "Aloxo" ),
				"dependency"  => Array( "element" => "read_more", "value" => array( "more" ) ),
			),
			array(
				"type"        => "colorpicker",
				"class"       => "",
				"heading"     => __( "Background Color Read More Text:", "Aloxo" ),
				"param_name"  => "bg_read_more_text",
				"description" => __( "Select whether to use background color for Read More Text or default.", "Aloxo" ),
				"dependency"  => Array( "element" => "read_more", "value" => array( "more" ) ),
			),
			array(
				"type"        => "colorpicker",
				"class"       => "",
				"heading"     => __( "Background Hover Color Read More Text:", "Aloxo" ),
				"param_name"  => "bg_read_more_text_hover",
				"description" => __( "Select whether to use background color when hover Read More Text or default.", "Aloxo" ),
				"dependency"  => Array( "element" => "read_more", "value" => array( "more" ) ),
			),
			array(
				"type"        => "colorpicker",
				"class"       => "",
				"heading"     => __( "Text Color Read More Text:", "Aloxo" ),
				"param_name"  => "read_more_text_color",
				"value"       => "#fff",
				"description" => __( "Select whether to use text color for Read More Text or default.", "Aloxo" ),
				"dependency"  => Array( "element" => "read_more", "value" => array( "more" ) ),
			),
			// Play with icon selector
			array(
				"type"        => "dropdown",
				"class"       => "",
				"heading"     => __( "Icon to display:", "Aloxo" ),
				"param_name"  => "icon_type",
				"value"       => array(
					"Font Awesome Icon" => "font-awesome",
					"Custom Image Icon" => "custom",
				),
				"description" => __( "Select which icon you would like to use", "Aloxo" )
			),
			// Play with icon selector
			array(
				"type"        => "icon",
				"class"       => "",
				"heading"     => __( "Select Icon:", "Aloxo" ),
				"param_name"  => "icon",
				"admin_label" => true,
				"value"       => "android",
				"description" => __( "Select the icon from the list.", "Aloxo" ),
				"dependency"  => Array( "element" => "icon_type", "value" => array( "font-awesome" ) ),
			),


			// Play with icon selector
			array(
				"type"        => "attach_image",
				"class"       => "",
				"heading"     => __( "Upload Image Icon:", "Aloxo" ),
				"param_name"  => "icon_img",
				"admin_label" => true,
				"value"       => "",
				"description" => __( "Upload the custom image icon.", "Aloxo" ),
				"dependency"  => Array( "element" => "icon_type", "value" => array( "custom" ) ),
			),
			// Resize the icon
			array(
				"type"        => "number",
				"class"       => "",
				"heading"     => __( "Icon Font Size ", "Aloxo" ),
				"param_name"  => "icon_size",
				"value"       => 32,
				"min"         => 16,
				"max"         => 100,
				"suffix"      => "px",
				"description" => __( "Select the icon font size.", "Aloxo" ),
				"dependency"  => Array( "element" => "icon_type", "value" => array( "font-awesome" ) ),
			),
			array(
				"type"        => "number",
				"class"       => "",
				"heading"     => __( "Width Images", "Aloxo" ),
				"param_name"  => "width_images",
				//"value"       => 32,
				// "min"         => 16,
				// "max"         => 500,
				"suffix"      => "px",
				"description" => __( "Select width images. Leave empty for using original size", "Aloxo" ),
				"dependency"  => Array( "element" => "icon_type", "value" => array( "custom" ) ),
			),
			array(
				"type"        => "number",
				"class"       => "",
				"heading"     => __( "Height Images", "Aloxo" ),
				"param_name"  => "height_images",
				//"value"       => 32,
				// "min"         => 16,
				// "max"         => 500,
				"suffix"      => "px",
				"description" => __( "Select Height Images. Leave empty for using original size", "Aloxo" ),
				"dependency"  => Array( "element" => "icon_type", "value" => array( "custom" ) ),
			),
			// // Resize the icon
			array(
				"type"       => "number",
				"class"      => "",
				"heading"    => __( "Width Box Icon (px)", "Aloxo" ),
				"param_name" => "width_box_font_awesome",
				"value"      => 70,
				"min"        => 0,
				"suffix"     => "px",
				"dependency" => Array( "element" => "icon_type", "value" => array( "font-awesome" ) ),
			),
			// array(
			// 	"type"       => "number",
			// 	"class"      => "",
			// 	"heading"    => __( "Margin bottom Icon", "Aloxo" ),
			// 	"param_name" => "margin_bt_icon",
			// 	"suffix"     => "px",
			// ),
			// Resize the icon
			// array(
			// 	"type"       => "dropdown",
			// 	"class"      => "",
			// 	"heading"    => __( "Width Box Icon", "Aloxo" ),
			// 	"param_name" => "width_box_icon",
			// 	"value"      => array(
			// 		"Full Width"  => "full",
			// 		"Custom Size" => "custom",
			// 	),
			// 	"dependency" => Array( "element" => "icon_type", "value" => array( "custom" ) ),
			// ),
			// array(
			// 	"type"       => "number",
			// 	"class"      => "",
			// 	"heading"    => __( "Width Box Icon (px)", "Aloxo" ),
			// 	"param_name" => "custom_width_box_icon",
			// 	"value"      => 150,
			// 	"min"        => 0,
			// 	"suffix"     => "px",
			// 	"dependency" => Array( "element" => "width_box_icon", "value" => array( "custom" ) ),
			// ),
			// array(
			// 	"type"       => "number",
			// 	"class"      => "",
			// 	"heading"    => __( "Height Box Icon (px)", "Aloxo" ),
			// 	"param_name" => "custom_height_box_icon",
			// 	"value"      => 150,
			// 	"min"        => 0,
			// 	"suffix"     => "px",
			// 	"dependency" => Array( "element" => "width_box_icon", "value" => array( "custom" ) ),
			// ),
			// Icon color - default or customize
			array(
				"type"        => "dropdown",
				"class"       => "",
				"heading"     => __( "Icon Color:", "Aloxo" ),
				"param_name"  => "color",
				"value"       => array( __( "Use Default", "Aloxo" ) => "none", __( "Custom Color", "Aloxo" ) => "custom" ),
				"description" => __( "Select whether to use color for icon or not.", "Aloxo" ),
				"dependency"  => Array( "element" => "icon_type", "value" => array( "font-awesome" ) ),
			),
			// Customize Icon Color
			array(
				"type"        => "colorpicker",
				"class"       => "",
				"heading"     => __( "Select Icon Color:", "Aloxo" ),
				"param_name"  => "icon_color",
				"value"       => "#fe4444",
				"description" => __( "Select the icon color.", "Aloxo" ),
				"dependency"  => Array( 'element' => "color", 'value' => array( 'custom' ) )
			),

			array(
				"type"       => "dropdown",
				"heading"    => __( "Layout", "Aloxo" ),
				"param_name" => "icon_style",
				"std"        => "style1",
				"value"      => array(
					__( "Layout 01", "Aloxo" ) => "style1",
					__( "Layout 02", "Aloxo" ) => "style2",
					__( "Layout 03", "Aloxo" ) => "style3",
					__( "Layout 04", "Aloxo" ) => "style4",
				)
			),

			// Images Preview
			array(
				"type"       => "preview",
				"heading"    => __( "Preview Layout", "Aloxo" ),
				"param_name" => "preview_style1",
				"value"      => get_template_directory_uri() . '/images/admin/icon-box/layout-01.jpg',
				"dependency" => Array( 'element' => "icon_style", 'value' => array( 'style1' ) )
			),
			array(
				"type"       => "preview",
				"heading"    => __( "Preview Layout", "Aloxo" ),
				"param_name" => "preview_style2",
				"value"      => get_template_directory_uri() . '/images/admin/icon-box/layout-02.jpg',
				"dependency" => Array( 'element' => "icon_style", 'value' => array( 'style2' ) )
			),

			array(
				"type"       => "preview",
				"heading"    => __( "Preview Layout", "Aloxo" ),
				"param_name" => "preview_style3",
				"value"      => get_template_directory_uri() . '/images/admin/icon-box/layout-03.jpg',
				"dependency" => Array( 'element' => "icon_style", 'value' => array( 'style3' ) )
			),
			array(
				"type"       => "preview",
				"heading"    => __( "Preview Layout", "Aloxo" ),
				"param_name" => "preview_style4",
				"value"      => get_template_directory_uri() . '/images/admin/icon-box/layout-04.jpg',
				"dependency" => Array( 'element' => "icon_style", 'value' => array( 'style4' ) )
			),
			array(
				"type"       => "preview",
				"heading"    => __( "Preview Layout", "Aloxo" ),
				"param_name" => "preview_style5",
				"value"      => get_template_directory_uri() . '/images/admin/icon-box/layout-05.jpg',
				"dependency" => Array( 'element' => "icon_style", 'value' => array( 'style5' ) )
			),
			array(
				"type"       => "preview",
				"heading"    => __( "Preview Layout", "Aloxo" ),
				"param_name" => "preview_style6",
				"value"      => get_template_directory_uri() . '/images/admin/icon-box/layout-06.jpg',
				"dependency" => Array( 'element' => "icon_style", 'value' => array( 'style6' ) )
			),
			array(
				"type"       => "preview",
				"heading"    => __( "Preview Layout", "Aloxo" ),
				"param_name" => "preview_style7",
				"value"      => get_template_directory_uri() . '/images/admin/icon-box/layout-07.jpg',
				"dependency" => Array( 'element' => "icon_style", 'value' => array( 'style7' ) )
			),
			array(
				"type"       => "radioimage",
				"class"      => "",
				"heading"    => __( "Select Box icon style", "Aloxo" ),
				"param_name" => "box_icon_style",
				"options"    => array(
					"circle"       => get_template_directory_uri() . '/images/admin/icon-box/box_icon_01.jpg',
					"square"       => get_template_directory_uri() . '/images/admin/icon-box/box_icon_02.jpg',
					"square_arrow" => get_template_directory_uri() . '/images/admin/icon-box/box_icon_03.jpg',
				),
				"std"        => "circle",
				"dependency" => Array( 'element' => "icon_style", 'value' => array( 'style1' ) )

			),
			// Play with icon selector
			array(
				"type"        => "attach_image",
				"class"       => "",
				"heading"     => __( "Upload Background Image", "Aloxo" ),
				"param_name"  => "bg_images",
				"admin_label" => true,
				"value"       => "",
				"description" => __( "Upload the background image.", "Aloxo" ),
				"dependency"  => Array( "element" => "icon_style", "value" => array( "style5",'style6') ),
			),
//			array(
//				'type'       => 'checkbox',
//				'heading'    => __( 'Hide desctiption hover', 'Aloxo' ),
//				'param_name' => 'hide_des_hover',
//				'value'      => array( __( 'Yes, please', 'Aloxo' ) => true ),
//				"dependency" => Array( "element" => "icon_style", "value" => array( "style5" ) ),
//			),
			array(
				"type"       => "number",
				"class"      => "",
				"heading"    => __( "Width Background Image (px)", "Aloxo" ),
				"param_name" => "custom_width_bg_images",
				"value"      => 150,
				"min"        => 0,
				"suffix"     => "px",
				"dependency" => Array( "element" => "icon_style", "value" => array( 'style5','style6') ),
			),
			array(
				"type"       => "number",
				"class"      => "",
				"heading"    => __( "Height Background Image (px)", "Aloxo" ),
				"param_name" => "custom_height_bg_images",
				"value"      => 150,
				"min"        => 0,
				"suffix"     => "px",
				"dependency" => Array( "element" => "icon_style", "value" => array( 'style5', 'style6' ) ),
			),
			//Position the icon box
			array(
				"type"        => "dropdown",
				"class"       => "",
				"heading"     => __( "Box Style:", "Aloxo" ),
				"param_name"  => "pos",
				"value"       => array(
					"Icon at Left"  => "left",
					"Icon at middle Left"  => "left-middle",
					"Icon at Right" => "right",
					"Icon at middle Right" => "right-middle",
					"Icon at Top"   => "top"
				),
				"description" => __( "Select icon position. Icon box style will be changed according to the icon position.", "Aloxo" ),
				"dependency"  => Array( 'element' => "icon_style", 'value' => array( 'style1' ) )
			),
			array(
				"type"       => "number",
				"class"      => "",
				"heading"    => __( "Margin Right Icon", "Aloxo" ),
				"param_name" => "margin_r_icon",
				"suffix"     => "px",
				"dependency" => Array( "element" => "pos", "value" => array( "left", "left-middle" ) ),
			),
			array(
				"type"       => "number",
				"class"      => "",
				"heading"    => __( "Margin Left Icon", "Aloxo" ),
				"param_name" => "margin_l_icon",
				"suffix"     => "px",
				"dependency" => Array( "element" => "pos", "value" => array( "right-middle", "right" ) ),
			),
			array(
				"type"       => "dropdown",
				"class"      => "",
				"heading"    => __( "Text Align Shortcode:", "Aloxo" ),
				"param_name" => "text_align_sc",
				"value"      => array(
					"Text Left"   => "text_left",
					"Text Right"  => "text_right",
					"Text Center" => "text_center"
				)
			),
			array(
				"type"       => "dropdown",
				"class"      => "",
				"heading"    => __( "Icon Hover Effects", "Aloxo" ),
				"param_name" => "icon_effect",
				"std"        => "",
				"value"      => array(
					__( "None", "Aloxo" )     => "",
					__( "BounceIn", "Aloxo" ) => "bounceIn",
//					__( "Zoom In", "Aloxo" )    => "effects_zoom_in",
//					__( "Zoom Out", "Aloxo" )   => "effects_zoom_out",
				),
			),
			// before groupp color <div>
			array(
				"type"       => "custom_before",
				"heading"    => __( "Config Color", "Aloxo" ),
				"param_name" => "custom_before",
			),

			array(
				"type"        => "colorpicker",
				"heading"     => __( "Background Header:", "Aloxo" ),
				"param_name"  => "icon_bg_header",
				"value"       => "",
				"description" => __( "Select the color for icon header.", "Aloxo" ),
				"dependency"  => Array( 'element' => "icon_style", 'value' => array( 'style4' ) )
			),
			array(
				"type"        => "colorpicker",
				"heading"     => __( "Icon Border Color:", "Aloxo" ),
				"param_name"  => "icon_border_color",
				"value"       => "",
				"description" => __( "Select the color for icon border.", "Aloxo" ),
				"dependency"  => Array( 'element' => "icon_style", 'value' => array( 'style1', 'style2', 'style3', 'style4' ) )
			),
			// Give some background to icon
			array(
				"type"        => "colorpicker",
				"heading"     => __( "Icon Background Color:", "Aloxo" ),
				"param_name"  => "icon_bg_color",
				"value"       => "",
				"description" => __( "Select the color for icon background.", "Aloxo" ),
				"dependency"  => Array( 'element' => "icon_style", 'value' => array( 'style1', 'style2', 'style3', 'style4' ) )
			),

			array(
				"type"        => "colorpicker",
				"heading"     => __( "Background Color Shortcode", "Aloxo" ),
				"param_name"  => "bg_shortcode",
				"value"       => "",
				"description" => __( "Select the color for shortcode background.", "Aloxo" ),
				"dependency"  => Array( 'element' => "icon_style", 'value' => array( 'style2', 'style4', 'style5', 'style6' ) )
			),

			array(
				"type"        => "colorpicker",
				"heading"     => __( "Hover Icon Color:", "Aloxo" ),
				"param_name"  => "icon_hover_color",
				"value"       => "",
				"description" => __( "Select the color hover for icon.", "Aloxo" ),
				"dependency"  => Array( 'element' => "icon_style", 'value' => array( 'style1', 'style2', 'style3', 'style4', 'style5') )
			),
			array(
				"type"        => "colorpicker",
				"heading"     => __( "Hover Icon Border Color:", "Aloxo" ),
				"param_name"  => "icon_border_color_hover",
				"value"       => "",
				"description" => __( "Select the color hover for icon border.", "Aloxo" ),
				"dependency"  => Array( 'element' => "icon_style", 'value' => array( 'style1', 'style2', 'style3', 'style4' ) )
			),
			// Give some background to icon
			array(
				"type"        => "colorpicker",
				"heading"     => __( "Background Color Shortcode Hover", "Aloxo" ),
				"param_name"  => "bg_shortcode_hover",
				"value"       => "",
				"description" => __( "Select the color for shortcode background.", "Aloxo" ),
				"dependency"  => Array( 'element' => "icon_style", 'value' => array( 'style5', 'style6' ) )
			),
			array(
				"type"        => "colorpicker",
				"heading"     => __( "Hover Icon Background Color:", "Aloxo" ),
				"param_name"  => "icon_bg_color_hover",
				"value"       => "",
				"description" => __( "Select the color hover for icon background header.", "Aloxo" ),
				"dependency"  => Array( 'element' => "icon_style", 'value' => array( 'style1', 'style2', 'style3', 'style4' ) )
			),

			// after groupp color </div>
			array(
				"type"       => "custom_after",
				"param_name" => "custom_after",
			),


			$add_css_animation,
			// Customize everything
			array(
				"type"        => "textfield",
				"class"       => "",
				"heading"     => __( "Extra Class", "Aloxo" ),
				"param_name"  => "el_class",
				"value"       => "",
				"description" => __( "Add extra class name that will be applied to the icon box, and you can use this class for your customizations.", "Aloxo" ),
			), 
			// array(
			// 	"type"       => "textfield",
			// 	"class"      => "hidden",
			// 	"heading"    => __( "", "Aloxo" ),
			// 	"param_name" => "class_icon_box",
			// 	"value"      => $class_icon_box,
			// ),
		) // end params array
	) // end vc_map array
); // end vc_map

/////////////////////////////////////
/////// Posts Display
////////////////////////////////////
vc_map( array(
	"name"     => __( "Posts Display", "aloxo" ),
	"base"     => "posts_display",
	"class"    => "",
	"icon"     => "icon-wpb-icon_posts_display",
	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params"   => array(
		array(
			"type"       => "textfield",
			"holder"     => "div",
			"class"      => "",
			"heading"    => __( "Heading Text", "aloxo" ),
			"param_name" => "title",
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Size Heading", "aloxo" ),
			"param_name"  => "size",
			"admin_label" => true,
			"value"       => array( __( "h1", "aloxo" ) => "h1", __( "h2", "aloxo" ) => "h2", __( "h3", "aloxo" ) => "h3", __( "h4", "aloxo" ) => "h4", __( "h5", "aloxo" ) => "h5", __( "h6", "aloxo" ) => "h6" ),
			"description" => __( "Select size heading.", "aloxo" )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Heading Style", "aloxo" ),
			"param_name"  => "heading_style",
			"admin_label" => true,
			"value"       => array( __( "Default", "aloxo" ) => "df", 
									__( "Style-01", "aloxo" ) => "style-01", 
									__( "Style-02", "aloxo" ) => "style-02" ,
									__( "Style-03", "aloxo" ) => "style-03" ,
									//__( "Style-04", "aloxo" ) => "style-04" ,
							),
		),
		array(
			"type"       => "textfield",
			"heading"    => __( "Right Heading Text", "aloxo" ),
			"param_name" => "right_heading_text",
			"dependency"  => Array( 'element' => "heading_style", 'value' => array( 'style-02' ) )
		),
		array(
			"type"       => "textfield",
			"heading"    => __( "Right Heading Link", "aloxo" ),
			"param_name" => "right_heading_link",
			"dependency"  => Array( 'element' => "heading_style", 'value' => array( 'style-02') )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Layout", "aloxo" ),
			"param_name"  => "layout",
			"admin_label" => true,
			"value"       => array( __( "Layout-01", "aloxo" ) => "layout-01", __( "Layout-02", "aloxo" ) => "layout-02", __( "Layout-03", "aloxo" ) => "layout-03" ),
			//"description" => __( "Select style heading.", "aloxo" )
		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Number Posts", "aloxo" ),
			"param_name"  => "number_posts",
			"value"       => __( "4", "aloxo" ),
			"description" => __( "Number Posts", "aloxo" ),
		),
		// array(
		// 	"type"       => "textfield",
		// 	"holder"     => "div",
		// 	"class"      => "4",
		// 	"heading"    => __( "Column", "aloxo" ),
		// 	"param_name" => "column",
		// 	"value"      => __( 1, "aloxo" )
		// ),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Column", "aloxo" ),
			"param_name"  => "column",
			"admin_label" => true,
			"value"       => array( __( "1", "aloxo" ) => "1", 
									__( "2", "aloxo" ) => "2", 
									__( "3", "aloxo" ) => "3", 
									__( "4", "aloxo" ) => "4" ,
									__( "5", "aloxo" ) => "5" ,
									__( "6", "aloxo" ) => "6" ,
							),
			"dependency"  => Array( 'element' => "layout", 'value' => array( 'layout-01','layout-02' ) )
			//"description" => __( "Select Orderby.", "aloxo" )
		),

		array(
			"type"       => "textfield",
			"holder"     => "div",
			"class"      => "4",
			"heading"    => __( "Content Length Excerpt Words", "aloxo" ),
			"param_name" => "excerpt_words",
			"value"      => __( 6, "aloxo" ),
			"dependency"  => Array( 'element' => "layout", 'value' => array( 'layout-02' ) )
		),
		// array(
		// 	"type"        => "textfield",
		// 	"heading"     => __( "Category Slug", "aloxo" ),
		// 	"param_name"  => "exclude_cats",
		// 	"value"       => __( "", "aloxo" ),
		// 	"description" => __( "", "aloxo" ),
		// ),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Select Category", "aloxo" ),
			"param_name"  => "cats",
			"value"       => $cate,
			"description" => __( "", "aloxo" ),
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Order by", "aloxo" ),
			"param_name"  => "orderby",
			"admin_label" => true,
			"value"       => array( __( "Date", "aloxo" ) => "date", 
									__( "Title", "aloxo" ) => "title", 
									__( "Comment", "aloxo" ) => "comment", 
									__( "Random", "aloxo" ) => "random" ),
			"description" => __( "Select Orderby.", "aloxo" )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Order", "aloxo" ),
			"param_name"  => "order",
			"admin_label" => true,
			"value"       => array( __( "ASC", "aloxo" ) => "asc", 
									__( "DESC", "aloxo" ) => "desc"),
			"description" => __( "Select Order.", "aloxo" )
		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Extra class name", "aloxo" ),
			"param_name"  => "el_class",
			"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "aloxo" ),
		)

	)
) );


/////////////////////////////////////
/////// counter_box
////////////////////////////////////
vc_map( array(
	"name"     => __( "Counter Box", "aloxo" ),
	"base"     => "counters_box",
	"class"    => "",
	"icon"     => "icon-wpb-icon_counter_box",
	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params"   => array(
		array(
			"type"       => "textfield",
			"holder"     => "div",
			"class"      => "",
			"heading"    => __( "Counters Label", "aloxo" ),
			"param_name" => "counters_label",
		),
		array(
			"type"       => "textfield",
			"holder"     => "div",
			"class"      => "",
			"heading"    => __( "Counters Value", "aloxo" ),
			"param_name" => "counters_value",
		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Extra class name", "aloxo" ),
			"param_name"  => "el_class",
			"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "aloxo" ),
		)

	)
) );
/////////////////////////////////////
/////// Social Link
////////////////////////////////////

vc_map( array(
	"name"     => __( "Social Link", "aloxo" ),
	"base"     => "social_link",
	"class"    => "",
	"icon"     => "icon-wpb-icon_social_link",
	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params"   => array(
		array(
			"type"        => "dropdown",
			"heading"     => __( "Style", "aloxo" ),
			"param_name"  => "style",
			"admin_label" => true,
			"value"       => array( 
								__( "Style 01", "aloxo" ) => "style-01",
								__( "Style 02", "aloxo" ) => "style-02"),
		),
		array(
			"type"       => "textfield",
			"heading"    => __( "Link Face", "aloxo" ),
			"param_name" => "link_face",
			"value"      => __( "", "aloxo" ),
		),
		array(
			"type"       => "textfield",
			"heading"    => __( "Link Twitter", "aloxo" ),
			"param_name" => "link_twitter",
			"value"      => __( "", "aloxo" ),
		),
		array(
			"type"       => "textfield",
			"heading"    => __( "Link Pinterest", "aloxo" ),
			"param_name" => "link_pinterest",
			"value"      => __( "", "aloxo" ),
		),
		array(
			"type"       => "textfield",
			"heading"    => __( "Link Google", "aloxo" ),
			"param_name" => "link_google",
			"value"      => __( "", "aloxo" ),
		),
		array(
			"type"       => "textfield",
			"heading"    => __( "Link Dribble", "aloxo" ),
			"param_name" => "link_dribble",
			"value"      => __( "", "aloxo" ),
		),
		array(
			"type"       => "textfield",
			"heading"    => __( "Link Linkedin", "aloxo" ),
			"param_name" => "link_linkedin",
			"value"      => __( "", "aloxo" ),
		),
		array(
			"type"       => "textfield",
			"heading"    => __( "Link Digg", "aloxo" ),
			"param_name" => "link_digg",
			"value"      => __( "", "aloxo" ),
		),
		array(
			"type"       => "textfield",
			"heading"    => __( "Link Youtube", "aloxo" ),
			"param_name" => "link_youtube",
			"value"      => __( "", "aloxo" ),
		),
	)
) );

/////////////////////////////////////
///////best sellers
////////////////////////////////////
vc_map( array(
	"name"     => __( "Best Sellers", 'aloxo' ),
	"base"     => "best_seller_products",
	"class"    => "",
	"icon"     => "icon-wpb-icon_best_seller_products",
	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params"   => array(
		array(
			"type"       => "textfield",
			'heading'    => __( 'Title', 'aloxo' ),
			"param_name" => "title",
			"value"      => __( "Best Sellers", "aloxo" )
		),
//		array(
//			"type"        => "dropdown",
//			"heading"     => __( "Style", "aloxo" ),
//			"param_name"  => "style",
//			"admin_label" => true,
//			"value"       => array( __( "Default", "aloxo" ) => "default",__( "Style 01", "aloxo" ) => "style1", __( "Style 02", "aloxo" ) => "style2", __( "Style 03", "aloxo" ) => "style3"),
//		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Number Posts", "aloxo" ),
			"param_name"  => "number_posts",
			"value"       => __( "4", "aloxo" ),
			"description" => __( "Number Posts", "aloxo" ),
		), array(
			"type"        => "dropdown",
			"heading"     => __( "Layout", "aloxo" ),
			"param_name"  => "layout",
			"admin_label" => true,
			"value"       => array( __( "Slider", "aloxo" ) => "slider", __( "Lists", "aloxo" ) => "lists" ),
			"description" => __( "Select Layout.", "aloxo" )
		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Column", "aloxo" ),
			"param_name"  => "column",
			"value"       => __( "4", "aloxo" ),
			"description" => __( "Column", "aloxo" ),
			"dependency"  => Array( "element" => "layout", "value" => array( "lists" ) ),

		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Extra class name", "aloxo" ),
			"param_name"  => "el_class",
			"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "aloxo" ),
		)

	)
) );

/////////////////////////////////////
///////best sellers
////////////////////////////////////
vc_map( array(
	"name"     => __( "Top Product", 'aloxo' ),
	"base"     => "top_products",
	"class"    => "",
	"icon"     => "icon-wpb-icon_best_seller_products",
	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params"   => array(
		array(
			"type"       => "textfield",
			'heading'    => __( 'Title', 'aloxo' ),
			"param_name" => "title",
			"value"      => __( "Best Sellers", "aloxo" )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Type", "aloxo" ),
			"param_name"  => "type",
			"admin_label" => true,
			"value"       => array( __( "Feature", "aloxo" ) => "feature",__( "Recent", "aloxo" ) => "recent", __( "Best Seller", "aloxo" ) => "bets_seller"),
		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Number Posts", "aloxo" ),
			"param_name"  => "number_posts",
			"value"       => __( "4", "aloxo" ),
			"description" => __( "Number Posts", "aloxo" ),
		), array(
			"type"        => "dropdown",
			"heading"     => __( "Layout", "aloxo" ),
			"param_name"  => "layout",
			"admin_label" => true,
			"value"       => array( __( "Slider", "aloxo" ) => "slider", __( "Lists", "aloxo" ) => "lists" ),
			"description" => __( "Select Layout.", "aloxo" )
		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Column", "aloxo" ),
			"param_name"  => "column",
			"value"       => __( "4", "aloxo" ),
			"description" => __( "Column", "aloxo" ),
			"dependency"  => Array( "element" => "layout", "value" => array( "lists" ) ),

		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Extra class name", "aloxo" ),
			"param_name"  => "el_class",
			"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "aloxo" ),
		)

	)
) );
/////////////////////////////////////
/////// wc_top_rated
////////////////////////////////////
vc_map( array(
	"name"     => __( "Top Rated Products", 'aloxo' ),
	"base"     => "wc_top_rated",
	"class"    => "",
	"icon"     => "icon-wpb-icon_best_seller_products",
	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params"   => array(
		array(
			"type"       => "textfield",
			'heading'    => __( 'Title', 'aloxo' ),
			"param_name" => "title",
			"value"      => __( "Top Rated Products", "aloxo" )
		),
//		array(
//			"type"        => "dropdown",
//			"heading"     => __( "Style", "aloxo" ),
//			"param_name"  => "style",
//			"admin_label" => true,
//			"value"       => array( __( "Default", "aloxo" ) => "default",__( "Style 01", "aloxo" ) => "style1", __( "Style 02", "aloxo" ) => "style2", __( "Style 03", "aloxo" ) => "style3"),
//		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Number Posts", "aloxo" ),
			"param_name"  => "number",
			"value"       => __( "4", "aloxo" ),
			"description" => __( "Number Posts", "aloxo" ),
		), array(
			"type"        => "dropdown",
			"heading"     => __( "Layout", "aloxo" ),
			"param_name"  => "layout",
			"admin_label" => true,
			"value"       => array( __( "Slider", "aloxo" ) => "slider", __( "Lists", "aloxo" ) => "lists" ),
			"description" => __( "Select Layout.", "aloxo" )
		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Column", "aloxo" ),
			"param_name"  => "column",
			"value"       => __( "4", "aloxo" ),
			"description" => __( "Column", "aloxo" ),
			"dependency"  => Array( "element" => "layout", "value" => array( "lists" ) ),

		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Extra class name", "aloxo" ),
			"param_name"  => "el_class",
			"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "aloxo" ),
		)

	)
) );

//WooCommerce Products
vc_map( array(
	'name'     => __( 'Products','aloxo'),
	'base'     => 'wc_products',
	'icon'     => 'icon-wpb-wp',
	'category' => __( 'Aloxo Shortcodes', 'aloxo' ),
	'params'   => array(
		array(
			'type'       => 'textfield',
			'heading'    => __( 'Title', 'aloxo' ),
			'param_name' => 'title',
			'std'        => __( 'Products', 'aloxo' ),
		),
//		array(
//			"type"        => "dropdown",
//			"heading"     => __( "Style", "aloxo" ),
//			"param_name"  => "style",
//			"admin_label" => true,
//			"value"       => array( __( "Default", "aloxo" ) => "default",__( "Style 01", "aloxo" ) => "style1", __( "Style 02", "aloxo" ) => "style2", __( "Style 03", "aloxo" ) => "style3"),
//		),
		array(
			'type'       => 'textfield',
			'heading'    => __( 'Number of products to show', 'aloxo' ),
			'std'        => '5',
			'param_name' => 'number'
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Show", "aloxo" ),
			"param_name"  => "show",
			"admin_label" => true,
			"value"       => array( __( "All Products", "aloxo" ) => "", __( "Featured Products", "aloxo" ) => "featured", __( "On-sale Products", "aloxo" ) => "onsale" ),
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Order by", "aloxo" ),
			"param_name"  => "orderby",
			"admin_label" => true,
			"value"       => array( __( "Date", "aloxo" ) => "date", __( "Price", "aloxo" ) => "price", __( "Random", "aloxo" ) => "rand", __( "Sales", "aloxo" ) => "sales" ),
		),

		array(
			"type"        => "dropdown",
			"heading"     => __( "Order", "aloxo" ),
			"param_name"  => "order",
			"admin_label" => true,
			"value"       => array( __( "ASC", "aloxo" ) => "asc", __( "DESC", "aloxo" ) => "desc" ),
		),
		array(
			'type'       => 'checkbox',
			'heading'    => __( 'Hide free products', 'aloxo' ),
			'param_name' => 'hide_free',
			'value'      => array( __( 'Yes, please', 'aloxo' ) => true )
		),
		array(
			'type'       => 'checkbox',
			'heading'    => __( 'Show hidden products', 'aloxo' ),
			'param_name' => 'show_hidden',
			'value'      => array( __( 'Yes, please', 'aloxo' ) => true )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Layout", "aloxo" ),
			"param_name"  => "layout",
			"admin_label" => true,
			"value"       => array( __( "Layout-01", "aloxo" ) => "left", __( "Layout-02", "aloxo" ) => "top", __( "Layout-03", "aloxo" ) => "layout-03", __( "Layout-04", "aloxo" ) => "layout-04" ),
			"description" => __( "Select Layout.", "aloxo" )
		),
		// array(
		// 	"type"        => "textfield",
		// 	"heading"     => __( "View More Button", "aloxo" ),
		// 	"param_name"  => "linkcustom",
		// 	"value"       => __( "", "aloxo" ),
		// 	"description" => __( "Link View More", "aloxo" ),
		// ),
		array(
				"type"        => "vc_link",
				"class"       => "",
				"heading"     => __( "View More Button Link", "Aloxo" ),
				"param_name"  => "link",
				"value"       => "",
				"description" => __( "Provide the link that will be applied to this Button.", "Aloxo" ),
				"dependency"  => Array( "element" => "layout", "value" => array( "top","left") ),
		),

		array(
			"type"        => "textfield",
			"heading"     => __( "Column", "aloxo" ),
			"param_name"  => "column",
			"value"       => __( "4", "aloxo" ),
			"description" => __( "Column", "aloxo" ),
			"dependency"  => Array( "element" => "layout", "value" => array( "top","left") ),

		),
		array(
			'type'       => 'textfield',
			'heading'    => __( 'Number per view', 'aloxo' ),
			'std'        => '4',
			'param_name' => 'num_per_view',
			"dependency"  => Array( "element" => "layout", "value" => array( "layout-03") ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'aloxo' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'aloxo' )
		)
	)
) );
/////////////////////////////////////
/////// Text Rotator
////////////////////////////////////
vc_map( array(
	"name"     => __( "Text Rotator", "aloxo" ),
	"base"     => "text_rotator",
	"class"    => "",
	"icon"     => "icon-wpb-icon_dropcap",
	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params"   => array(
		array(
			"type"       => "textarea_html",
			"holder"     => "div",
			"heading"    => __( "Text", "aloxo" ),
			"param_name" => "content",
			"value"      => __( '<h1>Super <span class="text_rotator">Simple, Customizable, Light Weight, Easy</span> Text Rotator with Style</h1>', "aloxo" )
		), 
		array(
			"type"        => "dropdown",
			"heading"     => __( "Style", "aloxo" ),
			"param_name"  => "style",
			"admin_label" => true,
			"value"       => array( __( "spin", "aloxo" ) => "spin",__( "fade", "aloxo" ) => "fade", __( "flipCube", "aloxo" ) => "flipCube", __( "flipUp", "aloxo" ) => "flipUp"),
		)
	)
) );

/**************vc-row*******************/
vc_map( array(
	'name' => __( 'Row', 'aloxo' ),
	'base' => 'vc_row',
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'show_settings_on_create' => false,
	'category' => __( 'Content', 'aloxo' ),
	'description' => __( 'Place content elements inside the row', 'aloxo' ),
	'params' => array(
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Font Color', 'wpb' ),
			'param_name' => 'font_color',
			'description' => __( 'Select font color', 'wpb' ),
			'edit_field_class' => 'col-md-6'
		),
 		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'aloxo' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'aloxo' ),
		), array(
			'type'       => 'dropdown',
			'heading'    => __( 'Layout', 'wpb' ),
			'param_name' => 'layout',
			'value'      => array(
				__( 'Wide', 'wpb' )  => 'wide',
				__( 'Boxed', 'wpb' ) => 'boxed',
				__( 'Mixing', 'wpb' ) => 'mixing',
			),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'Css', 'aloxo' ),
			'param_name' => 'css',
 			'group' => __( 'Design options', 'aloxo' )
		),array(
			'type' => 'textfield',
			'heading' => __( 'Extra ID name', 'aloxo' ),
			'param_name' => 'el_id',
			'description' => __( 'Extra ID Name use on one page', 'aloxo' ),
		)
	),
	'js_view' => 'VcRowView'
) );
/**************vc_row_inner*******************/
vc_map( array(
	'name' => __( 'Row', 'aloxo' ), //Inner Row
	'base' => 'vc_row_inner',
	'content_element' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'weight' => 1000,
	'show_settings_on_create' => false,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'aloxo' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'aloxo' )
		),
		array(
			'type'       => 'dropdown',
			'heading'    => __( 'Layout', 'wpb' ),
			'param_name' => 'layout',
			'value'      => array(
				__( 'Wide', 'wpb' )  => 'wide',
				__( 'Boxed', 'wpb' ) => 'boxed',
			),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'Css', 'aloxo' ),
			'param_name' => 'css',
 			'group' => __( 'Design options', 'aloxo' )
		)
	),
	'js_view' => 'VcRowView'
) );

//vc_map( array(
//	'name' => __( 'Progress Bar', 'aloxo' ),
//	'base' => 'vc_progress_bar',
//	'icon' => 'icon-wpb-graph',
//	'category' => __( 'Content', 'aloxo' ),
//	'description' => __( 'Animated progress bar', 'aloxo' ),
//	'params' => array(
//		array(
//			'type' => 'textfield',
//			'heading' => __( 'Widget title', 'aloxo' ),
//			'param_name' => 'title',
//			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'aloxo' )
//		),
//		array(
//			'type' => 'exploded_textarea',
//			'heading' => __( 'Graphic values', 'aloxo' ),
//			'param_name' => 'values',
//			'description' => __( 'Input graph values here. Divide values with linebreaks (Enter). Example: 90|Development', 'aloxo' ),
//			'value' => "90|Development,80|Design,70|Marketing"
//		),
//		array(
//			'type' => 'colorpicker',
//			'heading' => __( 'Graphic values Color', 'aloxo' ),
//			'param_name' => 'graphicvaluescolor',
//			'description' => __( 'Graphic values Color', 'aloxo' ),
// 		),
//		array(
//			'type' => 'textfield',
//			'heading' => __( 'Units', 'aloxo' ),
//			'param_name' => 'units',
//			'description' => __( 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'aloxo' )
//		),
//		array(
//			'type' => 'dropdown',
//			'heading' => __( 'Bar color', 'aloxo' ),
//			'param_name' => 'bgcolor',
//			'value' => array(
//				__( 'Grey', 'aloxo' ) => 'bar_grey',
//				__( 'Blue', 'aloxo' ) => 'bar_blue',
//				__( 'Turquoise', 'aloxo' ) => 'bar_turquoise',
//				__( 'Green', 'aloxo' ) => 'bar_green',
//				__( 'Orange', 'aloxo' ) => 'bar_orange',
//				__( 'Red', 'aloxo' ) => 'bar_red',
//				__( 'Black', 'aloxo' ) => 'bar_black',
//				__( 'Custom Color', 'aloxo' ) => 'custom'
//			),
//			'description' => __( 'Select bar background color.', 'aloxo' ),
//			'admin_label' => true
//		),
//		array(
//			'type' => 'colorpicker',
//			'heading' => __( 'Bar custom color', 'aloxo' ),
//			'param_name' => 'custombgcolor',
//			'description' => __( 'Select custom background color for bars.', 'aloxo' ),
//			'dependency' => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
//		),
//		array(
//			'type' => 'checkbox',
//			'heading' => __( 'Options', 'aloxo' ),
//			'param_name' => 'options',
//			'value' => array(
//				__( 'Add Stripes?', 'aloxo' ) => 'striped',
//				__( 'Add animation? Will be visible with striped bars.', 'aloxo' ) => 'animated'
//			)
//		),
//		array(
//			'type' => 'textfield',
//			'heading' => __( 'Extra class name', 'aloxo' ),
//			'param_name' => 'el_class',
//			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'aloxo' )
//		)
//	)
//) );
/* Accordion block
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Accordion', 'js_composer' ),
	'base' => 'vc_accordion',
	'show_settings_on_create' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-ui-accordion',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'jQuery UI accordion', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Style', 'js_composer' ),
			'param_name' => 'style',
			'value' => array(
				__( 'Style 01', 'js_composer' ) => 'style_1',
				__( 'Style 02', 'js_composer' ) => 'style_2',
				__( 'Style 03', 'js_composer' ) => 'style_3',
				__( 'Style 04', 'js_composer' ) => 'style_4',
				__( 'Style 05', 'js_composer' ) => 'style_5',

			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Active tab', 'js_composer' ),
			'param_name' => 'active_tab',
			'description' => __( 'Enter tab number to be active on load or enter false to collapse all tabs.', 'js_composer' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Allow collapsible all', 'js_composer' ),
			'param_name' => 'collapsible',
			'description' => __( 'Select checkbox to allow all sections to be collapsible.', 'js_composer' ),
			'value' => array( __( 'Allow', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	),
	'custom_markup' => '
<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
%content%
</div>
<div class="tab_controls">
    <button class="add_tab" title="' . __( 'Add accordion section', 'js_composer' ) . '">' . __( 'Add accordion section', 'js_composer' ) . '</button>
</div>
',
	'default_content' => '
    [vc_accordion_tab title="' . __( 'Section 1', 'js_composer' ) . '"][/vc_accordion_tab]
    [vc_accordion_tab title="' . __( 'Section 2', 'js_composer' ) . '"][/vc_accordion_tab]
',
	'js_view' => 'VcAccordionView'
) );

/* Tabs
---------------------------------------------------------- */
$tab_id_1 = time() . '-1-' . rand( 0, 100 );
$tab_id_2 = time() . '-2-' . rand( 0, 100 );
vc_map( array(
	"name" => __( 'Tabs', 'js_composer' ),
	'base' => 'vc_tabs',
	'show_settings_on_create' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-ui-tab-content',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Tabbed content', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Auto rotate tabs', 'js_composer' ),
			'param_name' => 'interval',
			'value' => array( __( 'Disable', 'js_composer' ) => 0, 3, 5, 10, 15 ),
			'std' => 0,
			'description' => __( 'Auto rotate tabs each X seconds.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Style', 'js_composer' ),
			'param_name' => 'style',
			'value' => array(
				__( 'Style 01', 'js_composer' ) => 'style_1',
				__( 'Style 02', 'js_composer' ) => 'style_2',
				__( 'Style 03', 'js_composer' ) => 'style_3',
 			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	),
	'custom_markup' => '<div class="wpb_tabs_holder wpb_holder vc_container_for_children"><ul class="tabs_controls"></ul>%content%</div>',
	'default_content' => '
[vc_tab title="' . __( 'Tab 1', 'js_composer' ) . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
[vc_tab title="' . __( 'Tab 2', 'js_composer' ) . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
',
	'js_view' => 'VcTabsView'
) );


//WooCommerce Sale Off Products
vc_map( array(
	'name'     => __( 'Sale Off Products','aloxo'),
	'base'     => 'sale_off_products',
	'icon'     => 'icon-wpb-wp',
	'category' => __( 'Aloxo Shortcodes', 'aloxo' ),
	'params'   => array(

		// title
		array(
			'type'       => 'textfield',
			'heading'    => __( 'Title', 'aloxo' ),
			'param_name' => 'title',
			'std'        => __( 'Products', 'aloxo' ),
		),
		array(
			'type'			=> 'colorpicker',
			'heading'		=> __('Title color', 'aloxo'),
			'param_name'	=> 'title_color',
			'value'			=> '#169f85',
		),
		array(
			'type'			=> 'number',
			'heading'		=> __('Title size', 'aloxo'),
			'param_name'	=> 'title_size',
			'min'			=> 0,
			'max'			=> 100,
			'value'			=> 13,
			'suffix'		=> 'px',
		),

		// sub title
		array(
			'type'			=> 'textfield',
			'heading'		=> __('Sub title', 'aloxo'),
			'param_name'	=> 'sub_title',
			'value'			=> 'get up to 20% up'
		),
		array(
			'type'			=> 'colorpicker',
			'heading'		=> __('Sub title color', 'aloxo'),
			'param_name'	=> 'sub_title_color',
			'value'			=> '#000'
		),
		array(
			'type'			=> 'number',
			'heading'		=> __('Sub title size', 'aloxo'),
			'param_name'	=> 'sub_title_size',
			'min'			=> 0,
			'max'			=> 100,
			'value'			=> 13,
			'suffix'		=> 'px',
		),

		// button
		array(
			'type'			=> 'textfield',
			'heading'		=> __('Button title', 'aloxo'),
			'param_name'	=> 'button_title',
			'value'			=> 'SHOP NOW'
		),
		array(
			'type'			=> 'colorpicker',
			'heading'		=> __('Button title color', 'aloxo'),
			'param_name'	=> 'button_title_color',
			'value'			=> '#fff'
		),
		array(
			'type'			=> 'number',
			'heading'		=> __('Button title size', 'aloxo'),
			'param_name'	=> 'button_title_size',
			'min'			=> 0,
			'max'			=> 100,
			'value'			=> 13,
			'suffix'		=> 'px',
		),
		array(
			'type'			=> 'colorpicker',
			'heading'		=> __('Button background color', 'aloxo'),
			'param_name'	=> 'bg_button'
		),

		// link button
		array(
			'type'			=> 'vc_link',
			'heading'		=> __('Link', 'aloxo'),
			'param_name'	=> 'link',
		),

		//image
		array(
			'type'			=> 'attach_image',
			'heading'		=> __('Product image', 'aloxo'),
			'param_name'	=> 'image'
		),

		// array(
		// 	'type'       => 'textfield',
		// 	'heading'    => __( 'Number of products to show', 'aloxo' ),
		// 	'std'        => '5',
		// 	'param_name' => 'number'
		// ),

		$add_css_animation_woo,

		array(
			"type"        => "textfield",
			"heading"     => __( "Extra class name", "aloxo" ),
			"param_name"  => "el_class",
			"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "aloxo" ),
		)
	)
) );

//WooCommerce Category
vc_map( array(
	'name'     => __( 'WC-Category','aloxo'),
	'base'     => 'wc_category',
	'icon'     => 'icon-wpb-wp',
	'category' => __( 'Aloxo Shortcodes', 'aloxo' ),
	'params'   => array(
		array(
			"type"        => "dropdown",
			"heading"     => __( "Layout", "aloxo" ),
			"param_name"  => "layout",
			'std'		  => "layout-01",
			"admin_label" => true,
			"value"       => array(
				__( "Layout-01", "aloxo" ) => "layout-01",
				// __( "Layout-02", "aloxo" ) => "layout-02",
				// __( "Layout-04", "aloxo" ) => "layout-04",
				// __( "Layout-05", "aloxo" ) => "layout-05",
				// __( "Layout-03", "aloxo" ) => "layout-03", 
				__( "Layout-06", "aloxo" ) => "layout-06",
			)
		),
		// Images Preview
		array(
			"type"       => "preview",
			"heading"    => __( "Preview Layout", "Aloxo" ),
			"param_name" => "preview_style1",
			"value"      => get_template_directory_uri() . '/images/admin/woo-cate/layout-01.jpg',
			"dependency" => Array( 'element' => "layout", 'value' => array( 'layout-01' ) )
		),
		array(
			"type"       => "preview",
			"heading"    => __( "Preview Layout", "Aloxo" ),
			"param_name" => "preview_style2",
			"value"      => get_template_directory_uri() . '/images/admin/woo-cate/layout-02.jpg',
			"dependency" => Array( 'element' => "layout", 'value' => array( 'layout-02' ) )
		),
		array(
			"type"       => "preview",
			"heading"    => __( "Preview Layout", "Aloxo" ),
			"param_name" => "preview_style3",
			"value"      => get_template_directory_uri() . '/images/admin/woo-cate/layout-03.jpg',
			"dependency" => Array( 'element' => "layout", 'value' => array( 'layout-03' ) )
		),
		array(
			"type"       => "preview",
			"heading"    => __( "Preview Layout", "Aloxo" ),
			"param_name" => "preview_style4",
			"value"      => get_template_directory_uri() . '/images/admin/woo-cate/layout-04.jpg',
			"dependency" => Array( 'element' => "layout", 'value' => array( 'layout-04' ) )
		),
		array(
			"type"       => "preview",
			"heading"    => __( "Preview Layout", "Aloxo" ),
			"param_name" => "preview_style5",
			"value"      => get_template_directory_uri() . '/images/admin/woo-cate/layout-05.jpg',
			"dependency" => Array( 'element' => "layout", 'value' => array( 'layout-05' ) )
		),
		array(
			"type"       => "preview",
			"heading"    => __( "Preview Layout", "Aloxo" ),
			"param_name" => "preview_style6",
			"value"      => get_template_directory_uri() . '/images/admin/woo-cate/layout-06.jpg',
			"dependency" => Array( 'element' => "layout", 'value' => array( 'layout-06' ) )
		),
		
		array(
			"type"        => "dropdown",
			"heading"     => __( "Style", "aloxo" ),
			"param_name"  => "layout_style",
			'std'		  => "style-01",
			"admin_label" => true,
			"value"       => array(__( "Style-01", "aloxo" ) => "style-01", __( "Style-02", "aloxo" ) => "style-02"),
			"dependency" => Array( 'element' => "layout", 'value' => array( 'layout-06' ) ),
		),

		array(
			'type'       => 'textfield',
			'heading'    => __( 'Title', 'aloxo' ),
			'param_name' => 'title',
			'std'        => __( 'Categories', 'aloxo' ),
			"dependency"  => Array( 'element' => "layout", 'value' => array( 'layout-01', 'layout-06' ) )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Order by", "aloxo" ),
			"param_name"  => "orderby",
			"admin_label" => true,
			"value"       => array(__( "Name", "aloxo" ) => "name", __( "Category Order", "aloxo" ) => "order"),
			"dependency"  => Array( 'element' => "layout", 'value' => array( 'layout-01' ) )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Options', 'aloxo' ),
			'param_name' => 'options',
			'value' => array(
				//__( 'Display as dropdown', 'aloxo' ) => 'dropdown',
				__( 'Show post counts', 'aloxo' ) => 'count',
				__( 'Show hierarchy', 'aloxo' ) => 'hierarchical'
			),
			"dependency"  => Array( 'element' => "layout", 'value' => array( 'layout-01' ) )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Columns", "aloxo" ),
			"param_name"  => "column",
			"value"       => array(__( "1", "aloxo" ) => "1", 
									__( "2", "aloxo" ) => "2",
									__( "3", "aloxo" ) => "3",
									__( "4", "aloxo" ) => "4",
									__( "5", "aloxo" ) => "5",
									__( "6", "aloxo" ) => "6",
							),
			"dependency"  => Array( 'element' => "layout", 'value' => array( 'layout-02' ) )
		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Items number per view", "aloxo" ),
			"param_name"  => "number_per_view",
			"value"       => __( "10", "aloxo" ),
			"dependency"  => Array( 'element' => "layout", 'value' => array( 'layout-02', 'layout-03', 'layout-04') )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Select Category", "aloxo" ),
			"param_name"  => "cats",
			"admin_label" => true,
			"value"       => $display_pro_cates,
			"description" => __( "", "aloxo" ),
			"dependency"  => Array( 'element' => "layout", 'value' => array( 'layout-05') )
		),
	)
) );



//WooCommerce Products Slider
vc_map( array(
	'name'     => __( 'Products Slider', 'aloxo' ),
	'base'     => 'wc_products_slider',
	'icon'     => 'icon-wpb-wp',
	'category' => __( 'Aloxo Shortcodes', 'aloxo' ),
	'params'   => array(
		array(
			'type'       => 'textfield',
			'heading'    => __( 'Title', 'aloxo' ),
			'param_name' => 'title',
			'std'        => __( 'Products', 'aloxo' ),
		),

		array(
			"type"        => "colorpicker",
			"heading"     => __( "Border bottom title color", "aloxo" ),
			"param_name"  => "border_bottom_title_color",
			"admin_label" => true,
			"value"       => '#37c6ca', //Default Red color
			"description" => __( "Choose text color", 'aloxo' )
		),

		array(
			'type'       => 'textfield',
			'heading'    => __( 'Number of products to show', 'aloxo' ),
			'std'        => '5',
			'param_name' => 'number'
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Show", "aloxo" ),
			"param_name"  => "show",
			"admin_label" => true,
			"value"       => array( __( "All Products", "aloxo" ) => "", __( "Featured Products", "aloxo" ) => "featured", __( "On-sale Products", "aloxo" ) => "onsale" ),
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Order by", "aloxo" ),
			"param_name"  => "orderby",
			"admin_label" => true,
			"value"       => array( __( "Date", "aloxo" ) => "date", __( "Price", "aloxo" ) => "price", __( "Random", "aloxo" ) => "rand", __( "Sales", "aloxo" ) => "sales" ),
		),

		array(
			"type"        => "dropdown",
			"heading"     => __( "Order", "aloxo" ),
			"param_name"  => "order",
			"admin_label" => true,
			"value"       => array( __( "ASC", "aloxo" ) => "asc", __( "DESC", "aloxo" ) => "desc" ),
		),
		array(
			'type'       => 'checkbox',
			'heading'    => __( 'Hide free products', 'aloxo' ),
			'param_name' => 'hide_free',
			'value'      => array( __( 'Yes, please', 'aloxo' ) => true )
		),
		array(
			'type'       => 'checkbox',
			'heading'    => __( 'Show hidden products', 'aloxo' ),
			'param_name' => 'show_hidden',
			'value'      => array( __( 'Yes, please', 'aloxo' ) => true )
		),
	/*	array(
			"type"        => "dropdown",
			"heading"     => __( "Layout", "aloxo" ),
			"param_name"  => "layout",
			"admin_label" => true,
			"value"       => array( __( "Slider", "aloxo" ) => "slider", __( "Lists", "aloxo" ) => "lists" ),
			"description" => __( "Select Layout.", "aloxo" )
		),*/
		array(
			"type"        => "dropdown",
			"heading"     => __( "Column", "aloxo" ),
			"param_name"  => "column",
			"value"       => array( __( "3", "aloxo" ) => "3", __( "4", "aloxo" ) => "4" ),
			"description" => __( "Column", "aloxo" )

		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'aloxo' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'aloxo' )
		),
		$add_css_animation_woo
	)
) );

vc_map( array(
	"name"     => __( "Category Product Showcase", "aloxo" ),
	"base"     => "wc_category_showcase",
	"class"    => "",
	"icon"     => "icon-wpb-icon_wc_category_showcase",
	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params"   => array(
		array(
			"type"        => "dropdown",
			"heading"     => __( "Select Category", "aloxo" ),
			"param_name"  => "cats",
			"admin_label" => true,
			"value"       => $display_pro_cates,
			"description" => __( "", "aloxo" ),
		),
		array(
			"type"       => "heading_title",
			"param_name" => "cate_config_1",
			"value"      => "showcase config",
		),

		array(
			"type"        => "dropdown",
			"heading"     => __( "Layout", "aloxo" ),
			"param_name"  => "first_layout",
			"admin_label" => true,
			"value"       => array(
				__( "Category Top Image", "aloxo" )  => "img",
				// __( "Top Sellers", "aloxo" ) => "seller",
				// __( "Top Rated", "aloxo" ) => "rated",
				__( "Custom", "aloxo" ) => "custom",
			),
			"description" => __( "Select Layout.", "aloxo" )
		),

		array(
			'type'       => 'textfield',
			'heading'    => __( 'Title', 'aloxo' ),
			'param_name' => 'first_title',
			'std'        => __( 'Products', 'aloxo' ),
			//"dependency"  => Array( 'element' => "showcase", 'value' => array( 'seller', 'rated' ) ),
			"dependency"  => Array( 'element' => "first_layout", 'value' => array( 'custom') )

		),
		////////
		array(
			"type"        => "dropdown",
			"heading"     => __( "Show", "aloxo" ),
			"param_name"  => "first_shown",
			"admin_label" => true,
			"value"       => array( __( "All Products", "aloxo" ) => "", __( "Featured Products", "aloxo" ) => "featured", __( "On-sale Products", "aloxo" ) => "onsale" ),
			"dependency"  => Array( 'element' => "first_layout", 'value' => array( 'custom') )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Order by", "aloxo" ),
			"param_name"  => "first_orderby",
			"admin_label" => true,
			"value"       => array( __( "Date", "aloxo" ) => "date", __( "Price", "aloxo" ) => "price", __( "Random", "aloxo" ) => "rand", __( "Sales", "aloxo" ) => "sales" ),
			"dependency"  => Array( 'element' => "first_layout", 'value' => array( 'custom') )
		),

		array(
			"type"        => "dropdown",
			"heading"     => __( "Order", "aloxo" ),
			"param_name"  => "first_order",
			"admin_label" => true,
			"value"       => array( __( "ASC", "aloxo" ) => "asc", __( "DESC", "aloxo" ) => "desc" ),
			"dependency"  => Array( 'element' => "first_layout", 'value' => array( 'custom') )
		),
		array(
			'type'       => 'checkbox',
			'heading'    => __( 'Hide free products', 'aloxo' ),
			'param_name' => 'first_hide_free',
			'value'      => array( __( 'Yes, please', 'aloxo' ) => true ),
			"dependency"  => Array( 'element' => "first_layout", 'value' => array( 'custom') )
		),
		array(
			'type'       => 'checkbox',
			'heading'    => __( 'Show hidden products', 'aloxo' ),
			'param_name' => 'first_show_hidden',
			'value'      => array( __( 'Yes, please', 'aloxo' ) => true ),
			"dependency"  => Array( 'element' => "first_layout", 'value' => array( 'custom') )
		),
		///////////
		array(
			"type"        => "dropdown",
			"heading"     => __( "Slider Type", "aloxo" ),
			"param_name"  => "first_show",
			"admin_label" => true,
			//'std'		  => __('vertical','aloxo'),
			//"value"       => array( __( "Vertical", "aloxo" ) => "vertical", __( "Horizontal", "aloxo" ) => "horizontal"),
			"value"       => array(
				__( "Style-01", "aloxo" )  	=> "vertical",
				__( "Style-02", "aloxo" ) 	=> "horizontal",
			),
			"dependency"  => Array( 'element' => "first_layout", 'value' => array( 'custom') )
		),
		array(
			'type'       => 'textfield',
			'heading'    => __( 'Number of products to show', 'aloxo' ),
			'std'        => '4',
			'param_name' => 'first_number',
			"dependency"  => Array( 'element' => "first_layout", 'value' => array( 'custom') )

		),
		array(
			'type'       => 'textfield',
			'heading'    => __( 'Number per view', 'aloxo' ),
			'std'        => '6',
			'param_name' => 'num_per_view',
			"dependency"  => Array( 'element' => "first_show", 'value' => array( 'vertical') )

		),
		array(
			"type"       => "heading_title",
			"param_name" => "cate_config_2",
			"value"      => "Content Config",
		),

		array(
			'type'       => 'textfield',
			'heading'    => __( 'Title', 'aloxo' ),
			'param_name' => 'title',
			'std'        => __( 'Products', 'aloxo' ),

		),

		array(
			'type'       => 'textfield',
			'heading'    => __( 'Number of products to show', 'aloxo' ),
			'std'        => '4',
			'param_name' => 'number'
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Show", "aloxo" ),
			"param_name"  => "show",
			"admin_label" => true,
			"value"       => array( __( "All Products", "aloxo" ) => "", __( "Featured Products", "aloxo" ) => "featured", __( "On-sale Products", "aloxo" ) => "onsale" ),
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Order by", "aloxo" ),
			"param_name"  => "orderby",
			"admin_label" => true,
			"value"       => array( __( "Date", "aloxo" ) => "date", __( "Price", "aloxo" ) => "price", __( "Random", "aloxo" ) => "rand", __( "Sales", "aloxo" ) => "sales" ),
		),

		array(
			"type"        => "dropdown",
			"heading"     => __( "Order", "aloxo" ),
			"param_name"  => "order",
			"admin_label" => true,
			"value"       => array( __( "ASC", "aloxo" ) => "asc", __( "DESC", "aloxo" ) => "desc" ),
		),
		array(
			'type'       => 'checkbox',
			'heading'    => __( 'Hide free products', 'aloxo' ),
			'param_name' => 'hide_free',
			'value'      => array( __( 'Yes, please', 'aloxo' ) => true )
		),
		array(
			'type'       => 'checkbox',
			'heading'    => __( 'Show hidden products', 'aloxo' ),
			'param_name' => 'show_hidden',
			'value'      => array( __( 'Yes, please', 'aloxo' ) => true )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Column", "aloxo" ),
			"param_name"  => "column",
			'std'        => '4',
			"value"       => array( __( "3", "aloxo" ) => "3", __( "4", "aloxo" ) => "4" ),
			"description" => __( "Column", "aloxo" )

		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'aloxo' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'aloxo' )
		),
		$add_css_animation_woo
	)
) );


/* Flickr
---------------------------------------------------------- */
vc_map( array(
	'base' => 'vc_flickr',
	'name' => __( 'Flickr Widget', 'js_composer' ),
	'icon' => 'icon-wpb-flickr',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Image feed from your flickr account', 'js_composer' ),
	"params" => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Flickr ID', 'js_composer' ),
			'param_name' => 'flickr_id',
			'admin_label' => true,
			'description' => sprintf( __( 'To find your flickID visit %s.', 'js_composer' ), 'idgettr dot com" target="_blank">idGettr</a>' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Number of photos', 'js_composer' ),
			'param_name' => 'count',
			'value' => array( 9, 8, 7, 6, 5, 4, 3, 2, 1 ),
			'description' => __( 'Number of photos.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Type', 'js_composer' ),
			'param_name' => 'type',
			'value' => array(
				__( 'User', 'js_composer' ) => 'user',
				__( 'Group', 'js_composer' ) => 'group'
			),
			'description' => __( 'Photo stream type.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Display', 'js_composer' ),
			'param_name' => 'display',
			'value' => array(
				__( 'Latest', 'js_composer' ) => 'latest',
				__( 'Random', 'js_composer' ) => 'random'
			),
			'description' => __( 'Photo order.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );



/////////////////////////////////////
///////Button
////////////////////////////////////
$colors_arr = array(
	__( 'Default', 'js_composer' ) => 'default',
	__( 'Blue', 'js_composer' ) => 'blue',
	__( 'Light Blue', 'js_composer' ) => 'lightblue',
	__( 'Dark Blue', 'js_composer' ) => 'darkblue',
	__( 'Red', 'js_composer' ) => 'red',
	__( 'Green', 'js_composer' ) => 'green',
	__( 'Orange', 'js_composer' ) => 'orange',
	__( 'Dark', 'js_composer' ) => 'dark',
	__( 'Light', 'js_composer' ) => 'light',
	__( 'Line Dark', 'js_composer' ) => 'linedark',
	__( 'Line Light', 'js_composer' ) => 'linelight',
	__( 'Custom Color', 'js_composer' ) => 'custom',
);
$target_arr = array(
	__( 'Same window', 'js_composer' ) => '_self',
	__( 'New window', 'js_composer' ) => "_blank"
);
$size_arr = array(
	__( 'Medium size', 'js_composer' ) => '',
	__( 'Large', 'js_composer' ) => 'big',
	__( 'Small', 'js_composer' ) => 'small',
);
vc_map( array(
	"name"     => __( "Button", "aloxo" ),
	"base"     => "vc_button",
	"class"    => "",
	"icon"     => "icon-wpb-vc_button",
	"category" => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params"   => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Text on the button', 'js_composer' ),
			'holder' => 'button',
			'class' => 'wpb_button',
			'param_name' => 'title',
			'value' => __( 'Text on the button', 'js_composer' ),
			'description' => __( 'Text on the button.', 'js_composer' )
		),
		array(
			'type' => 'href',
			'heading' => __( 'URL (Link)', 'js_composer' ),
			'param_name' => 'href',
			'description' => __( 'Button link.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Target', 'js_composer' ),
			'param_name' => 'target',
			'value' => $target_arr,
			'dependency' => array( 'element'=>'href', 'not_empty'=>true, 'callback' => 'vc_button_param_target_callback' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Color', 'js_composer' ),
			'param_name' => 'color',
			'value' => $colors_arr,
			'description' => __( 'Button color.', 'js_composer' ),
			'param_holder_class' => 'vc_colored-dropdown'
		),
		array(
			"type"        => "colorpicker",
			"heading"     => __( "Background color", "aloxo" ),
			"param_name"  => "bg_color",
			"admin_label" => true,
			"value"       => '#333', //Default Red color
			"description" => __( "Choose color", 'aloxo' ),
			"dependency"  => Array( 'element' => "color", 'value' => array( 'custom' ) )
		),
		// array(
		// 	'type' => 'dropdown',
		// 	'heading' => __( 'Icon', 'js_composer' ),
		// 	'param_name' => 'icon',
		// 	'value' => $icons_arr,
		// 	'description' => __( 'Button icon.', 'js_composer' )
		// ),
		array(
			"type"        => "icon",
			"class"       => "",
			"heading"     => __( "Select Icon:", "aloxo" ),
			"param_name"  => "icon",
			"admin_label" => true,
			"value"       => "",
			"description" => __( "Select the icon from the list.", "aloxo" ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Size', 'js_composer' ),
			'param_name' => 'size',
			'value' => $size_arr,
			'description' => __( 'Button size.', 'js_composer' )
		),
		array(
			"type"        => "dropdown",
			"heading"     => __( "Custom Margin", "aloxo" ),
			"param_name"  => "custom_mr",
			"admin_label" => true,
			"value"       => array( __( "Default", "aloxo" ) => "", __( "Custom", "aloxo" ) => "custom" ),
		),
		array(
			"type"        => "number",
			"heading"     => __( "Margin Button", "aloxo" ),
			"param_name"  => "mr_btn",
			"value"       => 0,
			"suffix"      => "px",
			"dependency"  => Array( 'element' => "custom_mr", 'value' => array( 'custom' ) )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

/* Woo Countdown
---------------------------------------------------------- */
vc_map( array(
	'base' => 'wc_countdown',
	'name' => __( 'WooCommerce Sale Countdown', 'js_composer' ),
	'icon' => 'icon-countdown',
	'category' => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params" => array(
		array(
			"type"        => "textfield",
			"heading"     => __( "Title", "aloxo" ),
			"param_name"  => "title_sale_product",
		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Sale Products", "aloxo" ),
			"param_name"  => "sale_product",
			"description" => __( "Enter Sale Products ID Example: 1, 2", "aloxo" ),
		),
	)
) );

/* Woo Product Search
---------------------------------------------------------- */
vc_map( array(
	'base' => 'wc_product_search',
	'name' => __( 'WooCommerce Product Search', 'js_composer' ),
	'icon' => 'icon-product-search',
	'category' => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params" => array(
		array(
			"type"        => "dropdown",
			"heading"     => __( "Style:", "Aloxo" ),
			"param_name"  => "search_style",
			"value"       => array(
				"Style 01" => "style-01",
				"Style 02" => "style-02",
			),
		),
		// Images Preview
		array(
			"type"       => "preview",
			"heading"    => __( "Preview Layout", "Aloxo" ),
			"param_name" => "preview_style1",
			"value"      => get_template_directory_uri() . '/images/admin/product-search/style-01.jpg',
			"dependency" => Array( 'element' => "search_style", 'value' => array( 'style-01' ) )
		),
		array(
			"type"       => "preview",
			"heading"    => __( "Preview Layout", "Aloxo" ),
			"param_name" => "preview_style2",
			"value"      => get_template_directory_uri() . '/images/admin/product-search/style-02.jpg',
			"dependency" => Array( 'element' => "search_style", 'value' => array( 'style-02' ) )
		),
	)
) );


/////////////////
// twitter
/////////////////
vc_map( array(
	'base' => 'twitter',
	'name' => __( 'Twitter', 'js_composer' ),
	'icon'     => 'icon-wpb-aloxo',
	'category' => __( 'Aloxo Shortcodes', 'aloxo' ),
	"params" => array(
		array(
			'type'			=> 'textfield',
			'heading'		=> __('Title', 'aloxo'),
			'param_name'	=> 'title',
			'value'			=> 'twtter',
		),
		
		array(
			'type'			=> 'colorpicker',
			'heading'		=> __('Title color', 'aloxo'),
			'param_name'	=> 'title_color',
			'value'			=> '#169f85',
		),

		array(
			'type'			=> 'number',
			'heading'		=> __('Title size', 'aloxo'),
			'param_name'	=> 'title_size',
			'value'			=> 16,
			'suffix'		=> 'px',
			'min'			=> 1,
			'max'			=> 100,
		),

		array(
			'type'			=> 'dropdown',
			'heading'		=> __('Title font weight', 'aloxo'),
			'param_name'	=> 'title_font',
			'value'		=> array(
				'nomal'		=> __('Normal', 'aloxo'),
				'bold'		=> __('Bold', 'aloxo'),
				'bolder'	=> __('Bolder', 'aloxo'),
				'lighter'	=> __('Lighter', 'aloxo'),
				'initial'	=> __('Initial', 'aloxo'),
				'inherit'	=> __('Inherit', 'aloxo'),
				'100'		=> __('100', 'aloxo'),
				'200'		=> __('200', 'aloxo'),
				'300'		=> __('300', 'aloxo'),
				'400'		=> __('400', 'aloxo'),
				'500'		=> __('500', 'aloxo'),
				'600'		=> __('600', 'aloxo'),
				'700'		=> __('700', 'aloxo'),
				'800'		=> __('800', 'aloxo'),
				'900'		=> __('900', 'aloxo'),
			),
		),

		array(
			'type'			=> 'icon',
			'heading'		=> __('Icon', 'aloxo'),
			'param_name'	=> 'icon',
			'admin_label' 	=> true,
			'value'       	=> 'twitter',
			'description' 	=> __( 'Select the icon from the list.', 'aloxo' ),
			'dependency'  => Array( 'element' => 'icon_type', 'value' => array('font-awesome')),
		),

		array(
			'type'			=> 'textfield',
			'heading'		=> __('Twitter name', 'aloxo'),
			'param_name'	=> 'twitter_id',
			'value'			=> 'kaka',	
		),

		array(
			'type'			=> 'textfield',
			'heading'		=> __('Consumer key', 'aloxo'),
			'param_name'	=> 'consumer_key',
		),

		array(
			'type'			=> 'textfield',
			'heading'		=> __('Consumer secret', 'aloxo'),
			'param_name'	=> 'consumer_secret',
		),

		array(
			'type'			=> 'textfield',
			'heading'		=> __('Access token', 'aloxo'),
			'param_name'	=> 'access_token',
		),

		array(
			'type'			=> 'textfield',
			'heading'		=> __('Access token secret', 'aloxo'),
			'param_name'	=> 'access_token_secret',
		),

		// array(
		// 	'type'			=> 'textfield',
		// 	'heading'		=> __('Twitter name', 'aloxo'),
		// 	'param_name'	=> 'twitter_id',
		// ),

		array(
			'type'			=> 'number',
			'heading'		=> __('Number post', 'aloxo'),
			'param_name'	=> 'count',
			'value'			=> 3,
		),

		// layout
		array(
			'type'			=> 'radioimage',
			'heading'		=> __('Select layout', 'aloxo'),
			'class'       	=> 'style_twitter_select',
			'param_name'	=> 'layout',
			'options'     	=> array(
				'layout-01'  => get_template_directory_uri() . '/images/admin/twitter/1.jpg',
				'layout-02'  => get_template_directory_uri() . '/images/admin/twitter/2.jpg',
			),
			'value'       => 'layout-01',
		)

		// $add_css_animation,

		// array(
		// 	'type'			=> 'textfield',
		// 	'heading'		=> __('Extract class name', 'aloxo'),
		// 	'param_name'	=> 'else_class',
		// 	'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		// ),
	)
) );


/******************Google Map ***********************/
vc_map( array(
	'name' => __( 'Aloxo: Google Map', 'aloxo' ),
	'base' => 'google_map',
	'icon' => 'google_map',
	'category' => __( 'Aloxo Shortcodes', 'aloxo' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Address.', 'aloxo' ),
			'param_name' => 'rnr_contact_address',
			'value' => __( ' ', 'aloxo' ),
			'description' => __( 'Enter your Address.', 'aloxo' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Latitude Position', 'aloxo' ),
			'param_name' => 'rnr_map_lat',
			'value' => __( '21.030138', 'aloxo' ),
			'description' => __( 'Find your latitude position at itouchmap dot com', 'aloxo' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Longitude Position', 'aloxo' ),
			'param_name' => 'rnr_map_long',
			'value' => __( '105.762467', 'aloxo' ),
			'description' => __( 'Find your longitude position at itouchmap dot com', 'aloxo' )
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Upload Logo for map', 'aloxo' ),
			'param_name' => 'rnr_map_logo',
			'value' => '',
			'description' => __( 'Upload images using the native media uploader, or define the URL directly', 'aloxo' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Map Zoom Value', 'aloxo' ),
			'param_name' => 'rnr_map_zoom',
			'value' => __( '18', 'aloxo' ),
			'description' => __( 'Give Map Zoom value.', 'aloxo' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		),
		$add_css_animation
	),
) );


vc_map( array(
	'name' => __( 'Aloxo: Shop Tivi', 'aloxo' ),
	'base' => 'wc_shop_tivi',
	'icon' => 'wc_shop_tivi',
	'category' => __( 'Aloxo Shortcodes', 'aloxo' ),
	'params' => array(
		array(
			"type"        => "dropdown",
			"heading"     => __( "Style", "aloxo" ),
			"param_name"  => "shop_style",
			"admin_label" => true,
			"value"       => array( __( "Style-01", "aloxo" ) => "style-01", __( "Style-02", "aloxo" ) => "style-02" ),
			"description" => __( "Select Style.", "aloxo" )
		),
		// Images Preview
		array(
			"type"       => "preview",
			"heading"    => __( "Preview Layout", "Aloxo" ),
			"param_name" => "preview_style1",
			"value"      => get_template_directory_uri() . '/images/admin/baby-tivi/style-01.jpg',
			"dependency" => Array( 'element' => "shop_style", 'value' => array( 'style-01' ) )
		),
		array(
			"type"       => "preview",
			"heading"    => __( "Preview Layout", "Aloxo" ),
			"param_name" => "preview_style2",
			"value"      => get_template_directory_uri() . '/images/admin/baby-tivi/style-02.jpg',
			"dependency" => Array( 'element' => "shop_style", 'value' => array( 'style-02' ) )
		),
		array(
			"type"        => "icon",
			"class"       => "",
			"heading"     => __( "Select Icon:", "Aloxo" ),
			"param_name"  => "shop_icon",
			"admin_label" => true,
			"description" => __( "Select the icon.", "Aloxo" ),
			"dependency"  => Array( "element" => "icon_type", "value" => array( "font-awesome" ) ),
		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Baby Shop Tivi", "aloxo" ),
			"param_name"  => "shop_text",
		),
		array(
			"type"        => "textfield",
			"heading"     => __( "Baby Shop Tivi Link", "aloxo" ),
			"param_name"  => "shop_link",
		),
		$add_css_animation
	),
) );
