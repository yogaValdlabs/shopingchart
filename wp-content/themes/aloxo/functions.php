<?php
/**
 * aloxo functions and definitions
 *
 * @package aloxo
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'aloxo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function aloxo_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on aloxo, use a find and replace
	 * to change 'aloxo' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'aloxo', get_template_directory() . '/languages' );

    add_theme_support( 'title-tag' );
    
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'aloxo' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

    /*
     * Declare WooCommerce support
     * 
     */
    add_theme_support( 'woocommerce' );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'audio'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'aloxo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // aloxo_setup
add_action( 'after_setup_theme', 'aloxo_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function aloxo_widgets_init() {
	register_sidebar( array(
        'name'          => __( 'Sidebar 1', 'aloxo' ),
        'id'            => 'sidebar-1',
        'description'   => 'Left Sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Sidebar 2', 'aloxo' ),
        'id'            => 'sidebar-2',
        'description'   => 'Right Sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => 'Top Drawer',
        'id'            => 'drawer_top',
        'description'   => __( 'Drawer Top', 'aloxo' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Right Drawer', 'aloxo' ),
        'id'            => 'drawer_right',
        'description'   => 'Drawer Right',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => 'Top Left',
        'id'            => 'top_left_sidebar',
        'description'   => __( 'Top Left', 'aloxo' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => 'Top Right',
        'id'            => 'top_right_sidebar',
        'description'   => __( 'Top Right Sidebar', 'aloxo' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<div class="title-widget">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => 'Header Left',
        'id'            => 'header_left',
        'description'   => __( 'Header Left', 'aloxo' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => 'Header Right',
        'id'            => 'header_right',
        'description'   => __( 'Header Right', 'aloxo' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => 'Menu Left',
        'id'            => 'menu_left',
        'description'   => __( 'Menu Left', 'aloxo' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => 'Menu Right',
        'id'            => 'menu_right',
        'description'   => __( 'Menu Right', 'aloxo' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => 'Footer 1',
        'id'            => 'footer_1',
        'description'   => __( 'Footer 1 Sidebar', 'aloxo' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widget">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => 'Footer 2',
        'id'            => 'footer_2',
        'description'   => __( 'Footer 2 Sidebar', 'aloxo' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widget">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => 'Footer 3',
        'id'            => 'footer_3',
        'description'   => __( 'Footer 3 Sidebar', 'aloxo' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widget">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => 'Footer 4',
        'id'            => 'footer_4',
        'description'   => __( 'Footer 4 Sidebar', 'aloxo' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widget">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => 'Copyright',
        'id'            => 'copyright',
        'description'   => __( 'Copyright', 'aloxo' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Sidebar Shop', 'aloxo' ),
        'id'            => 'shop',
        'description'   => 'Shop Sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'aloxo_widgets_init' );

/**
 * Enqueue styles.
 */
if ( ! function_exists( 'aloxo_styles' ) ) {
    function aloxo_styles() {
        global $current_blog;
        wp_register_style( 'aloxo-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
        wp_enqueue_style( 'aloxo-bootstrap' );

        wp_deregister_style( 'aloxo-pixel-industry' );
        wp_register_style( 'aloxo-pixel-industry', get_template_directory_uri() . '/js/jplayer/skin/pixel-industry/pixel-industry.min.css', array(), true );
		wp_enqueue_style( 'aloxo-custom', get_template_directory_uri() . '/css/custom.css' );

        if (is_multisite()) {
            if (file_exists(TP_THEME_DIR . 'style-' . $current_blog->blog_id . '.css')) {
                wp_enqueue_style('aloxo-style', get_template_directory_uri() . '/style-' . $current_blog->blog_id . '.css', array());
            } else {
                wp_enqueue_style('aloxo-style', get_stylesheet_uri());
            }
        } else {
            wp_enqueue_style('aloxo-style', get_stylesheet_uri());
        }


	}
    add_action( 'wp_enqueue_scripts', 'aloxo_styles' );
}
/**
 * Enqueue scripts.
 */
if ( ! function_exists( 'aloxo_scripts') ) {
    function aloxo_scripts() {
        global $theme_options_data;
		if(isset($theme_options_data['thim_rtl_support']) && $theme_options_data['thim_rtl_support'] =='1'){
			wp_enqueue_style( 'aloxo-rtl', get_template_directory_uri() . '/rtl.css', array() );
		}
     //   wp_enqueue_style( 'aloxo-awesome', TP_THEME_FRAMEWORK_URI . 'css/font-awesome.min.css', array() );
        wp_enqueue_style( 'aloxo-customizer-style', TP_THEME_FRAMEWORK_URI . 'css/custom-framework.css', array() );

        wp_deregister_script( 'aloxo-navigation' );
        wp_register_script( 'aloxo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true);
        wp_enqueue_script( 'aloxo-navigation' );

        wp_deregister_script( 'aloxo-skip-link-focus-fix' );
        wp_register_script( 'aloxo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true);
        wp_enqueue_script( 'aloxo-skip-link-focus-fix' );

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        wp_deregister_script( 'aloxo-carouFredSel' );
        wp_register_script( 'aloxo-carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-packed.min.js', array('jquery'), false, true);
        wp_enqueue_script( 'aloxo-carouFredSel' );

        wp_deregister_script( 'aloxo-jquery.appear' );
        wp_register_script( 'aloxo-jquery.appear', get_template_directory_uri() . '/js/jquery.appear.js', array('jquery'), false, true);
        wp_enqueue_script( 'aloxo-jquery.appear' );
        
        wp_deregister_script( 'aloxo-magnific-popup' );
        wp_register_script( 'aloxo-magnific-popup', get_template_directory_uri() . '/js/magnific-popup.min.js', array('jquery'), '1.0', true);
        wp_enqueue_script( 'aloxo-magnific-popup' );

        wp_deregister_script( 'aloxo-jquery.prettyPhoto' );
        wp_register_script( 'aloxo-jquery.prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), '1.0', true);
        wp_enqueue_script( 'aloxo-jquery.prettyPhoto' );

        wp_deregister_script( 'aloxo-jquery.imagesloaded.pkgd' );
        wp_register_script( 'aloxo-jquery.imagesloaded.pkgd', get_template_directory_uri() . '/js/imagesloaded.pkgd.js', array('jquery'), '', true);
        wp_enqueue_script( 'aloxo-jquery.imagesloaded.pkgd' );

        wp_deregister_script( 'aloxo-jquery.flexslider' );
        wp_register_script( 'aloxo-jquery.flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '', false);
        wp_enqueue_script( 'aloxo-jquery.flexslider' );

        wp_deregister_script( 'aloxo-chosen.jquery.min' );
        wp_register_script( 'aloxo-chosen.jquery.min', get_template_directory_uri() . '/js/chosen.jquery.min.js', array('jquery'), '', false);
        wp_enqueue_script( 'aloxo-chosen.jquery.min' );

        wp_deregister_script( 'aloxo-preloader' );
        wp_register_script( 'aloxo-preloader', get_template_directory_uri() . '/js/preloader.js', array('jquery'), '', true);
        // Load PreLoader if it is enabled from Theme Options
        if (isset($theme_options_data['show_perload']) && $theme_options_data['show_perload'] == 1) {
            wp_enqueue_script( 'aloxo-preloader' );
        }

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }


        wp_deregister_script( 'aloxo-SmoothScroll' );
        wp_register_script( 'aloxo-SmoothScroll', get_template_directory_uri() . '/js/SmoothScroll.min.js', array('jquery'), false, true);
        wp_enqueue_script( 'aloxo-SmoothScroll' );
        
        // Register the isotope script plugin:
        wp_deregister_script( 'aloxo-isotope' );
        wp_register_script( 'aloxo-isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), '', true ) ;

        wp_deregister_script( 'aloxo-infinitescroll' );
        wp_register_script( 'aloxo-infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array(), '', true );

        wp_deregister_script( 'aloxo-jplayer' );
        wp_register_script( 'aloxo-jplayer', get_template_directory_uri() . '/js/jplayer/jquery.jplayer.min.js', array( 'jquery' ), '', true );

        /* woo */
        wp_deregister_script( 'aloxo-owl-carousel' );
        wp_register_script( 'aloxo-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '', true );

        wp_deregister_script( 'aloxo-retina' );
        wp_register_script( 'aloxo-retina', get_template_directory_uri() . '/js/jquery.retina.min.js', array( 'jquery' ), '', true );

        wp_deregister_script( 'aloxo-custom-script' );
        wp_register_script( 'aloxo-custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '', true);
        wp_enqueue_script( 'aloxo-custom-script' );

		wp_deregister_script( 'aloxo-menumobile' );
		wp_register_script( 'aloxo-menumobile', TP_THEME_URI . 'js/menumobile.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'aloxo-menumobile' );

    }
    add_action( 'wp_enqueue_scripts', 'aloxo_scripts' );
}

global $theme_options_data;
$theme_options_data =  get_theme_mods();

/**
 * load framework
 */
require_once get_template_directory() . '/framework/tp-framework.php';

require TP_THEME_DIR . 'inc/shortcodes/shortcodes.php';



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/* * * Tax meta class. * * */
include TP_THEME_DIR . 'inc/tax-meta.php';

/**
 * Post Format file.
 */
require get_template_directory() . '/inc/post-formats.php';


/**
 * Load vc_map.
 */
if ( function_exists( 'vc_map' ) ) {
    /**
     * Register taxonomy "product_cat" to vc_map.php use
     */
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
        WC_Post_types::register_taxonomies();
    }

    require TP_THEME_DIR . 'inc/vc_map.php';
    require TP_THEME_DIR . 'inc/shortcodes/vc_row.php';
    require TP_THEME_DIR . 'inc/shortcodes/vc_row_inner.php';
    require TP_THEME_DIR . 'inc/shortcodes/vc_accordion.php';
    require TP_THEME_DIR . 'inc/shortcodes/vc_tabs.php';
    require TP_THEME_DIR . 'inc/shortcodes/vc_tab.php';
    require TP_THEME_DIR . 'inc/shortcodes/vc_flickr.php';
    require TP_THEME_DIR . 'inc/shortcodes/vc_button.php';
}

if (class_exists( 'WooCommerce' ) ) {
    // Woocomerce
    require get_template_directory() . '/woocommerce/woocommerce.php';
    require get_template_directory() . '/woocommerce/widgets/class-wc-wishlist.php';
    require get_template_directory() . '/woocommerce/widgets/class-wc-account.php';
    require get_template_directory() . '/woocommerce/widgets/class-wc-search.php';
    
}

require get_template_directory() . '/inc/widgets/widgets.php';

require_once(get_template_directory() . '/inc/aq_resizer.php');

if(is_admin()){
    require TP_THEME_DIR.'inc/admin/plugins-require.php';
}
require TP_THEME_DIR . 'inc/admin/customize-options.php';

// Hard Crop
if(false === get_option("medium_crop")) {
    add_option("medium_crop", "1");
} else {
    update_option("medium_crop", "1");
}
if(false === get_option("large_crop")) {
    add_option("large_crop", "1");
} else {
    update_option("large_crop", "1");
}