<?php
/*******************************************
 * search
 *******************************************/
class aloxo_search_widget extends WP_Widget {

	function aloxo_search_widget() {
		//Constructor
		$widget_ops = array( 'classname' => 'aloxo_search_widget', 'description' => 'A search form for your site.' );
		$this->WP_Widget( 'widget_aloxo_search_widget', 'Aloxo: Search on Page', $widget_ops );
	 add_action( 'load-widgets.php', array(&$this, 'thim_script') ); 
    }
    function thim_script() {      
        wp_enqueue_style( 'wp-color-picker' );          
        wp_enqueue_script( 'wp-color-picker' );      
    }  
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		// $class_custom = empty( $instance['class_custom'] ) ? '' : apply_filters( 'widget_class_custom', $instance['class_custom'] );
		// $style        = empty( $instance['style'] ) ? '' : apply_filters( 'widget_style', $instance['style'] );

		$background_color = empty($instance['background_color']) ? '' : apply_filters( 'widget_background_color', $instance['background_color'] );

		if ($background_color) {
			$css = ' style="background: '.$background_color.'"';
		}else $css = "";

		echo $before_widget;
	
			echo '<a href="#" class="widget-smartsearch" id="header-search" class="search-link"'.$css.'></a>';
		
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		// $instance['class_custom'] = strip_tags( $new_instance['class_custom'] );
		// $instance['style']        = strip_tags( $new_instance['style'] );
		$instance['background_color'] = $new_instance['background_color'];  
		return $instance;
	}

	function form( $instance ) {
		$instance     = wp_parse_args( (array) $instance, array('background_color' => '#e3e3e3'   ) );
		// $class_custom = strip_tags( $instance['class_custom'] );
		// $style        = strip_tags( $instance['style'] );
		
        $background_color = $instance['background_color'];
		?>
		
		<script type="text/javascript">
			jQuery(document).ready(function($) {  
				$('.thim-picker-color').wpColorPicker(); 
				$("body").bind("ajaxComplete", function(){
					$('.thim-picker-color').wpColorPicker();  
				});
			});
		</script>
		<p>  
            <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Background Color', 'aloxo' ); ?></label>  
            <input class="thim-picker-color" type="text" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo esc_attr( $background_color ); ?>" />                              
        </p>
	<?php
	}
}

register_widget( 'aloxo_search_widget' );

/**
 * Extra class to widget
 * -----------------------------------------------------------------------------
 */

add_action( 'widgets_init', array( 'aloxo_Widget_Attributes', 'setup' ) );
class aloxo_Widget_Attributes {

	const VERSION = '0.2.2';

	/**
	 * Initialize plugin
	 */
	public static function setup() {
		if ( is_admin() ) {
			// Add necessary input on widget configuration form
			add_action( 'in_widget_form', array( __CLASS__, '_input_fields' ), 10, 3 );

			// Save widget attributes
			add_filter( 'widget_update_callback', array( __CLASS__, '_save_attributes' ), 10, 4 );
		}
		else {
			// Insert attributes into widget markup
			add_filter( 'dynamic_sidebar_params', array( __CLASS__, '_insert_attributes' ) );
		}
	}


	/**
	 * Inject input fields into widget configuration form
	 *
	 * @since 0.1
	 * @wp_hook action in_widget_form
	 *
	 * @param object $widget Widget object
	 *
	 * @return NULL
	 */
	public static function _input_fields( $widget, $return, $instance ) {
		$instance = self::_get_attributes( $instance );
		?>
			<p>
				<?php printf(
					'<label for="%s">%s</label>',
					esc_attr( $widget->get_field_id( 'widget-class' ) ),
					esc_html__( 'Extra Class', 'widget-attributes' )
				) ?>
				<?php printf(
					'<input type="text" class="widefat" id="%s" name="%s" value="%s" />',
					esc_attr( $widget->get_field_id( 'widget-class' ) ),
					esc_attr( $widget->get_field_name( 'widget-class' ) ),
					esc_attr( $instance['widget-class'] )
				) ?>
			</p>
		<?php
		return null;
	}


	/**
	 * Get default attributes
	 *
	 * @since 0.1
	 *
	 * @param array $instance Widget instance configuration
	 *
	 * @return array
	 */
	private static function _get_attributes( $instance ) {
		$instance = wp_parse_args(
			$instance,
			array(
				'widget-class' => '',
			)
		);

		return $instance;
	}


	/**
	 * Save attributes upon widget saving
	 *
	 * @since 0.1
	 * @wp_hook filter widget_update_callback
	 *
	 * @param array  $instance     Current widget instance configuration
	 * @param array  $new_instance New widget instance configuration
	 * @param array  $old_instance Old Widget instance configuration
	 * @param object $widget       Widget object
	 *
	 * @return array
	 */
	public static function _save_attributes( $instance, $new_instance, $old_instance, $widget ) {
		$instance['widget-class'] = '';

		// Classes
		if ( !empty( $new_instance['widget-class'] ) ) {
			$instance['widget-class'] = apply_filters(
				'widget_attribute_classes',
				implode(
					' ',
					array_map(
						'sanitize_html_class',
						explode( ' ', $new_instance['widget-class'] )
					)
				)
			);
		}
		else {
			$instance['widget-class'] = '';
		}

		return $instance;
	}


	/**
	 * Insert attributes into widget markup
	 *
	 * @since 0.1
	 * @filter dynamic_sidebar_params
	 *
	 * @param array $params Widget parameters
	 *
	 * @return Array
	 */
	public static function _insert_attributes( $params ) {
		global $wp_registered_widgets;

		$widget_id  = $params[0]['widget_id'];
		$widget_obj = $wp_registered_widgets[ $widget_id ];

		if (
			!isset( $widget_obj['callback'][0] )
			|| !is_object( $widget_obj['callback'][0] )
		) {
			return $params;
		}

		$widget_options = get_option( $widget_obj['callback'][0]->option_name );
		if ( empty( $widget_options ) )
			return $params;

		$widget_num	= $widget_obj['params'][0]['number'];
		if ( empty( $widget_options[ $widget_num ] ) )
			return $params;

		$instance = $widget_options[ $widget_num ];

		// Classes
		if ( ! empty( $instance['widget-class'] ) ) {
			$params[0]['before_widget'] = preg_replace(
				'/class="/',
				sprintf( 'class="%s ', $instance['widget-class'] ),
				$params[0]['before_widget'],
				1
			);
		}

		return $params;
	}
}