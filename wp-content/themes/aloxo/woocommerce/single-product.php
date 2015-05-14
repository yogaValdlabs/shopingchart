<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

<?php 
	/**
	 * Custom Layout
	 */
	global $theme_options_data;
	$custom_layout = get_post_meta( get_the_ID(), 'thim_mtb_custom_layout', true );
	// fixdata custom layout

	/***********custom select layout*************/
	$select_layout = get_post_meta( get_the_ID(), 'thim_mtb_layout', true );
	/***********custom layout style*************/
	$layout_style = get_post_meta( get_the_ID(), 'thim_mtb_layout_style', true );
	$class = 'col-sm-9 alignright';
	$sidebar_cl =" product-sidebar-left";
	if ($theme_options_data['thim_woo_single_layout'] == '2c-r-fixed') {
		$class = "col-sm-9 alignleft";
		$sidebar_cl =" product-sidebar-right";
	}
	if ($theme_options_data['thim_woo_single_layout'] == '1col-fixed') {
		$class = "col-sm-12 fullwith";
		$sidebar_cl ="";
	}
	if ( $custom_layout == '1' ) {
		if ( $layout_style == 'boxed' ) {
			if ( $select_layout == 'full-content' ) {
				$class = "col-sm-12 fullwith";
				$sidebar_cl ="";
			}
			if ( $select_layout == 'sidebar-right' ) {
				$class = "col-sm-9 alignleft";
				$sidebar_cl =" product-sidebar-right";
	 		}
			if ( $select_layout == 'sidebar-left' ) {
				$class = 'col-sm-9 alignright';
				$sidebar_cl =" sidebar-left";
			}
	 	} elseif ( $layout_style == 'wide' ) {
			$class = "box-full";
		}
	}
?>
<main id="main" class="site-main main-product <?php echo $sidebar_cl;?>" role="main">
	<?php get_template_part( 'inc/templates/content', 'top' ); ?>
	<?php
		// layout # wide
		if ( $custom_layout == '1' ) {
			if ( $layout_style == 'boxed' ) {
				echo '<div class="container product_box"><div class="row" style="margin: 0;">';
			}
		}else{
			echo '<div class="container product_box"><div class="row" style="margin: 0;">';
		}
	?>
	<div class="content-site-main <?php echo $sidebar_cl;?>">
		<div class="<?php echo $class; ?>">
	<?php
		
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
	<?php
		echo '<h1 class="page-title">'.get_the_title().'</h1>';
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	</div>
	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
		if ( $class == "col-sm-9 alignleft" ||  $class == "col-sm-9 alignright"  ) {
			do_action( 'woocommerce_sidebar' );
		}
	?>
	</div>
	<?php
	if ( $custom_layout == '1' ) {
		if ( $layout_style == 'boxed' ) {
			echo '</div></div>';
		}
	}else{
		echo '</div></div>';
	}
	?>
</main>
<?php get_footer( 'shop' ); ?>