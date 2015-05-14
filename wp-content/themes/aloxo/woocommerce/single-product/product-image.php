<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

if ($product->get_gallery_attachment_ids()) {
	$has_thumb = " has-thumb";
}else {
	$has_thumb = "";
}

global $theme_options_data;

// Zoom out product image
if (isset($theme_options_data['thim_woo_set_effect']) && $theme_options_data['thim_woo_set_effect'] == "zoom_out") {
	wp_enqueue_script( 'aloxo-retina' );	
}


?>

<div class="images<?php echo $has_thumb;?>">
	<div id="product-image">
	<?php
		if ( has_post_thumbnail() ) {

			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
			$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $image_title
				) );

			$attachment_count = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			// Zoom out product image
			if (isset($theme_options_data['thim_woo_set_effect']) && $theme_options_data['thim_woo_set_effect'] == "zoom_out") {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="item"><a href="%s" itemprop="image" class="retina woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a></div>', $image_link, $image_title, $image ), $post->ID );
			}else {
				// Popup
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="item"><a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a></div>', $image_link, $image_title, $image ), $post->ID );
			}

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="item"><img src="%s" alt="%s" /></div>', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

		}
	?>
	<?php 
		$attachment_ids = $product->get_gallery_attachment_ids();

		if ( $attachment_ids ) {
			wp_enqueue_script( 'aloxo-owl-carousel' );
			?>
			<?php

				$loop = 0;
				$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

				foreach ( $attachment_ids as $attachment_id ) {

					$classes = array( 'zoom' );

					if ( $loop == 0 || $loop % $columns == 0 )
						$classes[] = 'first';

					if ( ( $loop + 1 ) % $columns == 0 )
						$classes[] = 'last';

					$image_link = wp_get_attachment_url( $attachment_id );

					if ( ! $image_link )
						continue;

					$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
					$image_class = esc_attr( implode( ' ', $classes ) );
					$image_title = esc_attr( get_the_title( $attachment_id ) );

					// Zoom out product image
					if (isset($theme_options_data['thim_woo_set_effect']) && $theme_options_data['thim_woo_set_effect'] == "zoom_out") {
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="item"><a href="%s" class="retina %s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a></div>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );
					}else {
						// Popup
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="item"><a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a></div>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );
					}

					$loop++;
				}

			?>
			<?php
		}

	?>
	</div>
	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
