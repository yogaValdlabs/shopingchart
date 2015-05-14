<?php
$footer->addSubSection( array(
	'name'     => 'Copyright Options',
	'id'       => 'display_copyright',
	'position' => 11,
) );

$footer->createOption( array(
	'name'        => 'Border Top Copyright Color',
	'id'          => 'copyright_border_top_color',
	'type'        => 'color-opacity',
	'default'     => '',
	//'livepreview' => '$("footer#colophon .copyright_area").css("background-color", value);'
) );

$footer->createOption( array(
	'name'        => 'Background Copyright Color',
	'id'          => 'copyright_bg_color',
	'type'        => 'color-opacity',
	'default'     => '#fff',
	'livepreview' => '$("footer#colophon .copyright_area").css("background-color", value);'
) );

$footer->createOption( array(
	'name'        => 'Text Color',
	'id'          => 'copyright_text_color',
	'type'        => 'color-opacity',
	'default'     => '#fff',
	//'css'		  => 'footer#colophon .copyright_area p{color: value;}'
	'livepreview' => '$("footer#colophon .copyright_area p").css("color", value);'
) );

$footer->createOption(array(
	'name'			=> 'Text size',
	'id'			=> 'copyright_text_size',
	'type'			=> 'select',
	'options'		=> $font_sizes,
	'default'		=> '13px',
	'livepreview'	=> '$("footer#colophon .copyright_area p").css("font-size", value)',

));

$footer->createOption(array(
	'name'			=> 'Text transform',
	'id'			=> 'copyright_text_transform',
	'type'			=> 'select',
	'options'		=> array(
		
	),
));

// $footer->createOption(array(
// 	'name'			=> 'Text align',
// 	'id'			=> 'copyright_text_align',
// 	'type'			=> 'select',
// 	'options'		=> array(
// 		'left'	 => 'Left',
// 		'center' => 'Center',
// 		'right'	 => 'Right'
// 	),
// 	'default'		=> 'left',
// 	'livepreview'	=> '$(".copyright-area, .copyright_area p").css("text-align", value)'

// ));

$footer->createOption( array(
	'name'        => 'Copyright Text',
	'id'          => 'copyright_text',
	'type'        => 'textarea',
	'default'	=> 'Designed by <span style="color: #4dbac0;">ThimPress</span>. Powered by <span style="color: #4dbac0;">WordPress</span>',
	'livepreview' => '$(".copyright").html(function(){return "<p>"+ value + "</p>";})'
) );

$footer->createOption( array(
	'name' => 'Tracking Code',
	'id'   => 'tracking_code',
	'type' => 'textarea',
	'des'  => 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.'
) );

$footer->createOption( array(
	'name' => 'Back To Top',
	'id'   => 'show_to_top',
	'type' => 'checkbox',
	'des'  => 'show or hide back to top'
) );