<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package aloxo
 */

?>
<?php
if ( have_posts() ) :
 
	/* Blog Type */
	if ($select_style == 'masonry') {
		wp_enqueue_script('aloxo-isotope');
		echo '<div class="blog-masonry '.$select_style_columns.'">';
	}else {
		echo '<div class="blog-basic">';
	}

	/* Start the Loop */
	while ( have_posts() ) : the_post();
		if ( $select_style == 'masonry' ) {
			get_template_part( 'content', 'grid' );
		} else {
			get_template_part( 'content' );
		}
	endwhile; 
	echo '</div>';

	/* Paging Type */
	if ($paging_style=="paging") {
		aloxo_paging_nav();
	}else if ($paging_style=="scroll") {
		/* Enqueue infinitescroll script for scroll */
		wp_enqueue_script('aloxo-infinitescroll');
		/* Enqueue audio script if current view has'nt audio post */
		wp_enqueue_style('aloxo-pixel-industry');
		wp_enqueue_script('aloxo-jplayer');

		aloxo_paging_nav();
	}else{ /* btn load more */
		/* Enqueue audio script if current view has'nt audio post */
		wp_enqueue_style('aloxo-pixel-industry');
		wp_enqueue_script('aloxo-jplayer');

		$cate = get_category($cat);
		if ($cate->category_count > get_option( 'posts_per_page' )) {
			global $sidebar_thumb_size;
			echo '<div class="blog_btn_load_more" style="text-align:center;"><a href="#" data-ajax_url="'.admin_url( 'admin-ajax.php' ).'" data-size="'.$sidebar_thumb_size.'" data-type="'.$select_style.'" data-cat="'.$cat.'" data-offset="'.get_option( 'posts_per_page' ).'" class="sc-btn big light">Load More</a></div>';
		}
	}
else : 
	get_template_part( 'content', 'none' );
endif;