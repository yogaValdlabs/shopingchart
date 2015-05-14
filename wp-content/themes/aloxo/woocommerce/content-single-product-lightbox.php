<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
global $product;

?>
<div class="woocommerce">
	<div id="content">
		<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" class="product">
			<?php
			global $post, $woocommerce, $product;
			$attachment_ids = $product->get_gallery_attachment_ids();
			?>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.retina.min.js"></script>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider-min.js"></script>
			<script type="text/javascript">
				jQuery(document).ready(function () {
					jQuery(".retina").retina({preload: true})
					jQuery('#carousel').flexslider({
						animation    : "slide",
						controlNav   : false,
						animationLoop: false,
						slideshow    : false,
						itemWidth    : 101,
						itemMargin   : 30,
						asNavFor     : '#slider',
						directionNav : false//Boolean: Create navigation for previous/next navigation? (true/false)
					});

					jQuery('#slider').flexslider({
						animation    : "slide",
						controlNav   : false,
						animationLoop: false,
						slideshow    : false,
						sync         : "#carousel",
						directionNav : true,//Boolean: Create navigation for previous/next navigation? (true/false)
						prevText     : "",//String: Set the text for the "previous" directionNav item
						nextText     : "",//String: Set the text for the "next" directionNav item
						start        : function (slider) {
							jQuery('body').removeClass('loading');
						}
					});

				});

			</script>

			<div class="images_quick_view">
				<div id="slider" class="flexslider">
					<ul class="slides">
						<?php
						if ( has_post_thumbnail() ) {
							$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
							$image_title      = esc_attr( get_the_title( get_post_thumbnail_id() ) );
							$image_link       = wp_get_attachment_url( get_post_thumbnail_id() );
							$attachment_count = count( $product->get_gallery_attachment_ids() );
							$gallery          = '[product-gallery]';
							echo '<li>';
							echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="retina" title="%s" style="">%s</a>', $image_link, $image_title, $image ), $post->ID );
							echo '</li>';
						}
						$attachment_ids = $product->get_gallery_attachment_ids();
						?>
						<?php
						$loop = 0;
						foreach ( $attachment_ids as $attachment_id ) {

							$image_link = wp_get_attachment_url( $attachment_id );

							if ( ! $image_link ) {
								continue;
							}
							$classes[]   = 'image-' . $attachment_id;
							$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
							$image_class = esc_attr( implode( ' ', $classes ) );
							$image_title = esc_attr( get_the_title( $attachment_id ) );
							echo '<li>';
							echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="retina" title="%s" style="">%s</a>', $image_link, $image_title, $image ), $post->ID );
							echo '</li>';
							$loop ++;
						}

						?>
					</ul>
				</div>
				<?php //do_action( 'woocommerce_product_thumbnails' ); ?>
			</div>


			<div class="summary_quick_view entry-summary x-summary">
				<div class="summary_content">
					<?php
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary_quick' );
					?>

				</div>
			</div>
			<!-- .summary -->
			<div class="clear"></div>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="view_detail_qw"> <?php echo _e( 'VIEW DETAIL', 'facile' ) ?></a>

			<div class="clear"></div>
		</div>
		<!-- #product-<?php the_ID(); ?> -->
	</div>

</div>