<?php


$header->addSubSection( array(
	'name'     => __('Top Header','aloxo'),
 	'id'       => 'display_top_header',
	'position' => 10,
) );

$header->createOption( array(
	'name'    => __( 'Show Top Bar', 'aloxo' ),
	'id'      => 'topbar_show',
	'type'    => 'checkbox',
	"desc"    => "Check to show top bar",
	'default' => false,
	'livepreview' => '
		if(value == false){
			$("#masthead .top-header").css("display", "none");
		}else{
			$("#masthead .top-header").css("display", "block");
		}
	'

) );

$header->createOption( array(
	'name'    => __( 'Font Size', 'aloxo' ),
	'id'      => 'font_size_top_header',
	'type'    => 'select',
	'options' => $font_sizes,
	'default' => '13px',
	'livepreview' => '$("#masthead .top-header").css("font-size", value);'
 ) );

$header->createOption( array(
	'name'        => __( 'Background color', 'aloxo' ),
	'id'          => 'bg_top_color',
	'type'        => 'color-opacity',
	'default'     => '#ffffff',
	'livepreview' => '$(".top-header").css("background-color", value);'
) );

$header->createOption(array(
	'name'			=> __('Background opacity', 'aloxo'),
	'id'			=> 'bg_top_opacity',
	'type'			=> 'number',
	'default'		=> '1',
	'min'			=> '0',
	'max'			=> '100',
	'step'			=> '1',
	'livepreview'	=> '$(".top-header").css("opacity", value)'
));

$header->createOption( array(
	'name'        => __( 'Border color', 'aloxo' ),
	'id'          => 'border_top_color',
	'type'        => 'color-opacity',
	'default'     => '#ffffff',
	//'livepreview' => '$("#masthead .top-header").css("{border-bottom: 5px solid valuee);'
) );

$header->createOption( array(
	'name'        => __( 'Text color', 'aloxo' ),
	'id'          => 'top_header_text_color',
	'type'        => 'color-opacity',
	'default'     => '#ffffff',
	'livepreview' => '$(".top-header a").css("color", value);'
) );

$header->createOption( array(
	'name'        => __( 'Link color', 'aloxo' ),
	'id'          => 'top_header_link_color',
	'type'        => 'color-opacity',
	'default'     => '#ffffff',
	'livepreview' => '$(".top-header a").hover(function (e) {
		$(this).css("color", value);
		e.stopPropagation();
  	});;'
) );

$header->createOption( array(
	'name'    => __( 'Width Top Left Sidebar', 'aloxo' ),
	'id'      => 'width_left_top',
	'type'    => 'number',
	'default' => '50',
	'max'     => '100',
	'min'     => '0',
	'step'    => '8.33333333333',
	'desc'    => 'width top left (%)',
	'livepreview' => '$(".top-left").css("width", value +"%");
			$(".top-right").css("width", ( 100 - value ) +"%")'
) );