<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 5/5/14
 * Time: 2:27 PM
 */

global $theme_options_data;
$height = 100;
$postid = get_the_ID();

/***********custom title*************/
$text_color = $bg_color = "";
/******************hide_title_and_subtitle *********************/
$hide_title_and_subtitle = 0;
$hide_breadcrumbs = 0;
$default_bg = get_template_directory_uri()."/images/product_heading.jpg";

$default_style = "";
if ( get_post_type() == "product" ) {
	$default_style = ' style-01';
	// Heading Style
	if (isset($theme_options_data['thim_woo_single_heading_style']) && $theme_options_data['thim_woo_single_heading_style'] <> '') {
		$default_style = ' '.$theme_options_data['thim_woo_single_heading_style'];
	}

	// Hide Title
	if ( isset( $theme_options_data['thim_woo_single_hide_title'] )) {
		$hide_title_and_subtitle = $theme_options_data['thim_woo_single_hide_title'];
	}
	// Hide Beadcrumb
	if ( isset( $theme_options_data['thim_woo_single_hide_breadcrumbs'] )) {
		$hide_breadcrumbs = $theme_options_data['thim_woo_single_hide_breadcrumbs'];
	}
	// Text Color
	if ( isset( $theme_options_data['thim_woo_single_text_color'] ) && $theme_options_data['thim_woo_single_text_color'] <> '' ) {
		$text_color = 'style="color: ' . $theme_options_data['thim_woo_single_text_color'] . '"';
	}
	//Heading color or Image
	if (isset($theme_options_data['thim_woo_single_heading']) && $theme_options_data['thim_woo_single_heading'] <> '') {
		if ($theme_options_data['thim_woo_single_heading'] == "bg_color") {// using bg color
			$bg_color =  'background: ' . $theme_options_data['thim_woo_single_bg_color']. ';';
		}else { // using image
			if ($theme_options_data['thim_woo_single_bg_img']) {
				//$bg_color = 'background-image:url('.$theme_options_data['thim_woo_single_bg_img'].');';
 				$woo_single_top_image     = $theme_options_data['thim_woo_single_bg_img'];
				$woo_single_top_image_src = $woo_single_top_image;
				if ( is_numeric( $woo_single_top_image ) ) {
					$woo_single_top_attachment = wp_get_attachment_image_src( $woo_single_top_image, 'full' );
					$woo_single_top_image_src  = $woo_single_top_attachment[0];
				}
				$bg_color = 'background: url(' . $woo_single_top_image_src . ');';
			} else {
				$bg_color = 'background-image:url('.$default_bg.');';
			}

		}
	}

	// height custom heading
	if ( isset( $theme_options_data['thim_woo_single_height_heading'] ) && $theme_options_data['thim_woo_single_height_heading'] != '0' ) {
		$height = $theme_options_data['thim_woo_single_height_heading'];
	}
} else {
	// Hide Title and Subtitle
	if ( isset( $theme_options_data['thim_post_page_hide_title'] )) {
		$hide_title_and_subtitle = $theme_options_data['thim_post_page_hide_title'];
	}
	// Hide Breadcrumbs
	if ( isset( $theme_options_data['thim_post_page_hide_breadcrumbs'] )) {
		$hide_breadcrumbs = $theme_options_data['thim_post_page_hide_breadcrumbs'];
	}
	// Text Color
	if ( isset( $theme_options_data['thim_post_page_text_color'] ) && $theme_options_data['thim_post_page_text_color'] <> '' ) {
		$text_color = 'style="color: ' . $theme_options_data['thim_post_page_text_color'] . '"';
	}
	// Background Color
	if ( isset( $theme_options_data['thim_post_page_bg_color'] ) && $theme_options_data['thim_post_page_bg_color'] <> '' ) {
		$bg_color = 'background: ' . $theme_options_data['thim_post_page_bg_color'] . ';';
	}
	// Background Image
	if ( isset( $theme_options_data['thim_post_page_top_image'] ) && $theme_options_data['thim_post_page_top_image'] <> '' ) {
		$post_page_top_image     = $theme_options_data['thim_post_page_top_image'];
		$post_page_top_image_src = $post_page_top_image;
		if ( is_numeric( $post_page_top_image ) ) {
			$post_page_top_attachment = wp_get_attachment_image_src( $post_page_top_image, 'full' );
			$post_page_top_image_src   = $post_page_top_attachment[0];
		}
		$bg_color = 'background: url(' . $post_page_top_image_src. ');';
 	}
	// height custom heading
	if ( isset( $theme_options_data['thim_post_page_height_heading'] ) && $theme_options_data['thim_post_page_height_heading'] != '0' ) {
		$height = $theme_options_data['thim_post_page_height_heading'];
	}
}

/***********custom hide title*************/
$using_custom_heading = get_post_meta( $postid, 'thim_mtb_using_custom_heading', true );
$c_css = '';
/* check theme option and custom post/page */
if ($using_custom_heading) {
	$hide_title_and_subtitle = get_post_meta( $postid, 'thim_mtb_hide_title_and_subtitle', true );
	$hide_breadcrumbs = get_post_meta( $postid, 'thim_mtb_hide_breadcrumbs', true );

	/***********height header*************/
	$mtb_height_heading = get_post_meta( $postid, 'thim_mtb_height_heading', true );

	if ( $mtb_height_heading != '' ) {
		$height = $mtb_height_heading;
	}
	/***********custom hide breadcrumbs*************/
	//$hide_breadcrumbs = get_post_meta( $postid, 'hide_breadcrumbs', true );


	$bg_color_page = get_post_meta( $postid, 'thim_mtb_bg_color', true );
	if ( $bg_color_page == '' ) {
		$bg_color_page = "#";
	}
	if ( $bg_color_page != '#' ) {
		$bg_color = 'background: ' . $bg_color_page . ';';
	}


	$bg_color_page = get_post_meta( $postid, 'thim_mtb_top_image', true );
	if ( isset($bg_color_page) &&  $bg_color_page != "") {
		$post_page_top_image_src = $bg_color_page;
		if ( is_numeric( $bg_color_page ) ) {
			$post_page_top_attachment = wp_get_attachment_image_src( $bg_color_page, 'full' );
			$post_page_top_image_src   = $post_page_top_attachment[0];
		}
		$bg_color = 'background: url(' . $post_page_top_image_src. ');';
 	}

	if ( $height <> '' ) {
		$height = 'height: ' . $height . 'px;';
	}

	if ($height || $bg_color) {
		$c_css = ' style="'.$bg_color.$height.'"';
	}

	$text_color_page = get_post_meta( $postid, 'thim_mtb_text_color', true );
	if ( $text_color_page == '' ) {
		$text_color_page = "#";
	}
	if ( $text_color_page != '#' ) {
		$text_color = 'style="color: ' . $text_color_page . '"';
	}

	/***********custom title*************/
	$custom_title = get_post_meta( $postid, 'thim_mtb_custom_title', true );
	/***********custom subtitle*************/
	$subtitle = get_post_meta( $postid, 'thim_subtitle', true );


}else {
	if ( $height <> '' ) {
		$height = 'height: ' . $height . 'px;';
	}
	if ($height || $bg_color) {
		$c_css = ' style="'.$bg_color.$height.'"';
	}
}

//if ( $using_custom_heading == '1' ) {
	if ( $hide_title_and_subtitle == '1' && $hide_breadcrumbs == '1' ) {
	} else {
		$class_full = '';
		if ( $hide_breadcrumbs == '1' || $hide_title_and_subtitle == '1' ) {
			$class_full = 'width100';
		}
		?>
 		<?php //if ( $custom_title != '' ||  $subtitle != '' ) {?>
		<div class="top_site_main<?php echo $default_style;?>" <?php echo $c_css; ?>>
			<div class="container page-title-wrapper" <?php echo $text_color; ?>>
				<?php if ( $hide_title_and_subtitle != '1' ) { ?>
					<div class="page-title-captions <?php echo $class_full; ?>">
						<?php
						echo '<header class="entry-header" >';
						if ( $using_custom_heading && $custom_title <> '' ) {
							echo '<h2 class="entry-title">' . $custom_title . '</h2>';
						} else {
							echo '<h2 class="entry-title">' . get_the_title( $postid ) . '</h2>';
						}
						if ( $using_custom_heading && $subtitle <> '' ) {
							echo '<p>' . $subtitle . '</p>';
						}
						echo '</header>';
						?>
					</div>
				<?php } ?>
				<?php
				if ( $hide_breadcrumbs != '1' ) {
					if ( get_post_type() == 'product' ) {
						echo '<div class="breadcrumbs ' . $class_full . '">';
						woocommerce_breadcrumb();
						echo '</div>';
					} else {
						echo '<div class="breadcrumbs ' . $class_full . '">';
						aloxo_breadcrumbs();
						echo '</div>';
					}
				}
				?>
			</div>
		</div>
		<?php //}
	}

// } else {
// }
?>