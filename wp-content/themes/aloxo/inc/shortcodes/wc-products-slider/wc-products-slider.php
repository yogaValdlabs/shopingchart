<?php
/**
 * Created by PhpStorm.
 * User: duonglh
 * Date: 6/30/14
 * Time: 2:45 PM
 */

add_shortcode( 'wc_products_slider', 'shortcode_wc_products_slider' );
function shortcode_wc_products_slider($atts, $content = null )
{
	$class_slider = $product_cat = $class_column = $number = $order = $aloxo_animation = $el_class = $css_animation = $show = $orderby = $layout = $column = $title = '';

	extract( shortcode_atts( array(
		'title'       => '',
		'number'      => '5',
		'show'        => '',
		'product_cat' => '',
		'orderby'     => '',
		'order'       => '',
		'hide_free'   => '',
		'show_hidden' => '',
		'el_class'    => '',
		/*'layout'      => '',*/
		'column'      => '3',
		'css_animation' => '',
		'border_bottom_title_color' => '#37c6ca'
	), $atts ) );

	$aloxo_animation .= ' ' . $el_class;
	$aloxo_animation .= aloxo_getCSSAnimation_woocommerce( $css_animation );

	$query_args = array(
		'posts_per_page' => $number,
		'post_status'    => 'publish',
		'post_type'      => 'product',
		'no_found_rows'  => 1,
		'order'          => $order == 'asc' ? 'asc' : 'desc'
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


	switch ( $show ) {
		case 'featured' :
			$query_args['meta_query'][] = array(
				'key'   => '_featured',
				'value' => 'yes'
			);
			break;
		case 'onsale' :
			$product_ids_on_sale    = wc_get_product_ids_on_sale();
			$product_ids_on_sale[]  = 0;
			$query_args['post__in'] = $product_ids_on_sale;
			break;
		/*case 'recent':
			$query_args['orderby'] = 'date';
			$query_args['order'] = 'desc';
			break;*/
	}

	switch ( $orderby ) {
		case 'price' :
			$query_args['meta_key'] = '_price';
			$query_args['orderby']  = 'meta_value_num';
			break;
		case 'rand' :
			$query_args['orderby'] = 'rand';
			break;
		case 'sales' :
			$query_args['meta_key'] = 'total_sales';
			$query_args['orderby']  = 'meta_value_num';
			break;
		default :
			$query_args['orderby'] = 'date';
	}

	$r            = new WP_Query( $query_args );

	$class_slider = "products-slider-02";


	$html = '<div class="wc-product-slider woocommerce ' . $aloxo_animation .' '. $class_slider . '">';
	if ( $title != '' ) {
		$html .= '<div class="module_title"><h4 style="border-bottom:2px solid '.$border_bottom_title_color.' !important">' . $title . '</h4><div class="es-nav"><span class="es-nav-prev" style="display: block;"><i class="fa fa-angle-left"></i></span><span class="es-nav-next" style="display: block;"><i class="fa fa-angle-right"></i></span></div></div>';
	}


	$total_products = 0;
	$index =  0 ;

	if ( $r->have_posts() ) {
		$html .= '<ul class="slider">';
		while ( $r->have_posts() ) {
			$r->the_post();
			ob_start();
			woocommerce_get_template( 'content-product-slider.php' );
			$content_product = ob_get_contents();
			ob_end_clean();
		 	$index++;
			$total_products++;

			if ($index == 1) {
			 $html .= '<li><ul class="products col-'. $column . '">';
		 	}

			$html .= $content_product;

			if ($index == $column * 2 || $total_products == $r->post_count) {
				$html .= '</ul></li>';
				$index = 0;
			}
		}
		$html .= '</ul>';
	}
	$html .= '</div>';

	wp_reset_postdata();
	wp_reset_query();
	return $html;


}