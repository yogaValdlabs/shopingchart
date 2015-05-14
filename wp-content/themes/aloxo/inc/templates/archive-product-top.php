<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 5/5/14
 * Time: 2:27 PM
 */

global $theme_options_data;
$cat_obj = $wp_query->get_queried_object();
if (isset($cat_obj->term_id)) {
	$category_ID   = $cat_obj->term_id;	
}else {
	$category_ID   = "";
}

/***********custom Top Images*************/

$height = 100;
$text_color =  $bg_color = $bg_header = $class_full ='';
$default_bg = get_template_directory_uri()."/images/product_heading.jpg";
$default_style = ' style-01';

// theme option color
if ( isset( $theme_options_data['thim_woo_cate_heading_text_color'] ) && $theme_options_data['thim_woo_cate_heading_text_color'] <> '' ) {
	$text_color_header = 'style="color: ' . $theme_options_data['thim_woo_cate_heading_text_color'] . '"';
}
// Heading Style
if (isset($theme_options_data['thim_woo_cate_heading_style']) && $theme_options_data['thim_woo_cate_heading_style'] <> '') {
	$default_style = ' '.$theme_options_data['thim_woo_cate_heading_style'];
}

//Heading color or Image
if (isset($theme_options_data['thim_woo_cate_heading']) && $theme_options_data['thim_woo_cate_heading'] <> '') {
	if ($theme_options_data['thim_woo_cate_heading'] == "bg_color") {// using bg color
		$bg_color =  'background: ' . $theme_options_data['thim_woo_cate_heading_bg_color']. ';';
	}else { // using image
		if ($theme_options_data['thim_woo_cate_heading_bg_img']) {
			//$bg_color = 'background-image:url('.$theme_options_data['thim_woo_cate_heading_bg_img'].');';

			$woo_cate_top_image     = $theme_options_data['thim_woo_cate_heading_bg_img'];
			$woo_cate_top_image_src = $woo_cate_top_image;
			if ( is_numeric( $woo_cate_top_image ) ) {
				$woo_cate_top_attachment = wp_get_attachment_image_src( $woo_cate_top_image, 'full' );
				$woo_cate_top_image_src  = $woo_cate_top_attachment[0];
			}
			$bg_color = 'background: url(' . $woo_cate_top_image_src . ');';
		} else {
			$bg_color = 'background-image:url('.$default_bg.');';
		}
	}
}

if ( isset( $theme_options_data['thim_woo_cate_height_heading'] ) && $theme_options_data['thim_woo_cate_height_heading'] <> '' ) {
	$height = $theme_options_data['thim_woo_cate_height_heading'];
}

// custom in cateogry
$text_color = get_tax_meta( $category_ID, 'aloxo_text_color_id_product', true );
if ( $text_color == '' ) {
	$text_color= "#";
}
if ( $text_color != '#' ) {
	$text_color_header = 'style="color: ' . $text_color . '"';
}
if (get_tax_meta( $category_ID, 'aloxo_cate_product_heading_bg', true ) == "bg_color"){
	$temp = get_tax_meta( $category_ID, 'aloxo_bg_color_product', true );
 	if ($temp) {
		$bg_color =  'background: ' . $temp. ';';
	} else {
		$bg_color = '';
	}
}else if (get_tax_meta( $category_ID, 'aloxo_cate_product_heading_bg', true ) == "bg_img"){
	$images_link = get_tax_meta( $category_ID, 'aloxo_bg_img_product', true );
 	if (isset($images_link['src'])) {
		$bg_color = 'background-image:url('.$images_link['src'].');';
	} else {
		$bg_color = 'background-image:url('.$default_bg.');';
	}
}else {

}

if($height <>''){
	$height = 'height: ' . $height . 'px;';
}

$c_css = '';
if ($height || $bg_color) {
	$c_css = ' style="'.$bg_color.$height.'"';
}


if ( isset( $theme_options_data['thim_woo_cate_hide_title'] )) {
	$hide_title = $theme_options_data['thim_woo_cate_hide_title'];
}
if ( isset( $theme_options_data['thim_woo_cate_hide_breadcrumbs'] )) {
	$hide_breadcrumbs = $theme_options_data['thim_woo_cate_hide_breadcrumbs'];
}
// bg_images
if ($hide_breadcrumbs == '1' || $hide_title == '1' ) {
	$class_full = 'width100';
}

?>
<?php
if ( !$hide_title || !$hide_breadcrumbs) {
	?>
	<div class="top_site_main<?php echo $default_style;?>" <?php echo $c_css; ?>>
		<div class="container page-title-wrapper">
		<?php if ($hide_title != '1') { ?>
			<div class="page-title-captions <?php echo $class_full; ?>">
					<header class="entry-header" <?php echo $text_color_header; ?>>
						<h2 class="page-title" <?php echo $text_color_header; ?>>
							<?php

								$thumbnail_id 	= get_woocommerce_term_meta( $category_ID, 'thumbnail_id', true );
								if ($thumbnail_id)
									$image = wp_get_attachment_thumb_url( $thumbnail_id );
								// else
								// 	$image = wc_placeholder_img_src();
								if (isset($image))
									echo '<img src="' . esc_url( $image ) . '"/>';

								// $linkimages = get_tax_meta($category_ID, 'aloxo_icon_cate', true);
								// //print_r($linkimages);
								// if (!empty($linkimages)) {
								//    echo '<img src="'.$linkimages['src'].'">';
								// }

								woocommerce_page_title();
							?>
						</h2>
					</header>
				<!-- .page-header -->
			</div>
			<?php } ?>
			<?php
			if ( $hide_breadcrumbs != '1' ) {
				echo '<div class="top-breadcrumbs '.$class_full.'" ' . $text_color_header . '><div class="wrapper-breadcrumb">';
				//	aloxo_breadcrumbs();
					woocommerce_breadcrumb();
				echo '</div></div>';
			}
			?>
		</div>
	</div>
<?php } ?>