<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package aloxo
 */

if (!function_exists('aloxo_paging_nav')) :

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function aloxo_paging_nav() {
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );

		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $GLOBALS['wp_query']->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '<', 'aloxo' ),
			'next_text' => __( '>', 'aloxo' ),
			'type'      => 'list'
		) );

		if ( $links ) :
			?>
			<div class="pagination loop-pagination">
				<?php echo $links; ?>
			</div>
			<!-- .pagination -->
		<?php
		endif;
	}

endif;

if (!function_exists('aloxo_sc_paging')) :

function aloxo_sc_paging( $pages = '', $range = 2, $paged=1 ) {
	$showitems = ( $range * 2 ) + 1;

	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo "<div class='pagination loop-pagination'><ul class='page-numbers'>";
		if ( $paged > 1 ) {
			echo "<li><a class='prev page-numbers' href='" . esc_url(get_pagenum_link( $paged - 1 )) . "'></a></li> ";
		}

		for ( $i = 1; $i <= $pages; $i ++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i ) ? "<li><span class='page-numbers current'>" . $i . "</span></li> " : "<li><a href='" . get_pagenum_link( $i ) . "' class='page-numbers' >" . $i . "</a></li> ";
			}
		}

		if ( $paged < $pages ) {
			echo "<li><a class='next page-numbers' href='" . esc_url(get_pagenum_link( $paged + 1 )) . "'></span></a></li> ";
		}
		echo "</ul></div>";
	}
}

endif;

if (!function_exists('aloxo_post_nav')) :

	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function aloxo_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
		$next = get_adjacent_post(false, '', false);
		if (!$next && !$previous) {
			return;
		}

		if (isset(get_previous_post()->ID) && get_the_post_thumbnail(get_previous_post()->ID, 'thumbnail')) {
			$prev_img = '<span class="img">'.get_the_post_thumbnail(get_previous_post()->ID, 'thumbnail').'</span>';	
		}else $prev_img = "";
		
		if (isset(get_next_post()->ID) && get_the_post_thumbnail(get_next_post()->ID, 'thumbnail')) {
			$next_img = '<span class="img">'.get_the_post_thumbnail(get_next_post()->ID, 'thumbnail').'</span>';
		}else $next_img = "";
	
		if ($previous) {
			previous_post_link('<div class="tm-single-nav post-prev">%link</div>', _x('<i class="fa fa-angle-left"></i><div class="post-entry"><div class="post-entry-inner"><div class="post-entry-content"><h3>%title</h3>'.$prev_img.'</div></div></div>', '', 'aloxo'));
		}
		if ($next) {
			next_post_link('<div class="tm-single-nav post-next">%link</div>', _x('<i class="fa fa-angle-right"></i><div class="post-entry"><div class="post-entry-inner"><div class="post-entry-content">'.$next_img.'<h3>%title</h3></div></div></div>', '', 'aloxo'));
		}
		
		
		?>

	<?php
	}

endif;

if ( ! function_exists( 'aloxo_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function aloxo_posted_on($style="") {
		global $theme_options_data;
		if (!$style) {
			$cmt = " Comment";
		}else {
			$style = " ".$style;
			$cmt="";
		}

		if (!isset($theme_options_data['thim_show_date'])) {
			$theme_options_data['thim_show_date'] = 1;
			$theme_options_data['thim_show_comment'] = 1;
			$theme_options_data['thim_date_format'] = "F j, Y";
		}
		?>
		<ul class="entry-meta<?php echo $style?>">
			<?php if (isset($theme_options_data['thim_show_date']) && $theme_options_data['thim_show_date'] == 1 ) { ?>
				<li>
					<a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_attr( the_time() )?>" rel="bookmark"><?php the_time( $theme_options_data['thim_date_format'] ); ?></a>
				</li>
			<?php
			}
			if (isset( $theme_options_data['thim_show_comment']) && $theme_options_data['thim_show_comment'] == 1) {
				?>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :
					?>
					<li>
						<?php comments_popup_link( __( '0'.$cmt, 'aloxo' ), __( '1'.$cmt, 'aloxo' ), __( '%'.$cmt, 'aloxo' ) ); ?>
					</li>
				<?php
				endif;
			}
			//edit_post_link( __( 'Edit', 'aloxo' ), ' <li class="edit-link">', '</li>' );
			?>
		</ul>
	<?php
	}
endif;

if ( ! function_exists( 'aloxo_author' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function aloxo_author() {
		global $theme_options_data;

		if (!isset($theme_options_data['thim_show_author'])) {
			$theme_options_data['thim_show_author'] = 1;
			$theme_options_data['thim_show_category'] = 1;
		}

		?>
		<ul class="entry-author">
			<?php
			if ( isset( $theme_options_data['thim_show_author']) && $theme_options_data['thim_show_author'] == 1 ) {
				?>
				<li>
					<span><?php echo _e('by ','aloxo');?></span><?php printf( '<a class="author" href="%1$s">%2$s</a>',
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						esc_html( get_the_author() )
					); ?>
				</li>
			<?php
			}

			if ( isset($theme_options_data['thim_show_category']) && $theme_options_data['thim_show_category'] == 1 && get_the_category() ) {
				?>
				<li>
					<?php 
						if ( isset( $theme_options_data['thim_limit_cates']) && $theme_options_data['thim_limit_cates'] == 1 ) {
					?>
						<span><?php echo _e('in ','aloxo');?></span><?php aloxo_random_cats(2, ', '); ?>
					<?php 
						} else {
					?>
						<span><?php echo _e('in ','aloxo');?></span><?php the_category( ', ', '' ); ?>
					<?php 
						}
					?>
				</li>
			<?php
			}
			edit_post_link( __( 'Edit', 'aloxo' ), ' <li class="edit-link">', '</li>' );
			?>
		</ul>
	<?php
	}
endif;
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function aloxo_categorized_blog() {
	if (false === ( $all_the_cool_cats = get_transient('aloxo_categories') )) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(array(
			'fields' => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number' => 2,
		));

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count($all_the_cool_cats);

		set_transient('aloxo_categories', $all_the_cool_cats);
	}

	if ($all_the_cool_cats > 1) {
		// This blog has more than 1 category so aloxo_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so aloxo_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in aloxo_categorized_blog.
 */
function aloxo_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient('aloxo_categories');
}

add_action('edit_category', 'aloxo_category_transient_flusher');
add_action('save_post', 'aloxo_category_transient_flusher');

