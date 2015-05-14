<?php

add_shortcode( 'wc_products', 'shortcode_wc_products' );
function shortcode_wc_products( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title'       => '',
		//'style' => '',
		'number'      => '5',
		'show'        => '',
		'orderby'     => '',
		'order'       => '',
		'hide_free'   => '',
		'show_hidden' => '',
		'el_class'    => '',
		'link'		  => '',
		'layout'      => '',
		'num_per_view'=> '',
		'column'      => ''
	), $atts ) );

	$query_args = array(
		'posts_per_page' => $number,
		'post_status' 	 => 'publish',
		'post_type' 	 => 'product',
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
			$product_ids_on_sale = wc_get_product_ids_on_sale();
			$product_ids_on_sale[] = 0;
			$query_args['post__in'] = $product_ids_on_sale;
			break;
	}

	switch ( $orderby ) {
		case 'price' :
			$query_args['meta_key'] = '_price';
			$query_args['orderby']  = 'meta_value_num';
			break;
		case 'rand' :
			$query_args['orderby']  = 'rand';
			break;
		case 'sales' :
			$query_args['meta_key'] = 'total_sales';
			$query_args['orderby']  = 'meta_value_num';
			break;
		default :
			$query_args['orderby']  = 'date';
	}
	
	$r = new WP_Query( $query_args );
	//$class_slider = $class_column = '';

	if ($layout == 'left') {
		if ($title != "")
			$class_column =' product_width_'.($column+1);
		else
			$class_column =' product_width_'.$column;

		$html = '<div class="wc-product woocommerce ' . $layout.'">';
		$html .= '<div class="shortcode_headding ' . $el_class . '">';
		$html .= '</div>';
		if ( $r->have_posts() ) {
			$html .= '<ul class="products'.$class_column.'">';
			
			// set link to read more button 
			if ( $link !== '' ) {
				$href      = vc_build_link( $link );
				if ($href['url']) {
					$more_link = '<div class="btn_vmore"><a href="' . esc_url($href['url']) . '" >';
					$more_link .= $href['title'];
					$more_link .= '</a></div>';
				}
			}else {
				$more_link = '';
			}

			$html .= '<li class="module_title_left style2 style2_no_bg"><div class="first-product"><h1 class="shortcode_title">' . $title . '</h1>'.$more_link.'</div></li>';
			while ( $r->have_posts() ) {
				$r->the_post();
				ob_start();
				woocommerce_get_template( 'content-product.php' );
				$content_product = ob_get_contents();
				ob_end_clean();
				$html .= $content_product;
			}
			$html .= '</ul>';
	 	}
		$html .= '</div>';
		//wp_reset_postdata();
		wp_reset_query();
		return $html;
	}

	if ($layout == 'top') {
		$class_column =' product_width_'.$column;
		$html = '<div class="wc-product woocommerce ' . $layout.'">';
		$html .= '<div class="shortcode_headding ' . $el_class . '">';
		if ( $title != '' ) {
			$html .= '<div class="module_title"><h3 class="shortcode_title">' . $title . '</h3></div>';
		}
		$html .= '</div>';
		if ( $r->have_posts() ) {
			$html .= '<ul class="products'.$class_column.'">';
			while ( $r->have_posts() ) {
				$r->the_post();
				ob_start();
				woocommerce_get_template( 'content-product.php' );
				$content_product = ob_get_contents();
				ob_end_clean();
				$html .= $content_product;
			}
			$html .= '</ul>';
	 	}

	 	// set link to read more button 
		if ( $link !== '' ) {
			$href      = vc_build_link( $link );
			if ($href['url']) {
				$more_link = '<div class="btn_vmore"><a href="' . esc_url($href['url']) . '" >';
				$more_link .= $href['title'];
				$more_link .= '</a></div>';
			}
		}else {
			$more_link = '';
		}

	 	$html .= $more_link;

		$html .= '</div>';
		//wp_reset_postdata();
		wp_reset_query();
		return $html;
	}
	if ($layout == 'layout-03') {
		$randnumber = rand( 0, 10000 );
		$number_id  = $randnumber;

		wp_enqueue_script( 'aloxo-jquery.jcarousellite', get_template_directory_uri() . '/js/jquery.jcarousellite.min.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'aloxo-imagesloaded.pkgd', get_template_directory_uri() . '/js/imagesloaded.pkgd.js', array( 'jquery' ), '', false );
	
		$html = '<div class="wc-product woocommerce ' . $layout.'">';
		// $html .= '<div class="shortcode_headding ' . $el_class . '">';
		if ( $title != '' ) {
			//$html .= '<div class="module_title"><h3 class="shortcode_title">' . $title . '</h3></div>';
			$html .= '<h3 class="title">' . $title . '</h3>';
		}

		//$html .= '</div>';
		if ( $r->have_posts() ) {
			$html .= '
	 		<script>
				jQuery(function($) {
					$(".wc-product .vertical_' . $number_id . '").imagesLoaded(function () {
						$(".wc-product .vertical_' . $number_id . '").jCarouselLite({
						    vertical: true,
						    hoverPause:true,
						    btnNext: ".wc-product .next",
	    					btnPrev: ".wc-product .prev",
						    visible: '.$num_per_view.',
						    auto:3000,
						    speed:500
					    });
					});
				});
			</script>';
			$html .= '<div class="prev"><i class="fa fa-angle-down"></i></div><div class="next"><i class="fa fa-angle-up"></i></div>';
			$html .= '<div class="vertical vertical_'.$number_id.'">';
			$html .= '<ul>';
			while ( $r->have_posts() ) {
				$r->the_post();
				global $product;
				$html .= '<li>';
					$html .= '<a href="'.esc_url( get_permalink( $product->id ) ).'" title="'.esc_attr( $product->get_title() ).'">';
						$html .= $product->get_image();
						$html .= '<div class="title">'.$product->get_title().'</div>';

						//if ( ! empty( $show_rating ) ) 
						if ($product->get_rating_html())
							$html .= '<div class="star">'.$product->get_rating_html().'</div>';
						if ($product->get_price_html())
							$html .= '<div class="price">'.$product->get_price_html().'</div>';
					$html .= '</a>';
					
				$html .= '</li>';
			}
			$html .= '</ul>';
			$html .= '</div>';
	 	}
		$html .= '</div>';
		//wp_reset_postdata();
		wp_reset_query();
		return $html;
		
	}
	if ($layout == 'layout-04') {
		$randnumber = rand( 0, 10000 );
		$number_id  = $randnumber;

		wp_enqueue_script( 'aloxo-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '', false );
		$config = ",singleItem:true";
		$html = '
 		<script>
			jQuery(function($) {
				$("#horizontal_' . $number_id . '").owlCarousel({
					autoPlay: 3000
					,navigation: true
					,navigationText: ["<i class=\'fa fa-angle-left\'></i>","<i class=\'fa fa-angle-right\'></i>"]
					,pagination: false
					'.$config.'
			  });
			});
		</script>';
		$html .= '<div class="wc-product woocommerce ' . $layout.'">';
		//$html .= '<div class="shortcode_headding ' . $el_class . '">';
		if ( $title != '' ) {
			//$html .= '<div class="module_title"><h3 class="shortcode_title">' . $title . '</h3></div>';
			$html .= '<h3 class="title">' . $title . '</h3>';
		}
		//$html .= '</div>';
		if ( $r->have_posts() ) {
			$html .= '<ul id="horizontal_'.$number_id.'" class="horizontal">';
			while ( $r->have_posts() ) {
				$r->the_post();
				// ob_start();
				// woocommerce_get_template( 'content-product.php' );
				// $content_product = ob_get_contents();
				// ob_end_clean();
				// $html .= $content_product;
				//$html .= $product->get_image();
				global $product;

				$html .= '<li>';
				$html .= '<div class="img_preview">'.woocommerce_get_product_thumbnail().'</div>';

				$html .= '<div class="title"><a href="'.esc_url( get_permalink( $product->id ) ).'" title="'.esc_attr( $product->get_title() ).'">';
				$html .= $product->get_title();
				$html .= '</a></div>';
				//if ( ! empty( $show_rating ) ) 
				if ($product->get_rating_html()) {
					$html .= '<div class="star">'.$product->get_rating_html().'</div>';
				}else {
					$html .= "<div class=\"star\"><div title=\"Rated 0 out of 5\" class=\"star-rating\"><span style=\"width:0%\"><strong class=\"rating\">0.00</strong> out of 5</span></div></div>";
				}
				if ($product->get_price_html())
					$html .= '<div class="price">'.$product->get_price_html().'</div>';
				$html .= '</li>';
			}
			$html .= '</ul>';
	 	}
		$html .= '</div>';
		//wp_reset_postdata();
		wp_reset_query();
		return $html;
	}
}
