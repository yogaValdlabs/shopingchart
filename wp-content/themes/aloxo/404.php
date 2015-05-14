<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package aloxo
 */

get_header(); ?>
 	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php get_template_part( 'inc/templates/archive', 'top' ); ?>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="page-404-content">
							<div class="left_404"><h2>404</h2></div>
							<div class="right_404">
								<p><?php _e( 'The page you requested was not found, and we have a fine quess why', 'aloma' ); ?></p>
								<i><?php _e( 'If you typed the URL directly, please make sure the spelling is correct.<br/> If you clicked on link to get here, the link is outdated.', 'aloma' ); ?></i>
							</div>
							<div class="clear"></div>
 							<?php get_search_form(); ?>
 						</div>
						<!-- .page-content -->
					</div>
				</div>
			</div>

 		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
