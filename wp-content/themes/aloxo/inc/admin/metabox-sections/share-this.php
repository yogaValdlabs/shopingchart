<?php
$share_setting = $titan->createMetaBox( array(
	'name'      => 'Share This and Number Related',
	'post_type' => array( 'post', ),
) );
$share_setting->createOption( array(
	'name'    => __( 'Number Related', 'aloxo' ),
	'id'      => 'number_related',
	'type'    => 'text',
	'default' => 4,
) );

$share_setting->createOption( array(
	'name' => __( 'Text Social', 'aloxo' ),
	'id'   => 'text_share_this',
	'type' => 'text',
) );
$share_setting->createOption( array(
	'name'    => __( 'Face', 'aloxo' ),
	'id'      => 'share_one_face',
	'type'    => 'checkbox',
	'desc'    => ' ',
	'default' => true,
) );
$share_setting->createOption( array(
	'name'    => __( 'Twitter', 'aloxo' ),
	'id'      => 'share_one_twitter',
	'type'    => 'checkbox',
	'desc'    => ' ',
	'default' => true,
) );
$share_setting->createOption( array(
	'name'    => __( 'Google', 'aloxo' ),
	'id'      => 'share_one_google_plus',
	'type'    => 'checkbox',
	'desc'    => ' ',
	'default' => true,
) );
$share_setting->createOption( array(
	'name'    => __( 'Tumblr', 'aloxo' ),
	'id'      => 'share_one_tumblr',
	'type'    => 'checkbox',
	'desc'    => ' ',
	'default' => true,
) );