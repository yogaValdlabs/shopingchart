<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package aloxo
 */
?>
<div id="secondary" class="widget-area col-sm-3" role="complementary">
	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) :
		dynamic_sidebar( 'sidebar-1' );
	endif; // end sidebar widget area ?>
</div><!-- #secondary -->
