<?php
/**
 * Template Name: Home Page
 *
 **/
get_header();
?>

	<div id="main-content" class="home-content home-page" role="main">
		<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
		?>
	</div><!-- #main-content -->

<?php get_footer();
