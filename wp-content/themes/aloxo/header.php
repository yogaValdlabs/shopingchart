<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package aloxo
 */
global $theme_options_data;
?><!DOCTYPE html>
<html <?php language_attributes(); ?><?php if ( isset( $theme_options_data['thim_rtl_support'] ) && $theme_options_data['thim_rtl_support'] == '1' ) {
	echo "dir=\"rtl\"";
} ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php
	if ( isset( $theme_options_data['thim_disable_responsive'] ) && $theme_options_data['thim_disable_responsive'] != '1' ) {
		echo '	<meta name="viewport" content="width=device-width, initial-scale=1">';
	}
	?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">

	<?php

	$class_header = '';

	if ( isset( $theme_options_data['thim_rtl_support'] ) && $theme_options_data['thim_rtl_support'] == '1' ) {
		$class_header .= 'rtl';
	}
	if ( !isset( $theme_options_data['thim_header_style'] ) ) {
		$theme_options_data['thim_header_style'] = "header_v1";
	}

	if ( isset( $theme_options_data['thim_header_style'] ) ) {
		$class_header .= $theme_options_data['thim_header_style'];
	}
	?>
	<?php
	$favicon_id = $theme_options_data['thim_favicon'];
	// The value may be a URL to the image (for the default parameter)
	// or an attachment ID to the selected image.
	$favicon_src = $favicon_id; // For the default value
	if ( is_numeric( $favicon_id ) ) {
		$imageAttachment = wp_get_attachment_image_src( $favicon_id );
		$favicon_src     = $imageAttachment[0];
	}
	?>
	<link rel="shortcut icon" href=" <?php
	if ( isset( $theme_options_data['thim_favicon'] ) ) {
		echo esc_url( $favicon_src );
	} else {
		echo esc_url( get_template_directory_uri() . "/images/favicon.ico" );
	}
	?>" type="image/x-icon" />


	<!-- <link rel="shortcut icon" href="<?php //echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" /> -->
	<?php
	wp_head();
	?>
</head>

<body <?php body_class( $class_header ); ?>>
<!-- menu for mobile-->
<div id="wrapper-container" class="wrapper-container">
	<div class="content-pusher">
		<!-- Preloader Start-->
		<?php if ( isset( $theme_options_data['show_perload'] ) && $theme_options_data['show_perload'] ) {
			echo "
	<div id='preload'>
		<i class='fa fa-spinner fa-spin'></i>
	</div>";
		} ?>
		<!-- Preloader End -->
		<?php if ( isset( $theme_options_data['thim_show_drawer_right'] ) && $theme_options_data['thim_show_drawer_right'] == '1' && is_active_sidebar( 'drawer_right' ) ) { ?>
			<div class="slider_sidebar">
				<?php dynamic_sidebar( 'drawer_right' ); ?>
			</div>  <!--slider_sidebar-->
		<?php } ?>

		<nav class="visible-xs mobile-menu-container mobile-effect" role="navigation">
			<?php get_template_part( 'inc/header/mobile-menu' ); ?>
		</nav>

		<?php
		// drawer
		if ( isset( $theme_options_data['thim_show_drawer'] ) && $theme_options_data['thim_show_drawer'] == '1' && is_active_sidebar( 'drawer_top' ) ) {
			get_template_part( 'inc/header/drawer' );
		}
		//header
		if ( isset( $theme_options_data['thim_header_style'] ) && $theme_options_data['thim_header_style'] == 'header_v1' ) {
			get_template_part( 'inc/header/header_1' );
		} elseif ( isset( $theme_options_data['thim_header_style'] ) && $theme_options_data['thim_header_style'] == 'header_v2' ) {
			get_template_part( 'inc/header/header_2' );
		} elseif ( isset( $theme_options_data['thim_header_style'] ) && $theme_options_data['thim_header_style'] == 'header_v3' ) {
			get_template_part( 'inc/header/header_3' );
		} else {
			get_template_part( 'inc/header/header_4' );
		}
		//var_dump($theme_options_data['thim_box_layout']);
		?>
		<div id="wrapper" <?php if ( isset( $theme_options_data['thim_box_layout'] ) && $theme_options_data['thim_box_layout'] == "boxed" ) {
			echo 'class="boxed_area"';
		} ?>>
			<!-- #masthead -->
			<div id="content" class="site-content">