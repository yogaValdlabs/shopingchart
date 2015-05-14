<?php

// main menu

$header->addSubSection(array(
    'name' => __('Main Menu', 'aloxo'),
    'id' => 'display_main_menu',
    'position' => 15,
));


$header->createOption(array("name" => __("Background color", "aloxo"),
    "desc" => "Pick a background color for main menu",
    "id" => "bg_main_menu_color",
    "default" => "#fff",
    "type" => "color-opacity",
    'livepreview' => '$(".navigation").css("background-color", value);'

));
$header->createOption(array("name" => __("Color Border of Top Menu", "aloxo"),
    "id" => "border_main_menu",
    "default" => "#37c6ca",
    "type" => "color-opacity",
    'livepreview' => '$(".navigation").css("border-top-color", value);'
));
//$header->createOption( array( "name"    => __("Background Opacity","aloxo"),
//							  "desc"    => "Value in [0,1]",
//							  "id"      => "bg_main_menu_opacity",
//							  "default" => "0.3",
//							  "type"    => "text"
//) );

$header->createOption(array("name" => __("Text color", "aloxo"),
    "desc" => __("Pick a text color for main menu", "aloxo"),
    "id" => "main_menu_text_color",
    "default" => "#0e2a36",
    "type" => "color-opacity"
));
$header->createOption(array("name" => __("Text Hover color", "aloxo"),
    "desc" => __("Pick a text hover color for main menu", "aloxo"),
    "id" => "main_menu_text_hover_color",
    "default" => "#01b888",
    "type" => "color-opacity"
));

$header->createOption(array("name" => __("Background Text Hover/Active Color", "aloxo"),
    "desc" => "Pick a background color for main menu",
    "id" => "main_menu_text_hover_bg_color",
    "default" => "",
    "type" => "color-opacity"
));

$header->createOption(array("name" => __("Top Border Hover/Active Color", "aloxo"),
    "desc" => "Pick a background color for main menu",
    "id" => "main_menu_text_hover_border_color",
    "default" => "",
    "type" => "color-opacity"
));

$header->createOption(array("name" => __("Top Border Color for Submenu", "aloxo"),
    "desc" => "Pick a background color for main menu",
    "id" => "sub_menu_border_top_color",
    "default" => "",
    "type" => "color-opacity"
));

// $header->createOption( array( "name"    => __("Background Sub menu","aloxo"),
// 							  "desc"    => __("Pick a background color for sub menu","agap"),
// 							  "id"      => "bg_sub_menu",
// 							  "default" => "#0e2a36",
// 							  "type"    => "color-opacity"
// ) );

//$header->createOption( array( "name"    => __("Opacity Hover","aloxo"),
//							  "desc"    => "Value in [0,1]",
//							  "id"      => "opacity_parent_menu",
//							  "default" => "0.3",
//							  "type"    => "text"
//) );

$header->createOption(array("name" => __("Font Size", "aloxo"),
    "desc" => "Default is 13",
    "id" => "font_size_main_menu",
    "default" => "13px",
    "type" => "select",
    "options" => $font_sizes
));

//$header->createOption( array( "name"    => __("Font Weight","aloxo"),
//							  "desc"    => "Default bold",
//							  "id"      => "font_weight_main_menu",
//							  "default" => "400",
//							  "type"    => "select",
//							  "options" => array( 'bold' => 'Bold', 'normal' => 'Normal', '100' => '100', '200' => '200', '300' => '300', '400' => '400', '500' => '500', '600' => '600', '700' => '700', '800' => '800', '900' => '900' ),
//) );
$header->createOption(array(
    'name' => __('Text  Hover Opacity', 'aloxo'),
    'id' => 'opacity_parent_menu',
    'type' => 'number',
    'default' => '100',
    'max' => '100',
    'min' => '0',
    'step' => '1',
    'desc' => 'Opacity of another item in menu when hover to one item.',
    // 'livepreview' => '$(".top-left").css("width", value +"%");
    // 		$(".top-right").css("width", ( 100 - value ) +"%")'
));