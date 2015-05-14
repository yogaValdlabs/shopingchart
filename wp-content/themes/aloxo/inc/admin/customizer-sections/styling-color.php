<?php
$styling->addSubSection( array(
	'name'     => 'Background Color & Text Color',
	'id'       => 'styling_color',
	'position' => 13,
) );


$styling->createOption( array(
	'name'        => 'Body Background Color',
	'id'          => 'body_bg_color',
	'type'        => 'color-opacity',
	'default'     => '#000',
	//'css'		  => 'body{background:value; }',
	'livepreview' => '$("body").css("background-color", value);'
) );

$styling->createOption( array(
	'name'        => 'Theme Primary Color',
	'id'          => 'body_primary_color',
	'type'        => 'color-opacity',
	'default'     => '#01b888',
	'livepreview' => '
		$(".bg-color-primary .sc-testimonials ul#testimonials li #testimonial-scrollbar a").css("background-color", value);
 	'
) );

// $styling->createOption( array(
// 	'name'        => 'Text Color',
// 	'id'          => 'body_text_color',
// 	'type'        => 'color-opacity',
// 	'default'     => '#0e2a36',
// 	'livepreview' => '
// 		$(".our-team-title").css("background-color", value);
//  	'
// ) );