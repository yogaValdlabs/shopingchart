<?php

$footer->addSubSection( array(
	'name'     => 'Footer',
	'id'       => 'display_footer',
	'position' => 10,
) );


$footer->createOption( array(
	'name'    => 'Footer Column',
	'id'      => 'footer_column',
	'type'    => 'number',
	'desc'    => 'This is footer column',
	'default' => '4',
	'max'     => '4'
) );

$footer->createOption( array(
	'name'    => 'Width Column',
	'id'      => 'width_column',
	'default' => '2+3+4+3',
	'type'    => 'text',
	'desc'    => 'Enter width of the ( columns 1 + columns 2 + columns 3 + columns 4 ) total of 12'
) );

$footer->createOption( array(
	'name'                => 'Footer Text Font',
	'id'                  => 'footer_text_font',
	'type'                => 'font-color',
	'show_font_family'    => false,
	'show_font_weight'    => true,
	'show_font_style'     => false,
	'show_line_height'    => true,
	'show_letter_spacing' => false,
	'show_text_transform' => false,
	'show_font_variant'   => false,
	'show_text_shadow'    => false,
	'show_preview'        => true,
	'show_color'          => true,
	'default'             => array(
		'color-opacity' => '#169f85',
		'line-height' 	=> '1em',
		'font-weight' 	=> '500',
		'font-size'	  	=> '14px',
	)
) );

$footer->createOption( array(
	'name'                => 'Footer Title Font',
	'id'                  => 'footer_title_font',
	'type'                => 'font-color',
	'show_font_family'    => false,
	'show_font_weight'    => true,
	'show_font_style'     => false,
	'show_line_height'    => true,
	'show_letter_spacing' => false,
	'show_text_transform' => true,
	'show_font_variant'   => false,
	'show_text_shadow'    => false,
	'show_color'          => true,
	'default'             => array(
		'color-opacity' => '#888888',
		'line-height' 	=> '1em',
		'font-weight' 	=> '500',
		'font-size'	  	=> '18px',
	),
) );

$footer->createOption( array(
	'name'        => 'Background Footer Color',
	'id'          => 'footer_bg_color',
	'type'        => 'color-opacity',
	'default'     => '#0e2a36',
	'livepreview' => '$("footer#colophon .footer").css("background-color", value);'
) );

//$footer->createOption( array(
//	'name'        => 'Text Color',
//	'id'          => 'footer_text_color',
//	'type'        => 'color-opacity',
//	'default'     => '#fff',
//	'livepreview' => '$(".footer,.footer a").css("color", value);'
//) );
