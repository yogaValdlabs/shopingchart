<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package aloxo
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area">
 	<?php // You can start editing here -- including this comment!  ?>
 	<?php if (have_comments()) : ?>
		<h3 class="comments-title">
			<?php
				echo get_comments_number();
				if( get_comments_number() != '1'){
					echo ' comments';
				}else{
					echo ' comment';
				}
 			?>
		</h3>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h5 class="screen-reader-text"><?php _e( 'Comment navigation', 'aloxo' ); ?></h5>
				<div class="comment_nav">
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'aloxo' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'aloxo' ) ); ?></div>
				</div>
			</nav><!-- #comment-nav-above -->
			<?php endif; // Check for comment navigation.  ?>
			<ol class="lists_comments">
 				<?php wp_list_comments( 'style=li&&type=comment&avatar_size=50&callback=aloxo_comment' );	?>    <!-- .comment-list -->
 			</ol><!-- .comment-list -->

		<div class="clear"></div>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h5 class="screen-reader-text"><?php _e( 'Comment navigation', 'aloxo' ); ?></h5>
				<div class="comment_nav">
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'aloxo' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'aloxo' ) ); ?></div>
				</div>
			</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation.  ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'aloxo' ); ?></p>
		<?php endif; ?>
	<?php endif; // have_comments() ?>
	<?php comment_form(); ?>

</div><!-- #comments -->