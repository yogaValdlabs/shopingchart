<?php
/*
 * Post and Page Display Settings
 */
$display->addSubSection( array(
	'name'     => 'Archive',
	'id'       => 'display_archive',
	'position' => 2,
 ) );
$display->createOption( array(
	'name'    => 'Archive Layout',
	'id'      => 'archive_layout',
	'type'    => 'radio-image',
	'options' => array(
		'no-sidebar' => $url . 'body-full.png',
	    'left-sidebar' => $url . 'sidebar-left.png',
	    'right-sidebar' => $url . 'sidebar-right.png',
	    'lcr-sidebar'   => $url . 'body-left-right.png',
	    'lrc-sidebar' => $url . 'body-cl.jpg',
	    'clr-sidebar' => $url . 'body-cr.jpg'
 	),
	'default'=>'left-sidebar'
) );

$display->createOption( array(
    'name' => 'Select Layout',
    'id' => 'archive_style_layout',
    'type' => 'select',
    'options' => array(
        'basic' => 'Basic',
        'masonry' => 'Masonry',
    ),
    'default' => 'basic',
) );

$display->createOption( array(
    'name' => 'Select Columns',
    'id' => 'archive_style_columns',
    'type' => 'select',
    'desc' => 'This config will work for masonry layout',
    'options' => array(
        'col-2' => '2 Columns',
        'col-3' => '3 Columns',
        'col-4' => '4 Columns',
    ),
    'default' => 'col-2',
) );

$display->createOption( array(
	'name'        => 'Content Background',
	'id'          => 'archive_bg_content',
	'type'        => 'color-opacity',
	'default'     => '#fff',
	//'livepreview' => '$("body").css("background-color", value);'
) );

// $display->createOption( array(
// 	'name'        => 'Top Image',
// 	'id'          => 'top_image_archive',
// 	'type'        => 'upload',
// 	'desc'=>'Enter URL or Upload an top image file for header',
// 	'livepreview' => ''
// ) );

$display->createOption( array(
	'name'    => 'Hide Breadcrumbs?',
	'id'      => 'archive_hide_breadcrumbs',
	'type'    => 'checkbox',
	"desc"    => "Check this box to hide/unhide Breadcrumbs",
	'default' => false,
) );

$display->createOption( array(
	'name'    => 'Hide Title',
	'id'      => 'archive_hide_title',
	'type'    => 'checkbox',
	"desc"    => "Check this box to hide/unhide title",
	'default' => false,
) );

$display->createOption( array(
	'name'        => 'Background Heading',
	'id'          => 'archive_bg_color',
	'type'        => 'color-opacity',
	'default'     => '#37c6ca',
	'livepreview' => ''
) );

$display->createOption( array(
	'name'        => 'Text Color Heading',
	'id'          => 'archive_text_color',
	'type'        => 'color-opacity',
	'default'     => '#fff',
	'livepreview' => ''
) );

$display->createOption( array(
	'name'    => 'Height Heading',
	'id'      => 'archive_height_heading',
	'type'    => 'number',
	"desc" => "Use a number without 'px', default is 100. ex: 100",
	'default' => '100',
	'max'     => '300',
	'min'=>'50',
) );

$display->createOption( array(
	'name' => 'Description for each article',
	'id' => 'desc_each_article',
	'options' => array(
		'full_text' => 'Full text',
 		'summary' => 'Summary',
 	),
	'type' => 'radio',
 	'default' => 'summary',
) );

$display->createOption( array(
	'name'    => 'Excerpt Length',
	'id'      => 'archive_excerpt_length',
	'type'    => 'number',
	"desc" => "Enter the number of words you want to cut from the content to be the excerpt of search and archive and portfolio page.",
	'default' => '20',
	'max'     => '100',
	'min'=>'10',
) );


$display->createOption( array(
	'name'    => 'Show category',
	'id'      => 'show_category',
	'type'    => 'checkbox',
	"desc"    => "show/hidden",
	'default' => false,
) );

$display->createOption( array(
	'name'    => 'Show Date',
	'id'      => 'show_date',
	'type'    => 'checkbox',
	"desc"    => "show/hidden",
	'default' => true,
) );

$display->createOption( array(
	'name'    => 'Show Author',
	'id'      => 'show_author',
	'type'    => 'checkbox',
	"desc"    => "show/hidden",
	'default' => true,
) );

$display->createOption( array(
	'name'    => 'Show Comment',
	'id'      => 'show_comment',
	'type'    => 'checkbox',
	"desc"    => "show/hidden",
	'default' => true,
) );

$display->createOption( array(
	'name' => 'Date Format',
	'id' => 'date_format',
	'type' => 'text',
	"desc" => __('<a href="http://codex.wordpress.org/Formatting_Date_and_Time">Formatting Date and Time</a>','aloxo'),
	'default'=>'j M Y'
) );

$display->createOption( array(
	'name'    => 'Select Paging Style',
	'id'      => 'paging_style',
	'type'    => 'select',
	'options' => array(
		'paging'=> 'Paging', 
        'btn_load_more'=> 'Button Load More',
        'scroll' => 'Infinite Scroll',
 	),
	'default'=>'paging'
) );