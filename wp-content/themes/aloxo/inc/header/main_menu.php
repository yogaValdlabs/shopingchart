<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 7/29/14
 * Time: 10:06 AM
 */
global $theme_options_data;

$logo_id = $theme_options_data['thim_logo'];
// The value may be a URL to the image (for the default parameter)
// or an attachment ID to the selected image.
$logo_src = $logo_id; // For the default value
if ( is_numeric( $logo_id ) ) {
    $imageAttachment = wp_get_attachment_image_src( $logo_id );
    $logo_src = $imageAttachment[0];
} 
?>
<!-- Brand and toggle get grouped for better mobile display -->

<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="offcanvas">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<div class="sb-header">
		<?php if ( is_active_sidebar( 'menu_right' ) || ( isset( $theme_options_data['thim_show_drawer_right'] ) && $theme_options_data['thim_show_drawer_right'] == '1' && is_active_sidebar( 'drawer_right' ) ) ) {
			echo '<ul class="navbar_right table_cell">';
		}

		if ( is_active_sidebar( 'menu_right' ) ) {
			dynamic_sidebar( 'menu_right' );
		}
		if ( is_active_sidebar( 'menu_right' ) || ( isset( $theme_options_data['thim_show_drawer_right'] ) && $theme_options_data['thim_show_drawer_right'] == '1' && is_active_sidebar( 'drawer_right' ) ) ) {
			echo '</ul>';
		}
		?>
	</div>
	<div class="mobile_logo">
		<?php
			echo '<h2 class="header_logo">';
		 ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
			<?php
			if ( isset( $logo_src ) && $logo_src ) {
				$aloxo_logo_size = @getimagesize( $logo_src );
				$width            = $aloxo_logo_size[0];
				$height           = $aloxo_logo_size[1];
				$site_title       = esc_attr( get_bloginfo( 'name', 'display' ) );
				echo '<img src="' . $logo_src . '" alt="' . $site_title . '" width="' . $width . '" height="' . $height . '" />';
			} else {
				bloginfo( 'name' );
			}?>
		</a>
		<?php
			echo '</h2>';
		 ?>
	</div>
	<?php if ( isset( $theme_options_data['thim_show_drawer_right'] ) && $theme_options_data['thim_show_drawer_right'] == 1 && is_active_sidebar( 'drawer_right' ) ) { ?>
		<div class="sliderbar-menu-controller visible-xs menu-controller-mobile">
			<?php
			$icon = '';
			if ( isset( $theme_options_data['thim_icon_drawer_right'] ) ) {
				$icon = 'fa ' . $theme_options_data['thim_icon_drawer_right'];
			}
			?>
			<div>
				<i class="<?php echo $icon; ?>"></i>
			</div>
		</div>
	<?php } ?>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="main_menu">
	<div class="main_menu_container desktop_menu">
		<?php
			if ( is_active_sidebar( 'menu_left' ) ) {
				echo '<ul class="navbar_left table_cell">';
					dynamic_sidebar( 'menu_left' );
				echo '</ul>';
			}
		?>
		<ul class="nav navbar-nav table_cell">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '%3$s'
				) );
			} else {
				wp_nav_menu( array(
					'theme_location' => '',
					'container'      => false,
					'items_wrap'     => '%3$s'
				) );
			}

			if ( isset($theme_options_data['thim_header_style']) && $theme_options_data['thim_header_style'] == 'header_v4') {
				if ( is_active_sidebar( 'menu_right' ) ) {
					// this config for template
					if ( is_page_template( 'page-templates/homepage11.php' )|| is_page_template( 'page-templates/homepage_dev7.php' ))				
						dynamic_sidebar( 'top_right_sidebar' );
					else
						dynamic_sidebar( 'menu_right' );
				}

				if ( isset( $theme_options_data['thim_show_drawer_right'] ) && $theme_options_data['thim_show_drawer_right'] == '1' && is_active_sidebar( 'drawer_right' ) ) {
					?>
					<li class="sliderbar-menu-controller">
						<?php
						$icon = '';
						if ( isset( $theme_options_data['thim_icon_drawer_right'] ) ) {
							$icon = 'fa ' . $theme_options_data['thim_icon_drawer_right'];
						}
						?>
						<div>
							<i class="<?php echo $icon; ?>"></i>
						</div>
					</li>
				<?php
				}
			}
			?>
		</ul>

		<?php 
		if ( isset($theme_options_data['thim_header_style']) && $theme_options_data['thim_header_style'] !== 'header_v4') {
		?>

		<?php if ( is_active_sidebar( 'menu_right' ) || ( isset( $theme_options_data['thim_show_drawer_right'] ) && $theme_options_data['thim_show_drawer_right'] == '1' && is_active_sidebar( 'drawer_right' ) ) ) {
			echo '<ul class="navbar_right table_cell">';
		}

		if ( is_active_sidebar( 'menu_right' ) ) {
			// this config for template
			if ( is_page_template( 'page-templates/homepage11.php' ) || is_page_template( 'page-templates/homepage_dev7.php' ) )
				dynamic_sidebar( 'top_right_sidebar' );
			else
				dynamic_sidebar( 'menu_right' );
		}

		if ( isset( $theme_options_data['thim_show_drawer_right'] ) && $theme_options_data['thim_show_drawer_right'] == '1' && is_active_sidebar( 'drawer_right' ) ) {
			?>
			<li class="sliderbar-menu-controller">
				<?php
				$icon = '';
				if ( isset( $theme_options_data['thim_icon_drawer_right'] ) ) {
					$icon = 'fa ' . $theme_options_data['thim_icon_drawer_right'];
				}
				?>
				<div>
					<i class="<?php echo $icon; ?>"></i>
				</div>
			</li>
		<?php
		}
 		if ( is_active_sidebar( 'menu_right' ) || ( isset( $theme_options_data['thim_show_drawer_right'] ) && $theme_options_data['thim_show_drawer_right'] == '1' && is_active_sidebar( 'drawer_right' ) ) ) {
			echo '</ul>';
		}
		?>
		<?php 
		}
		?>

	</div>
</div>
