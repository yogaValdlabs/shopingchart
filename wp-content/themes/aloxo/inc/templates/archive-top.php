<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 5/5/14
 * Time: 2:27 PM
 */

global $theme_options_data;
/***********custom Top Images*************/
$height = 100;
$text_color =  $bg_color = $bg_header = $class_full = $text_color_header = '';
$hide_breadcrumbs = 0;
$hide_title = 0;
// color theme options
if ( get_post_type() == "product" ) {
	if ( isset( $theme_options_data['thim_woo_cate_heading_text_color'] ) && $theme_options_data['thim_woo_cate_heading_text_color'] <> '' ) {
		$text_color_header = 'style="color: ' . $theme_options_data['thim_woo_cate_heading_text_color'] . '"';
	}
	if ( isset( $theme_options_data['thim_woo_cate_heading_bg_color'] ) && $theme_options_data['thim_woo_cate_heading_bg_color'] <> '' ) {
		$bg_color =  'background: ' . $theme_options_data['thim_woo_cate_heading_bg_color']. ';';
	}

	if ( isset( $theme_options_data['thim_woo_cate_height_heading'] ) && $theme_options_data['thim_woo_cate_height_heading'] <> '' ) {
		$height = $theme_options_data['thim_woo_cate_height_heading'];
	}
	if ( isset( $theme_options_data['thim_woo_cate_hide_title'] )) {
		$hide_title = $theme_options_data['thim_woo_cate_hide_title'];
	}
	if ( isset( $theme_options_data['thim_woo_cate_hide_breadcrumbs'] )) {
		$hide_breadcrumbs = $theme_options_data['thim_woo_cate_hide_breadcrumbs'];
	}
}else{
	if ( isset( $theme_options_data['thim_archive_text_color'] ) && $theme_options_data['thim_archive_text_color'] <> '' ) {
		$text_color_header = 'style="color: ' . $theme_options_data['thim_archive_text_color'] . '"';
	}
	if ( isset( $theme_options_data['thim_archive_bg_color'] ) && $theme_options_data['thim_archive_bg_color'] <> '' ) {
		$bg_color =  'background: ' . $theme_options_data['thim_archive_bg_color']. ';';
	}
	if ( isset( $theme_options_data['thim_archive_height_heading'] ) && $theme_options_data['thim_archive_height_heading'] <> '' ) {
		$height = $theme_options_data['thim_archive_height_heading'];
	}
	if ( isset( $theme_options_data['thim_archive_hide_title'] )) {
		$hide_title = $theme_options_data['thim_archive_hide_title'];
	}
	if ( isset( $theme_options_data['thim_archive_hide_breadcrumbs'] )) {
		$hide_breadcrumbs = $theme_options_data['thim_archive_hide_breadcrumbs'];
	}
}

// custom color in category
$text_color = get_tax_meta( $cat, 'aloxo_text_color_id', true );

if ( $text_color == '' ) {
	$text_color= "#";
}
if ( $text_color != '#' ) {
	$text_color_header = 'style="color: ' . $text_color . '"';
}

$bg_header = get_tax_meta( $cat, 'aloxo_bg_header', true );
if ( $bg_header == '' || $bg_header == '#' ) {
}else {
	$bg_color = 'background: ' . $bg_header . ';';
}
if($height <>''){
	$height = 'height: ' . $height . 'px;';
}

$c_css = '';
if ($height || $bg_color) {
	$c_css = ' style="'.$bg_color.$height.'"';
}

//hide
// $hide_breadcrumbs = get_tax_meta( $cat, 'aloxo_hide_breadcrumbs', true );
// $hide_title = get_tax_meta( $cat, 'aloxo_hide_title', true );
// if($hide_title =='on'){
// 	$hide_title = 1;
// }
// if($hide_breadcrumbs =='on'){
// 	$hide_breadcrumbs  = 1;
// }

// bg_images
if ($hide_breadcrumbs == '1' || $hide_title == '1' ) {
	$class_full = 'width100';
}

?>
<?php
if ( !$hide_title || !$hide_breadcrumbs) {
	?>
	<div class="top_site_main " <?php echo $c_css; ?>>
		<div class="container page-title-wrapper" <?php echo $text_color_header; ?>>
			<div class="page-title-captions <?php echo $class_full; ?>">
				<?php if ($hide_title != '1') { ?>
					<header class="entry-header" >
						<h2 class="page-title">
							<?php
							if ( get_post_type() == "product" ):
								woocommerce_page_title();
							elseif ( is_category() ) :
								if (!get_tax_meta( $cat, 'aloxo_custom_top_title', true ))
									single_cat_title();
								else echo get_tax_meta( $cat, 'aloxo_custom_top_title', true );
								
							elseif ( is_tag() ) :
								single_tag_title();

							elseif ( is_author() ) :
								printf( __( 'Author: %s', 'aloxo' ), '<span class="vcard">' . get_the_author() . '</span>' );

							elseif ( is_day() ) :
								printf( __( 'Day: %s', 'aloxo' ), '<span>' . get_the_date() . '</span>' );

							elseif ( is_month() ) :
								printf( __( 'Month: %s', 'aloxo' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'aloxo' ) ) . '</span>' );

							elseif ( is_year() ) :
								printf( __( 'Year: %s', 'aloxo' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'aloxo' ) ) . '</span>' );
							elseif ( is_search() ) :
								printf( __( 'Search Results for: %s', 'aloxo' ), '<span>' . get_search_query() . '</span>' );
							elseif ( is_404() ) :
								 _e( '404', 'aloxo' );

							//printf( __( 'Year: %s', 'aloxo' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'aloxo' ) ) . '</span>' );

							elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
								_e( 'Asides', 'aloxo' );

							elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
								_e( 'Galleries', 'aloxo' );

							elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
								_e( 'Images', 'aloxo' );

							elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
								_e( 'Videos', 'aloxo' );

							elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
								_e( 'Quotes', 'aloxo' );

							elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
								_e( 'Links', 'aloxo' );

							elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
								_e( 'Statuses', 'aloxo' );

							elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
								_e( 'Audios', 'aloxo' );

							elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
								_e( 'Chats', 'aloxo' );

							elseif ( get_post_type() == "portfolio" ) :
								_e( 'Portfolio', 'aloxo' );
							else :
								_e( 'Archives', 'aloxo' );

							endif;
							?>
						</h2>
					</header>
				<?php } ?>
				<!-- .page-header -->
			</div>

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
<?php } ?>