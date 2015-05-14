<?php

$social_sharing = $titan->createThimCustomizerSection( array(
	'name'     => 'Social Sharing',
	'position' => 6,
) );

$social_sharing->createOption( array(
	'name' => 'Text',
	'id'   => 'text_social',
	'type' => 'text',
) );

//$social_sharing->createOption( array(
//	'name'    => 'Link Target',
//	'id'      => 'link_target',
//	'type'    => 'select',
//	'options' => array(
//		'_self'                    => 'Same window',
//		'_blank'      => 'New window',
// 	),
//	'default' => '_self',
//) );

$social_sharing->createOption( array(
	'name'    => 'Facebook',
	'id'      => 'sharing_facebook',
	'type'    => 'checkbox',
	"desc"    => "Show the facebook sharing option in blog posts.",
	'default' => true,
) );

$social_sharing->createOption( array(
	'name'    => 'Twitter',
	'id'      => 'sharing_twitter',
	'type'    => 'checkbox',
	"desc"    => "Show the twitter sharing option in blog posts.",
	'default' => true,
) );

$social_sharing->createOption( array(
	'name'    => 'LinkedIn',
	'id'      => 'sharing_linkedin',
	'type'    => 'checkbox',
	"desc"    => "Show the LinkIn sharing option in blog posts.",
	'default' => false,
) );

$social_sharing->createOption( array(
	'name'    => 'Tumblr',
	'id'      => 'sharing_tumblr',
	'type'    => 'checkbox',
	"desc"    => "Show the Tumblr sharing option in blog posts.",
	'default' => true,
) );

$social_sharing->createOption( array(
	'name'    => 'Google Plus',
	'id'      => 'sharing_google',
	'type'    => 'checkbox',
	"desc"    => "Show the g+ sharing option in blog posts.",
	'default' => true,
) );

$social_sharing->createOption( array(
	'name'    => 'Pinterest',
	'id'      => 'sharing_pinterest',
	'type'    => 'checkbox',
	"desc"    => "Show the pinterest sharing option in blog posts.",
	'default' => false,
) );

