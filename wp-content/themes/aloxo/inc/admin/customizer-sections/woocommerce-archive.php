<?php
$woocommerce->addSubSection( array(
	'name'     => 'Category Products',
	'id'       => 'woo_archive',
	'position' => 1,
 ) );
$woocommerce->createOption( array(
	'name'    => 'Archive Layout',
	'id'      => 'woo_cate_layout',
	'type'    => 'radio-image',
	'options' => array(
		'1col-fixed' => $url . 'body-full.png',
       	'2c-l-fixed' => $url . 'sidebar-left.png',
       	'2c-r-fixed' => $url . 'sidebar-right.png'
 	),
	'default'=>'2c-l-fixed'
) );

$woocommerce->createOption( array(
    'name' => 'Number of Products per Page',
    'id' => 'woo_product_per_page',
    'type' => 'number',
    'desc' => 'Insert the number of posts to display per page.',
    'default' => '8',
    'max' => '100',
) );

$woocommerce->createOption( array(
    'name' => 'Heading Style',
    'id' => 'woo_cate_heading_style',
    'type' => 'select',
    'options' => array(
        'style-01' => 'Style 01',
        'style-02' => 'Style 02',
    ),
    'default' => 'style-01',
) );

// $woocommerce->createOption( array(
// 	'name'        => 'Top Image',
// 	'id'          => 'top_image_archive',
// 	'type'        => 'upload',
// 	'desc'=>'Enter URL or Upload an top image file for header',
// 	'livepreview' => ''
// ) );

$woocommerce->createOption( array(
	'name'    => 'Hide Breadcrumbs?',
	'id'      => 'woo_cate_hide_breadcrumbs',
	'type'    => 'checkbox',
	"desc"    => "Check this box to hide/unhide Breadcrumbs",
	'default' => false,
) );

$woocommerce->createOption( array(
	'name'    => 'Hide Title',
	'id'      => 'woo_cate_hide_title',
	'type'    => 'checkbox',
	"desc"    => "Check this box to hide/unhide title",
	'default' => false,
) );

$woocommerce->createOption( array(
    'name' => 'Background Heading',
    'id' => 'woo_cate_heading',
    'type' => 'select',
    'options' => array(
        'bg_color' => 'Background Color',
        'bg_img' => 'Background Image',
    ),
    'default' => 'bg_color',
) );

$woocommerce->createOption( array(
	'name'        => 'Background Heading Color',
	'id'          => 'woo_cate_heading_bg_color',
	'type'        => 'color-opacity',
	'default'     => '#008d71',
	'livepreview' => ''
) );

$woocommerce->createOption( array(
	'name'    => __( 'Background Heading Image', 'aloxo' ),
	'id'      => 'woo_cate_heading_bg_img',
	'type'    => 'upload',
	'desc'    => __( 'Upload your logo', 'aloxo' ),
	'default' => get_template_directory_uri( 'template_directory' ) . "/images/product_heading.jpg",
	//'livepreview' => '$(".no-sticky-logo img").attr("src", "' . wp_get_attachment_image_src( value, 'full' )[0] . '");'
) );

$woocommerce->createOption( array(
	'name'        => 'Text Color Heading',
	'id'          => 'woo_cate_heading_text_color',
	'type'        => 'color-opacity',
	'default'     => '#fff',
	//'livepreview' => '$("body").css("background-color", value);'
) );

// $woocommerce->createOption( array(
// 	'name'        => 'Text Color Heading',
// 	'id'          => 'archive_text_color',
// 	'type'        => 'color-opacity',
// 	'default'     => '#fff',
// 	'livepreview' => ''
// ) );

$woocommerce->createOption( array(
	'name'    => 'Height Heading',
	'id'      => 'woo_cate_height_heading',
	'type'    => 'number',
	"desc" => "Use a number without 'px', default is 100. ex: 100",
	'default' => '100',
	'max'     => '300',
	'min'=>'50',
) );
