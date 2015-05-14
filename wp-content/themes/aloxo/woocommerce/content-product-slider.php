<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

global $product, $woocommerce_loop, $theme_options_data, $post;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop'] ++;
// Extra post classes
$classes = array();
$classes[] = 'product_animated animated';
?>



<li <?php post_class( $classes ); ?>>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<div class="item-product">
		<?php
		if ( isset( $theme_options_data['thim_woo_set_show_wishlist'] ) && $theme_options_data['thim_woo_set_show_wishlist'] == '1' ) {
			if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) || is_plugin_active_for_network('yith-woocommerce-wishlist/init.php')) {
				echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
			}
		}
		?>
		<div class="product-hover">
			<?php
			if ( isset( $theme_options_data['thim_woo_set_hover_item'] ) && $theme_options_data['thim_woo_set_hover_item'] == "changeimages" ) {
				echo '<div class="product-image">';
			} else {
				echo '<div class="product-image flip-wrapper">';
			}?>
			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );


			?>

		</div>
		<div class="product-button">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="link_hover">&nbsp;</a>
			<div class="box-button">
				<div class="item_button">
				<?php

				do_action( 'woocommerce_after_shop_loop_item' );


				if ( isset( $theme_options_data['thim_woo_set_show_qv'] ) && $theme_options_data['thim_woo_set_show_qv'] == '1' ) {
					echo '<div class="quick-view" data-prod="' . $post->ID . '"><i class="fa fa-search"></i></div>';
				}


				if ( isset( $theme_options_data['thim_woo_set_show_compare'] ) && $theme_options_data['thim_woo_set_show_compare'] == '1' ) {
					if ( is_plugin_active( 'yith-woocommerce-compare/init.php') || is_plugin_active_for_network('yith-woocommerce-compare/init.php')) {
						echo '<a href="' . get_permalink( $product->id ) . '&amp;action=yith-woocompare-add-product&amp;id=' . $product->id . '" class="compare button" data-product_id="' . $product->id . '" title="' . __( "Compare", "aloxo" ) . '">' . __( "Compare", "aloxo" ) . '</a>';
					}
				}

				?>
				</div>
			</div>
		</div>



	</div>



	<?php
	/**
	 * woocommerce_after_shop_loop_item_title hook
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );
	?>
	<div class="hr">&nbsp;</div>
	<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

	</div>
	<?php /*do_action( 'woocommerce_after_shop_loop_item' );*/?>
</li>

