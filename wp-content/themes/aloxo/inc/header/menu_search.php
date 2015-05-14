<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 8/1/14
 * Time: 9:17 AM
 */
global $theme_options_data;
?>
<!-- Brand and toggle get grouped for better mobile display -->
<?php if ( has_nav_menu( 'primary' ) ) : ?>
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="offcanvas">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<?php if ( isset( $theme_options_data['thim_show_drawer_right'] ) && $theme_options_data['thim_show_drawer_right'] == '1' && is_active_sidebar( 'drawer_right' ) ) { ?>
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
			<ul class="nav navbar-nav">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '%3$s'
				) );
				?>
				<?php if ( is_active_sidebar( 'menu_right' ) ) {
					dynamic_sidebar( 'menu_right' );
				}?>
				<li class="widget aloxo_search_widget" id="widget_aloxo_search_widget-2">
					<div class="main-header-v9-search search_form ">
						<a class="search-link" id="header-v9-search"><i class="fa fa-search"></i></a>
					</div>
				</li>
				<?php if ( isset( $theme_options_data['thim_show_drawer_right'] ) && $theme_options_data['thim_show_drawer_right'] == '1' && is_active_sidebar( 'drawer_right' ) ) { ?>
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
				<?php } ?>
			</ul>
		</div>
	</div>
<?php
else:
	echo _e( 'Define your main navigation in', 'aloxo' ) . '<a href="' . esc_url(home_url()) . '/wp-admin/nav-menus.php"> <b>Apperance > Menus</b></a>';
endif;
?>
