<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 4/23/14
 * Time: 9:42 AM
 */
//////////////////////////////////////////////////////////////////
// Our Team
//////////////////////////////////////////////////////////////////
add_shortcode( 'our_team', 'shortcode_our_team' );
function shortcode_our_team( $atts, $content = null ) {
	global $post;
	extract( shortcode_atts( array(
		'number'        => 8,
		'el_class'      => '',
		'layout'		=>'',
		'column'		=>''
	), $atts ) );

	$html = '';
	$args = array(
		'posts_per_page' => $number,
		'post_type'      => 'our_team'
	);
	$columns='';
	if($column<>''){
		$columns   = 12 / $column;
	}

	$our_team = new WP_Query( $args );
	if ( $our_team->have_posts() ) {
		if($layout =='slider'){
			wp_enqueue_script( 'aloxo-roundabout', get_template_directory_uri() . '/js/jquery.roundabout.min.js', array('jquery'), '', false );
			$html .= '
				<script>
					jQuery(function($){
								window.addEventListener(\'load\',function(){setTimeout(function(){
									$("#content_our_team").roundabout({
										btnNext: ".next_team" ,
										btnPrev: ".prev_team" ,
										responsive: true
									});
								},false);
							});
					})
				</script>';
			$html .= '<div class="wapper_our_team"><ul id="content_our_team">';
		}else{
			$html .= '<div class="wapper_lists_our_team row"><ul>';
		}
		while ( $our_team->have_posts() ): $our_team->the_post();
			$regency      = get_post_meta(get_the_ID(), 'regency', true);
			$link_face      = get_post_meta(get_the_ID(), 'face_url', true);
			$link_twitter      = get_post_meta(get_the_ID(), 'twitter_url', true);
			$google_url      = get_post_meta(get_the_ID(), 'google_url', true);
			$dribbble_url      = get_post_meta(get_the_ID(), 'dribbble_url', true);
			$linkedin_url      = get_post_meta(get_the_ID(), 'linkedin_url', true);

			$image_id = get_post_thumbnail_id($post->ID);
			$image_url = wp_get_attachment_image($image_id, 'our_team' , false, array( 'alt'   => get_the_title() ,'title' =>  get_the_title()  ));
			if($layout =='slider'){
				$html .= '<li>';
			}else{
				$html .= '<li class="col-sm-'.$columns.'"><div class="content_list_our_team">';
			}
			$html .= '<div class="our_team-image">' . $image_url . '</div>';
			$html .= '<div class="content_team">
							<div class="out_team_title">
								<h4><a href="' . get_permalink( $post->ID ) . '" title="' . get_the_title( $post->ID ) . '" >' . get_the_title( $post->ID ) . '</a></h4>';
			if($regency<>''){
				$html .='<div class = "regency">'.$regency.'</div>';
			}
			$html .= '</div>
							<div class="hidden_child">
								<div class = "description">'. aloxo_excerpt('15') .'</div>
								<ul class="social_team">';
			if($link_face <>''){
				$html .= '<li><a class="face" href="'.esc_url($link_face).'"><i class="fa fa-facebook-square"></i></a></li>';
			}
			if($link_twitter <>''){
				$html .= '<li><a class="twitter" href="'.esc_url($link_twitter).'"><i class="fa fa-twitter"></i></a></li>';
			}
			if($google_url <>''){
				$html .= '<li><a class="google" href="'.esc_url($google_url).'"><i class="fa fa-google-plus"></i></a></li>';
			}
			if($dribbble_url <>''){
				$html .= '<li><a class="dribble" href="'.esc_url($dribbble_url).'"><i class="fa fa-dribbble"></i></a></li>';
			}
			if($linkedin_url <>''){
				$html .= '<li><a class="linkedin" href="'.esc_url($linkedin_url).'"><i class="fa fa-linkedin"></i></a></li>';
			}

			$html .= '</ul></div>';
			$html .= '</div><div class="clear"></div>';
			if($layout =='slider'){
				$html .= '</li>';
			}else{
				$html .= '</div></li>';
			}
		endwhile;
		$html .= '</ul>';
		if($layout =='slider'){
			$html .= '<div class="nav_team">
				<a href="#" class="next_team"><span class="inner_icon"><span class="icon"><i class="fa fa-angle-right"></i></span></span></a>
				<a href="#" class="prev_team"><span class="inner_icon"><span class="icon"><i class="fa fa-angle-left"></i></span></span></a>
			</div>';
		}

		$html .= '</div>';
	}
	wp_reset_postdata();

	return $html;
}