<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 7/24/14
 * Time: 3:45 PM
 */
global $theme_options_data;

$logo_id = $theme_options_data['thim_logo'];
// The value may be a URL to the image (for the default parameter)
// or an attachment ID to the selected image.
$logo_src = $logo_id; // For the default value
if ( is_numeric( $logo_id ) ) {
	$imageAttachment = wp_get_attachment_image_src( $logo_id, 'full' );
	$logo_src        = $imageAttachment[0];
}

$sticky_logo_id = $theme_options_data['thim_sticky_logo'];
// The value may be a URL to the image (for the default parameter)
// or an attachment ID to the selected image.
$sticky_logo_src = $sticky_logo_id; // For the default value
if ( is_numeric( $sticky_logo_id ) ) {
	$imageAttachment = wp_get_attachment_image_src( $sticky_logo_id, 'full' );
	$sticky_logo_src = $imageAttachment[0];
}

?>
<?php
if ( isset( $theme_options_data['thim_header_position'] ) && $theme_options_data['thim_header_position'] == 'header_after_slider' && is_active_sidebar( 'banner_header' ) ) {
	dynamic_sidebar( 'banner_header' );
}
?>
<header id="masthead" class="site-header <?php if ( isset( $theme_options_data['thim_header_position'] ) && $theme_options_data['thim_header_position'] <> '' ) {
	echo $theme_options_data['thim_header_position'];
}
if ( isset( $theme_options_data['thim_config_height_sticky'] ) && $theme_options_data['thim_config_height_sticky'] <> '' ) {
	echo ' ' . $theme_options_data['thim_config_height_sticky'];
}
if ( isset( $theme_options_data['thim_config_att_sticky'] ) && $theme_options_data['thim_config_att_sticky'] <> '' ) {
	echo ' ' . $theme_options_data['thim_config_att_sticky'];
} ?>" role="banner">
	<?php if ( isset( $theme_options_data['thim_header_layout'] ) && $theme_options_data['thim_header_layout'] == 'boxed' ) {
		echo "<div class=\"container header_boxed\">";
	}
	?>
	<?php
	$width_topsidebar_left = 5;
	if ( isset( $theme_options_data['width_left_top_sidebar'] ) ) {
		$width_topsidebar_left = $theme_options_data['width_left_top_sidebar'];
	}
	$width_topsidebar_right = 12 - $width_topsidebar_left;
	if ( isset( $theme_options_data['thim_topbar_show'] ) && $theme_options_data['thim_topbar_show'] == '1' ) {
		?>
		<?php if ( ( is_active_sidebar( 'top_right_sidebar' ) ) || ( is_active_sidebar( 'top_left_sidebar' ) ) ) : ?>
			<div class="top-header">
				<?php if ( isset( $theme_options_data['thim_header_layout'] ) && $theme_options_data['thim_header_layout'] == 'wide' ) {
					echo "<div class=\"container\"><div class=\"row\">";
				}
				?>
				<?php if ( is_active_sidebar( 'top_left_sidebar' ) ) : ?>
					<div class="col-sm-<?php echo $width_topsidebar_left; ?> top_left">
						<ul class="top-left-menu">
							<?php dynamic_sidebar( 'top_left_sidebar' ); ?>
						</ul>
					</div><!-- col-sm-6 -->
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'top_right_sidebar' ) ) : ?>
					<div class="col-sm-<?php echo $width_topsidebar_right; ?> top_right">
						<ul class="top-right-menu">
							<?php dynamic_sidebar( 'top_right_sidebar' ); ?>
						</ul>
					</div><!-- col-sm-6 -->
				<?php endif; ?>
				<?php if ( isset( $theme_options_data['thim_header_layout'] ) && $theme_options_data['thim_header_layout'] == 'wide' ) {
					echo "</div></div>";
				}
				?>
			</div><!--End/div.top-->
		<?php
		endif;
	}
	?>
	<?php
	$width_logo = 3;
	if ( isset( $theme_options_data['thim_column_logo'] ) ) {
		$width_logo = $theme_options_data['thim_column_logo'];
	}
	$width_menu = 12 - $width_logo;
	?>
	<div class="wapper_logo">
		<div class="container tm-table">

			<?php if ( is_active_sidebar( 'header_left' ) ) : ?>
				<div class="table_cell">
					<div class="header_left">
						<?php dynamic_sidebar( 'header_left' ); ?>
					</div>
				</div><!-- col-sm-6 -->
			<?php endif; ?>

			<div class="menu-mobile-effect navbar-toggle" data-effect="mobile-effect">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</div>

			<div class="table_cell table_cell-center sm-logo">
				<?php if ( is_single() ) {
					echo '<h2 class="header_logo">';
				} else {
					echo '<h1 class="header_logo">';
				} ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
					<?php
					if ( isset( $logo_src ) && $logo_src ) {
						$aloxo_logo_size = @getimagesize( $logo_src );
						$width           = $aloxo_logo_size[0];
						$height          = $aloxo_logo_size[1];
						$site_title      = esc_attr( get_bloginfo( 'name', 'display' ) );
						echo '<img src="' . $logo_src . '" alt="' . $site_title . '" width="' . $width . '" height="' . $height . '" />';
					} else {
						bloginfo( 'name' );
					} ?>
				</a>
				<?php if ( is_single() ) {
					echo '</h2>';
				} else {
					echo '</h1>';
				} ?>
			</div>
			<?php if ( is_active_sidebar( 'header_right' ) ) : ?>
				<div class="table_cell right_header">
					<div class="header_right">
						<?php dynamic_sidebar( 'header_right' ); ?>
					</div>
				</div><!-- col-sm-6 -->
			<?php endif; ?>
			<div id="header-search-form-input" class="main-header-search-form-input">
				<form role="search" method="get" action="<?php echo get_site_url(); ?>">
					<input type="text" value="" name="s" id="s" placeholder="<?php echo __( 'Search the site or press ESC to cancel.', 'aloxo' ); ?>" class="form-control ob-search-input" autocomplete="off" />
					<span class="header-search-close"><i class="fa fa-times"></i></span>
				</form>
				<ul class="ob_list_search">
				</ul>
			</div>
		</div>
		<!--end container tm-table-->
	</div>
	<!--end wapper-logo-->
	<div class="navigation affix-top" <?php if ( isset( $theme_options_data['thim_header_sticky'] ) && $theme_options_data['thim_header_sticky'] == 1 ) {
		echo 'data-spy="affix" data-offset-top="' . $theme_options_data['thim_header_height_sticky'] . '" ';
	} ?>>
		<!-- <div class="main-menu"> -->
		<div class="container tm-table">
			<div class="col-sm-<?php echo $width_logo ?> table_cell sm-logo-affix">
				<?php
				echo '<h2 class="header_logo">';
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
					<?php
					if ( isset( $sticky_logo_src ) ) {
						if ( $sticky_logo_src ) {
							$aloxo_logo_size = @getimagesize( $sticky_logo_src );
							$width           = $aloxo_logo_size[0];
							$height          = $aloxo_logo_size[1];
							$site_title      = esc_attr( get_bloginfo( 'name', 'display' ) );
							echo '<img src="' . $sticky_logo_src . '" alt="' . $site_title . '" width="' . $width . '" height="' . $height . '" />';
						} else {

							$aloxo_logo_size = @getimagesize( $logo_src );
							$width           = $aloxo_logo_size[0];
							$height          = $aloxo_logo_size[1];
							$site_title      = esc_attr( get_bloginfo( 'name', 'display' ) );
							echo '<img src="' . $logo_src . '" alt="' . $site_title . '" width="' . $width . '" height="' . $height . '" />';
						}
					}
					?>
				</a>
				<?php
				echo '</h2>';
				?>
			</div>
			<nav class="col-sm-<?php echo $width_menu ?> table_cell" role="navigation">
				<?php get_template_part( 'inc/header/main_menu' ); ?>
			</nav>
		</div>
		<!-- </div> -->
	</div>
	<?php if ( isset( $theme_options_data['thim_header_layout'] ) && $theme_options_data['thim_header_layout'] == 'boxed' ) {
		echo "</div>";
	}
	?>

</header>
