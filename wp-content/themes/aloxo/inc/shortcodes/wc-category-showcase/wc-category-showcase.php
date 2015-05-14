<?php
add_shortcode( 'wc_category_showcase', 'shortcode_wc_category_showcase' );

function shortcode_wc_category_showcase($atts, $content = null)
{
	extract( shortcode_atts( array(
		'cats'			  => 6,
		'first_layout'    => '',
		'first_title'	  => '',
		'first_show'	  => '',
		'first_number' 	  => 6,
		'num_per_view'	  => '',

		'first_shown'	  => '',
		'first_orderby'	  => '',
		'first_order'	  => '',
		'first_hide_free' => '',
		'first_show_hidden'	=> '',

		'title' 		  => '',
		'number'     	  => '',
		'show'			  => '',
		'orderby'	  	  => '',
		'order'	  		  => '',
		'hide_free'	  	  => '',
		'show_hidden'	  => '',
		'column'		  => '4',
		'el_class'	  	  => '',
	), $atts ) );

	/* first query */
	$first_query_args = array(
		'posts_per_page' => $first_number,
		'post_status'    => 'publish',
		'post_type'      => 'product',
		'no_found_rows'  => 1,
		'order'          => $first_order == 'asc' ? 'asc' : 'desc'
	);

	$first_query_args['meta_query'] = array();

	if ( empty( $instance['show_hidden'] ) ) {
		$first_query_args['meta_query'][] = WC()->query->visibility_meta_query();
		$first_query_args['post_parent']  = 0;
	}

	if ( ! empty( $instance['hide_free'] ) ) {
		$first_query_args['meta_query'][] = array(
			'key'     => '_price',
			'value'   => 0,
			'compare' => '>',
			'type'    => 'DECIMAL',
		);
	}

	$first_query_args['meta_query'][] = WC()->query->stock_status_meta_query();
	$first_query_args['meta_query']   = array_filter( $first_query_args['meta_query'] );

	switch ( $show ) {
		case 'featured' :
			$first_query_args['meta_query'][] = array(
				'key'   => '_featured',
				'value' => 'yes'
			);
			break;
		case 'onsale' :
			$product_ids_on_sale    = wc_get_product_ids_on_sale();
			$product_ids_on_sale[]  = 0;
			$first_query_args['post__in'] = $product_ids_on_sale;
			break;
	}

	switch ( $first_orderby ) {
		case 'price' :
			$first_query_args['meta_key'] = '_price';
			$first_query_args['orderby']  = 'meta_value_num';
			break;
		case 'rand' :
			$first_query_args['orderby'] = 'rand';
			break;
		case 'sales' :
			$first_query_args['meta_key'] = 'total_sales';
			$first_query_args['orderby']  = 'meta_value_num';
			break;
		default :
			$first_query_args['orderby'] = 'date';
	}
	if ( $cats ) {
		$first_query_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $cats
			)
		);
 	}

	/* second query */
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
	if ( $cats ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $cats
			)
		);
 	}
 	
	//$r = new WP_Query( $query_args );
	//$class_column = '';
	//$class_column =' product_width_'.$column;
	$class_column =' product_width_'.$column;

	if ($cats) {
		$term_link = get_term_link((int)$cats, 'product_cat');
		// If there was an error, continue to the next term.
	    if ( is_wp_error( $term_link ) ) {
	        return;
	    }
		$view_all = '<a class="viewall" href="'.esc_url($term_link).'">View all</a>';
		//var_dump($term_link);
	}else $view_all = "";
	

	$html = '<div class="sc-woo-showcase woocommerce ' . $el_class . '">';

	$html .='<div class="top-cate">';	
	$term = get_term_by( 'id', (int)$cats, 'product_cat' );
	$html .= '<div class="cur-cate"><a href="' . get_term_link((int)$cats, 'product_cat' ) . '">' . $term->name . '</a></div>';

	$termchildren = get_term_children( (int)$cats, 'product_cat' );
	$html .= '<ul>';
	foreach ( $termchildren as $child ) {
		$term = get_term_by( 'id', $child, 'product_cat' );
		$html .= '<li><a href="' . get_term_link( $child, 'product_cat' ) . '">' . $term->name . '</a></li>';
	}
	$html .= '</ul>';
	$html .='</div>';

	$html .='<div class="left-cate col-1-5">';
	if ($first_layout == "img") {
		$linkimages = get_tax_meta((int)$cats, 'aloxo_product_image_field_id', true);
		if ($linkimages <> '') {
		   $html .=  '<img src="'.$linkimages['src'].'">';
		}	
		// $thumbnail_id 	= get_woocommerce_term_meta( (int)$cats, 'thumbnail_id', true );
		// if ($thumbnail_id)
		// 	$image = wp_get_attachment_thumb_url( $thumbnail_id );
		// // else
		// // 	$image = wc_placeholder_img_src();
		// if ($image)
		// 	$html .= '<img src="' . esc_url( $image ) . '"/>';

	}else {
		if ( $first_title != '' ) {
			$html .= '<h3 class="title">' . $first_title . '</h3>';
		}
		
		if ($first_show == "horizontal") {
			$randnumber = rand( 0, 10000 );
			$number_id  = $randnumber;

			wp_enqueue_script( 'aloxo-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '', false );
			$config = ",singleItem:true";
			$html .= '
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
			$r = new WP_Query( $first_query_args );
			if ( $r->have_posts() ) {
				$html .= '<ul id="horizontal_'.$number_id.'" class="horizontal">';
				//$html .= '<ul class="products'.$class_column.'">';
				while ( $r->have_posts() ) {
					$r->the_post();
					// ob_start();
					// woocommerce_get_template( 'content-product.php' );
					// $content_product = ob_get_contents();
					// ob_end_clean();
					// $html .= $content_product;
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
				$html .='</ul>';
		 	}
		 	wp_reset_postdata();
		 	wp_reset_query();
		 	
		}else {
			$randnumber = rand( 0, 10000 );
			$number_id  = $randnumber;

			wp_enqueue_script( 'aloxo-jquery.jcarousellite', get_template_directory_uri() . '/js/jquery.jcarousellite.min.js', array( 'jquery' ), '', false );
			wp_enqueue_script( 'aloxo-imagesloaded.pkgd', get_template_directory_uri() . '/js/imagesloaded.pkgd.js', array( 'jquery' ), '', false );
			

			$html .= '<div class="prev"><i class="fa fa-angle-down"></i></div><div class="next"><i class="fa fa-angle-up"></i></div>';

			$html .= '
	 		<script>
				jQuery(function($) {
					$(".left-cate .vertical_' . $number_id . '").imagesLoaded(function () {
						$(".left-cate .vertical_' . $number_id . '").jCarouselLite({
						    vertical: true,
						    hoverPause:true,
						    btnNext: ".left-cate .next",
	    					btnPrev: ".left-cate .prev",
						    visible: '.$num_per_view.',
						    auto:3000,
						    speed:500
					    });
					});
				});
			</script>';

			$r = new WP_Query( $first_query_args );
			if ( $r->have_posts() ) {
				$html .= '<div class="vertical vertical_'.$number_id.'">';
				$html .= '<ul>';
				while ( $r->have_posts() ) {
					$r->the_post();
					// global $product;
					// $html .= '<li>';
					// 	$html .= '<a href="'.esc_url( get_permalink( $product->id ) ).'" title="'.esc_attr( $product->get_title() ).'">';
					// 		$html .= $product->get_image();
					// 		$html .= $product->get_title();

					// 		//if ( ! empty( $show_rating ) ) 
					// 		$html .= $product->get_rating_html();
					// 		$html .= $product->get_price_html();
					// 	$html .= '</a>';
						
					// $html .= '</li>';
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
				$html .='</div>';

		 	}
		 	wp_reset_postdata();
		 	wp_reset_query();
		}
	}
	
	
	$html .='</div>';
	$html .='<div class="right-cate col-4-5">';	
	$html .= '<div class="top-title">';
	if ( $title != '' ) {

			$html .= '<h3 class="title">' . $title . '</h3>';
	}
	$html .= $view_all;
	$html .= '</div>';


	$r = new WP_Query( $query_args );
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
 	wp_reset_postdata();
 	wp_reset_query();
 	$html .= '</div>';
	$html .= '</div>';

	

	return $html;
}
