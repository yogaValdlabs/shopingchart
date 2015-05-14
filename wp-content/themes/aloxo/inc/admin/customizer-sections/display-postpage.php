<?php
/*
 * Post and Page Display Settings
 */
$display->addSubSection( array(
	'name'     => 'Post & Page',
	'id'       => 'display_postpage',
	'position' => 3,
) );

$display->createOption( array(
	'name'    => 'Select Layout Default',
	'id'      => 'post_page_layout',
	'type'    => 'radio-image',
	'options' => array(
		'1col-fixed' => $url . 'body-full.png',
		'2c-l-fixed' => $url . 'sidebar-left.png',
		'2c-r-fixed' => $url . 'sidebar-right.png'
	),
	'default' => '2c-l-fixed',
) );

$display->createOption( array(
	'name'        => 'Content Background',
	'id'          => 'post_page_bg_content',
	'type'        => 'color-opacity',
	'default'     => '#fafafa',
	//'livepreview' => '$("body").css("background-color", value);'
) );

$display->createOption( array(
	'name'    => 'Hide Breadcrumbs?',
	'id'      => 'post_page_hide_breadcrumbs',
	'type'    => 'checkbox',
	"desc"    => "Check this box to hide/unhide Breadcrumbs",
	'default' => false,
) );

$display->createOption( array(
	'name'    => 'Hide Title',
	'id'      => 'post_page_hide_title',
	'type'    => 'checkbox',
	"desc"    => "Check this box to hide/unhide title",
	'default' => false,
) );

$display->createOption( array(
	'name'        => 'Top Image',
	'id'          => 'post_page_top_image',
	'type'        => 'upload',
	'desc'        => 'Enter URL or Upload an top image file for header',
	'livepreview' => '',
) );

$display->createOption( array(
	'name'        => 'Background Heading',
	'id'          => 'post_page_bg_color',
	'type'        => 'color-opacity',
	'default'     => '#37c6ca',
	'livepreview' => '',
) );

$display->createOption( array(
	'name'        => 'Text Color Heading',
	'id'          => 'post_page_text_color',
	'type'        => 'color-opacity',
	'default'     => '#fff',
	'livepreview' => '',
) );

$display->createOption( array(
	'name'    => 'Height Heading',
	'id'      => 'post_page_height_heading',
	'type'    => 'number',
	"desc"    => "Use a number without 'px', default is 100. ex: 100",
	'default' => '100',
	'max'     => '300',
	'min'     => '50',
) );
$display->createOption( array(
	'name'    => 'About Author',
	'id'      => 'hide_about_author',
	'type'    => 'checkbox',
	"desc"    => "Check this box to Show/Hide About Author",
	'default' => true,
) );