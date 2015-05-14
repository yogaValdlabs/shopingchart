<?php
	/***
		Shortcode twitter
		User : longpq
		Date : 12/17/2014
		Time : 10:00 PM
	***/

	add_shortcode('twitter', 'shortcode_twitter');

	function shortcode_twitter($atts, $content=null) {
		extract(shortcode_atts(array(
			'title'					=> '',
			'title_color'			=> '',
			'title_size'			=> '',
			'title_font'			=> '',
			'icon'					=> '',
			'widget_id'				=> '',
            'created_at'            => '',
			//'twitter_name'			=> '',
			'layout'				=> '',
			'consumer_key'			=> '',
			'consumer_secret'		=> '',
			'access_token'			=> '',
			'access_token_secret'	=> '',
			'twitter_id'			=> '',
			'count'					=> '',
			'css_animation'			=> '',
			'else_class'			=> ''
		), $atts));


		$css = $html =  '';
		//$periods = $lengths = $now = $difference = $periods = $transName = $token = $credentials = $toSend = $border = '' ;

		$title = $title ? $title : '';
		//$twitter_name = $twitter_name ? $twitter_name : 'Peter Packer';
		$consumer_key = $consumer_key ? $consumer_key : '';
		$consumer_secret = $consumer_secret ? $consumer_secret : '';
		$access_token = $access_token ? $access_token : '';
		$access_token_secret = $access_token_secret ? $access_token_secret : '';
		$twitter_id = $twitter_id ? $twitter_id : '';
		$count = $count ? $count : '';
		$layout = $layout ? $layout : 'layout-01';
		$icon = $icon ? 'fa fa-'.$icon : 'fa fa-twitter fa-3x';

		$css .= $title_color ? 'color:'.$title_color.';' : 'color:#169f85;';
		$css .= $title_size ? 'font-size:'.$title_size.'px;' : 'font-size:13px';
		$css .= $title_font ? 'font-weight:'.$title_font.';' : 'font-weight:normal;'; 
		$css_animation .= ' ' . $else_class;
		$css_animation .= aloxo_getCSSAnimation( $css_animation );

		//$border = $border ? 'boder:1px solid #e5e5e5;' : 'border:none;';

		$css = $css ? 'style="' .$css. '"' : '';


		if ( $twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count ) {
			$transName = 'list_tweets_' . $widget_id;
			$cacheTime = 10;
			if ( false === ( $twitterData = get_transient( $transName ) ) ) {

				$token = get_option( 'cfTwitterToken_' . $widget_id );

				// get a new token anyways
				delete_option( 'cfTwitterToken_' . $widget_id );

				// getting new auth bearer only if we don't have one
				if ( !$token ) {
					// preparing credentials
					$credentials = $consumer_key . ':' . $consumer_secret;
					$toSend      = base64_encode( $credentials );

					// http post arguments
					$args = array(
						'method'      => 'POST',
						'httpversion' => '1.1',
						'blocking'    => true,
						'headers'     => array(
							'Authorization' => 'Basic ' . $toSend,
							'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8'
						),
						'body'        => array( 'grant_type' => 'client_credentials' )
					);

					add_filter( 'https_ssl_verify', '__return_false' );
					$response = wp_remote_post( 'https://api.twitter.com/oauth2/token', $args );

					$keys = json_decode( wp_remote_retrieve_body( $response ) );

					if ( $keys ) {
						// saving token to wp_options table
						update_option( 'cfTwitterToken_' . $widget_id, $keys->access_token );
						$token = $keys->access_token;
					}
				}
				// we have bearer token wether we obtained it from API or from options
				$args = array(
					'httpversion' => '1.1',
					'blocking'    => true,
					'headers'     => array(
						'Authorization' => "Bearer $token"
					)
				);

				add_filter( 'https_ssl_verify', '__return_false' );
				$api_url  = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $twitter_id . '&count=' . $count;
				$response = wp_remote_get( $api_url, $args );

				set_transient( $transName, wp_remote_retrieve_body( $response ), 60 * $cacheTime );
			}
			@$twitter = json_decode( get_transient( $transName ), true );


			// layout 1
			if($layout == 'layout-01') {
				if ( $twitter && is_array( $twitter ) ) {
					$html .= '<div class="twitter ' . $layout . '">';
						$html .= '<div class="item-twitter">';
						$html .= '<h3 class="item-twitter-title" ' . $css . '>' . $title . '</h3>';
						$html .= '<div class="item-twitter-icon"><span><i class="'. $icon .'" ></i></span></div>';
						$html .= '</div>';
						 foreach ( $twitter as $tweet ):
							$twitterTime = strtotime( $tweet['created_at'] );
							$timeAgo     = ago( $twitterTime );
							
							$html .= '<div class="content-twitter">';
								$html .= '<div class="content-twitter-name">';
									$html .= '<div class="content-twitter-name-n">' . $twitter_id. '</div>';
									$html .= '<div class="content-twitter-name-t"><span>' . $timeAgo . '</span></div>';
								$html .= '</div>';
								
								$html .= '<div class="content-twitter-con">';	
								 $html .= '<p>';							
									$latestTweet = $tweet['text'];
									$latestTweet = preg_replace( '/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet );
									$latestTweet = preg_replace( '/@([a-z0-9_]+)/i', '<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet );
									$html .= $latestTweet;	
								 $html .= '</p>';
							    $html .= '</div>';
								
							$html .= '</div>';
						 endforeach; 
					$html .= '</div>'; // end .twitter
				
				} // end if ( $twitter && is_array( $twitter ) )
			} 

			// layout 2
			if($layout == 'layout-02') {
				if ( $twitter && is_array( $twitter ) ) {
					$html .= '<div class="twitter ' . $layout . '">';
						$html .= '<div class="item-twitter">';
						$html .= '<div class="item-twitter-title" ' . $css . '>' . $title . '</div>';
						$html .= '<div class="item-twitter-icon"><span><i class="'. $icon .'" ></i></span></div>';
						$html .= '</div>';
						 foreach ( $twitter as $tweet ):
							$twitterTime = strtotime( $tweet['created_at'] );
							$timeAgo     = ago( $twitterTime );
							
							$html .= '<div class="content-twitter">';
								$html .= '<div class="content-twitter-name">';
									$html .= '<h3 class="content-twitter-name-n">' . $twitter_id. '</h3>';
									$html .= '<div class="content-twitter-name-t"><span>' . $timeAgo . '</span></div>';
								$html .= '</div>';
								
								$html .= '<div class="content-twitter-con">';	
								 $html .= '<p>';							
									$latestTweet = $tweet['text'];
									$latestTweet = preg_replace( '/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet );
									$latestTweet = preg_replace( '/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet );
									$html .= $latestTweet;	
								 $html .= '</p>';
							    $html .= '</div>';
								
							$html .= '</div>';
						 endforeach; 
					$html .= '</div>'; // end .twitter
					$html .= '<div class="twitter-bottom"></div>';
				
				} // end if ( $twitter && is_array( $twitter ) ) 
			}
			
		} // end if ( $twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count )

		//return $after_widget;

		

		return $html;

	}

	function ago( $time ) {
		$periods    = array( "second", "minute", "hour", "day", "week", "month", "year", "decade" );
		$lengths    = array( "60", "60", "24", "7", "4.35", "12", "10" );
		$now        = time();
		$difference = $now - $time;
		//$tense      = "ago";
		for ( $j = 0; $difference >= $lengths[$j] && $j < count( $lengths ) - 1; $j ++ ) {
			$difference /= $lengths[$j];
		}
		$difference = round( $difference );
		if ( $difference != 1 ) {
			$periods[$j] .= "s";
		}

		return "$difference $periods[$j] ago ";
	}

