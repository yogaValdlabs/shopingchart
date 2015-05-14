<?php
/**
 * @package aloxo
 */
global $theme_options_data;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 
		/* Video, Audio, Image, Gallery, Default will get thumb */
		do_action( 'aloxo_entry_top', 'full' ); 
	?>

	<div class="page-content-inner">
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
			<?php aloxo_author(); ?>
			<?php aloxo_posted_on(); ?>
		</header>
		<!-- .entry-header -->
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'aloxo' ),
				'after'  => '</div>',
			) );
			?>
		</div>
		<?php
		/* translators: used between list items, there is a space after the comma */
		$tag_list = get_the_tag_list( '<footer class="entry-footer"><i class="fa fa-tags"></i>', __( ' ', 'aloxo' ), '</footer>' );
		echo $tag_list;

		if(isset($theme_options_data['thim_hide_about_author']) && $theme_options_data['thim_hide_about_author'] =='1' ){
		?>
		<section class="about-author">
			<h3 class="tm-title"><?php echo _e( 'about the author: ', 'aloxo' ) ?>
				<?php the_author_posts_link(); ?>
			</h3>

			<div class="about-author-conteainer">
				<div class="avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), '90', '' ); ?>
				</div>
				<div class="description">
					<p>
						<?php the_author_meta( 'description' ); ?>
					</p>
				</div>
			</div>
		</section>

		<?php
		}
			get_template_part( 'inc/related' );
		?>
 	</div>
</article><!-- #post-## -->
