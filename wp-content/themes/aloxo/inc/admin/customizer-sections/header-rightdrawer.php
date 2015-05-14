<?php

// Right Drawer Options
$header->addSubSection( array(
	'name'     =>  __('Right Drawer','aloxo'),
	'id'       => 'display_right_drawer',
	'position' => 12,
) );


$header->createOption( array(
	'name'    => __( 'Show or Hide Right Drawer', 'aloxo' ),
	'id'      => 'show_drawer_right',
	'type'    => 'checkbox',
	"desc"    => "show/hide",
	'default' => false,
) );

$header->createOption( array(
	'name'        => __( 'Right Drawer Background color', 'aloxo' ),
	'id'          => 'bg_drawer_right_color',
	'type'        => 'color-opacity',
	'default'     => '#ffffff',
	'livepreview' => '$(".slider_sidebar").css("background-color", value);'
) );

$header->createOption( array(
	'name'        => __( 'Right Drawer Text Color', 'aloxo' ),
	'id'          => 'drawer_right_text_color',
	'type'        => 'color-opacity',
	'default'     => '#ffffff',
	'livepreview' => '$(".slider_sidebar,.slider_sidebar .widget-title,caption").css("color", value)'
) );

$header->createOption( array(
	'name'        => __( 'Right Drawer Link Color', 'aloxo' ),
	'id'          => 'drawer_right_link_color',
	'type'        => 'color-opacity',
	'default'     => '#ffffff',
	'livepreview' => '$(".slider_sidebar a").css("color", value)'
) );

$header->createOption( array(
	'name'    => __( 'Right Drawer Icon', 'aloxo' ),
	'id'      => 'icon_drawer_right',
	'type'    => 'text',
	'default' => 'fa-bars',
	"desc"    => "Enter FontAwesome icon name. For example: fa-bars, fa-user",
) );

$header->createOption( array(
	'name'        => __( 'Icon Right Drawer color', 'aloxo' ),
	'id'          => 'drawer_right_icon_color',
	'type'        => 'color-opacity',
	'default'     => '#555',
	'livepreview' => '$(".sliderbar-menu-controller > span").css("color", value);'
) );
