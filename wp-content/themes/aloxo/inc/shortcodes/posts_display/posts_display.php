<?php
add_shortcode( 'posts_display', 'shortcode_posts_display' );
function shortcode_posts_display( $atts, $content = null ) {
	global $theme_options_data;
	wp_enqueue_script( 'jquery.flexslider' );
	extract( shortcode_atts( array(
		'title'              => '',
		'size'               => '',
		'layout'             => '',
		'number_posts'       => 4,
		'column'             => 4,
		'excerpt_words'      => '',
		'cats'               => '',
		'heading_style'      => '',
		'orderby'            => '',
		'order'              => '',
		'right_heading_text' => '',
		'right_heading_link' => '#',
		//'display'      => 'oldest',
		'el_class'           => '',
	), $atts ) );

	$query_args = array(
		'posts_per_page' => $number_posts,
		'order'          => $order == 'asc' ? 'asc' : 'desc',
	);

	switch ( $orderby ) {
		case 'date' :
			$query_args['orderby'] = 'post_date';
			break;
		case 'title' :
			$query_args['orderby'] = 'post_title';
			break;
		case 'comment' :
			$query_args['orderby'] = 'comment_count';
			break;
		default : //random
			$query_args['orderby'] = 'rand';
	}

	if ( $cats ) {
		$cats_id                 = explode( ',', $cats );
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'term_id',
				'terms'    => $cats_id
			)
		);
	}

	$posts_display = new WP_Query( $query_args );

	$heading_style = ' ' . $heading_style;
$html = '';
	if ( $posts_display->have_posts() ) {
		$html .= '<div class="sc-posts-display ' . $layout . '">';

		/* layout 01 */
		if ( $layout == 'layout-01' ) {
			$img_size    = "medium";
			$time_format = $theme_options_data['thim_date_format'];
			//$html .= '<ul>';
			if ( $title ) {
				if ( $heading_style == " style-02" ) {
					$html .= '<div class="heading' . $heading_style . '"><h3>' . $title . '</h3>';
					$html .= '<span>';
					$html .= '<a href="' . esc_url($right_heading_link) . '">' . $right_heading_text . '</a>';
					$html .= '</span>';
					$html .= '</div>';
				} else {
					$html .= '<div class="heading' . $heading_style . '"><h3>' . $title . '</h3></div>';
				}
			} else {

			}
			$html .= '<div class="list-post">';
			while ( $posts_display->have_posts() ) {
				$posts_display->the_post();

				$format = $post_format = get_post_format();
				if ( $column ) {
					$col = " col-1-" . $column;
				} else $col = "";

				if ( false === $format ) {
					$format = ' class="format-standard' . $col . '"';
				} else {
					$format = ' class="format-' . $format . $col . '"';
				}

				//$html .= '<div class="item">';
				$html .= '<article id="item-post-' . get_the_ID() . '" ' . $format . '>';
				$html .= '<div class= "content-inner">';

				$attr = array(
					'title' => get_the_title(),
					'alt'   => get_the_title()
				);
				/*
					standard
					aside
					gallery
					link
					image
					quote
					video
					audio

					status
					chat
				*/
				switch ( $post_format ) {
					case "aside":
						$html .= '<div class="entry-container">';
						$html .= '<span class="time">' . get_the_time( $time_format ) . '</span>';
						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';
						$length = $theme_options_data['thim_archive_excerpt_length'];
						$html .= aloxo_excerpt( $length );
						$html .= '</div>';
						break;
					case "gallery":
						$images      = aloxo_meta( 'thim_gallery', "type=image&single=false&size=$img_size" );
						$images_full = aloxo_meta( 'thim_gallery', "type=image&single=false&size=full" );

						if ( empty( $images ) ) {
							break;
						}
						wp_enqueue_script( 'aloxo-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '', false );
						$html .= '<div class="post-formats-wrapper"><div class="flexslider">';
						$html .= '<ul class="slides">';
						$i = 0;
						foreach ( $images as $image ) {
							$html .= '<li><a data-rel="prettyPhoto[gallery]" href="' . esc_url($images_full[$i]['url']) . '" class="hover-gradient"><img src="' . $image['url'] . '" alt="' . get_the_title() . '"></a></li>';
							$i ++;
						}
						$html .= '</ul>';
						$html .= '</div>';

						$html .= '<div class="entry-container">';
						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';
						$html .= '<span class="time">' . get_the_time( $time_format ) . '</span>';


						$html .= '</div>';
						break;
					case "link":
						$html .= '<div class="entry-thumbnail">';
						$html .= '<a target="_blank" href="' . aloxo_meta( 'thim_url' ) . '">' . get_the_post_thumbnail( get_the_ID(), $img_size, $attr ) . '</a>';
						$html .= '</div>';
						break;
					case "image":
						$html .= '<div class="entry-thumbnail">';

						$images = aloxo_meta( 'thim_image', "type=image&size=$img_size" );
						if ( empty( $images ) ) {
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
							$url   = $thumb['0'];
						} else {
							$image = current( $images );
							$url   = $image['url'];
						}

						$html .= '<a data-rel="prettyPhoto[img1]" href="' . esc_url($url) . '">' . get_the_post_thumbnail( get_the_ID(), $img_size, $attr ) . '<i class="fa fa-picture-o"></i></a>';
						$html .= '</div>';

						$html .= '<div class="entry-container">';
						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';
						$html .= '<span class="time">' . get_the_time( $time_format ) . '</span>';

						break;
					case "video":
						$html .= '<div class="entry-thumbnail">';
						//$html .= '<a data-rel="prettyPhoto[video]" href="'.aloxo_meta( 'video' ).'">'.get_the_post_thumbnail( get_the_ID(), $img_size, $attr ).'<i class="fa fa-play-circle-o"></i></a>';
						$html .= '<a data-rel="prettyPhoto[video]" href="' . aloxo_meta( 'thim_video' ) . '">' . get_the_post_thumbnail( get_the_ID(), $img_size, $attr ) . '<span class="play-button"></span></a>';
						$html .= '</div>';

						$html .= '<div class="entry-container">';
						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';
						$html .= '<span class="time">' . get_the_time( $time_format ) . '</span>';

						break;
					case "quote":
						$html .= '<div class="entry-container">';
						$html .= '<blockquote>' . aloxo_meta( 'thim_quote' ) . '</blockquote>';
						$html .= '</div>';
						break;

					default:
						$html .= '<div class="entry-thumbnail">';
						$html .= '<a href="' . get_permalink( get_the_ID() ) . '">' . get_the_post_thumbnail( get_the_ID(), $img_size, $attr ) . '</a>';
						$html .= '</div>';
						$html .= '<div class="entry-container">';
						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';
						$html .= '<span class="time">' . get_the_time( $time_format ) . '</span>';
						$html .= '</div>';
				}
				$html .= '</div>';
				$html .= '</article>';
				// $html .= '</div>';


				// $html .= '<li>';
				// $html .= '<div class="thumb">';
				// $html .= '<a href="' . get_permalink( get_the_ID() ) . '" title="' . get_the_title( get_the_ID() ) . '"> <img src="' . aloxo_post_thumbnail_src( 'medium' ) . '" alt="' . get_permalink( get_the_ID() ) . '" /></a>';
				// $html .= '</div>';
				// $html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';
				// $html .= '</li>';
			}
			$html .= '</div>';
			//$html .= '</ul>';
		}

		/* layout 02 */
		if ( $layout == 'layout-02' ) {
			$img_size    = "medium";
			$time_format = $theme_options_data['thim_date_format'];
			//$html .= '<ul>';

			if ( $title ) {
				if ( $heading_style === " style-02" ) {
					$html .= '<div class="heading' . $heading_style . '"><h3>' . $title . '</h3>';
					$html .= '<span>';
					$html .= '<a href="' . esc_url($right_heading_link) . '">' . $right_heading_text . '</a>';
					$html .= '</span>';
					$html .= '</div>';

				} else
					$html .= '<div class="heading' . $heading_style . '"><h3>' . $title . '</h3></div>';
			} else {

			}
			$html .= '<div class="list-post">';
			while ( $posts_display->have_posts() ) {
				$posts_display->the_post();

				$format = $post_format = get_post_format();
				if ( $column ) {
					$col = " col-1-" . $column;
				} else $col = "";

				if ( false === $format ) {
					$format = ' class="format-standard' . $col . '"';
				} else {
					$format = ' class="format-' . $format . $col . '"';
				}

				//$html .= '<div class="item">';
				$html .= '<article id="item-post-' . get_the_ID() . '" ' . $format . '>';
				$html .= '<div class= "content-inner">';

				$attr = array(
					'title' => get_the_title(),
					'alt'   => get_the_title()
				);
				/*
					standard
					aside
					gallery
					link
					image
					quote
					video
					audio

					status
					chat
				*/
				switch ( $post_format ) {
					case "aside":
						$html .= '<div class="entry-container">';
						$html .= '<div class="time">' . get_the_time( $time_format ) . '</div>';
						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';
						$length = $theme_options_data['thim_archive_excerpt_length'];
						$html .= aloxo_excerpt( $length );
						$html .= '</div>';
						break;
					case "gallery":
						$images      = aloxo_meta( 'thim_gallery', "type=image&single=false&size=$img_size" );
						$images_full = aloxo_meta( 'thim_gallery', "type=image&single=false&size=full" );

						if ( empty( $images ) ) {
							break;
						}
						wp_enqueue_script( 'aloxo-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '', false );
						$html .= '<div class="post-formats-wrapper"><div class="flexslider">';
						$html .= '<ul class="slides">';
						$i = 0;
						foreach ( $images as $image ) {
							$html .= '<li><a data-rel="prettyPhoto[gallery]" href="' . esc_url($images_full[$i]['url']) . '" class="hover-gradient"><img src="' . $image['url'] . '" alt="' . get_the_title() . '"></a></li>';
							$i ++;
						}
						$html .= '</ul>';
						$html .= '</div>';

						$html .= '<div class="entry-container">';
						//$html .= '<div class="time"><h3 class="post-day">'.get_the_time('d').'</h3><div class="line"></div><h3>'.get_the_time('M').'</h3></div>';
						//$html .= '<div class="time"><div class="post-day">'.get_the_time('d').'</div><div class="line"></div><div>'.get_the_time('M').'</div></div>';
						$html .= '<div class="time"><span class="post-day">' . get_the_time( 'd' ) . '</span><span>' . get_the_time( 'M' ) . '</span></div>';

						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';

						if ( $excerpt_words ) {
							$html .= '<div class="entry-summary">
											' . aloxo_excerpt( $excerpt_words ) . '
										</div>
									';
							$html .= '<div class="readmore"><div class="title"><a href="' . get_permalink( get_the_ID() ) . '">Read More</a></div></div>';
						} else {
							$html .= '<div class="entry-summary">
												 ' . get_the_content() . '
										</div>
									';
						}

						$html .= '</div>';
						break;
					case "link":
						$html .= '<div class="entry-thumbnail">';
						$html .= '<a target="_blank" href="' . aloxo_meta( 'thim_url' ) . '">' . get_the_post_thumbnail( get_the_ID(), $img_size, $attr ) . '</a>';
						$html .= '</div>';
						break;
					case "image":
						$html .= '<div class="entry-thumbnail">';

						$images = aloxo_meta( 'thim_image', "type=image&size=$img_size" );
						if ( empty( $images ) ) {
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
							$url   = $thumb['0'];
						} else {
							$image = current( $images );
							$url   = $image['url'];
						}

						$html .= '<a data-rel="prettyPhoto[img1]" href="' . esc_url($url) . '">' . get_the_post_thumbnail( get_the_ID(), $img_size, $attr ) . '<i class="fa fa-picture-o"></i></a>';
						$html .= '</div>';

						$html .= '<div class="entry-container">';
						//$html .= '<div class="time"><h3 class="post-day">'.get_the_time('d').'</h3><div class="line"></div><h3>'.get_the_time('M').'</h3></div>';
						//$html .= '<div class="time"><div class="post-day">'.get_the_time('d').'</div><div class="line"></div><div>'.get_the_time('M').'</div></div>';
						$html .= '<div class="time"><span class="post-day">' . get_the_time( 'd' ) . '</span><span>' . get_the_time( 'M' ) . '</span></div>';

						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';


						if ( $excerpt_words ) {
							$html .= '<div class="entry-summary">
											' . aloxo_excerpt( $excerpt_words ) . '
										</div>
									';
							$html .= '<div class="readmore"><div class="title"><a href="' . get_permalink( get_the_ID() ) . '">Read More</a></div></div>';
						} else {
							$html .= '<div class="entry-summary">
												 ' . get_the_content() . '
										</div>
									';
						}

						$html .= '</div>';
						break;
					case "video":
						$html .= '<div class="entry-thumbnail">';
						//$html .= '<a data-rel="prettyPhoto[video]" href="'.aloxo_meta( 'video' ).'">'.get_the_post_thumbnail( get_the_ID(), $img_size, $attr ).'<i class="fa fa-play-circle-o"></i></a>';
						$html .= '<a data-rel="prettyPhoto[video]" href="' . aloxo_meta( 'thim_video' ) . '">' . get_the_post_thumbnail( get_the_ID(), $img_size, $attr ) . '<span class="play-button"></span></a>';
						$html .= '</div>';

						$html .= '<div class="entry-container">';
						//$html .= '<div class="time"><h3 class="post-day">'.get_the_time('d').'</h3><div class="line"></div><h3>'.get_the_time('M').'</h3></div>';
						//$html .= '<div class="time"><div class="post-day">'.get_the_time('d').'</div><div class="line"></div><div>'.get_the_time('M').'</div></div>';
						$html .= '<div class="time"><span class="post-day">' . get_the_time( 'd' ) . '</span><span>' . get_the_time( 'M' ) . '</span></div>';

						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';


						if ( $excerpt_words ) {
							$html .= '<div class="entry-summary">
											' . aloxo_excerpt( $excerpt_words ) . '
										</div>
									';
							$html .= '<div class="readmore"><div class="title"><a href="' . get_permalink( get_the_ID() ) . '">Read More</a></div></div>';
						} else {
							$html .= '<div class="entry-summary">
												 ' . get_the_content() . '
										</div>
									';
						}

						$html .= '</div>';
						break;
					case "quote":
						$html .= '<div class="entry-container">';
						$html .= '<blockquote>' . aloxo_meta( 'thim_quote' ) . '</blockquote>';
						$html .= '</div>';
						break;

					default:
						$html .= '<div class="entry-thumbnail">';
						$html .= '<a href="' . get_permalink( get_the_ID() ) . '">' . get_the_post_thumbnail( get_the_ID(), $img_size, $attr ) . '</a>';
						$html .= '</div>';
						$html .= '<div class="entry-container">';
						//$html .= '<div class="time"><div class="post-day">'.get_the_time('d').'</div><div class="line"></div><div>'.get_the_time('M').'</div></div>';
						$html .= '<div class="time"><span class="post-day">' . get_the_time( 'd' ) . '</span><span>' . get_the_time( 'M' ) . '</span></div>';

						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';


						if ( $excerpt_words ) {
							$html .= '<div class="entry-summary">
											' . aloxo_excerpt( $excerpt_words ) . '
										</div>
									';
							$html .= '<div class="readmore"><div class="title"><a href="' . get_permalink( get_the_ID() ) . '">Read More</a></div></div>';
						} else {
							$html .= '<div class="entry-summary">
												 ' . get_the_content() . '
										</div>
									';
						}

						$html .= '</div>';
				}
				$html .= '</div>';
				$html .= '</article>';
				// $html .= '</div>';


				// $html .= '<li>';
				// $html .= '<div class="thumb">';
				// $html .= '<a href="' . get_permalink( get_the_ID() ) . '" title="' . get_the_title( get_the_ID() ) . '"> <img src="' . aloxo_post_thumbnail_src( 'medium' ) . '" alt="' . get_permalink( get_the_ID() ) . '" /></a>';
				// $html .= '</div>';
				// $html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';
				// $html .= '</li>';
			}
			$html .= '</div>';
			//$html .= '</ul>';
		}

		/* layout 03 */
		if ( $layout == 'layout-03' ) {
			$randnumber = rand( 0, 10000 );
			$number_id  = $randnumber;

			wp_enqueue_script( 'aloxo-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '', false );
			$config = ",singleItem:true";
			$html .= '
	 		<script>
				jQuery(function($) {
					$("#horizontal_' . $number_id . '").owlCarousel({
						autoPlay: 3000
						,navigation: true
						,navigationText: ["<i class=\'fa fa-angle-left\'></i>","<i class=\'fa fa-angle-right\'></i>"]
						,pagination: false
						' . $config . '
				  });
				});
			</script>';

			$img_size    = "medium";
			$time_format = $theme_options_data['thim_date_format'];
			//$html .= '<ul>';
			if ( $title ) {
				if ( $heading_style == " style-02" ) {
					$html .= '<div class="heading' . $heading_style . '"><h3>' . $title . '</h3>';
					$html .= '<span>';
					$html .= '<a href="' . esc_url($right_heading_link) . '">' . $right_heading_text . '</a>';
					$html .= '</span>';
					$html .= '</div>';
				} else
					$html .= '<div class="heading' . $heading_style . '"><h3>' . $title . '</h3></div>';
			} else {

			}
			$html .= '<div id="horizontal_' . $number_id . '">';
			while ( $posts_display->have_posts() ) {
				$posts_display->the_post();

				$format = $post_format = get_post_format();
				if ( $column ) {
					$col = " col-1-" . $column;
				} else $col = "";

				if ( false === $format ) {
					$format = ' class="format-standard"';
				} else {
					$format = ' class="format-' . $format . '"';
				}

				//$html .= '<div class="item">';
				$html .= '<article id="item-post-' . get_the_ID() . '" ' . $format . '>';
				$html .= '<div class= "content-inner">';

				$attr = array(
					'title' => get_the_title(),
					'alt'   => get_the_title()
				);
				/*
					standard
					aside
					gallery
					link
					image
					quote
					video
					audio

					status
					chat
				*/
				switch ( $post_format ) {
					case "aside":
						$html .= '<div class="entry-container">';
						$html .= '<div class="time">' . get_the_time( $time_format ) . '</div>';
						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';
						$length = $theme_options_data['thim_archive_excerpt_length'];
						$html .= aloxo_excerpt( $length );
						$html .= '</div>';
						break;
					case "gallery":
						$images      = aloxo_meta( 'thim_gallery', "type=image&size=$img_size" );
						$images_full = aloxo_meta( 'thim_gallery', "type=image&size=full" );

						if ( empty( $images ) ) {
							break;
						}
						wp_enqueue_script( 'aloxo-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '', false );
						$html .= '<div class="post-formats-wrapper"><div class="flexslider">';
						$html .= '<ul class="slides">';
						$i = 0;
						foreach ( $images as $image ) {
							$html .= '<li><a data-rel="prettyPhoto[gallery]" href="' . esc_url($images_full[$i]['url']) . '" class="hover-gradient"><img src="' . $image['url'] . '" alt="' . get_the_title() . '"></a></li>';
							$i ++;
						}
						$html .= '</ul>';
						$html .= '</div>';

						$html .= '<div class="entry-container">';
						//$html .= '<div class="time"><h3 class="post-day">'.get_the_time('d').'</h3><div class="line"></div><h3>'.get_the_time('M').'</h3></div>';
						$html .= '<div class="time"><span class="post-day">' . get_the_time( 'd' ) . '</span><span>' . get_the_time( 'M' ) . '</span></div>';

						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';
						$html .= '<span class="post-meta">' . __( 'Post by ', 'aloxo' ) . ' ' . get_the_author() . '</span>';
						$html .= '</div>';
						break;
					case "link":
						$html .= '<div class="entry-thumbnail">';
						$html .= '<a target="_blank" href="' . aloxo_meta( 'thim_url' ) . '">' . get_the_post_thumbnail( get_the_ID(), $img_size, $attr ) . '</a>';
						$html .= '</div>';
						break;
					case "image":
						$html .= '<div class="entry-thumbnail">';

						$images = aloxo_meta( 'thim_image', "type=image&size=$img_size" );
						if ( empty( $images ) ) {
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
							$url   = $thumb['0'];
						} else {
							$image = current( $images );
							$url   = $image['url'];
						}

						$html .= '<a data-rel="prettyPhoto[img1]" href="' . esc_url($url) . '">' . get_the_post_thumbnail( get_the_ID(), $img_size, $attr ) . '<i class="fa fa-picture-o"></i></a>';
						$html .= '</div>';

						$html .= '<div class="entry-container">';
						//$html .= '<div class="time"><h3 class="post-day">'.get_the_time('d').'</h3><div class="line"></div><h3>'.get_the_time('M').'</h3></div>';
						$html .= '<div class="time"><span class="post-day">' . get_the_time( 'd' ) . '</span><span>' . get_the_time( 'M' ) . '</span></div>';

						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';
						$html .= '<span class="post-meta">' . __( 'Post by ', 'aloxo' ) . ' ' . get_the_author() . '</span>';
						$html .= '</div>';
						break;
					case "video":
						$html .= '<div class="entry-thumbnail">';
						//$html .= '<a data-rel="prettyPhoto[video]" href="'.aloxo_meta( 'video' ).'">'.get_the_post_thumbnail( get_the_ID(), $img_size, $attr ).'<i class="fa fa-play-circle-o"></i></a>';
						$html .= '<a data-rel="prettyPhoto[video]" href="' . aloxo_meta( 'thim_video' ) . '">' . get_the_post_thumbnail( get_the_ID(), $img_size, $attr ) . '<span class="play-button"></span></a>';
						$html .= '</div>';

						$html .= '<div class="entry-container">';
						//$html .= '<div class="time"><h3 class="post-day">'.get_the_time('d').'</h3><div class="line"></div><h3>'.get_the_time('M').'</h3></div>';
						$html .= '<div class="time"><span class="post-day">' . get_the_time( 'd' ) . '</span><span>' . get_the_time( 'M' ) . '</span></div>';

						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';

						$html .= '<span class="post-meta">' . __( 'Post by ', 'aloxo' ) . ' ' . get_the_author() . '</span>';
						$html .= '</div>';
						break;
					case "quote":
						$html .= '<div class="entry-container">';
						$html .= '<blockquote>' . aloxo_meta( 'thim_quote' ) . '</blockquote>';
						$html .= '</div>';
						break;

					default:
						$html .= '<div class="entry-thumbnail">';
						$html .= '<a href="' . get_permalink( get_the_ID() ) . '">' . get_the_post_thumbnail( get_the_ID(), $img_size, $attr ) . '</a>';
						$html .= '</div>';
						$html .= '<div class="entry-container">';
						//$html .= '<div class="time"><h3 class="post-day">'.get_the_time('d').'</h3><div class="line"></div><h3>'.get_the_time('M').'</h3></div>';
						$html .= '<div class="time"><span class="post-day">' . get_the_time( 'd' ) . '</span><span>' . get_the_time( 'M' ) . '</span></div>';

						$html .= '<h3><a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title() . '</a></h3>';

						$html .= '<span class="post-meta">' . __( 'Post by ', 'aloxo' ) . ' ' . get_the_author() . '</span>';
						$html .= '</div>';
				}
				$html .= '</div>';
				$html .= '</article>';

			}
			$html .= '</div>';
			//$html .= '</ul>';
		}
		$html .= '</div>';
	}

	return $html;
	////////////////////////////////////////////////
}
