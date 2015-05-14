<?php
/**
 * @package aloxo
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="grid-content">
		<?php //do_action( 'aloxo_entry_top', 'full' ); 
			do_action ('aloxo_featured_img_url');
		?>
		<div class="entry-content">
			<?php
			if ( has_post_format( 'link' ) ) {
				$url  = aloxo_meta( 'url' );
				$text = aloxo_meta( 'text' );
				if ( $url && $text ) {
					echo '<header class="entry-header">
 					<div class="box-header">
						<p><a class="link" href="' . esc_url($url) . '">' . $text . '</a></p>
					</div>
				</header>';
 				}
			} elseif ( has_post_format( 'quote' ) ) {
				$quote      = aloxo_meta( 'quote' );
				$author     = aloxo_meta( 'author' );
				$author_url = aloxo_meta( 'author_url' );
				if ( $author_url ) {
					$author = ' <a href=' . esc_url($author_url) . '>' . $author . '</a>';
				}
				if ( $quote && $author ) {
					echo '
					<header class="entry-header">
 					<div class="box-header">
						<blockquote>' . $quote . '<cite>' . $author . '</cite></blockquote>
						
					</div>
					</header>
				 ';
 				}
			} else {
				?>
				<header class="entry-header">
					<?php aloxo_posted_on(); ?>
					<h3><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
					<?php aloxo_author(); ?>
 				</header>
				<!-- .entry-header -->
				<div class="entry-summary">
  					<?php
					global $theme_options_data;
						$length = $theme_options_data['thim_archive_excerpt_length'];
						echo aloxo_excerpt( $length ).'.. ';
					?>
					<a href="<?php esc_url(the_permalink());?>"><?php echo _e('Read More','aloxo');?></a>
				</div><!-- .entry-summary -->
			<?php }; ?>
		</div>
	</div>
</article><!-- #post-## -->
