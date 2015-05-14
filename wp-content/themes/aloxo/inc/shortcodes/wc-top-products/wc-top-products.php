<?php

add_shortcode( 'top_products', 'top_products' );

function top_products( $atts, $content = null ) {
	global $woocommerce;
	extract( shortcode_atts( array(
		'number_posts' => 5,
		'title'        => '',
		'type'		   => '',
		'layout'       => '',
		'el_class'     => '',
		'column'       => '',
	), $atts ) );


	if ( class_exists( 'Woocommerce' ) ):
		$query_args = array(
			'posts_per_page' => $number_posts,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'no_found_rows'  => 1,
			'order'			 => 'desc'
		);

		$query_args['meta_query'] = array();

		if ( empty( $instance['show_hidden'] ) ) {
			$query_args['meta_query'][] = WC()->query->visibility_meta_query();
			$query_args['post_parent']  = 0;
		}

		if ( ! empty( $instance['hide_free'] ) ) {
			$query_args['meta_query'][] = array(
			    'key'     => '_price',
			    'value'   => 0,
			    'compare' => '>',
			    'type'    => 'DECIMAL',
			);
		}

		$query_args['meta_query'][] = WC()->query->stock_status_meta_query();
    	$query_args['meta_query']   = array_filter( $query_args['meta_query'] );

		switch ( $type ) {
			case 'feature' :
				$query_args['meta_query'][] = array(
					'key'   => '_featured',
					'value' => 'yes'
				);
				break;
			case 'recent' :
				$query_args['orderby'] = 'date';
				break;
			case 'bets_seller' :
				$query_args['meta_key'] = 'total_sales';
				$query_args['orderby'] = 'meta_value_num';
				break;
			default :
				$query_args['orderby'] = 'date';
		}
		
		$class_slider = $class_column = '';
		if ( $layout == 'slider' ) {
			$class_slider = "products-slider";
		}
		if ( $layout == 'lists' && $column !='' ) {
 			$class_column =' product_width_'.$column;
		}
		$r    = new WP_Query( $query_args );
		$html = '<div class="products-slider-01 wc-top-product woocommerce ' . $class_slider . '">';

		if ( $r->have_posts() ) {
			$html .= '<ul class="products'.$class_column.'">';
			while ( $r->have_posts() ): $r->the_post();
				ob_start();
				//woocommerce_get_template( 'content-top-product.php' );
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
