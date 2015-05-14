<?php
/**
 * The template for displaying search results pages.
 *
 * @package aloxo
 */
?>
<?php
	if (have_posts()) :
		/* Start the Loop */
        if ( $select_style == 'basic' ) {
            $css_layout = 'blog-basic ';
            $layout_column = " ";
        } else {
            wp_enqueue_script('aloxo-isotope');
            $css_layout = 'blog-masonry ';
            $layout_column = $select_style_columns;
        }
    ?>
    <div class="<?php echo $css_layout.' '.$layout_column. ' '; ?>content-search-page">
        <?php while (have_posts()) : the_post(); ?>
            <?php
            /**
             * Run the loop for the search to output the results.
             * If you want to overload this in a child theme then include a file
             * called content-search.php and that will be used instead.
             */
            if ( $select_style == 'masonry' ) {
                get_template_part( 'content', 'grid' );
            } else {
                get_template_part( 'content' );
            }
            ?>
        <?php endwhile; ?>
    </div>
    <?php aloxo_paging_nav(); ?>
<?php else : ?>
    <?php get_template_part('content', 'none'); ?>
<?php endif; ?>