<?php
/* Set Default value when theme option not save at first time setup */
global $theme_options_data;

if (

	is_page_template( 'page-templates/homepage3_1.php' )
	|| is_page_template( 'page-templates/homepage3_2.php' )
	|| is_page_template( 'page-templates/homepage3_3.php' )
	|| is_page_template( 'page-templates/homepage3_4.php' )
	|| is_page_template( 'page-templates/homepage.php' ) 
) {

	$file = tp_template_path();
	include $file;

	return;
} else {

}
$file = tp_template_path();

if ( get_post_type() == "tribe_events" ) {
	include $file;
 	return;
}

get_header();


if ( (get_post_type() == "product" && is_woocommerce()) || (function_exists( 'is_shop' ) && is_shop()) || ( function_exists( 'is_product_category' ) && is_product_category()) ) {
	include $file;
} elseif ( (is_category() || is_archive() || is_search()) && !use_bbpress() ) {

	global $sidebar_thumb_size,$wp_query;
	
 	/* custom style layout */
 	$select_style   = get_tax_meta( $cat, 'aloxo_style_archive', true );
	if ($select_style <> '') {
	}else {
		$select_style = $theme_options_data['thim_archive_style_layout'];
	}

	/* cutom style layout columns */
	if ($select_style == "masonry") {
		$select_style_columns   = get_tax_meta( $cat, 'aloxo_style_archive_columns', true );
		if ($select_style_columns <> '') {
			
		}else {
			$select_style_columns = $theme_options_data['thim_archive_style_columns'];
		}	
	}else $select_style_columns = "";
	
	/* cutom layout */
	$select_sidebar 	= get_tax_meta( $cat, 'aloxo_layout', true );
	$signal_sidebar 	= "col-sm-9";
	$page_content 		= "col-sm-12";
	$page_container 	= "";
	$sideb          	= "";
	$sidebar_thumb_size = "thumbnail";
	if ( $select_sidebar <> '' ) {
		if ( $select_sidebar == 'no-sidebar' ) {
			$signal_sidebar = "col-sm-12";
			$sidebar_thumb_size = "medium";
		} elseif ( 	$select_sidebar == 'left-sidebar' || 
					$select_sidebar == 'right-sidebar' ) {
			$signal_sidebar = "col-sm-9";
			if ($select_sidebar == 'right-sidebar') {
				$page_container = "col-sm-9";
			}else {
				$page_content = "col-sm-9";
			}
			$sideb = $select_sidebar;
			$sidebar_thumb_size = "medium";
		} elseif ( 	$select_sidebar == 'lcr-sidebar' || 
					$select_sidebar == 'lrc-sidebar' || 
					$select_sidebar == 'clr-sidebar' ) {
			$signal_sidebar = "col-sm-6";
			$page_container = "col-sm-9";
			$page_content = "col-sm-9";
			$sideb = $select_sidebar;
		}
	} else {
		if ( $theme_options_data['thim_archive_layout'] == 'no-sidebar' ) {
			$signal_sidebar = "col-sm-12";
			$sidebar_thumb_size = "medium";
		} elseif ( 	$theme_options_data['thim_archive_layout'] == 'left-sidebar' || 
					$theme_options_data['thim_archive_layout'] == 'right-sidebar' ) {
			$signal_sidebar = "col-sm-9";
			if ($theme_options_data['thim_archive_layout'] == 'right-sidebar') {
				$page_container = "col-sm-9";
			}else {
				$page_content = "col-sm-9";
			}
			$sideb = $theme_options_data['thim_archive_layout'];
			$sidebar_thumb_size = "medium";
		} elseif ( 	$theme_options_data['thim_archive_layout'] == 'lcr-sidebar' ||
					$theme_options_data['thim_archive_layout'] == 'lrc-sidebar' || 
					$theme_options_data['thim_archive_layout'] == 'clr-sidebar' ) {
			$signal_sidebar = "col-sm-6";
			$page_container = "col-sm-9";
			$page_content = "col-sm-9";
			$sideb = $theme_options_data['thim_archive_layout'];
			$sidebar_thumb_size = "thumbnail";
		}
	}

	/* Disable Heading */
	$cat_disable_heading = get_tax_meta( $cat, 'aloxo_cat_disable_heading', true );

	/* Custom Content Background Color */
	$custom_cat_bg_color = get_tax_meta( $cat, 'aloxo_custom_cat_bg_color', true );
	if ( $custom_cat_bg_color ) {
		$cat_bg_color = get_tax_meta( $cat, 'aloxo_cat_bg_color', true );
		$bg_content   = $cat_bg_color;
	}else {
		if ( $theme_options_data['thim_archive_bg_content'] == "" ) {
			$bg_content = "#";
		} else {
			$bg_content = $theme_options_data['thim_archive_bg_content'];
		}
	}
	$bg  = 'style=" margin-top: 40px;margin-bottom: 40px;"';
	$bg1 = 'style=" padding: 15px;background: ' . $bg_content . '";';
	if ( $bg_content == "" || $bg_content == "#" ) {
		$bg1 = "";
	}

	/* Paging style */
	
	$paging_style = get_tax_meta( $cat, 'aloxo_paging_style', true );

	if ($paging_style) {
		
	}else {
		if( isset($theme_options_data['paging_style']) && $theme_options_data['paging_style'] != "" ) {
			$paging_style = $theme_options_data['paging_style'];
		}else {
			$paging_style = "paging";
		}
	}
	
	

	?>
	<!-- <section id="primary" class="content-area blog_layout <?php echo $select_style; ?>"> -->
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<!--remove archive top -->
			<?php if ( !$cat_disable_heading ) {
				get_template_part( 'inc/templates/archive', 'top' );
			} ?>
			<div class="container content-site-main content-archive <?php echo $sideb; ?>" <?php echo $bg; ?>>
				<div class="row">

					<?php //if ($page_container) {?>
					<div class="page-container <?php echo $page_container; ?>">
					<?php //} ?>
					<div class="page-contents <?php echo $page_content; ?>">
						<div class="page-content-inner <?php echo $paging_style;?>" <?php echo $bg1; ?>>
							<?php
 								include $file;
 							?>
						</div>
					</div>
					<?php

					if ($signal_sidebar === "col-sm-9") {
					 	if ($sideb === "left-sidebar") {
							get_sidebar();
							echo '</div><!--End Page Container -->';
						}else {
							echo '</div><!--End Page Container -->';
							get_sidebar( '2' );
						}
					}else if ($signal_sidebar === "col-sm-6"){
						get_sidebar();
						echo '</div><!--End Page Container -->';
						get_sidebar( '2' );	
					}else {
						echo '</div><!--End Page Container -->';
					}
					?>
				</div>
			</div>
			<!-- content-site-main-->
		</main>
		<!-- #main -->
	</section><!-- #primary -->
<?php
} else {
	if ( is_page() || is_single() || use_bbpress()) {

		/* Background Content Post Page */
		if ( $theme_options_data['thim_post_page_bg_content'] == "" ) {
			$bg_content = "#";
		} else {
			$bg_content = $theme_options_data['thim_post_page_bg_content'];
		}

		/*********** Using Custom Layout *************/
		$custom_layout = get_post_meta( get_the_ID(), 'thim_mtb_custom_layout', true );

		/*custom select layout*/
		$select_layout = get_post_meta( get_the_ID(), 'thim_mtb_layout', true );

		/*custom layout style*/
		$layout_style = get_post_meta( get_the_ID(), 'thim_mtb_layout_style', true );

		/*********** Theme option*************/
		$class      = 'col-sm-9 alignright';
		$sidebar_cl = " sidebar-left";

		$bg  = 'style=" margin-top: 40px;margin-bottom: 40px;"';
		$bg1 = 'style=" padding: 15px;background: ' . $bg_content . '";';

		if ( $theme_options_data['thim_post_page_layout'] == '2c-r-fixed' ) {
			$class      = "col-sm-9 alignleft";
			$sidebar_cl = " sidebar-right";
		}
		if ( $theme_options_data['thim_post_page_layout'] == '1col-fixed' ) {
			$class      = "col-sm-12 fullwith";
			$sidebar_cl = "";
		}

		if ( $custom_layout == '1' ) {
			if ( $layout_style == 'boxed' ) {
				if ( $select_layout == 'full-content' ) {
					$class = "col-sm-12 fullwith";
				}
				if ( $select_layout == 'sidebar-right' ) {
					$class      = "col-sm-9 alignleft";
					$sidebar_cl = " sidebar-right";
				}
				if ( $select_layout == 'sidebar-left' ) {
					$class      = 'col-sm-9 alignright';
					$sidebar_cl = " sidebar-left";
				}

				/* Custom Background Content Post Page */
				if ( get_post_meta( get_the_ID(), 'thim_mtb_bg_content_boxed', true ) ) {
					$bg_content = get_post_meta( get_the_ID(), 'thim_mtb_bg_content_boxed', true );
				} else {
					$bg_content = "#";
				}

				$bg  = 'style=" margin-top: 40px;margin-bottom: 40px;"';
				$bg1 = 'style=" padding: 15px;background: ' . $bg_content . '";';
			} elseif ( $layout_style == 'wide' ) {
				$class = "box-full";
				$bg1   = $bg = '';
			}

			if ( $bg_content == "" || $bg_content == "#" ) {
				$bg1 = "";
			}
		}
		?>

		<main id="main" class="site-main main-single" role="main">
			<?php
			//if ( ! is_page_template() ) {
			get_template_part( 'inc/templates/content', 'top' );
			//}
			if ( $custom_layout == '1' ) {
				if ( $layout_style == 'boxed' ) {
					echo '<div class="container"><div class="row">';
				}
			} else {
				echo '<div class="container"><div class="row">';
			}
			?>
			<div class="content-post <?php echo $sidebar_cl; ?>" <?php echo $bg; ?>>
				<div class="main-content <?php echo $class; ?>">
					<div class="page-content-inner" <?php echo $bg1; ?>>
						<?php
							include $file;
						?>
					</div>
				</div>
				<?php
				if ( $class == "col-sm-9 alignleft" ) {
					get_sidebar( '2' );
				} elseif ( $class == "col-sm-9 alignright" ) {
					get_sidebar();
				}
				?>
			</div>
			<?php
			if ( $custom_layout == '1' ) {
				if ( $layout_style == 'boxed' ) {
					echo '</div></div>';
				}
			} else {
				echo '</div></div>';
			}
			?>
		</main>
	<?php
	} else {
		include $file;
	}
	// post_nav
	if ( is_single() ) {
		aloxo_post_nav();
	}
}
?>
<?php
get_footer();
?>