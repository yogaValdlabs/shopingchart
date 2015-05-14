<?php
/**
 * Loop Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;

$rating = $product->get_average_rating();

?>

<?php 
if ($rating == '') {
	echo "<div title=\"Rated 0 out of 5\" class=\"star-rating\"><span style=\"width:0%\"><strong class=\"rating\">0.00</strong> out of 5</span></div>";
} else {
	$rating_html = $product->get_rating_html();
	echo $rating_html;
}