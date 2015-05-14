<?php // Get Related Portfolio by Category

$munber_related = 3;
$munber_related = get_post_meta( $post->ID, 'thim_number_related', true );
$text_share = get_post_meta( $post->ID, 'thim_text_share_this', true );
$share_face = get_post_meta( $post->ID, 'thim_share_one_face', true );
$share_twitter = get_post_meta( $post->ID, 'thim_share_one_twitter', true );
$share_google_plus = get_post_meta( $post->ID, 'thim_share_one_google_plus', true );
$share_tumblr = get_post_meta( $post->ID, 'thim_share_one_tumblr', true );
$related = aloxo_get_related_posts( $post->ID, $munber_related );
if ( $related->have_posts() ) {
	?>
	<section class="related-archive">
		<div class="module_title"><h3 class="widget-title"><?php _e( 'YOU MAY ALSO LIKE', 'aloxo' ); ?></h3></div>
		<?php
 		echo '<ul class="archived-posts">';
		while ( $related->have_posts() ) {
			$related->the_post();
			if ( has_post_thumbnail() ) {
				?>
				<li>
					<div class="category-posts clear">
						<?php do_action( 'aloxo_entry_top', 'medium' ); ?>
						<div class="rel-post-text">
							<h5>
								<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a>
							</h5>
						</div>
					</div>
				</li>
			<?php
			} else {
				?>
				<li>
					<div class="category-posts clear">
						<div class="rel-post-text">
							<h5 class="title-related no-images">
								<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a>
							</h5>
							<?php aloxo_posted_on(); ?>
						</div>
						<div class="des-related">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</li>
			<?php
			}
		}
		echo '</ul>';
		?>
	</section><!--.related-->
<?php
	wp_reset_postdata();
} ?>

<?php if($share_face <>'' || $share_twitter <>'' || $share_google_plus <>'' || $share_tumblr <>'' || $text_share <>''){?>
<section class="tm-share">
	<?php if ( $text_share <> '' ) {
		echo '<h3 class="tm-title">' . $text_share . '</h3>';
	}

	?>

	<ul class="social-networks">
		<?php if ( $share_face == '1' ): ?>
			<li>
				<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>" data-title="<?php echo _e( 'Facebook', 'aloxo' ); ?>"><i class="fa fa-facebook"></i></a>
			</li>
		<?php endif; ?>
		<?php if ( $share_twitter == '1' ): ?>
			<li>
				<a href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" data-title="<?php echo _e( 'Twitter', 'aloxo' ); ?>"><i class="fa fa-twitter"></i></a>
			</li>
		<?php endif; ?>
		<?php if ( $share_google_plus == '1' ): ?>
			<li>
				<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-title="<?php echo _e( 'GooglePlus', 'aloxo' ); ?>"><i class="fa fa-google-plus"></i></a>
			</li>
		<?php endif; ?>
		<?php if ( $share_tumblr == '1' ): ?>
			<li>
				<a href="http://www.tumblr.com/share/link?url=<?php echo urlencode( get_permalink() ); ?>&amp;name=<?php echo urlencode( $post->post_title ); ?>&amp;description=<?php echo urlencode( get_the_excerpt() ); ?>" data-title="<?php echo _e( 'Tumblr', 'aloxo' ); ?>"><i class="fa fa-tumblr"></i></a>
			</li>
		<?php endif; ?>
	</ul>
 </section>
<?php }?>