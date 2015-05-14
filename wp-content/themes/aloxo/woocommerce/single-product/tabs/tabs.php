<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
	<?php
		global $theme_options_data;
		if (isset($theme_options_data['thim_woo_set_desc_style']) && $theme_options_data['thim_woo_set_desc_style']=="style_tab") {

		
	?>
	<div class="woocommerce-tabs">
		<ul class="tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php echo $key ?>_tab">
					<a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</li>

			<?php endforeach; ?>
		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<div class="panel entry-content" id="tab-<?php echo $key ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>

		<?php endforeach; ?>
	</div>
	<?php
		} else {
	?>
			<div class="panel-group toggle_desc" id="accordion">
				<?php
				$i = 1;
				foreach ( $tabs as $key => $tab ) :
					?>
					<div class="panel panel-description">
						<div class="panel-heading">
							<p class="panel-title">
								<a <?php if ( $i !== 1 ) { echo 'class="collapsed"';} ?> data-toggle="collapse" data-parent="#accordion" href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
							</p>
						</div>
						<div id="tab-<?php echo $key ?>" class="panel-collapse collapse <?php if ( $i == 1 ) {
							echo "in";
						} ?>">
							<div class="panel-body">
								<?php call_user_func( $tab['callback'], $key, $tab ) ?>
							</div>
						</div>
					</div>
					<?php $i ++; endforeach; ?>
			</div>
	<?php
		}
	?>
<?php endif; ?>