<?php
/**
 * Product Search Widget
 *
 * Displays product search widget
 *
 * @author        kien16
 * @category      Widgets
 * @package       thimpress
 * @version       1.0
 * @extends       WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class WC_Search extends WP_Widget {
	function WC_Search() {
        //Constructor
        $widget_ops = array( 'classname' => 'aloxo_wc_search', 'description' => 'Product Search for aloxo site.' );
        $this->WP_Widget( 'aloxo_widget_search', 'Aloxo: Product Search', $widget_ops );
    	add_action( 'load-widgets.php', array(&$this, 'thim_script') ); 
    }
    function thim_script() {      
        wp_enqueue_style( 'wp-color-picker' );          
        wp_enqueue_script( 'wp-color-picker' );      
    }  
	function widget( $args, $instance ) {
		extract( $args );
		$search_style = $instance['search_style']; 

		echo $before_widget;
		$taxonomy = "product_cat";

		echo '<div class="product_search '.$search_style.'">';
		echo '<form method="get" action="'.get_site_url().'">';
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
		if ($search_style=='style-02') {
			echo  '<div class="ps-search-border-container">';
			echo  '<div class="ps-search-border-left">';
			echo  '</div>';
		}
		echo '<div class="ps-selector-container">';
		echo '<a class="ps-selector" href="#"><span>'.__( 'All', 'aloxo' ).'</span> <i class="fa fa-sort-desc"></i></a>';
		$terms = get_terms($taxonomy , array( 'hide_empty'=>false));
		if ( !empty( $terms ) && !is_wp_error( $terms ) ){
			echo '<ul class="ps-option">';
			echo '<li class="all-product"><a href="#" class="active">'.__( 'All', 'aloxo' ).'</a></li>';
			echo wp_list_categories($args);
			echo '</ul>';
		}
		echo '</div>';

		echo '<div class="ps_container">';
		echo '<input class="ps-field" type="text" name="s" placeholder="'.__( 'Search product...', 'aloxo' ).'" autocomplete="off">';
		if ($search_style=='style-01') {
			echo  '<a href="#" onclick="jQuery(this).closest(\'form\').submit();"><i class="fa fa-search fa-lg"></i></a>';
		}
		echo '<input type="hidden" name="post_type" value="product">';
		echo '<input type="hidden" name="product_cat" value="">';
		echo '<ul class="product_results woocommerce"></ul>';
		echo '</div>';

		if ($search_style=='style-02') {
			echo '<div class="ps-search">';
			echo  '<a href="#" onclick="jQuery(this).closest(\'form\').submit();"><i class="fa fa-search fa-lg"></i></a>';
			echo '</div>';

			echo  '</div>';
		}

		echo '</form>';
		echo '</div>';

		echo $after_widget;
	}

	/**
	 * update function.
	 *
	 * @see    WP_Widget->update
	 * @access public
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;  
        $instance = $new_instance;  
        $instance['search_style'] = $new_instance['search_style'];   
        return $instance;  
	}

	/**
	 * form function.
	 *
	 * @see    WP_Widget->form
	 * @access public
	 *
	 * @param array $instance
	 *
	 * @return void
	 */
	function form( $instance ) {
		$defaults = array(  
            'search_style' => 'style-01'  ,
        );  
        // Merge the user-selected arguments with the defaults  
        $instance = wp_parse_args( (array) $instance, $defaults ); 
		$search_style = $instance['search_style']; 
		?>
		<p>
			<label for="<?php echo $this->get_field_id('search_style'); ?>">
				<?php _e('Style', 'aloxo' ); ?>
			</label>
			<select name="<?php echo $this->get_field_name('search_style'); ?>" id="<?php echo $this->get_field_id('search_style'); ?>" class="widefat">
				<?php
				$s_style = array(
					'style-01'	=>	'Style 01', 
					'style-02'	=>	'Style 02', 
				);
				foreach ($s_style as $key => $value) {
					echo '<option value="' . $key . '"', $search_style == $key ? ' selected="selected"' : '', '>', $value, '</option>';
				}
				?>
			</select>
		</p>
        <?php	
	}

}

register_widget( 'WC_Search' );


if (!class_exists('wc_dropdown_category_walker'))
{
	class wc_dropdown_category_walker extends  Walker_Nav_Menu
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
			$link .= '>';
			$link .= $cat_name;
			$link .= '</a>';
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
				$output .= $link;
			}
			else
			{
				$output .= $link;
			}


			if ($has_children && $hierarchical && !isset($disable_plus))
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