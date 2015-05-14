<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package aloxo
 */
?>
<div class="widget-sidebar-shop col-sm-3">
	<?php if ( ! dynamic_sidebar( 'shop' ) ) :
			dynamic_sidebar( 'shop' );
	endif; // end sidebar widget area
	?>
</div>