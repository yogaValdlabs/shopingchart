<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 4/22/14
 * Time: 8:41 AM
 */
//////////////////////////////////////////////////////////////////
// Testimonials
//////////////////////////////////////////////////////////////////

add_shortcode( 'testimonials', 'shortcode_testimonials' );
function shortcode_testimonials( $atts, $content = null ) {
	global $post;
	extract( shortcode_atts( array(
		//'hidden_title' => '',
		'title'        => '',
		'size'         => '',
		'style'        => '',
		'layout'       => '',
		'bg_color'     => '',
		'text_color'   => '',
		'number'       => 4,
		'el_class'     => ''
	), $atts ) );
	$args            = array(
		'post_type'      => 'testimonials',
		'posts_per_page' => $number
	);
	$lop_testimonial = new WP_Query( $args );
	$html            = '';
	wp_enqueue_script( 'aloxo-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '', false );
	$randnumber = rand( 0, 10000 );
	$number_id  = $randnumber;
	if ( $layout == 'layout1' ) {
		$html .= '
 		<script>
			jQuery(function($) {
				$("#testimonials_' . $number_id . '").owlCarousel({
					autoPlay: 3000,
					items : 2,
					stopOnHover: true,
					responsive: true,
					itemsDesktop : [1199,2],
					itemsDesktopSmall : [979,2]
			  });
			});
		</script>';
	} else {
		$html .= '
 		<script>
			jQuery(function($) {
				$("#testimonials_' . $number_id . '").owlCarousel({
				  autoPlay: 4000,
				  singleItem : true,
				  stopOnHover: true,
				  pagination: false
 			  });
			});
		</script>';
	}
	$background = $textcolor = $bg = '';
	if ( $bg_color != '' ) {
		$background = 'background:' . $bg_color;
		$html .= '<style>
					#testimonials_' . $number_id . ' .testimonial_content:after{
						border-top: 18px solid' . $bg_color . ';
					}
				</style>';
	}
	if ( $text_color != '' ) {
		$textcolor = 'color:' . $text_color;
	}
	if ( $background != '' || $textcolor != '' ) {
		$bg = 'style="' . $background . ';' . $textcolor . '"';
	}
	if ( $lop_testimonial->have_posts() ) {
		$html .= '<div class="shortcode_testimonials ' . $layout . '">';
		if ( $title != '' ) {
			$html .= '<div class="module_title ' . $style . '" ><' . $size . ' class="wpb_heading">' . $title  . '</' . $size . '></div>';
		}
		$html .= '<div id="testimonials_' . $number_id . '" class="testimonials"> ';
		while ( $lop_testimonial->have_posts() ): $lop_testimonial->the_post();
			$urlimg   = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
			$web_link = get_post_meta( get_the_ID(), 'website_url', true );
			if ( $urlimg != '' ) {
				$theme_options_data = getimagesize( $urlimg );
				$width       = $theme_options_data[0];
				$height      = $theme_options_data[1];
			} else {
				$width  = 0;
				$height = 0;
			}
			if ( $layout == 'layout1' ) {
				$html .= '<div class="item_testimonial">';
				if ( $urlimg <> '' ) {
					$html .= '<div class="avta"><div class="box-avta"><img src="' . $urlimg . '" alt="' . the_title( ' ', ' ', false ) . '" width="' . $width . '" height="' . $height . '"/></div></div>';
				}
				$html .= '<div class="testimonial_des">';
				$html .= '<h5>' . the_title( ' ', ' ', false ) . '</h5>';
				if ( $web_link <> '' ) {
					$html .= '<a href="' . esc_url($web_link) . '" title="' . $web_link . '">' . $web_link . ' </a>';
				}
				$html .= '<p>' . get_the_content() . '</p>';
				$html .= '</div></div>';
			} else {

				$html .= '<div class="item_testimonial">';
				$html .= '<div class="testimonial_content" ' . $bg . '>';
				$html .= '<p>' . get_the_content() . '</p>';
				$html .= '</div>';
				$html .= '<div class="testimonial_footer">';
				if ( $urlimg <> '' ) {
					$html .= '<div class="avta"><div class="box-avta"><img src="' . $urlimg . '" alt="' . the_title( ' ', ' ', false ) . '" width="' . $width . '" height="' . $height . '"/></div></div>';
				}
				$html .= '<div class="testimonial_des">';
				$html .= '<h5>' . the_title( ' ', ' ', false ) . '</h5>';
				if ( $web_link <> '' ) {
					$html .= '<a href="' . esc_url($web_link) . '" title="' . $web_link . '">' . $web_link . ' </a>';
				}
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</div>';
			}
		endwhile;
		$html .= '</div></div>';
	}

	wp_reset_postdata();

	return $html;
}
