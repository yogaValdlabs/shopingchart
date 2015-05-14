<?php

if ( !defined( 'WP_LOAD_IMPORTERS' ) ) {
	define( 'WP_LOAD_IMPORTERS', true );
}

define( 'POST_COUNT', TP_THEME_DIR . 'inc/admin/data/cache/count.txt' );
define( 'MENU_MAPPING', TP_THEME_DIR . 'inc/admin/data/cache/menus.txt' );
define( 'MENU_ITEM_ORPHANS', TP_THEME_DIR . 'inc/admin/data/cache/menu_item_orphans.txt' );
define( 'PROCESS_TERM', TP_THEME_DIR . 'inc/admin/data/cache/process_term.txt' );
define( 'PROCESS_POSTS', TP_THEME_DIR . 'inc/admin/data/cache/process_posts.txt' );
define( 'MENU_MISSING', TP_THEME_DIR . 'inc/admin/data/cache/menu_missing.txt' );
define( 'URL_REMAP', TP_THEME_DIR . 'inc/admin/data/cache/url_remap.txt' );
define( 'POST_ORPHANS', TP_THEME_DIR . 'inc/admin/data/cache/post_orphans.txt' );
define( 'FEATURE_IMAGES', TP_THEME_DIR . 'inc/admin/data/cache/feature_images.txt' );
define( 'REV_IMPORT', TP_THEME_DIR . 'inc/admin/data/cache/rev.txt' );
define( 'MENU_CONFIG', TP_THEME_DIR . 'inc/admin/data/menus.txt' );
define( 'MENU_READING_CONFIG', TP_THEME_DIR . 'inc/admin/data/menu_reading.txt' );


// Load Importer API
require_once ABSPATH . 'wp-admin/includes/import.php';
if ( file_exists( ABSPATH . 'wp-content/plugins/revslider/revslider_admin.php' ) && class_exists( 'UniteBaseAdminClassRev' ) ) {
	require_once( ABSPATH . 'wp-content/plugins/revslider/revslider_admin.php' );
}
$tp_importerError   = false;
$import_filepath    = TP_THEME_DIR . 'inc/admin/data/demodata.xml';
$import_settingpath = TP_THEME_DIR . 'inc/admin/data/setting.json';
$import_woo_setting = TP_THEME_DIR . 'inc/admin/data/woocommerce/setting.txt';
//check if wp_importer, the base importer class is available, otherwise include it
if ( !class_exists( 'WP_Importer' ) ) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	if ( file_exists( $class_wp_importer ) ) {
		require_once( $class_wp_importer );
	} else {
		$tp_importerError = true;
	}
}

//check if the wp import class is available, this class handles the wordpress XML files. If not include it
//make sure to exclude the init function at the end of the file in kriesi_importer
if ( !class_exists( 'WP_Import' ) ) {
	$class_wp_import = TP_FRAMEWORK_LIBS_DIR . 'import/wordpress-importer.php';
	if ( file_exists( $class_wp_import ) ) {
		require_once( $class_wp_import );
	} else {
		$tp_importerError = true;
	}
}

if ( $tp_importerError !== false ) {
	echo "The Auto importing script could not be loaded. please use the wordpress importer and import the XML file that is located in your themes folder manually.";
} else {
	if ( class_exists( 'WP_Import' ) ) {
		include_once( TP_FRAMEWORK_LIBS_DIR . 'import/tp-import-class.php' );
	}


	//if (!is_file($import_filepath) || !is_file($import_settingpath)) {
	if ( !is_file( $import_filepath ) ) {

		echo ent2ncr($import_filepath);
		echo "The XML file containing the demo content is not available or could not be read in <pre>" . get_template_directory() . "</pre><br/> You might want to try to set the file permission to chmod 777.<br/>If this doesn't work please use the wordpress importer and import the XML file (should be located in your themes folder: dummy.xml) manually <a href='/wp-admin/import.php'>here.</a>";
	} else {
		if ( !isset( $custom_export ) ) {

			$wp_import = new ob_wp_import();
			$type      = $_REQUEST['type'];

			ob_start();
			switch ( trim( $type ) ) {
				case 'woo_setting':
					if ( is_file( $import_woo_setting ) ) {
						if ( !$wp_import->import_woosetting( $import_woo_setting ) ) {
							ob_end_clean();
							echo ent2ncr($return->get_error_message());

							return;
						}
					}
					ob_end_clean();
					echo 'core';

					break;
				case 'core':
					$wp_import->fetch_attachments = true;
					if ( $wp_import->import( $import_filepath ) == 0 ) {
                        //ob_end_clean();
						echo 'core';

						return;
					}
					ob_end_clean();
					echo 'widgets';

					break;

				case 'menus':
					if ( !$wp_import->set_menus() ) {
						ob_end_clean();
						echo 'error';
					} else {
						ob_end_clean();
						echo 'slider';
					}
					break;

				case 'widgets':
					$widgets_json = TP_THEME_DIR . 'inc/admin/data/widget/widget_data.json'; // widgets data file

					$widgets_json = file_get_contents( $widgets_json );

					if ( !$wp_import->import_widgets( $widgets_json ) ) {
						ob_end_clean();
						echo 'error';
					} else {
						ob_end_clean();
						echo 'setting';
					}
					break;				
				case 'setting':
					if ( !$wp_import->set_options( $import_settingpath ) ) {
						ob_end_clean();
						echo 'error';
					} else {
						$wp_import->updateTaxCount();
						ob_end_clean();
						//$wp_import->updateTaxCount();
						echo 'menus';
					}
					break;
                case 'slider':
					$check_slider = $wp_import->import_revslider();
					if ( !$check_slider ) {
						ob_end_clean();
						if (class_exists('RevSlider')) {
                            echo 'revolution_error';
                        }
                        else{ 
                            echo 'done';
                        }
					} elseif ( $check_slider == 1 ) {
						ob_end_clean();
						echo 'slider';
					} else {
						ob_end_clean();
						echo 'done';
					}
					break;
			}
		}
	}
}




