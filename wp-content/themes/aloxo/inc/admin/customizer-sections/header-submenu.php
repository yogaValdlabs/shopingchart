<?php

// main menu

$header->addSubSection( array(
	'name'     =>  __('Sub Menu','aloxo'),
	'id'       => 'display_sub_menu',
	'position' => 16,
) );


$header->createOption( array( "name"    => __("Background color","aloxo"),
							  "desc"    => "Pick a background color for sub menu",
							  "id"      => "bg_sub_menu_color",
							  "default" => "#222222",
							  "type"    => "color-opacity",
                              'livepreview' => '$("#main_menu li .sub-menu").css("background-color", value);
                                        $("#main_menu ul.navbar-nav>li.menu-item-has-children>ul.sub-menu").css("border-top-color", value)'
) );
$header->createOption( array( "name"    => __("Background color Hover","aloxo"),
							  "desc"    => "Pick a background color hover for sub menu",
							  "id"      => "bg_sub_menu_color_hover",
							  "default" => "#fff",
							  "type"    => "color-opacity"
) );

$header->createOption( array( "name"    => __("Color Border of Sub Menu","aloxo"),
							  "id"      => "border_sub_menu",
							  "default" => "#06191A",
							  "type"    => "color-opacity"
) );

$header->createOption( array( "name"    => __("Text color","aloxo"),
							  "desc"    => __("Pick a text color for sub menu","aloxo"),
							  "id"      => "sub_menu_text_color",
							  "default" => "#bababa",
							  "type"    => "color-opacity",
                              'livepreview' => '$("#main_menu li .sub-menu li a").css("color", value);'
) );
$header->createOption( array( "name"    => __("Text color hover","aloxo"),
							  "desc"    => __("Pick a text color hover for sub menu","aloxo"),
							  "id"      => "sub_menu_text_color_hover",
							  "default" => "#222222",
							  "type"    => "color-opacity"
) );