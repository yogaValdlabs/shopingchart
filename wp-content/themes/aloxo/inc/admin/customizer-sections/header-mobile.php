<?php

// main menu

$header->addSubSection( array(
	'name'     =>  __('Mobile Menu','agapi'),
	'id'       => 'display_mobile_menu',
	'position' => 16,
) );


$header->createOption( array( "name"    => __("Background color","agapi"),
							  "desc"    => "Pick a background color for main menu",
							  "id"      => "bg_mobile_menu_color",
							  "default" => "#222",
							  "type"    => "color-opacity"
) );

$header->createOption( array( "name"    => __("Border color","agapi"),
							  "desc"    => "Pick a background color for main menu",
							  "id"      => "bg_mobile_border",
							  "default" => "#303030",
							  "type"    => "color-opacity"
) );

$header->createOption( array( "name"    => __("Text color","agapi"),
							  "desc"    => __("Pick a text color for main menu","agapi"),
							  "id"      => "mobile_menu_text_color",
							  "default" => "#a2a2a2",
							  "type"    => "color-opacity"
) );
$header->createOption( array( "name"    => __("Text color active","agapi"),
							  "desc"    => __("Pick a text active color for main menu","agapi"),
							  "id"      => "mobile_menu_text_hover_color",
							  "default" => "#01b888",
							  "type"    => "color-opacity"
) );


$header->createOption( array( "name"    => __("Font Size","agapi"),
							  "desc"    => "Default is 13",
							  "id"      => "font_size_mobile_menu",
							  "default" => "13px",
							  "type"    => "select",
							  "options" => $font_sizes
) );
