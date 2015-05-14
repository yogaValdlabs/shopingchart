<?php

$header->addSubSection( array(
	'name'     => __( 'Header Layout', 'aloxo' ),
	'id'       => 'display_header_layout',
	'position' => 13,
) );

$header->createOption( array(
	'name'    => __( 'Select a Layout', 'aloxo' ),
	'id'      => 'header_style',
	'type'    => 'radio-image',
	'options' => array(
		"header_v1" => get_template_directory_uri( 'template_directory' ) . "/images/patterns/header1.jpg",
		"header_v2" => get_template_directory_uri( 'template_directory' ) . "/images/patterns/header2.jpg",
		"header_v3" => get_template_directory_uri( 'template_directory' ) . "/images/patterns/header3.jpg",
		// "header_v4" => get_template_directory_uri( 'template_directory' ) . "/images/patterns/header1.jpg",
		// "header_v5" => get_template_directory_uri( 'template_directory' ) . "/images/patterns/header2.jpg",
		// "header_v6" => get_template_directory_uri( 'template_directory' ) . "/images/patterns/header3.jpg",
		// "header_v7" => get_template_directory_uri( 'template_directory' ) . "/images/patterns/header1.jpg",
		// "header_v8" => get_template_directory_uri( 'template_directory' ) . "/images/patterns/header2.jpg",
		// "header_v9" => get_template_directory_uri( 'template_directory' ) . "/images/patterns/header3.jpg",
	),
	'default' => 'header_v2',
) );

$header->createOption( array(
	'name'    => __( 'Header Layout', 'aloxo' ),
	'id'      => 'header_layout',
	'type'    => 'select',
	'options' => array(
		'boxed' => __( 'Boxed', 'aloxo' ),
		'wide'  => __( 'Wide', 'aloxo' ),
	),
	'default' => 'wide',
) );

$header->createOption( array(
	'name'    => __( 'Header Position', 'aloxo' ),
	'id'      => 'header_position',
	'type'    => 'select',
	'options' => array(
		'' => __( 'Default', 'aloxo' ),
		'overlay_header'  => __( 'Overlay', 'aloxo' ),
		'header_after_slider'  => __( 'After Slider', 'aloxo' ),
	),
	'default' => '',
) );
//$header->createOption( array(
//	'name'    => __( 'Header Position', 'aloxo' ),
//	'id'      => 'header_position',
//	'type'    => 'select',
//	'options' => array(
//		''                    => __( 'Default', 'aloxo' ),
//		'overlay_header'      => __( 'Overlay', 'aloxo' ),
//		'header_after_slider' => __( 'After Slider', 'aloxo' ),
//	),
//	'default' => '',
//) );

$header->createOption( array(
	'name' => __( 'Margin Top', 'aloxo' ),
	'id'   => 'margin_header_top',
	'type' => 'number',
	'max'  => '100'
) );
