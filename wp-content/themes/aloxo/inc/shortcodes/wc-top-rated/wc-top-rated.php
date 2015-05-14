<?php

//////////////////////////////////////////////////////////////////
// add widget woocommerce top rated
//////////////////////////////////////////////////////////////////
add_shortcode( 'widget_top_rated_product', 'woocommerce_top_rated' );
function woocommerce_top_rated( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title'    => '',
		'number'   => '5',
		'style'    => '',
		'number'   => '',
		'el_class' => ''
	), $atts ) );

	add_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
	$query_args               = array( 'posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );
	$query_args['meta_query'] = WC()->query->get_meta_query();

	$r = new WP_Query( $query_args );

	if ( $r->have_posts() ) {
		$output = '<div class="woocommerce shortcode_products ' . $el_class . '">';
		if ( $title ) {
			$output .= '<div class="module_title shortcode_headding ' . $style . '"><h4 class="shortcode_title">' . $title . '</h4>';
			if ( $style == "style2" || $style == "style3" ) {
				$output .= '<span class="line-center"></span>';
			}
			$output .= '</div>';
		}

		$output .= '<ul class="product_list_widget">';
		while ( $r->have_posts() ) {
			$r->the_post();
			ob_start();
			wc_get_template( 'content-widget-product.php', array( 'show_rating' => true ) );
			$content_product = ob_get_contents();
			ob_end_clean();
			$output .= $content_product;
		}
		$output .= '</ul></div>';
	}
	remove_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
	wp_reset_postdata();

	return $output;
}
