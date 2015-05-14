<?php
/*
 * Front page displays settings: Posts page
 */
$display->addSubSection( array(
	'name'     => 'Frontpage',
	'id'       => 'display_frontpage',
	'position' => 1,
) );

$display->createOption( array(
	'name'    => 'Select Layout Default',
	'id'      => 'front_page_layout',
	'type'    => 'radio-image',
	'options' => array(
		'1col-fixed' => $url . 'body-full.png',
       	'2c-l-fixed' => $url . 'sidebar-left.png',
       	'2c-r-fixed' => $url . 'sidebar-right.png',
       	'3c-fixed'   => $url . 'body-left-right.png',
       	'3c-r-fixed' => $url . 'body-cr.jpg'
	),
	'default' => '2c-l-fixed',
) );

$display->createOption( array(
    'name' => 'Select Layout',
    'id' => 'front_page_style_layout',
    'type' => 'select',
    'options' => array(
        'basic' => 'Basic',
        'masonry' => 'Masonry',
    ),
    'default' => 'basic',
) );

$display->createOption( array(
    'name' => 'Select Columns',
    'id' => 'front_page_style_columns',
    'type' => 'select',
    'desc' => 'This config will work for masonry layout',
    'options' => array(
        'col-2' => '2 Columns',
        'col-3' => '3 Columns',
        'col-4' => '4 Columns',
    ),
    'default' => 'col-2',
) );

$display->createOption( array(
	'name'    => 'Hide Title',
	'id'      => 'front_page_hide_title',
	'type'    => 'checkbox',
	"desc"    => "Check this box to hide/unhide title",
	'default' => false,
) );
$display->createOption( array(
	'name'    => 'Custom Title',
	'id'      => 'front_page_custom_title',
	'type'    => 'text',
	'default' => '',
) );

$display->createOption( array(
	'name'        => 'Content Background',
	'id'          => 'front_page_bg_content',
	'type'        => 'color-opacity',
	'default'     => '#fff',
	//'livepreview' => '$("body").css("background-color", value);'
) );

$display->createOption( array(
	'name'        => 'Background Heading',
	'id'          => 'front_page_bg_color',
	'type'        => 'color-opacity',
	'default'     => '#37c6ca',
	'livepreview' => '',
) );
$display->createOption( array(
	'name'        => 'Text Color Heading',
	'id'          => 'front_page_text_color',
	'type'        => 'color-opacity',
	'default'     => '#fff',
	'livepreview' => '',
) );
$display->createOption( array(
	'name'    => 'Height Heading',
	'id'      => 'front_page_height_heading',
	'type'    => 'number',
	"desc"    => "Use a number without 'px', default is 100. ex: 100",
	'default' => '100',
	'max'     => '300',
	'min'     => '50',
) );

$display->createOption( array(
	'name'    => 'Select Paging Style',
	'id'      => 'front_page_paging_style',
	'type'    => 'select',
	'options' => array(
		'paging'=> 'Paging', 
        'btn_load_more'=> 'Button Load More',
        'scroll' => 'Infinite Scroll',
 	),
	'default'=>'paging'
) );