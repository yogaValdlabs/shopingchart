<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package aloxo
 */
?>
<div id="secondary-2" class="widget-area col-sm-3" role="complementary">
	<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) :
		dynamic_sidebar( 'sidebar-2' );
	endif; // end sidebar widget area ?>
</div><!-- #secondary -->
