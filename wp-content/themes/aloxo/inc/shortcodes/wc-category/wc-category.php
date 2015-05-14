<?php
/**
 * Created by PhpStorm.
 * User: duonglh
 * Date: 6/23/14
 * Time: 9:32 PM
 */
add_shortcode( 'wc_category', 'shortcode_wc_category' );
function shortcode_wc_category($atts, $content = null )
{

	extract( shortcode_atts( array(
		'title'       => 'categories',
		'orderby'	  => 'name',
		'layout'	  => 'layout-01',
		'layout_style'	  => 'style-01',
		'number_per_view' => 6,
		'column' => 6,
		'cats' => '',
		'options'     => 'hierarchical'
	), $atts ) );
	if ($layout== "layout-02") {

		$html = "";
		$html .= '<div class="sc-category '.$layout.'">';

		$taxonomy = "product_cat";
		$total = wp_count_terms( $taxonomy, array( 'hide_empty'=>false) ); 
		$terms = get_terms($taxonomy , array( 'hide_empty'=>false, 'number' => $number_per_view));
		if ( !empty( $terms ) && !is_wp_error( $terms ) ){
			$html .= "<ul>";
			foreach ( $terms as $term ) {
				$image 			= '';
				$thumbnail_id 	= get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
				if ($thumbnail_id)
					$image = wp_get_attachment_thumb_url( $thumbnail_id );
				else
					$image = wc_placeholder_img_src();

				$html .= '<li class="col-1-'.$column.'"><a href="' . get_term_link( $term ) . '">';
				$html .= '<img src="' . esc_url( $image ) . '" />';
				$html .= $term->name . '</a></li>';
			}
			if ($total > $number_per_view) {
				$html .= '<li class="col-1-'.$column.'" style="text-align: center;"><a class="cate_btn_load_more" href="#" data-ajax_url="'.admin_url( 'admin-ajax.php' ).'" data-column = "'.$column.'" data-off="'.$number_per_view.'" data-offset="'.$number_per_view.'"><div class="dots" style=""><div class="dot"><span class="one"></span></div><div class="dot"><span class="two"></span></div><div class="dot"><span class="three"></span></div></div>More</a></li>';

			}
			$html .= "</ul>";
		}
		$html .= '</div>';

		return $html;
	}
	if ($layout== "layout-03") {
		$html = '';
		$randnumber = rand( 0, 10000 );
		$number_id  = $randnumber;

		wp_enqueue_script( 'aloxo-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '', false );

		if ($number_per_view == 1) {
			$config = ",singleItem:true";
		}else {
			$config = ',items : '.$number_per_view.',
					stopOnHover: true,
					responsive: true,
					itemsDesktop : [1199,1],
					itemsDesktopSmall : [979,1]';
		}
		$html .= '
 		<script>
			jQuery(function($) {
				$("#cats_' . $number_id . '").owlCarousel({
					autoPlay: 3000
					,navigation: true,
					pagination: false,
					navigationText: ["<i class=\'fa fa-angle-left\'></i>","<i class=\'fa fa-angle-right\'></i>"]
					'.$config.'
			  });
			});
		</script>';

		$html .= '<div class="sc-category '.$layout.'">';
		
		$terms = get_terms("product_cat",array( 'hide_empty'=>false));
		if ( !empty( $terms ) && !is_wp_error( $terms ) ){
			$html .= '<div id ="cats_' . $number_id . '">';
			foreach ( $terms as $term ) {
				$image 			= '';
				$thumbnail_id 	= get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
				if ($thumbnail_id)
					$image = wp_get_attachment_thumb_url( $thumbnail_id );
				else
					$image = wc_placeholder_img_src();

				$html .= '<li><a href="' . get_term_link( $term ) . '">';
				$html .= '<img src="' . esc_url( $image ) . '" />';

				$html .= $term->name . '</a></li>';
			}
			$html .= '</div>';
		}
		
		$html .= '</div>';

		return $html;
	}
	if ($layout== "layout-04") {
		$html = '';
		$randnumber = rand( 0, 10000 );
		$number_id  = $randnumber;

		wp_enqueue_script( 'aloxo-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '', false );

		if ($number_per_view == 1) {
			$config = ",singleItem:true";
		}else {
			$config = ',items : '.$number_per_view.',
					stopOnHover: true,
					responsive: true,
					itemsDesktop : [1199,1],
					itemsDesktopSmall : [979,1]';
		}
		$html .= '
 		<script>
			jQuery(function($) {
				$("#cats_' . $number_id . '").owlCarousel({
					autoPlay: 3000
					,navigation: true,
					pagination: false,
					navigationText: ["<i class=\'fa fa-angle-left\'></i>","<i class=\'fa fa-angle-right\'></i>"]
					'.$config.'
			  });
			});
		</script>';

		$html .= '<div class="sc-category '.$layout.'">';
		
		$terms = get_terms("product_cat",array( 'hide_empty'=>false));
		if ( !empty( $terms ) && !is_wp_error( $terms ) ){
			//$html .= "<ul>";
			$html .= '<div id ="cats_' . $number_id . '">';
			foreach ( $terms as $term ) {
				$image 			= '';
				$thumbnail_id 	= get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
				if ($thumbnail_id)
					$image = wp_get_attachment_thumb_url( $thumbnail_id );
				else
					$image = wc_placeholder_img_src();

				$html .= '<li><a href="' . get_term_link( $term ) . '">';
				$html .= '<img src="' . esc_url( $image ) . '" />';

				//$html .= $term->name . '</a></li>';
				$html .= '</a></li>';
			}
			$html .= '</div>';
			//$html .= "</ul>";
		}
		
		$html .= '</div>';

		return $html;
	}
	if ($layout== "layout-05") {
		$html = '';
		$html .= '<div class="sc-category '.$layout.'">';
		
		$linkimages = get_tax_meta((int)$cats, 'aloxo_product_image_field_id', true);
		if ($linkimages <> '') {
		   $html .=  '<img src="'.$linkimages['src'].'">';
		}

		// $html .= '<div class="cat-btn">';
		// $html .= '</div>';
		$term = get_term_by( 'id', (int)$cats, 'product_cat' );
		$html .= '<div class="cat-btn"><a href="' . get_term_link((int)$cats, 'product_cat' ) . '">' . $term->name . '</a></div>';


		$html .= '</div>';

		return $html;
	}

	if ($layout== "layout-06") {
		$html = '';
		$taxonomy = "product_cat";
		if (isset($atts['title']) && $atts['title'])
			$title = $atts['title'];
		else $title = "";

		$html .= '<div class="sc-category '.$layout.' '.$layout_style.'">';
		
		$args = array(
			'show_option_all'    => '',
			'orderby'            => 'name',
			'order'              => 'ASC',
			'style'              => 'list',
			'show_count'         => 1,
			'hide_empty'         => 0,
			'use_desc_for_title' => 1,
			'child_of'           => 0,
			'feed'               => '',
			'feed_type'          => '',
			'feed_image'         => '',
			'exclude'            => '',
			'exclude_tree'       => '',
			'include'            => '',
			'hierarchical'       => 1,
			'disable_plus'		 => 1,
			'link_item'			 => 1,
			'title_li'           => '',
			'show_option_none'   => __( 'No categories', 'aloxo' ),
			'number'             => null,
			'echo'               => 0,
			'depth'              => 0,
			'current_category'   => 0,
			'pad_counts'         => 1,
			'taxonomy'           => 'product_cat',
			'walker'             => new wc_dropdown_category_walker
		);

		$html .=  '<div class="ps-categories">';
		$html .=  '<div class="ps-categories-inner">';
		$html .=  '<a href="#"><i class="fa fa-bars fa-lg"></i> '.$title.'</a>';
		$terms = get_terms($taxonomy , array( 'hide_empty'=>false));
		if ( !empty( $terms ) && !is_wp_error( $terms ) ){
			$html .=  '<ul class="ps-cate-list">';
			// foreach ( $terms as $term ) {
			// 	$html .=  '<li><a href="'.get_term_link((int)$term->term_id, $taxonomy).'" rel="'.$term->slug.'">' .$term->name.'</a></li>';
			// }
			$html .= wp_list_categories($args);

			$html .=  '</ul>';
		}
		$html .=  '</div>';
		$html .=  '</div>';

		// $linkimages = get_tax_meta((int)$cats, 'aloxo_product_image_field_id', true);
		// if ($linkimages <> '') {
		//    $html .=  '<img src="'.$linkimages['src'].'">';
		// }

		// // $html .= '<div class="cat-btn">';
		// // $html .= '</div>';
		// $term = get_term_by( 'id', (int)$cats, 'product_cat' );
		// $html .= '<div class="cat-btn"><a href="' . get_term_link((int)$cats, 'product_cat' ) . '">' . $term->name . '</a></div>';


		$html .= '</div>';

		return $html;
	}

	if (isset($atts['title']) && $atts['title'])
		$title = $atts['title'];
	else $title = "";

	$d = false;
	$c = false;
	$h = false;

	$html = '';

	if ($options) {
		$options = explode( ",", $options);
		//if ( in_array( "dropdown", $options ) ) $d = true;
		if ( in_array( "count", $options ) ) $c = true;
		if ( in_array( "hierarchical", $options ) ) $h = true;
	}
	
	//$html = '<div class="widget_product_categories">';//    $atts['title'];
	$html .= '<div class= "sc-category layout-01">';
	if ($title)
		$html .='<h4 class="title">' . $title .  '</h4>';
	$html .= '<ul class="product-categories">';

	$args = array(
		'show_option_all'    => '',
		'orderby'            => 'name',
		'order'              => 'ASC',
		'style'              => 'list',
		'show_count'         => $c,
		'hide_empty'         => 0,
		'use_desc_for_title' => 1,
		'child_of'           => 0,
		'feed'               => '',
		'feed_type'          => '',
		'feed_image'         => '',
		'exclude'            => '',
		'exclude_tree'       => '',
		'include'            => '',
		'hierarchical'       => $h,
		'title_li'           => '',
		'show_option_none'   => __( 'No categories', 'aloxo' ),
		'number'             => null,
		'echo'               => 0,
		'depth'              => 0,
		'current_category'   => 0,
		'pad_counts'         => 1,
		'taxonomy'           => 'product_cat',
		'walker'             => new wc_category_walker
	);

	$o             = $atts['orderby'] ? $atts['orderby'] : 'order';

	// Menu Order
	$args['menu_order'] = false;
	if ( $o == 'order' ) {
		$args['menu_order'] = 'asc';
	}



	$html .= wp_list_categories($args);

	$html .= '</ul>';

	$html .= '</div>';

	return $html;
}

if (!class_exists('wc_category_walker'))
{
	class wc_category_walker extends  Walker_Nav_Menu
	{
		/**
		 * What the class handles.
		 *
		 * @see Walker::$tree_type
		 * @since 2.1.0
		 * @var string
		 */
		var $tree_type = 'product_cat';

		var $db_fields = array( 'parent' => 'parent', 'id' => 'term_id', 'slug' => 'slug' );

		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker::start_lvl()
		 *
		 * @since 2.1.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of category. Used for tab indentation.
		 * @param array  $args   An array of arguments. Will only append content if style argument value is 'list'.
		 *                       @see wp_list_categories()
		 */
		function start_lvl( &$output, $depth = 0, $args = array() ) {

			$indent = str_repeat("\t", $depth);
			$output .= "$indent<ul class='children'>\n";
		}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker::end_lvl()
		 *
		 * @since 2.1.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of category. Used for tab indentation.
		 * @param array  $args   An array of arguments. Will only append content if style argument value is 'list'.
		 *                       @wsee wp_list_categories()
		 */
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul>\n";
		}

		/**
		 * Start the element output.
		 *
		 * @see Walker::start_el()
		 *
		 * @since 2.1.0
		 *
		 * @param string $output   Passed by reference. Used to append additional content.
		 * @param object $category Category data object.
		 * @param int    $depth    Depth of category in reference to parents. Default 0.
		 * @param array  $args     An array of arguments. @see wp_list_categories()
		 * @param int    $id       ID of the current category.
		 */
		function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
			extract($args);
			$cat_name = esc_attr( $category->name );

			/** This filter is documented in wp-includes/category-template.php */
			$cat_name = apply_filters( 'list_cats', $cat_name, $category );

			$link = '<a href="' . esc_url( get_term_link($category) ) . '" ';
//			if ( $use_desc_for_title == 0 || empty($category->description) ) {
//				$link .= 'title="' . esc_attr( sprintf(__( 'View all posts filed under %s' , 'aloxo' ), $cat_name) ) . '"';
//			} else {
//				/**
//				 * Filter the category description for display.
//				 *
//				 * @since 1.2.0
//				 *
//				 * @param string $description Category description.
//				 * @param object $category    Category object.
//				 */
//				$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
//			}
			$link .= '>';
			$link .= $cat_name . '</a>';
			if ( !empty($show_count) )
				$link .= ' (' . number_format_i18n( $category->count ) . ')';

			$output .= "\t<li";
			$class = 'cat-item cat-item-' . $category->term_id;
			if ( !empty($current_category) ) {
				$_current_category = get_term( $current_category, $category->taxonomy );
				if ( $category->term_id == $current_category )
					$class .=  ' current-cat';
				elseif ( $category->term_id == $_current_category->parent )
					$class .=  ' current-cat-parent';
			}

			if ($has_children && $hierarchical)
			{
				$class .=  ' cat-parent';
			}



			$output .=  ' class="' . $class . '"';


			$output.="><div>";


			if($category->parent == 0)
			{
				$image 			= '';
				$thumbnail_id 	= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );

				if ($thumbnail_id)
					$image = wp_get_attachment_thumb_url( $thumbnail_id );
				else
					$image = wc_placeholder_img_src();

				// Prevent esc_url from breaking spaces in urls for image embeds
				// Ref: http://core.trac.wordpress.org/ticket/23605
				$image = str_replace( ' ', '%20', $image );

				//$icon = '<img src="' . esc_url( $image ) . '"  height="22" width="22" alt="'.$category->name.'"  />';
				$icon = '<img src="' . esc_url( $image ) . '"  alt="'.$category->name.'" class="icon-category-small" />';


				/*$image = '<img width="20" src="'. get_theme_root_uri() .'/aloxo/images/cate-girl-tee.png"/>';*/
				$output .= $icon . $link;
			}
			else
			{
				$output .= $link;
			}


			if ($has_children && $hierarchical)
			{
				$output .= '<span class="icon-plus"><i class="fa fa-plus"></i></span>';
			}

			$output .="</div>";
		}

		/**
		 * Ends the element output, if needed.
		 *
		 * @see Walker::end_el()
		 *
		 * @since 2.1.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $page   Not used.
		 * @param int    $depth  Depth of category. Not used.
		 * @param array  $args   An array of arguments. Only uses 'list' for whether should append to output. @see wp_list_categories()
		 */
		function end_el( &$output, $page, $depth = 0, $args = array() ) {
			$output .= "</li>\n";
		}

		public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
			if ( ! $element || 0 === $element->count ) {
				return;
			}
			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

	}
}

if (!class_exists('CategoryThumbnail_Walker')) {
	class CategoryThumbnail_Walker extends Walker_Category {
	    // A new element has been stumbled upon and has ended
	    //function end_el( &$output, $category, $depth, $args ) {
		function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
	    	
	        $image 			= '';
			$thumbnail_id 	= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );

			if ($thumbnail_id)
				$image = wp_get_attachment_thumb_url( $thumbnail_id );
			else
				$image = wc_placeholder_img_src();

			$output .= '<img src="' . esc_url( $image ) . '" />';

	        // Output the standard link ending
	        //parent::end_el( $output, $category, $depth, $args );
			parent::start_el( $output, $category, $depth, $args, $id );

	    }
	} 
}
