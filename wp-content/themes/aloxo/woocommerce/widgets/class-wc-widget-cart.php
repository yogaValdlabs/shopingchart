<?php
/**
 * Shopping Cart Widget
 *
 * Displays shopping cart widget
 *
 * @author        WooThemes
 * @category      Widgets
 * @package       WooCommerce/Widgets
 * @version       2.0.1
 * @extends       WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Custom_WC_Widget_Cart extends WC_Widget_Cart {

	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;

	function Custom_WC_Widget_Cart() {
        //Constructor
    	add_action( 'load-widgets.php', array(&$this, 'thim_script') ); 
    	parent::__construct();
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
		$cart_style = $instance['cart_style']; 

		if ( is_cart() || is_checkout() ) {
			return;
		}
		global $woocommerce;
		$title         = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Cart', 'woocommerce' ) : $instance['title'], $instance, $this->id_base );
		$hide_if_empty = empty( $instance['hide_if_empty'] ) ? 0 : 1;
		echo $before_widget;
		if ( $title ) {
			echo '<div class="minicart_hover '.$cart_style.'" id="header-mini-cart">';
		}
		$cat_total = $woocommerce->cart->get_cart_subtotal();
		list( $cart_items ) = aloxo_get_current_cart_info();
 		//echo '<div class="main-header-cart"><ul class="aloxo_cart"><li><a href="#"> <span class="icon_cart"></span><span id="cart-items-number">'. $cart_items. ' items</span> </a></li><li>|</li><li><a href="#"><span id="cart-total">'.$cat_total.'</span></a></li>';
 		echo '<div class="main-header-cart"><ul class="aloxo_cart"><li><a href="#"'.$style.'> <span class="icon_cart"></span><span id="cart-items-number">'. $cart_items. '</span> </a></li></ul>';
		echo '</div>';
		if ( $hide_if_empty ) {
			echo '<div class="hide_cart_widget_if_empty">';
		}
		// Insert cart widget placeholder - code in woocommerce.js will update this on page load
		echo '<div class="widget_shopping_cart_content" style="display: none;"></div>';
		if ( $hide_if_empty ) {
			echo '</div>';
		}
		if ( $title ) {
			echo '</div>';
		}
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
		$instance['background_color'] = $new_instance['background_color'];  
		$instance['title']         = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['hide_if_empty'] = empty( $new_instance['hide_if_empty'] ) ? 0 : 1;
		$instance['cart_style'] = $new_instance['cart_style'];

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
		$hide_if_empty = empty( $instance['hide_if_empty'] ) ? 0 : 1;
		$background_color = isset($instance['background_color']) ? $instance['background_color'] : "";
		$cart_style = isset($instance['cart_style']) ? $instance['cart_style'] : "style-01";
		?>

		<p>
			<label for="<?php echo $this->get_field_id('cart_style'); ?>">
				<?php _e('Style', 'aloxo' ); ?>
			</label>
			<select name="<?php echo $this->get_field_name('cart_style'); ?>" id="<?php echo $this->get_field_id('cart_style'); ?>" class="widefat">
				<?php
				$s_style = array(
					'style-01'	=>	'Style 01', 
					'style-02'	=>	'Style 02',
					'style-03'	=>	'Style 03', 
				);
				foreach ($s_style as $key => $value) {
					echo '<option value="' . $key . '"', $cart_style == $key ? ' selected="selected"' : '', '>', $value, '</option>';
				}
				?>
			</select>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'woocommerce' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php if ( isset ( $instance['title'] ) ) {
				echo esc_attr( $instance['title'] );
			} ?>" /></p>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'hide_if_empty' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_if_empty' ) ); ?>"<?php checked( $hide_if_empty ); ?> />
			<label for="<?php echo $this->get_field_id( 'hide_if_empty' ); ?>"><?php _e( 'Hide if cart is empty', 'woocommerce' ); ?></label>
		</p>

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