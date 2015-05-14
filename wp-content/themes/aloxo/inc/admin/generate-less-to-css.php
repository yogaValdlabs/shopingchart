<?php

/**
 * This class generates custom CSS into static CSS file in uploads folder
 * and enqueue it in the frontend
 *
 * CSS is generated only when theme options is saved (changed)
 * Works with LESS (for unlimited color schemes)
 *
 *
 */
require_once( TP_FRAMEWORK_LIBS_DIR . "less/lessc.inc.php" );
require_once( TP_THEME_DIR . "inc/admin/theme-options-to-css.php" );

function generate( $fileout, $type, $theme_option_variations ) {

	WP_Filesystem();
	global $wp_filesystem;

	$css   = "";
	$regex = array(
		"`^([\t\s]+)`ism"                       => '',
		"`^\/\*(.+?)\*\/`ism"                   => "",
		"`([\n\A;]+)\/\*(.+?)\*\/`ism"          => "$1",
		"`([\n\A;\s]+)//(.+?)[\n\r]`ism"        => "$1\n",
		"`(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+`ism" => "",
		"/\n/i"                                 => ""
	);

	$compiler = new lessc;


	$compiler->setFormatter( 'compressed' );
//    $css .= $compiler->compileFile(TP_THEME_DIR . 'less/style.less');

	$css .= $compiler->compileFile( TP_THEME_DIR . 'less/theme-options.less' );

	$css .= customcss();


	$css = preg_replace( array_keys( $regex ), $regex, $css );

//    // Bootstrap Generate
//    $bootstrap = $compiler->compileFile(TP_THEME_DIR . 'less/bootstrap.less');
//    if (!$wp_filesystem->put_contents(TP_THEME_DIR . 'css/bootstrap.min.css', $bootstrap, FS_CHMOD_FILE)) {
//        echo __LINE__ . _e("Can't write the file \"") . TP_THEME_DIR . 'css/bootstrap.min' . $type . "\"";
//    }

	// Bootstrap Generate
	$compare_style = $compiler->compileFile( TP_THEME_DIR . 'less/yith_compare.less' );
	if ( !$wp_filesystem->put_contents( TP_THEME_DIR . 'css/yith_compare.css', $compare_style, LOCK_EX ) ) {
		// echo __LINE__ . _e("Can't write the file \"") . TP_THEME_DIR . 'css/yith_compare' . $type . "\"";
		@chmod( TP_THEME_DIR . 'css/yith_compare.css', 0777 );
		file_put_contents( TP_THEME_DIR . 'css/yith_compare.css', $compare_style, LOCK_EX );
	}


	$style = $wp_filesystem->get_contents( TP_THEME_DIR . "inc/theme-info.txt" );

	// Determine whether Multisite support is enabled
	if ( is_multisite() ) {
		// Write Theme Info into style.css
		if ( !file_put_contents( $fileout . $type, $style, LOCK_EX ) ) {
			@chmod( $fileout . $type, 0777 );
			file_put_contents( $fileout . $type, $style, LOCK_EX );
		}

		// Write the rest to specific site style-ID.css
		$fileout = $fileout . '-' . get_current_blog_id();
		if ( !file_put_contents( $fileout . $type, $style . $css, LOCK_EX ) ) {
			@chmod( $fileout . $type, 0777 );
			file_put_contents( $fileout . $type, $style . $css, LOCK_EX );
		}
	} else {
		// If this is not multisite, we write them all in style.css file
		$style .= $css;
		if ( !file_put_contents( $fileout . $type, $style, LOCK_EX ) ) {
			@chmod( $fileout . $type, 0777 );
			file_put_contents( $fileout . $type, $style, LOCK_EX );
		}
	}
}