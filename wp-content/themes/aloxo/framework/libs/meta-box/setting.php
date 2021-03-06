<?php
$url = TP_THEME_URI . 'images/admin/layout/';

$mtb_setting = $titan->createMetaBox( array(
	'name'      => 'Display Setting',
	'post_type' => array( 'page', 'post', 'portfolio', 'product'),
) );

$mtb_setting->createOption( array(
	'name' => __( 'Custom Featured Title Area', 'thim' ),
	'type' => 'heading'
) );

$mtb_setting->createOption( array(
	'name' => __( 'Using Custom Featured Title Area?', 'thim' ),
	'id'   => 'mtb_using_custom_heading',
	'type' => 'checkbox',
	'desc' => ' '
) );


$mtb_setting->createOption( array(
	'name' => __( 'Custom Title and Subtitle', 'thim' ),
	'type' => 'heading',
) );

$mtb_setting->createOption( array(
	'name' => __( 'Hide Title and Subtitle', 'thim' ),
	'id'   => 'mtb_hide_title_and_subtitle',
	'type' => 'checkbox',
	'desc' => ' '
) );

$mtb_setting->createOption( array(
	'name' => __( 'Custom Title', 'thim' ),
	'id'   => 'mtb_custom_title',
	'type' => 'text',
	'desc' => __( 'Leave empty to use post title', 'thim' )
) );

$mtb_setting->createOption( array(
	'name' => __( 'Subtitle', 'thim' ),
	'id'   => 'subtitle',
	'type' => 'text'
) );

$mtb_setting->createOption( array(
	'name' => 'Hide Breadcrumbs?',
	'id'   => 'mtb_hide_breadcrumbs',
	'type' => 'checkbox',
	"desc" => "Check this box to hide/unhide Breadcrumbs"
) );

$mtb_setting->createOption( array(
	'name' => __( 'Custom Heading Background', 'thim' ),
	'id'	=> 'custom_heading_bg',
	'type' => 'heading'
) );

$mtb_setting->createOption( array(
	'name' => 'Top Image',
	'id'   => 'mtb_top_image',
	'type' => 'upload',
	'desc' => 'Upload your top image'
) );

$mtb_setting->createOption( array(
	'name' => __( 'Background', 'thim' ),
	'id'   => 'mtb_bg_color',
	'type' => 'color'
) );

$mtb_setting->createOption( array(
	'name' => __( 'Text Color Featured Title', 'thim' ),
	'id'   => 'mtb_text_color',
	'type' => 'color'
) );

$mtb_setting->createOption( array(
	'name'    => __( 'Height Custom Heading ', 'thim' ),
	'id'      => 'mtb_height_heading',
	'type'    => 'number',
	"desc"    => "Use a number custom heading (px) default is 100. ex: 100",
	'default' => '100',
	'max'     => '300',
	'min'     => '0',
) );

$mtb_setting->createOption( array(
	'name' => __( 'Custom Layout', 'thim' ),
	'type' => 'heading'
) );

$mtb_setting->createOption( array(
	'name' => __( 'Use Custom Layout?', 'thim' ),
	'id'   => 'mtb_custom_layout',
	'type' => 'checkbox',
	'desc' => ' '
) );

$mtb_setting->createOption( array(
	'name'    => 'Layout Style',
	'id'      => 'mtb_layout_style',
	'type'    => 'radio-image',
	'options' => array(
		'wide'  => $url . 'body-full.png',
		'boxed' => $url . 'content-boxed.jpg',
	),
) );

$mtb_setting->createOption( array(
	'name'    => 'Select Layout',
	'id'      => 'mtb_layout',
	'type'    => 'radio-image',
	'options' => array(
		'full-content'  => $url . 'body-full.png',
		'sidebar-left'  => $url . 'sidebar-left.png',
		'sidebar-right' => $url . 'sidebar-right.png'
	),
	'default' => 'sidebar-left',
	'desc'    => '(* only be used with <b> content boxed </b> layout )'
) );
$mtb_setting->createOption( array(
    'name' => 'Custom Background Content Boxed',
    'id' => 'mtb_bg_content_boxed',
    'type' => 'color',
    'desc' => 'Pick a color',
    'default' => '#555555',
) );