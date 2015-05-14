<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

get_header( 'shop' ); ?>

<?php
/**
 * Custom Layout
 */
global $theme_options_data, $wp_query, $cate_sidebar;

$class         = 'col-sm-9 alignright';
$sidebar_cl    = " product-sidebar-left";
$cate_sidebar  = "left";
$select_layout = $images_link = $text_color_infor = null;

if ( $theme_options_data['thim_woo_cate_layout'] == '2c-r-fixed' ) {
	$class      = "col-sm-9 alignleft";
	$sidebar_cl = " product-sidebar-right";
}
if ( $theme_options_data['thim_woo_cate_layout'] == '1col-fixed' ) {
	$class        = "col-sm-12 fullwith";
	$sidebar_cl   = "";
	$cate_sidebar = "no";
}

$cat_obj = $wp_query->get_queried_object();
if ( $cat_obj ) {
	if ( property_exists( $cat_obj, 'term_id' ) ) {
		$category_ID      = $cat_obj->term_id;
		$select_layout    = get_tax_meta( $category_ID, 'aloxo_custom_cate_layout', true );
		$images_link      = get_tax_meta( $category_ID, 'aloxo_bg_product', true );
		$text_color_infor = get_tax_meta( $category_ID, 'aloxo_text_color_product', true );
		if ( $text_color_infor == '' ) {
			$text_color_infor = "#";
		}
		if ( $select_layout == "right_sidebar" ) {
			$class        = "col-sm-9 alignleft";
			$sidebar_cl   = " product-sidebar-right";
			$cate_sidebar = "right";
		} else {
			if ( $select_layout == "fullwidth" ) {
				$class        = "col-sm-12 fullwith";
				$sidebar_cl   = "";
				$cate_sidebar = "no";
			} else {
				if ( $select_layout == "left_sidebar" ) {
					$class        = "col-sm-9 alignright";
					$sidebar_cl   = " product-sidebar-left";
					$cate_sidebar = "left";
				} else {

				}
			}
		}
	}
}
?>
	<div class="main-content-shop site-main" role="main">
		<?php get_template_part( 'inc/templates/archive-product', 'top' ); ?>
		<div class="container archive-product-wapper<?php echo $sidebar_cl; ?>">
			<div class="row">
				<div class="archive-product-content <?php echo $class; ?>">
					<?php
					/**
					 * woocommerce_before_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					do_action( 'woocommerce_before_main_content' );
					?>

					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

						<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

					<?php endif; ?>

					<?php do_action( 'woocommerce_archive_description' ); ?>

					<?php if ( have_posts() ) : ?>
						<?php
						$class_product = 'grid';
						$gird_active   = $list_active = '';
						if ( isset( $theme_options_data['thim_list_grid_default'] ) ) {
							$class_product = $theme_options_data['thim_list_grid_default'];
						}
						if ( isset( $theme_options_data['thim_list_grid_default'] ) && $theme_options_data['thim_list_grid_default'] == 'list' ) {
							$list_active = ' switcher-active';
						}
						if ( isset( $theme_options_data['thim_list_grid_default'] ) && $theme_options_data['thim_list_grid_default'] == 'grid' ) {
							$gird_active = ' switcher-active';
						}
						?>
						<!-- product list/grid -->
						<div class="product-filter">
							<div class="display">
								<a href="javascript:;" class="switchToGrid<?php echo esc_attr( $gird_active ); ?>"><i class="fa fa-th"></i></a>
								<a href="javascript:;" class="switchToList<?php echo esc_attr( $list_active ); ?>"><i class="fa fa-list-ul"></i></a>
							</div>
							<div class="sort">
								<?php
								/**
								 * woocommerce_before_shop_loop hook
								 *
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action( 'woocommerce_before_shop_loop' );
								?>
							</div>
						</div>

						<?php //woocommerce_product_loop_start(); ?>
						<ul class="products archive_switch products-<?php echo esc_attr( $class_product ); ?>">
							<?php woocommerce_product_subcategories(); 
							
							$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
							$segments = explode('/', $url);
							if($segments[2] != ""):
								while ( have_posts() ) : the_post(); ?>

									<?php wc_get_template_part( 'content', 'product' ); ?>

								<?php endwhile; // end of the loop. 
								endif;
								?>
						</ul>
						<?php //woocommerce_product_loop_end(); ?>

						<?php
						/**
						 * woocommerce_after_shop_loop hook
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
						?>

					<?php elseif ( !woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

						<?php wc_get_template( 'loop/no-products-found.php' ); ?>

					<?php endif; ?>
				</div>
				<?php
				/**
				 * woocommerce_after_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );
				?>

				<?php
				/**
				 * woocommerce_sidebar hook
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				//do_action( 'woocommerce_sidebar' );
				if ( $class != "col-sm-12 fullwith" ) {
					do_action( 'woocommerce_sidebar' );
				}
				?>
			</div>
		</div>
	</div>
<?php get_footer( 'shop' ); ?>