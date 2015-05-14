<?php

add_shortcode( 'best_seller_products', 'best_seller_products' );

function best_seller_products( $atts, $content = null ) {
	global $woocommerce;
	extract( shortcode_atts( array(
		'number_posts' => 5,
		'title'        => '',
		'layout'       => '',
		'el_class'     => '',
		'column'       => '',
	), $atts ) );


	if ( class_exists( 'Woocommerce' ) ):
		$query_args                 = array(
			'posts_per_page' => $number_posts,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'meta_key'       => 'total_sales',
			'orderby'        => 'meta_value_num',
			'no_found_rows'  => 1,
		);
		$query_args['meta_query']   = $woocommerce->query->get_meta_query();
		$query_args['meta_query'][] = array(
			'key'     => '_price',
			'value'   => 0,
			'compare' => '>',
			'type'    => 'DECIMAL',
		);
		$class_slider = $class_column = '';
		if ( $layout == 'slider' ) {
			$class_slider = "products-slider";
		}
		if ( $layout == 'lists' && $column !='' ) {
 			$class_column =' product_width_'.$column;
		}
		$r    = new WP_Query( $query_args );
		$html = '<div class="wc-best-selles woocommerce ' . $class_slider . '">';
		if ( $r->have_posts() ) {
			$html .= '<ul class="products'.$class_column.'">';
			while ( $r->have_posts() ): $r->the_post();
				ob_start();
				woocommerce_get_template( 'content-product.php' );
				$content_product = ob_get_contents();
				ob_end_clean();
				$html .= $content_product;
			endwhile;
			$html .= '</ul>';
			if ( $layout == 'slider' ) {
				$html .= '<span class="es-nav-prev"><i class="fa fa-angle-left"></i></span><span class="es-nav-next"><i class="fa fa-angle-right"></i></span>';
			}
			wp_reset_postdata();
		}

		$html .= '</div>';
	endif;

	return $html;
}
