<?php
$woocommerce->addSubSection( array(
	'name'     => 'Product Page',
	'id'       => 'woo_single',
	'position' => 2,
) );

$woocommerce->createOption( array(
	'name'    => 'Select Layout Default',
	'id'      => 'woo_single_layout',
	'type'    => 'radio-image',
	'options' => array(
		'1col-fixed' => $url . 'body-full.png',
		'2c-l-fixed' => $url . 'sidebar-left.png',
		'2c-r-fixed' => $url . 'sidebar-right.png'
	),
	'default' => '2c-l-fixed',
) );

$woocommerce->createOption( array(
    'name' => 'Heading Style',
    'id' => 'woo_single_heading_style',
    'type' => 'select',
    'options' => array(
        'style-01' => 'Style 01',
        'style-02' => 'Style 02',
    ),
    'default' => 'style-01',
) );

// $woocommerce->createOption( array(
// 	'name'        => 'Content Background',
// 	'id'          => 'post_page_bg_content',
// 	'type'        => 'color-opacity',
// 	'default'     => '#fff',
// 	//'livepreview' => '$("body").css("background-color", value);'
// ) );

$woocommerce->createOption( array(
	'name'    => 'Hide Breadcrumbs?',
	'id'      => 'woo_single_hide_breadcrumbs',
	'type'    => 'checkbox',
	"desc"    => "Check this box to hide/unhide Breadcrumbs",
	'default' => false,
) );

$woocommerce->createOption( array(
	'name'    => 'Hide Title',
	'id'      => 'woo_single_hide_title',
	'type'    => 'checkbox',
	"desc"    => "Check this box to hide/unhide title",
	'default' => false,
) );

$woocommerce->createOption( array(
    'name' => 'Background Heading',
    'id' => 'woo_single_heading',
    'type' => 'select',
    'options' => array(
        'bg_color' => 'Background Color',
        'bg_img' => 'Background Image',
    ),
    'default' => 'bg_color',
) );

$woocommerce->createOption( array(
	'name'        => 'Background Heading Color',
	'id'          => 'woo_single_bg_color',
	'type'        => 'color-opacity',
	'default'     => '#008d71',
	'livepreview' => '',
) );

$woocommerce->createOption( array(
	'name'    => __( 'Background Heading Image', 'aloxo' ),
	'id'      => 'woo_single_bg_img',
	'type'    => 'upload',
	'desc'    => __( 'Upload your logo', 'aloxo' ),
	'default' => get_template_directory_uri( 'template_directory' ) . "/images/product_heading.jpg",
	//'livepreview' => '$(".no-sticky-logo img").attr("src", "' . wp_get_attachment_image_src( value, 'full' )[0] . '");'
) );

$woocommerce->createOption( array(
	'name'        => 'Text Color Heading',
	'id'          => 'woo_single_text_color',
	'type'        => 'color-opacity',
	'default'     => '#fff',
	'livepreview' => '',
) );

$woocommerce->createOption( array(
	'name'    => 'Height Heading',
	'id'      => 'woo_single_height_heading',
	'type'    => 'number',
	"desc"    => "Use a number without 'px', default is 100. ex: 100",
	'default' => '100',
	'max'     => '300',
	'min'     => '50',
) );