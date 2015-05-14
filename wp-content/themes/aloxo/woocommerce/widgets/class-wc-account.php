<?php
/**
 * Account Widget
 *
 * Displays Account Link widget
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

class WC_Account extends WP_Widget {
	function WC_Account() {
        //Constructor
        $widget_ops = array( 'classname' => 'aloxo_wc_account', 'description' => 'Account for aloxo site.' );
        $this->WP_Widget( 'aloxo_widget_account', 'Aloxo: Account', $widget_ops );
    add_action( 'load-widgets.php', array(&$this, 'thim_script') ); 
    }
    function thim_script() {      
        wp_enqueue_style( 'wp-color-picker' );          
        wp_enqueue_script( 'wp-color-picker' );      
    }  
	function widget( $args, $instance ) {
		extract( $args );
		$background_color = $instance['background_color']; 

		if ($background_color) {
			$style = ' style="background: '.$background_color.'"';
		}else $style = "";
		echo $before_widget;
		$myaccount_page_url = $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
		if ( $myaccount_page_id ) {
		  $myaccount_page_url = get_permalink( $myaccount_page_id );
		}
		echo '<a class="widget-account" href="'.esc_url($myaccount_page_url).'"'.$style.'></a>';
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
        $instance['background_color'] = $new_instance['background_color'];  
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
            'background_color' => '#e3e3e3'  
        );  
        // Merge the user-selected arguments with the defaults  
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>  
		
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
            <input class="thim-picker-color" type="text" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />                              
        </p>
        <?php	
	}

}

register_widget( 'WC_Account' );