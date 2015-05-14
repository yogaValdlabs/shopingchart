<?php
$styling->addSubSection( array(
	'name'     => 'RTL Support & Disable Responsive',
	'id'       => 'styling_rtl',
	'position' => 15,
) );

$styling->createOption( array(
	'name'    => 'RTL Support',
	'id'      => 'rtl_support',
	'type'    => 'checkbox',
	"desc"    => "Enable/Disable",
	'default' => false,
) );
$styling->createOption( array(
	'name'    => 'Disable Responsive',
	'id'      => 'disable_responsive',
	'type'    => 'checkbox',
	"desc"    => "",
	'default' => false,
) );