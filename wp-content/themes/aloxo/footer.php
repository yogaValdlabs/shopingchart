<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package aloxo
 */
?>

<?php global $theme_options_data;?>

</div><!-- #content -->
<footer id="colophon" class="site-footer" role="contentinfo">
	<?php if ( is_active_sidebar( 'footer_1' ) || is_active_sidebar( 'footer_2' ) || is_active_sidebar( 'footer_3' ) || is_active_sidebar( 'footer_4' ) ) : ?>
		<div class="footer">
			<div class="container">
				<div class="row">
					<?php
					$wd_column = array( "4", "4", "4", "4" );
					if ( isset( $theme_options_data['thim_width_column'] ) ) {
						$width     = preg_replace( '/\s+/', '', $theme_options_data['thim_width_column'] );
						$wd_column = explode( '+', $width );
					}
					if ( isset( $theme_options_data['thim_footer_column'] ) ) {
						$column_footer = $theme_options_data['thim_footer_column'];
					} else {
						$column_footer = '4';
					}
					?>
					<?php
					for ( $i = 1; $i <= $column_footer; $i ++ ) {
						$widget_footer = "footer_" . $i;
						?>
						<?php if ( is_active_sidebar( $widget_footer ) ) : ?>
							<div class="col-sm-<?php echo $wd_column[$i - 1]; ?>">
								<?php dynamic_sidebar( $widget_footer ); ?>
							</div><!-- col-sm-6 -->
						<?php endif; ?>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<!--==============================copyright=====================================-->
	<div class="copyright_area">
		<div class="container">
			<div class="copyright_inner">
				<?php
				if ( isset( $theme_options_data['thim_copyright_text'] ) ) {
					echo '<div class="copyright"><p>' . do_shortcode( $theme_options_data['thim_copyright_text'] ) . '</p></div>';
				}?>
				<?php if ( is_active_sidebar( 'copyright' ) ) : ?>
					<div class="column_right">
						<?php dynamic_sidebar( 'copyright' ); ?>
					</div><!-- col-sm-6 -->
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->

</div><!-- end #wapper-->
<?php if ( isset( $theme_options_data['thim_show_to_top'] ) && $theme_options_data['thim_show_to_top'] == 1 ) { ?>
	<div id="topcontrol" class="icon-up-open" title="<?php _e( 'Scroll To Top', 'aloxo' ); ?>">
		<i class="fa fa-chevron-up"></i></div>
<?php } ?>

</div><!-- .content-pusher -->
</div><!-- .wrapper-container -->
<?php if ( isset( $theme_options_data['google_analytics'] ) ) {
	echo $theme_options_data['google_analytics'];
} ?>
<?php wp_footer(); ?>
</body>
</html>

