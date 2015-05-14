<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package aloxo
 */

get_header(); ?>
<?php
global $theme_options_data;
$select_style = 'basic';
$sideb = "one_sidebar";
$sidebar_thumb_size = "thumbnail"; 

if ( isset( $theme_options_data['thim_front_page_style_layout'] ) ) {
	$select_style = $theme_options_data['thim_front_page_style_layout'];
}

/* cutom style layout columns */
if ($select_style == "masonry") {
	$select_style_columns = $theme_options_data['thim_front_page_style_columns'];
}else $select_style_columns = "";

$class_layout      = "col-sm-9";
$layout_front_page = '2c-l-fixed';
if ( isset( $theme_options_data['thim_front_page_layout'] ) ) {
	$layout_front_page = $theme_options_data['thim_front_page_layout'];
	if ( $theme_options_data['thim_front_page_layout'] == '1col-fixed' ) {
		$class_layout = "col-sm-12";
		$sidebar_thumb_size = "medium"; 
	} elseif ( $theme_options_data['thim_front_page_layout'] == '2c-r-fixed' || $theme_options_data['thim_front_page_layout'] == '2c-l-fixed' ) {
		$class_layout = "col-sm-9";
		$sidebar_thumb_size = "medium"; 
	} elseif ( $theme_options_data['thim_front_page_layout'] == '3c-fixed' || $theme_options_data['thim_front_page_layout'] == '3c-r-fixed' ) {
		$class_layout = "col-sm-6";
		$sideb = "two_sidebar";
	}
}

/* default value */
if ( isset( $theme_options_data['thim_front_page_bg_content'] ) ) {

}else {
	$theme_options_data['thim_front_page_bg_content']  = "#fff";
}

$bg  = 'style=" margin-top: 40px;margin-bottom: 40px;"';
$bg_content = $theme_options_data['thim_front_page_bg_content'];
if ($bg_content != "" && $bg_content != "#")
	$bg1 = 'style=" padding: 15px;background: ' . $bg_content . '";';
else $bg1 = "";

/* Paging style */
if( isset($theme_options_data['thim_front_page_paging_style']) && $theme_options_data['thim_front_page_paging_style'] != "" ) {
	$paging_style = $theme_options_data['thim_front_page_paging_style'];
}else {
	$paging_style = "paging";
}

?>


<section id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		$text_color   = "#333";
		$custom_title = $text_color = $background_heading = $hide_breadcrubs = $height = '';
		if ( isset( $theme_options_data['thim_front_page_hide_title'] ) ) {
			$hide_title_front_page = $theme_options_data['thim_front_page_hide_title'];
		}else $hide_title_front_page = false;

		if ( isset( $theme_options_data['thim_front_page_custom_title'] ) && $theme_options_data['thim_front_page_custom_title'] <> '' ) {
			$custom_title = $theme_options_data['thim_front_page_custom_title'];
		} else {
			$custom_title = __( 'Home', 'aloxo' );
		}

		if ( isset( $theme_options_data['thim_front_page_text_color'] ) && $theme_options_data['thim_front_page_text_color'] <> '' ) {
			$text_color = 'style="color: ' . $theme_options_data['thim_front_page_text_color'] . '"';
		}
		if ( isset( $theme_options_data['thim_front_page_bg_color'] ) && $theme_options_data['thim_front_page_bg_color'] <> '' ) {
			$background_heading = $theme_options_data['thim_front_page_bg_color'];
		}
		if ( isset( $theme_options_data['thim_front_page_height_heading'] ) && $theme_options_data['thim_front_page_height_heading'] <> '' ) {
			$height = $theme_options_data['thim_front_page_height_heading'];
		} else {
			$height = '100';
		}

 		echo '<style>
				.top_site_main{height: ' . $height . 'px}
			</style>';

		if ( $custom_title <> "" && !$hide_title_front_page) {
			?>
			<div class="top_site_main" <?php if ($background_heading <> ''){ ?>style="background-color:<?php echo $background_heading; ?>" <?php } ?>>
				<div class="container page-title-wrapper">
					<div class="page-title-captions width100">
						<header class="entry-header" <?php echo $text_color; ?>>
							<h2 class="page-title" <?php echo $text_color; ?>>
								<?php echo $custom_title; ?>
							</h2>
						</header>
						<!-- .page-header -->
					</div>
				</div>
			</div>
		<?php
		}
		?>
		<div class="container home-content content-archive" <?php echo $bg;?> >
			<div class="row">
				<?php
				if ( $layout_front_page == '2c-l-fixed' || $layout_front_page == '3c-fixed' ) {
					get_sidebar();
				}
				?>
				<div class="<?php echo $class_layout; ?>">
				<div class="page-content-inner <?php echo $paging_style;?>" <?php echo $bg1; ?>>
					<?php if (have_posts()) : ?>
					<?php
					/* Blog Type */
					if ($select_style == 'masonry') {
						wp_enqueue_script('aloxo-isotope');
						echo '<div class="blog-masonry '.$select_style_columns.'">';
					}else {
						echo '<div class="blog-basic">';
					}

					?>
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php
						if ( $select_style == 'masonry' ) {
							get_template_part( 'content', 'grid' );
						} else {
							get_template_part( 'content' );
						}
						?>
					<?php endwhile; ?>		
				</div>
					<?php
					/* Paging Type */
					if ($paging_style=="paging") {
						aloxo_paging_nav();
					}else if ($paging_style=="scroll") {
						/* Enqueue infinitescroll script for scroll */
						wp_enqueue_script('aloxo-infinitescroll');
						/* Enqueue audio script if current view has'nt audio post */
						wp_enqueue_script('aloxo-pixel-industry');
						wp_enqueue_script('aloxo-jplayer');

						aloxo_paging_nav();
					}else{ /* btn load more */
						/* Enqueue audio script if current view has'nt audio post */
						wp_enqueue_script('aloxo-pixel-industry');
						wp_enqueue_script('aloxo-jplayer');

						if (wp_count_posts()->publish > get_option( 'posts_per_page' )) {
							//global $sidebar_thumb_size;
							echo '<div class="blog_btn_load_more" style="text-align:center;"><a href="#" data-ajax_url="'.admin_url( 'admin-ajax.php' ).'" data-size="'.$sidebar_thumb_size.'" data-type="'.$select_style.'" data-cat="all" data-offset="'.get_option( 'posts_per_page' ).'" class="sc-btn big light">Load More</a></div>';
						}
					}
	 				?>
				</div>
			</div>
 			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php
			endif;
			?>
		<!-- </div> -->
		<?php
		if ( $layout_front_page == '3c-r-fixed' ) {
			get_sidebar();
		}
		if ( $layout_front_page == '2c-r-fixed' || $layout_front_page == '3c-r-fixed' || $layout_front_page == '3c-fixed' ) {
			get_sidebar( '2' );
		}
		?>
		</div>
		<!-- </div> -->
		<!-- content-site-main-->
	</main>
	<!-- #main -->
</section><!-- #primary -->
<?php get_footer(); ?>

