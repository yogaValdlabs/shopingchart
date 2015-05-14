<?php

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.3.6
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once TP_FRAMEWORK_LIBS_DIR . 'class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'tp_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function tp_register_required_plugins() {
	$plugins = array(
//              example
        array(
            'name' => 'Regenerate Thumbnails', // The plugin name
            'slug' => 'regenerate-thumbnails', // The plugin slug (typically the folder name)
            'source' => 'http://downloads.wordpress.org/plugin/regenerate-thumbnails.zip', // The plugin source
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version'            => '2.2.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'               => 'Thim Portfolio', // The plugin name
            'slug'               => 'thim-portfolio', // The plugin slug (typically the folder name)
            'source'             => get_template_directory() . '/inc/plugins/thim-portfolio.zip', // The plugin source
            'required'           => false, // If false, the plugin is only 'recommended' instead of required
            'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'               => 'WooCommerce Sales Countdown', // The plugin name
            'slug'               => 'woosalescountdown', // The plugin slug (typically the folder name)
            'version'            => '1.8.6',
            'source'             => get_template_directory() . '/inc/plugins/woosalescountdown.zip', // The plugin source
            'required'           => false, // If false, the plugin is only 'recommended' instead of required
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'               => 'Contact Form 7', // The plugin name
            'slug'               => 'contact-form-7', // The plugin slug (typically the folder name)
            'source'             => 'https://downloads.wordpress.org/plugin/contact-form-7.4.1.zip', // The plugin source
            'version'            => '4.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'required'           => false, // If false, the plugin is only 'recommended' instead of required
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'               => 'MailChimp for WordPress', // The plugin name
            'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
            'version'            => '2.2.5',
            'source'             => 'https://downloads.wordpress.org/plugin/mailchimp-for-wp.2.2.5.zip', // The plugin source
            'required'           => false, // If false, the plugin is only 'recommended' instead of required
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'               => 'WooCommerce', // The plugin name
            'slug'               => 'woocommerce', // The plugin slug (typically the folder name)
            'version'            => '2.3.5',
            'source'             => 'https://downloads.wordpress.org/plugin/woocommerce.2.3.5.zip', // The plugin source
            'required'           => false, // If false, the plugin is only 'recommended' instead of required
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'               => 'YITH Woocommerce Compare', // The plugin name
            'slug'               => 'yith-woocommerce-compare', // The plugin slug (typically the folder name)
            'version'            => '1.2.3',
            'source'             => 'https://downloads.wordpress.org/plugin/yith-woocommerce-compare.1.2.3.zip', // The plugin source
            'required'           => false, // If false, the plugin is only 'recommended' instead of required
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'               => 'YITH WooCommerce Wishlist', // The plugin name
            'slug'               => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
            'version'            => '2.0.3',
            'source'             => 'https://downloads.wordpress.org/plugin/yith-woocommerce-wishlist.2.0.3.zip', // The plugin source
            'required'           => false, // If false, the plugin is only 'recommended' instead of required
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
        ),
		array(
			'name' => 'Visual Composer', // The plugin name
			'slug' => 'js_composer', // The plugin slug (typically the folder name)
			'source' => get_template_directory() . '/inc/plugins/js_composer.zip', // The plugin source
			'required' => true, // If false, the plugin is only 'recommended' instead of required
			'version' => '4.4.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name' => 'Revolution Slider', // The plugin name
			'slug' => 'revslider', // The plugin slug (typically the folder name)
			'source' => get_template_directory() . '/inc/plugins/revslider.zip', // The plugin source
			'required' => true, // If false, the plugin is only 'recommended' instead of required
			'version' => '4.5.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => '', // If set, overrides default API URL and points to an external URL
		),
        array(
			'name' => 'Widget Logic', // The plugin name
			'slug' => 'widget-logic', // The plugin slug (typically the folder name)
			'source' => 'https://downloads.wordpress.org/plugin/widget-logic.0.57.zip', // The plugin source
			'required' => false, // If false, the plugin is only 'recommended' instead of required
			'version' => '0.57', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => '', // If set, overrides default API URL and points to an external URL
		),
        array(
            'name' => 'WooCommerce Quantity Increment', // The plugin name
            'slug' => 'woocommerce-quantity-increment', // The plugin slug (typically the folder name)
            'source' => 'https://downloads.wordpress.org/plugin/woocommerce-quantity-increment.1.0.0.zip', // The plugin source
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        )
    );
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */


//    global $aloxo_data;
//    $plugin = array();
//    for ($i = 0; $i < count($plugins_support); $i ++) {
//        $slug_name = $plugins_support[$i]['slug'];
//        if (!isset($aloxo_data[$slug_name]) || (isset($aloxo_data[$slug_name]) && $aloxo_data[$slug_name])) {
//            $plugin[] = $plugins_support[$i];
//        }
//    }
//
//    $plugins = array_merge($plugins_require, $plugin);

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain' => 'aloxo', // Text domain - likely want to be the same as your theme.
        'default_path' => '', // Default absolute path to pre-packaged plugins
        'parent_menu_slug' => 'themes.php', // Default parent menu slug
        'parent_url_slug' => 'themes.php', // Default parent URL slug
        'menu' => 'install-required-plugins', // Menu slug
        'has_notices' => true, // Show admin notices or not
        'is_automatic' => false, // Automatically activate plugins after installation or not
        'message' => '', // Message to output right before the plugins table
        'strings' => array(
            'page_title' => __('Install Required Plugins', 'aloxo'),
            'menu_title' => __('Install Plugins', 'aloxo'),
            'installing' => __('Installing Plugin: %s', 'aloxo'), // %1$s = plugin name
            'oops' => __('Something went wrong with the plugin API.', 'aloxo'),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s)
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s)
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s)
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s)
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins'),
            'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins'),
            'return' => __('Return to Required Plugins Installer', 'aloxo'),
            'plugin_activated' => __('Plugin activated successfully.', 'aloxo'),
            'complete' => __('All plugins installed and activated successfully. %s', 'aloxo'), // %1$s = dashboard link
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );
	tgmpa( $plugins, $config );
}
