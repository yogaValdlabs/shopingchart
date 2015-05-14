<?php
if ( ! class_exists( 'THIM_Portfolio' ) ) {
	/**
	 * Thim Theme
	 *
	 * Manage the portfolio in the THIM Framework
	 *
	 * @class THIM_Portfolio
	 * @package	thimpress
	 * @since 1.0
	 * @author kien16
	 */
	class THIM_Portfolio {

		/**
	     * @var string
	     * @since 1.0
	     */
	    public $version = THIM_PORTFOLIO_VERSION;

	    /**
	     * @var object The single instance of the class
	     * @since 1.0
	     */
	    protected static $_instance = null;

		/**
	     * @var string
	     * @since 1.0
	     */
	    public $plugin_url;

	    /**
	     * @var string
	     * @since 1.0
	     */
	    public $plugin_path;

	    /**
		 * The array of templates that this plugin tracks.
		 *
		 * @var      array
		 */
		protected $templates;

		/**
		 * Get the template path.
		 *
		 * @return string
		 */
		public function template_path() {
			return apply_filters( 'portfolio_template_path', 'thim-portfolio/' );
		}

		/**
	     * Main plugin Instance
	     *
	     * @static
	     * @return object Main instance
	     *
	     * @since 1.0
	     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
	     */
	    public static function instance() {
	        if ( is_null( self::$_instance ) ) {
	            self::$_instance = new self();
	        }

	        return self::$_instance;
	    }

		/**
		 * Constructor
		 *
		 * Initialize plugin and registers the portfolio cpt
		 */
		public function __construct() {

	        // Define the url and path of plugin
	        $this->plugin_url  = untrailingslashit( plugins_url( '/', __FILE__ ) );
	        $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );

	        //add_action( 'admin_enqueue_scripts', array( $this, 'thim_scripts' ) );
	       	add_action('wp_footer', array($this, 'thim_scripts'));
	        //add_action( 'wp_enqueue_scripts', array( $this, 'thim_scripts' ) );

	        // Register CPTU
	        add_action( 'after_setup_theme', array( $this, 'register_cptu' ), 20 );

	        // Register Taxonomy
	        add_action( 'after_setup_theme', array( $this, 'register_taxonomy' ), 20 );

	        

	        require_once 'lib/aq_resizer.php';

	        // Display custom update messages for posts edits
			add_filter( 'post_updated_messages', array( $this, 'updated_messages' ) );

			// Include OWN Metabox
			require_once 'lib/meta-boxes/thim-meta-box.php';
			require_once 'lib/meta-boxes/init.php';
			add_filter( 'thim_meta_boxes', array( $this, 'register_metabox' ), 20 );

			// Include OWN Option
			require_once 'lib/thim-options/thim-options.php';
			require_once 'lib/thim-options/init.php';
			add_filter( 'thim_options', array( $this, 'register_options' ), 20 );

			add_action('template_redirect', array( $this, 'template_redirect' ), 20 );
            
	    }

	    /**
         * Enqueue script and styles in admin side
         *
         * Add style and scripts to administrator
         *
         * @return void
         * @since    1.0
         * @author   thim
         */
        public function thim_scripts() {
            //scripts
            wp_deregister_script( 'isotope' );
	        wp_register_script( 'isotope', JS_URL . 'isotope.pkgd.min.js', array('jquery'), false, true);
	        wp_enqueue_script( 'isotope' );

	        wp_deregister_script( 'jquery.appear' );
	        wp_register_script( 'jquery.appear', JS_URL . 'jquery.appear.js', array('jquery'), false, true);
	        wp_enqueue_script( 'jquery.appear' );
	        
	        wp_deregister_script( 'infinitescroll' );
	        wp_register_script( 'infinitescroll', JS_URL . 'jquery.infinitescroll.min.js', array('jquery'), false, true);
	        wp_enqueue_script( 'infinitescroll' );

	        wp_deregister_script( 'flexslider' );
	        wp_register_script( 'flexslider', JS_URL . 'jquery.flexslider-min.js', array('jquery'), false, true);

	        wp_deregister_script( 'magnific-popup' );
	        wp_register_script( 'magnific-popup', JS_URL . 'magnific-popup.min.js', array('jquery'), '1.0', true);
	        wp_enqueue_script( 'magnific-popup' );

	        wp_deregister_script( 'jquery.prettyPhoto' );
	        wp_register_script( 'jquery.prettyPhoto', JS_URL . 'jquery.prettyPhoto.js', array('jquery'), '1.0', true);
	        wp_enqueue_script( 'jquery.prettyPhoto' );

	        wp_enqueue_style( 'css-magnific-popup', CSS_URL . 'magnific-popup.css' );
	        wp_enqueue_style( 'css-prettyPhoto', CSS_URL . 'prettyPhoto.css' );
	        wp_enqueue_style( 'css-portfolio', CSS_URL . 'portfolio.css' );

        	wp_enqueue_script( 'jquery-imagesloaded', JS_URL  . 'imagesloaded.pkgd.js', array(), false, false );
            wp_enqueue_script( 'jquery-portfolio', JS_URL  . 'portfolio.js', array(), false, false );
        }

	    /**
		 * Template part Redirect.
		 *
		 * @access public
		 * @return void
		 */
	    public function template_redirect() {
	    	global $wp_query;
	    	//echo $_SERVER['REQUEST_URI'];
	    	if (get_post_type() == "portfolio" && (is_category() || is_archive()) || isset($wp_query->query_vars['portfolio_category']) ) {
	    		if (is_404()) {
					status_header('200');
				}
	    		$this->get_template_part( 'archive' , "portfolio");
	    		exit();
	    	}
	    	else if (get_post_type() == "portfolio" && is_single()) {
	    		$this->get_template_part("single", "portfolio");
	    		exit();
	    	}
	    	else {
	    		return;
	    	}
		}

		/**
		 * Get template part (for templates like the shop-loop).
		 *
		 * @access public
		 * @param mixed $slug
		 * @param string $name (default: '')
		 * @return void
		 */
		public function get_template_part( $slug, $name = '' ) {
			$template = '';
			// Look in yourtheme/slug-name.php and yourtheme/portfolio/slug-name.php
			if ( $name ) {
				$template = locate_template( array( "{$slug}-{$name}.php", 'portfolio/' . "{$slug}-{$name}.php" ) );
			}
			// Get default slug-name.php
			if ( ! $template && $name && file_exists( $this->plugin_path . "/templates/{$slug}-{$name}.php" ) ) {
				$template = $this->plugin_path . "/templates/{$slug}-{$name}.php";
			}
			// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/portfolio/slug.php
			if ( ! $template ) {
				$template = locate_template( array( "{$slug}.php", 'portfolio/' . "{$slug}.php" ) );
			}
			// Allow 3rd party plugin filter template file from their plugin
			$template = apply_filters( 'get_template_part', $template, $slug, $name );

			if ( $template ) {
				load_template( $template, false );
			}
		}

	    /**
	     * Register the Custom Post Type Unlimited
	     *
	     * @return void
	     * @since 1.0
	     * @author thimpress
	     */
	    public function register_cptu () {
	    	$labels = array(
				'name'               => _x( 'Portfolio', 'Post Type General Name', 'thimpress' ),
				'singular_name'      => _x( 'Portfolio', 'Post Type Singular Name', 'thimpress' ),
				'menu_name'          => __( 'Portfolio', 'thimpress' ),
				'parent_item_colon'  => __( 'Parent Portfolio:', 'thimpress' ),
				'all_items'          => __( 'All Portfolios', 'thimpress' ),
				'view_item'          => __( 'View Portfolio', 'thimpress' ),
				'add_new_item'       => __( 'Add New Portfolio', 'thimpress' ),
				'add_new'            => __( 'New Portfolio', 'thimpress' ),
				'edit_item'          => __( 'Edit Portfolio', 'thimpress' ),
				'update_item'        => __( 'Update Portfolio', 'thimpress' ),
				'search_items'       => __( 'Search portfolios', 'thimpress' ),
				'not_found'          => __( 'No portfolios found', 'thimpress' ),
				'not_found_in_trash' => __( 'No portfolios found in Trash', 'thimpress' ),
			);
			$args   = array(
				'labels'      => $labels,
				'supports'    => array( 'title', 'editor', 'thumbnail' ),
				'public'      => true,
				'has_archive' => true,
			);
			register_post_type( 'portfolio', $args );
	    }

	    /**
		 * Register Portfolio Taxonomy
		 *
		 * @return void
		 * @since  1.0
		 */
		public function register_taxonomy () {
			// Portfolio Categories
			$labels = array(
				'name'                       => _x( 'Portfolio Categories', 'Taxonomy General Name', 'thimpress' ),
				'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'thimpress' ),
				'menu_name'                  => __( 'Categories', 'thimpress' ),
				'all_items'                  => __( 'All Categories', 'thimpress' ),
				'parent_item'                => __( 'Parent Category', 'thimpress' ),
				'parent_item_colon'          => __( 'Parent Category:', 'thimpress' ),
				'new_item_name'              => __( 'New Category Name', 'thimpress' ),
				'add_new_item'               => __( 'Add New Category', 'thimpress' ),
				'edit_item'                  => __( 'Edit Category', 'thimpress' ),
				'update_item'                => __( 'Update Category', 'thimpress' ),
				'separate_items_with_commas' => __( 'Separate categories with commas', 'thimpress' ),
				'search_items'               => __( 'Search categories', 'thimpress' ),
				'add_or_remove_items'        => __( 'Add or remove categories', 'thimpress' ),
				'choose_from_most_used'      => __( 'Choose from the most used categories', 'thimpress' ),
			);
			$args   = array(
				'labels'       => $labels,
				'hierarchical' => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'portfolio_category' ),
			);
			register_taxonomy( 'portfolio_category', 'portfolio', $args );
		}

		/**
		 * Change updated messages
		 *
		 * @param  array $messages
		 *
		 * @return array
		 * @since  1.0
		 */
		public function updated_messages( $messages = array() ) {
			global $post, $post_ID;
			$messages['portfolio'] = array(
				0  => '',
				1  => sprintf( __( 'Portfolio updated. <a href="%s">View Portfolio</a>', 'thimpress' ), esc_url( get_permalink( $post_ID ) ) ),
				2  => __( 'Custom field updated.', 'thimpress' ),
				3  => __( 'Custom field deleted.', 'thimpress' ),
				4  => __( 'Portfolio updated.', 'thimpress' ),
				5  => isset( $_GET['revision'] ) ? sprintf( __( 'Portfolio restored to revision from %s', 'thimpress' ), wp_post_revision_title( ( int ) $_GET['revision'], false ) ) : false,
				6  => sprintf( __( 'Portfolio published. <a href="%s">View Portfolio</a>', 'thimpress' ), esc_url( get_permalink( $post_ID ) ) ),
				7  => __( 'Portfolio saved.', 'thimpress' ),
				8  => sprintf( __( 'Portfolio submitted. <a target="_blank" href="%s">Preview Portfolio</a>', 'thimpress' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
				9  => sprintf( __( 'Portfolio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Portfolio</a>', 'thimpress' ), date_i18n( __( 'M j, Y @ G:i', 'thimpress' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
				10 => sprintf( __( 'Portfolio draft updated. <a target="_blank" href="%s">Preview Portfolio</a>', 'thimpress' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
			);

			return $messages;
		}

		/**
		 * Register Portfolio Metabox
		 *
		 * @return void
		 * @since  1.0
		 */
		public function register_options ($options) {
			// Better has an underscore as last sign
        	$prefix = 'thim_portfolio_option_';
        	$options[] = array( "name" => "Archive Settings",
			                   	"type" => "heading" );

        	$options[] = array( "name"    => "Select a Layout",
                               "desc"    => "",
                               "id"      => $prefix."archive_layout",
                               "std"     => "left-sidebar",
                               "type"    => "radioimage",
                               "options" => array(
                                   "left-sidebar" => CORE_PLUGIN_URL . "/lib/thim-options/img/sidebar-left.png",
                                   "right-sidebar" => CORE_PLUGIN_URL . "/lib/thim-options/img/sidebar-right.png",
                                   "no-sidebar" => CORE_PLUGIN_URL . "/lib/thim-options/img/content-boxed.jpg",
                                   "fullwidth" => CORE_PLUGIN_URL . "/lib/thim-options/img/content-full.jpg",
                               ) );
			$options[] = array(
				'name'    => __( 'Column', 'aloxo' ),
				'id'      => $prefix.'column',
				'type'    => 'radioimage',
				'std'     => 'four',
				'options' => array(
					'two'   => CORE_PLUGIN_URL . "/lib/thim-options/img/two-col.png",
					'three' => CORE_PLUGIN_URL . "/lib/thim-options/img/three-col.png",
					'four'  => CORE_PLUGIN_URL . "/lib/thim-options/img/four-col.png",
					'five'  => CORE_PLUGIN_URL . "/lib/thim-options/img/five-col.png",
				),
			);
			$options[] = array(
				'name' => __( 'Enable gutter for Items', 'aloxo' ),
				'id'   => $prefix.'gutter',
				'type' => 'checkbox'
			);
			$options[] = array(
				'name'    => __( 'Items Size', 'aloxo' ),
				'id'      => $prefix.'item_size',
				'type'    => 'select',
				'std'     => 'masonry',
				'options' => array(
					'multigrid'	=>	'Multigrid', 
					'masonry'	=>	'Masonry', 
					'same'	=>	'Same size', 
				)
			);
			$options[] = array(
				'name'    => __( 'Items Style', 'aloxo' ),
				'id'      => $prefix.'item_style',
				'type'    => 'select',
				'std'     => 'classic',
				'options' => array(
					'text'	=>	'Text', 
					'classic'	=>	'Classic',  
				),
			);
	

			$options[] = array(
				'name'    => __( 'Images Hover Effects', 'aloxo' ),
				'id'      => $prefix.'item_effect',
				'type'    => 'select',
				'std'     => 'effects_classic',
				'options' => array(
					'effects_classic'	=>	'Classic', 
					'effects_zoom_01'	=>	'Zoom In 01',  
					'effects_zoom_02'	=>	'Zoom In 02',  
				)
			);
			$options[] = array(
				'name'    => __( 'Pagination Styles', 'aloxo' ),
				'id'      => $prefix."paging",
				'type'    => 'select',
				'std'     => 'all',
				'options' => array(
					'all'	=>	'Show All', 
					'paging'	=>	'Paging',  
					'infinite_scroll'	=>	'Infinite Scroll',
				),
			);

        	$options[] = array( "name" => "Number Per View",
			                   "id"   => $prefix."num_per_view",
			                   "std"  => "8",
			                   "type" => "number" );

        	$options[] = array( "name" => "Single Page Settings",
			                   	"type" => "heading" );

        	$options[] = array( "name"    => "Select a Layout",
                               "desc"    => "",
                               "id"      => $prefix."single_layout",
                               "std"     => "no-sidebar",
                               "type"    => "radioimage",
                               "options" => array(
                                   "left-sidebar" => CORE_PLUGIN_URL . "/lib/thim-options/img/sidebar-left.png",
                                   "right-sidebar" => CORE_PLUGIN_URL . "/lib/thim-options/img/sidebar-right.png",
                                   "no-sidebar" => CORE_PLUGIN_URL . "/lib/thim-options/img/content-boxed.jpg",
                               ) );
        	return $options;
		}

		/**
		 * Register Portfolio Metabox
		 *
		 * @return void
		 * @since  1.0
		 */
		public function register_metabox ($meta_boxes) {
			$meta_boxes[] = array(
		        'id' => 'portfolio_settings',
		        'title' => 'Portfolio Settings',
		        'pages' => array( 'portfolio' ),
		        'fields' => array(
		        	array(
						'name'    => __( 'Multigrid Size', 'thimpress' ),
						'id'      => 'feature_images',
						'type'    => 'select',
						'desc'    => 'This config will working for portfolio layout style.',
						'std'     => 'Random',
						'options' => array(
							'random' => "Random",
							'size11' => "Size 1x1(480 x 320)",
							'size12' => "Size 1x2(480 x 640)",
							'size21' => "Size 2x1(960 x 320)",
							'size22' => "Size 2x2(960 x 640)"
						),
					),
		        	array(
						'name'     => __( 'Portfolio Type', 'thimpress' ),
						'id'       => "selectPortfolio",
						'type'     => 'select',
						'options'  => array(
							'portfolio_type_1' => __( 'Image', 'thimpress' ),
							'portfolio_type_2' => __( 'Slider', 'thimpress' ),
							'portfolio_type_3' => __( 'Video', 'thimpress' ),
							'portfolio_type_4' => __( 'Left Floating Sidebar', 'thimpress' ),
							'portfolio_type_5' => __( 'Right Floating Sidebar', 'thimpress' ),
							'portfolio_type_8' => __( 'Gallery', 'thimpress' ),
							'portfolio_type_6' => __( 'Sidebar Slider', 'thimpress' ),
							'portfolio_type_9' => __( 'Vertical Stacked', 'thimpress' ),
							'portfolio_type_7' => __( 'Page Builder', 'thimpress' ),

						),
						// Select multiple values, optional. Default is false.
						'multiple' => false,
						'std'      => 'portfolio_type_1',
					),

					array(
						'name'     => 'Video',
						'id'       => 'project_video_type',
						'type'     => 'select',
						'class'    => 'portfolio_type_3',
						'options'  => array(
							'youtube' => 'Youtube',
							'vimeo'   => 'Vimeo',
						),
						'multiple' => false,
						'std'      => array( 'no' )
					),
					array(
						'name'  => 'Video URL or own Embedd Code<br />(Audio Embedd Code is possible, too)',
						'id'    => 'project_video_embed',
						'desc'  => 'Just paste the ID of the video (E.g. http://www.youtube.com/watch?v=<strong>GUEZCxBcM78</strong>) you want to show, or insert own Embed Code. <br />This will show the Video <strong>INSTEAD</strong> of the Image Slider.<br /><strong>Of course you can also insert your Audio Embedd Code!</strong><br /><br /><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image..',
						'type'  => 'textarea',
						'class' => 'portfolio_type_3',
						'std'   => "",
						'cols'  => "40",
						'rows'  => "8"
					),

		        	array(
						'name'             => 'Upload Image',
						'desc'             => 'Upload up images for a slideshow - or only one to display a single image. <br /><br /><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image.',
						'id'               => 'project_item_slides',
						'type'             => 'image',
						'max_file_uploads' => 1,
						'class'            => 'portfolio_type_1 portfolio_type_8 portfolio_type_9',
					),

		        	array(
						'name'             => 'Upload Image',
						'desc'             => 'Upload up images for a slideshow - or only one to display a single image. <br /><br /><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image.',
						'id'               => 'portfolio_sliders',
						'type'             => 'image_video',
						'class'            => 'portfolio_type_6 portfolio_type_2 portfolio_type_4 portfolio_type_5',
						'max_file_uploads' => 20,
					),
		        )
			);
			return $meta_boxes;
		}
	}

	/**
	 * Main instance of plugin
	 *
	 * @return \THIM_Portfolio
	 * @since  1.0
	 * @author thimpress
	 */
	function THIM_Portfolio() {
	    return THIM_Portfolio::instance();
	}

	/**
	 * Instantiate Portfolio class
	 *
	 * @since  1.0
	 * @author thimpress
	 */
	THIM_Portfolio();
}