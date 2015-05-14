<?php
add_shortcode( 'wc_countdown', 'shortcode_wc_countdown' );
function shortcode_wc_countdown( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title_sale_product'=> '',
		'sale_product'      => ''
	), $atts ) );

	if ( $sale_product ) {
 		$sale_product  = explode( ',', $sale_product );
	}

	ob_start();

	$randnumber = rand( 0, 10000 );
	$number_id  = $randnumber;
	wp_enqueue_script( 'aloxo-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '', false );
	
	if (count($sale_product) > 1) {
		$btn_custom ='var $pagination_top_'.$number_id.' = product_'.$number_id.'.prev(".heading_sale").find(".arrows"),
			$next_top_'.$number_id.' = $pagination_top_'.$number_id.'.find(".next"),
			$back_top_'.$number_id.' = $pagination_top_'.$number_id.'.find(".back");

		$next_top_'.$number_id.'.click(function () {

			product_'.$number_id.'.trigger("owl.next");
		});
		$back_top_'.$number_id.'.click(function () {
			product_'.$number_id.'.trigger("owl.prev");
		});
		';
	} else $btn_custom = "";

	$config = ",singleItem:true";
	echo '
		<script>
		jQuery(function($) {
			var product_'.$number_id.' = $("#product_'.$number_id.'");
			$("#product_' . $number_id . '").owlCarousel({
				autoPlay: false
				,pagination: false
				'.$config.'
			});
			'.$btn_custom .'
		});
	</script>';
	

	

	?>
	<div class="woocommerce ob_widget">
		<div class="heading_sale">
			<h3><?php echo $title_sale_product;?></h3>
			<?php if (count($sale_product) > 1) { ?>
			<div class="arrows">
				<span class="back"><i class="fa fa-angle-left"></i></span> <span class="next"><i class="fa fa-angle-right"></i></span>
			</div>
			<?php } ?>
		</div>
		<ul id="product_<?php echo $number_id;?>" class="products">
		<?php
		@$show_datetext = get_option( 'ob_datetext_show', 1 );
		$date_text = $message = $time_text = '';
		$localization = ', localization:{ days: "' . __( 'days', 'woosalescountdown' ) . '", hours: "' . __( 'hours', 'woosalescountdown' ) . '", minutes: "' . __( 'minutes', 'woosalescountdown' ) . '", seconds: "' . __( 'seconds', 'woosalescountdown' ) . '" }';
		if ( ! $show_datetext ) {
			$date_text = ', showText:0';
		}
		if ( count( $sale_product ) > 0 ) {
			for ( $i = 0; $i < count( $sale_product ); $i ++ ) {

				$product = get_product( $sale_product[$i] );
				if (!$product->id) {
					return;
				}
				if ( trim( $product->product_type ) != 'variable' ) {
					$time_from           = get_post_meta( $product->id, "_sale_price_dates_from", true );
					$time_end            = get_post_meta( $product->id, "_sale_price_dates_to", true );
					$_turn_off_countdown = get_post_meta( $product->id, '_turn_off_countdown', true );

					$ob_product_show_title     = get_option( 'ob_product_show_title', 'yes' );
					$ob_product_show_price     = get_option( 'ob_product_show_price', 'yes' );
					$ob_product_show_image     = get_option( 'ob_product_show_image', 'yes' );
					$ob_product_show_addtocart = get_option( 'ob_product_show_addtocart', 'yes' );
					$ob_product_show_linkable  = get_option( 'ob_product_show_linkable', 'yes' );
					$ob_product_images_sizes   = get_option( 'ob_product_images_sizes', 'shop_thumbnail' );
					$show_message              = get_option( 'ob_message_show', 1 );
					?>
					<li class="product">
						<?php if (trim( $ob_product_show_linkable ) == 'yes'){ ?>
						<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>">
							<?php } ?>
							<?php if ( trim( $ob_product_show_image ) == 'yes' ) { ?>
								<?php echo $product->get_image( $ob_product_images_sizes ); ?>
							<?php } ?>
							<?php if ( trim( $ob_product_show_title ) == 'yes' ) { ?>
								<h3><?php echo $product->get_title() ?></h3>
							<?php } ?>
							<?php if ( trim( $ob_product_show_price ) == 'yes' ) {
								echo $product->get_price_html();
							} ?>
							<?php if (trim( $ob_product_show_linkable ) == 'yes'){ ?>
						</a>
					<?php } ?>
						<?php
						if ( $time_from && $time_end && !$_turn_off_countdown ) {
							$discount      = get_post_meta( $product->id, "_quantity_discount", true );
							$sale          = get_post_meta( $product->id, "_quantity_sale", true );
							$stock         = get_post_meta( $product->id, "_stock", true );
							$_manage_stock = get_post_meta( $product->id, "_manage_stock", true );

							if ( $_manage_stock ) {
								if ( trim( $_manage_stock ) == 'yes' ) {
									if ( $stock < 1 ) {
										$discount = 0;
									}
								}
							}
							if ( ! $sale ) {
								$sale = 0;
							}
							$current_time = strtotime( current_time( "Y-m-d G:i:s" ) );
							$date_format  = get_option( 'date_format', 'F j, Y' );
							if ( $current_time < $time_from ) {
								$time = $time_from; // - time();

								@$message = __( get_option( 'ob_title_coming', 'Coming' ), 'woosalescountdown' );

								$time_text = '<h5 class="schedule_text">' . date( $date_format, $time_from ) . __(' to ','woosalescountdown') . date( $date_format, $time_end ) . '</h5>';
							} else {
								$time = $time_end; // - time();

								@$message = __( get_option( 'ob_title_sale', 'Sale' ), 'woosalescountdown' );

								$time_text = '<h5 class="schedule_text">' . date( $date_format, $time_from ) . __(' to ','woosalescountdown') . date( $date_format, $time_end ) . '</h5>';
							}
							if ( $current_time > $time_end ) {
								continue;
							}
							$check_sale = 1;
							if ( $sale < $discount ) {
								@$per_sale = intval( $sale / $discount * 100 );
							} else {
								$check_sale = 0;
							}

							@$ob_time_show = get_option( 'ob_time_show' );
							switch ( $ob_time_show ) {
								case 1:
									?>
									<div class="ob_warpper">
										<?php if ( $show_message ) { ?>
											<h3><?php echo $message ?></h3>
										<?php } ?>
									</div>

									<div class="widget_myCounter_<?php echo $product->id; ?> widget_product"></div>
									<?php break;
								case 2:
									if ( $check_sale ) {
										?>
										<div class="ob_warpper">
											<?php if ( $show_message ) { ?>
												<h3><?php echo $message ?></h3>
											<?php } ?>

											<div class="ob_discount">
												<div class="ob_sale" style="width:<?php echo $per_sale ?>%"></div>
											</div>
											<span><?php echo $sale . ' ' . __( 'sold', 'woosalescountdown' ) ?></span>

										</div>
									<?php
									}
									break;
								case 3:
									?>
									<div class="ob_warpper">
										<?php if ( $show_message ) { ?>
											<h3><?php echo $message ?></h3>

										<?php } ?>
										<?php echo $time_text; ?>
									</div>


									<?php break;
								default:
									?>
										<div class="ob_warpper">
											<?php if ( $show_message ) { ?>
												<h3><?php echo $message ?></h3>
											<?php } ?>
											<?php if ( $check_sale ) { ?>
												<div class="ob_discount">
													<div class="ob_sale" style="width:<?php echo $per_sale ?>%"></div>
												</div>
												<span><?php echo $sale . ' ' . __( 'sold', 'woosalescountdown' ) ?></span>
											<?php } ?>
										</div>

										<div class="widget_myCounter_<?php echo $product->id; ?> widget_product"></div>

									<?php
							} ?>
							<?php echo "<script type='text/javascript'>
									jQuery(function () {
										jQuery('.widget_myCounter_" . $product->id . "').mbComingsoon({ expiryDate: new Date(" . date( "Y", $time ) . ", " . ( date( "m", $time ) - 1 ) . ", " . date( "d", $time ) . "), speed:500, gmt:" . get_option( 'gmt_offset' ) . $date_text . $localization . " });
									});
									</script>";
						}
						if ( trim( $ob_product_show_addtocart ) == 'yes' ) {
							echo apply_filters( 'woocommerce_loop_add_to_cart_link',
								sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button add_to_cart_button product_type_simple %s product_type_%s">%s</a>',
									esc_url( $product->add_to_cart_url() ),
									esc_attr( $product->id ),
									esc_attr( $product->get_sku() ),
									$product->is_purchasable() ? 'add_to_cart_button' : '',
									esc_attr( $product->product_type ),
									esc_html( $product->add_to_cart_text() ) ),
								$product );
						}
						?>
					</li>
				<?php
				} else {

					$ob_product_show_title     = get_option( 'ob_product_show_title', 'yes' );
					$ob_product_show_price     = get_option( 'ob_product_show_price', 'yes' );
					$ob_product_show_image     = get_option( 'ob_product_show_image', 'yes' );
					$ob_product_show_addtocart = get_option( 'ob_product_show_addtocart', 'yes' );
					$ob_product_show_linkable  = get_option( 'ob_product_show_linkable', 'yes' );
					$ob_product_images_sizes   = get_option( 'ob_product_images_sizes', 'shop_thumbnail' );

					?>
					<li class="product">
						<?php if (trim( $ob_product_show_linkable ) == 'yes'){ ?>
						<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>">
							<?php } ?>
							<?php if ( trim( $ob_product_show_image ) == 'yes' ) { ?>
								<?php echo $product->get_image( $ob_product_images_sizes ) ?>
							<?php } ?>
							<?php if ( trim( $ob_product_show_title ) == 'yes' ) { ?>
								<h3><?php echo $product->get_title() ?></h3>
							<?php } ?>
							<?php if ( trim( $ob_product_show_price ) == 'yes' ) {
								echo $product->get_price_html();
							} ?>
							<?php if (trim( $ob_product_show_linkable ) == 'yes'){ ?>
						</a>
					<?php
					}


					if ( trim( $ob_product_show_addtocart ) == 'yes' ) {
						echo apply_filters( 'woocommerce_loop_add_to_cart_link',
							sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button add_to_cart_button  %s product_type_%s">%s</a>',
								esc_url( $product->add_to_cart_url() ),
								esc_attr( $product->id ),
								esc_attr( $product->get_sku() ),
								$product->is_purchasable() ? 'add_to_cart_button' : '',
								esc_attr( $product->product_type ),
								esc_html( $product->add_to_cart_text() ) ),
							$product );
					}
					?>
					</li>
				<?php
				}
			}
		} ?>
		</ul>
		</div>
	<?php
	$content_product = ob_get_contents();
	ob_end_clean();
	$html = $content_product;
	return $html;
}