<?php
$font_sizes = array(
	'10px' => '10px',
	'11px' => '11px',
	'12px' => '12px',
	'13px' => '13px',
	'14px' => '14px',
	'15px' => '15px',
	'16px' => '16px',
	'17px' => '17px',
	'18px' => '18px',
	'19px' => '19px',
	'20px' => '20px',
	'21px' => '21px',
	'22px' => '22px',
	'23px' => '23px',
	'24px' => '24px',
	'25px' => '25px',
	'26px' => '26px',
	'27px' => '27px',
	'28px' => '28px',
	'29px' => '29px',
	'30px' => '30px',
	'31px' => '31px',
	'32px' => '32px',
	'33px' => '33px',
	'34px' => '34px',
	'35px' => '35px',
	'36px' => '36px',
	'37px' => '37px',
	'38px' => '38px',
	'39px' => '39px',
	'40px' => '40px',
	'41px' => '41px',
	'42px' => '42px',
	'43px' => '43px',
	'44px' => '44px',
	'45px' => '45px',
	'46px' => '46px',
	'47px' => '47px',
	'48px' => '48px',
	'49px' => '49px',
	'50px' => '50px',
);
/*
 * Creating a logo Options
 */
$logo = $titan->createThimCustomizerSection( array(
	'name'     => __( 'Logo', 'aloxo' ),
	'position' => 1,
) );

$logo->createOption( array(
	'name'    => __( 'Header Logo', 'aloxo' ),
	'id'      => 'logo',
	'type'    => 'upload',
	'desc'    => __( 'Upload your logo', 'aloxo' ),
	'default' => get_template_directory_uri( 'template_directory' ) . "/images/logo.png",
	//'livepreview' => '$(".no-sticky-logo img").attr("src", "' . wp_get_attachment_image_src( value, 'full' )[0] . '");'
) );

$logo->createOption( array(
	'name' => __( 'Sticky Logo', 'aloxo' ),
	'id'   => 'sticky_logo',
	'type' => 'upload',
	'default' => get_template_directory_uri( 'template_directory' ) . "/images/sticky_logo.png",
	'desc' => __( 'Upload your sticky logo', 'aloxo' ),
	//'livepreview' => '$(".sticky-logo img").attr("src",value);'
) );

$logo->createOption( array(
	'name'    => __( 'Width Logo', 'aloxo' ),
	'id'      => 'column_logo',
	'type'    => 'number',
	'default' => '2',
	'max'     => '12',
	'min'     => '1',
	'step'    => '1',
) );

$logo->createOption( array(
	'name' => __( 'Favicon Logo', 'aloxo' ),
	'id'   => 'favicon',
	'type' => 'upload',
	'default' => get_template_directory_uri( 'template_directory' ) . "/images/favicon.ico",
	'desc' => __( 'Upload your sticky logo', 'aloxo' ),
	//'livepreview' => '$(".sticky-logo img").attr("src",value);'
) );

/*
 * Creating a Header Options
 */

$header = $titan->createThimCustomizerSection( array(
	'name'     => __( 'Header', 'aloxo' ),
	'position' => 2,
	'id'       => 'display-header',
) );
