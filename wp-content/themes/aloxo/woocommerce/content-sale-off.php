<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-sale-off.php
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

global $product, $woocommerce_loop,$theme_options_data;

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
//if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
//	$classes[] = 'first';
//}
//if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
//	$classes[] = 'last';
//}
//$classes[] = 'product_animated animated';
//$classes[] = 'col-xs-6';


?>
<li <?php post_class( $classes ); ?>>

	<div class="item-product">
		<?php echo woocommerce_get_product_thumbnail(array(158,158))?>
		<a class="product-name" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		<span class="product-sale-off">GET UP TO 20% OFF</span>
		<a class="product-button" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">SHOP NOW</a>
	<?php
	/**
	 * woocommerce_after_shop_loop_item_title hook
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */

	?>

	</div>
</li>