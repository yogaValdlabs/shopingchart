<?php
/**
 * Shortcode Name: Product Search
 * Author: kien16
 */
add_shortcode( 'wc_product_search', 'shortcode_wc_product_search' );
function shortcode_wc_product_search( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'search_style'       => '',
	), $atts ) );

	$taxonomy = "product_cat";
	$html = "";
	$html .= '<div class="product_search '.$search_style.'">';
	$html .=  '<form method="get" action="'.get_site_url().'">';

	$args = array(
		'show_option_all'    => '',
		'orderby'            => 'name',
		'order'              => 'ASC',
		'style'              => 'list',
		'show_count'         => 1,
		'hide_empty'         => 0,
		'use_desc_for_title' => 1,
		'child_of'           => 0,
		'feed'               => '',
		'feed_type'          => '',
		'feed_image'         => '',
		'exclude'            => '',
		'exclude_tree'       => '',
		'include'            => '',
		'hierarchical'       => 1,
		'title_li'           => '',
		'show_option_none'   => __( 'No categories', 'aloxo' ),
		'number'             => null,
		'echo'               => 0,
		'depth'              => 0,
		'current_category'   => 0,
		'pad_counts'         => 1,
		'taxonomy'           => 'product_cat',
		'walker'             => new wc_dropdown_category_walker
	);

	if ($search_style=='style-02') {
		$html .=  '<div class="ps-search-border-container">';
		$html .=  '<div class="ps-search-border-left">';
		$html .=  '</div>';
	}

	$html .=  '<div class="ps-selector-container">';
	$html .=  '<a class="ps-selector" href="#"><span>'.__( 'All', 'aloxo' ).'</span> <i class="fa fa-sort-desc"></i></a>';
	$terms = get_terms($taxonomy , array( 'hide_empty'=>false));
	if ( !empty( $terms ) && !is_wp_error( $terms ) ){
		$html .=  '<ul class="ps-option">';
		$html .=  '<li class="all-product"><a href="#">'.__( 'All', 'aloxo' ).'</a></li>';
		$html .= wp_list_categories($args);
		$html .=  '</ul>';
	}
	$html .=  '</div>';

	$html .=  '<div class="ps_container">';
	$html .=  '<input class="ps-field" type="text" name="s" placeholder="'.__( 'Search product...', 'aloxo' ).'" autocomplete="off">';
	if ($search_style=='style-01') {
		$html .=  '<a href="#" onclick="jQuery(this).closest(\'form\').submit();"><i class="fa fa-search fa-lg"></i></a>';
	}
	$html .=  '<input type="hidden" name="post_type" value="product">';
	$html .=  '<input type="hidden" name="product_cat" value="">';
	$html .=  '<ul class="product_results woocommerce"></ul>';
	$html .=  '</div>';

	if ($search_style=='style-02') {
		$html .=  '<div class="ps-search">';
		$html .=  '<a href="#" onclick="jQuery(this).closest(\'form\').submit();"><i class="fa fa-search fa-lg"></i></a>';
		$html .=  '</div>';
		$html .=  '</div>';
	}

	$html .=  '</form>';
	$html .=  '</div>';
	return $html;
}