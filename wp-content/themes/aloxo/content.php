<?php
/**
 * @package aloxo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-inner">
		<?php
		global $sidebar_thumb_size;

		/* Video, Audio, Image, Gallery, Default will get thumb */
		do_action( 'aloxo_entry_top', $sidebar_thumb_size ); ?>

		<div class="entry-content">
			<?php
			if ( has_post_format( 'link' ) && aloxo_meta( 'thim_url' ) && aloxo_meta( 'thim_text' ) ) {
				$url  = aloxo_meta( 'thim_url' );
				$text = aloxo_meta( 'thim_text' );
				if ( $url && $text ) {
					echo '<header class="entry-header">
						<h3 class="blog_title"><a class="link" href="' . esc_url( $url ) . '">' . $text . '</a><h3>
					</header>';
				}
			} elseif ( has_post_format( 'quote' ) && aloxo_meta( 'thim_quote' ) && aloxo_meta( 'thim_author_url' ) ) {
				$quote      = aloxo_meta( 'thim_quote' );
				$author     = aloxo_meta( 'thim_author' );
				$author_url = aloxo_meta( 'thim_author_url' );
				if ( $author_url ) {
					$author = ' <a href=' . esc_url( $author_url ) . '>' . $author . '</a>';
				}
				if ( $quote && $author ) {
					echo '
					<header class="entry-header">
					<div class="box-header box-quote">
						<blockquote>' . $quote . '<cite>' . $author . '</cite></blockquote>	
					</div>
					</header>
					';
				}
			} elseif ( has_post_format( 'audio' ) ) {
				echo '
					 <header class="entry-header">
 						<h3 class="blog_title"><a href="' . get_permalink( get_the_ID() ) . '" rel="bookmark">' . get_the_title( get_the_ID() ) . '</a></h3>
 					</header>
				 ';
			} else {
				?>
				<header class="entry-header">
					<?php aloxo_posted_on(); //aloxo_posted_on('style-01'); ?>
					<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
					<?php aloxo_author(); ?>
				</header>
				<!-- .entry-header -->
				<div class="entry-summary">
					<?php
					global $theme_options_data;

					if ( isset( $theme_options_data['thim_desc_each_article'] ) && $theme_options_data['thim_desc_each_article'] == 'full_text' ) {
						the_content();
					} else {
						if ( isset( $theme_options_data['thim_archive_excerpt_length'] ) ) {
							$length = $theme_options_data['thim_archive_excerpt_length'];
						} else {
							$length = '50';
						}
						echo aloxo_excerpt( $length ) . '... ';?>
						<a href="<?php the_permalink(); ?>" class="read-more"><?php echo _e( 'Read More', 'aloxo' ); ?></a>
					<?php
					}
					?>
				</div><!-- .entry-summary -->
			<?php }; ?>
		</div>
	</div>
</article><!-- #post-## -->