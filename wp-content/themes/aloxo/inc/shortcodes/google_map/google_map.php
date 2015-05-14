<?php
/**
 * Created by PhpStorm.
 * User: Anh Tuan
 * Date: 4/22/14
 * Time: 12:25 AM
 */
//////////////////////////////////////////////////////////////////
// google map
//////////////////////////////////////////////////////////////////

add_shortcode( 'google_map', 'shortcode_google_map' );

function shortcode_google_map( $atts, $content = null ) {
	$rnr_map_lat = $rnr_map_logo = $rnr_map_long = $rnr_map_logo = $rnr_map_zoom = $el_class = $aloxo_animation = $css_animation = $rnr_contact_address = '';
	extract( shortcode_atts( array(
		'rnr_map_lat'         => '',
		'rnr_map_long'        => '',
		'rnr_map_logo'        => $rnr_map_logo,
		'rnr_map_zoom'        => "",
		'el_class'            => '',
		'rnr_contact_address' => '',
		'css_animation'       => ''
	), $atts ) );
	$img_id  = preg_replace( '/[^\d]/', '', $rnr_map_logo );
	$link_to = wp_get_attachment_image_src( $img_id, 'full' );
	$link_to = $link_to[0];
	if ( $link_to == '' ) {
		$link_to = get_template_directory_uri() . "/images/logo_map.png";
	}
	if ( $rnr_contact_address == '' ) {
		$rnr_contact_address = __( 'My Address', 'aloxo' );
	}
	$aloxo_animation .= ' ' . $el_class;
	$aloxo_animation .= aloxo_getCSSAnimation( $css_animation );

	wp_enqueue_script( 'mapapi', 'https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&ver=2.1', array(), '', true );
	wp_enqueue_script( 'infobox', 'http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js?ver=2.1', array(), '', true );

	$html = '
			<div class="row contact-map">
					  <script type="text/javascript">
                        jQuery(document).ready(function() {
                     		 function initialize() {
                              var secheltLoc = new google.maps.LatLng(' . $rnr_map_lat . ',' . $rnr_map_long . ');
                              var myMapOptions = {
                                   center: secheltLoc
                                  ,mapTypeId: google.maps.MapTypeId.ROADMAP
                                  ,zoom: ' . $rnr_map_zoom . ', scrollwheel: false,mapTypeControl: false, draggable: false
                              };
                              var theMap = new google.maps.Map(document.getElementById("google-map"), myMapOptions);
                              var image = new google.maps.MarkerImage(
                                  "' . get_template_directory_uri() . '/images/pinMap.png",
									new google.maps.Size(17,26),
									new google.maps.Point(0,0),
									new google.maps.Point(8,26)
									);
									var shadow = new google.maps.MarkerImage(
									"' . get_template_directory_uri() . '/images/pinMap-shadow.png",
									new google.maps.Size(33,26),
									new google.maps.Point(0,0),
									new google.maps.Point(9,26)
									);
									var marker = new google.maps.Marker({
									map: theMap,
									icon: image,
									shadow: shadow,
									draggable: false,
									animation: google.maps.Animation.DROP,
									position: secheltLoc,
									visible: true
									});

									var boxText = document.createElement("div");
									boxText.innerHTML = \'<div class="captionMap animated bounceInDown"><img src="' . $link_to . '" class="alignleft"  alt="Contact Address"> <span>' . $rnr_contact_address . '</span></div>\';
									var myOptions = {
									content: boxText
									,disableAutoPan: false,maxWidth: 0
									,pixelOffset: new google.maps.Size(-140, 0)
									,zIndex: null
									,boxStyle: {
									width: "280px"
									}
									,closeBoxURL: ""
									,infoBoxClearance: new google.maps.Size(1, 1)
									,isHidden: false
									,pane: "floatPane"
									,enableEventPropagation: false
									};

									google.maps.event.addListener(theMap, "click", function (e) {
									ib.open(theMap, this);
									});

									var ib = new InfoBox(myOptions);
									ib.open(theMap, marker);
									}
									google.maps.event.addDomListener(window, \'load\', initialize);

									});
									</script>
									<div id="google-map" class="embed clearfix">
										<div class="mapPreLoading">
										<span><h4>Loading</h4></span>
									<span class="l-1"></span>
									<span class="l-2"></span>
									<span class="l-3"></span>
									<span class="l-4"></span>
									<span class="l-5"></span>
									<span class="l-6"></span>
									</div>
									</div>
									</div>
	';

	return $html;
}