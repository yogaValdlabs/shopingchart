<?php
// Override WooCommerce function
if (!function_exists('woocommerce_template_loop_product_thumbnail')) {

    function woocommerce_template_loop_product_thumbnail() {
        global $product, $theme_options_data;
        $attachment_ids = $product->get_gallery_attachment_ids();
        $image = "";
        if (isset($attachment_ids[0])) {
            $image = wp_get_attachment_image($attachment_ids[0], apply_filters('shop_catalog', 'shop_catalog'));
        }

        if (isset($theme_options_data['thim_woo_set_hover_item']) && $theme_options_data['thim_woo_set_hover_item'] == "changeimages") {
            echo woocommerce_get_product_thumbnail();
            if ($image != "") {
                echo '<div class="product-change-images">' . $image . '</div>';
            }
        } else {
            echo '<div class="thumb flip">';
            echo '<span class="face">' . woocommerce_get_product_thumbnail() . '</span>';
            if ($image != "") {
                echo '<span class="face back">' . $image . '</span>';
            } else {
                echo '<span class="face back">' . woocommerce_get_product_thumbnail() . '</span>';
            }
            echo '</div>';
        }
    }

}

// add button compare before button wishlist
global $yith_woocompare;
if ( isset( $yith_woocompare ) ) {
    remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
    add_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 30 );
}


add_action('woocommerce_single_product_summary_quick', 'woocommerce_template_single_title', 5);
add_action('woocommerce_single_product_summary_quick', 'woocommerce_template_single_rating', 10);
add_action('woocommerce_single_product_summary_quick', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary_quick', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary_quick', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary_quick', 'woocommerce_template_single_sharing', 50);
add_action('woocommerce_single_product_summary_quick', 'woocommerce_template_single_add_to_cart', 30);

/* Custom WC_Widget_Cart */
function aloxo_get_current_cart_info() {
    global $woocommerce;
    $items = count( $woocommerce->cart->get_cart() );

    return array(
        $items,
        get_woocommerce_currency_symbol()
    );
}
function aloxo_add_to_cart_success_ajax( $count_cat_product ) {
    global $woocommerce;
    list( $cart_items ) = aloxo_get_current_cart_info();
    if ( $cart_items > 0 ) {
        $cart_items = $cart_items . __( '', 'aloxo' );
    } else {
        $cart_items = '0' . __( '', 'aloxo' );
    }
    $cat_total                                                  = $woocommerce->cart->get_cart_subtotal();
    $count_cat_product['#header-mini-cart #cart-items-number']  = '<span id="cart-items-number">' . $cart_items . '</span>';
    $count_cat_product['#header-mini-cart #cart-total .amount'] = $cat_total;

    return $count_cat_product;
}
add_filter( 'add_to_cart_fragments', 'aloxo_add_to_cart_success_ajax' );


// Override WooCommerce Widgets
add_action('widgets_init', 'override_woocommerce_widgets', 15);
function override_woocommerce_widgets() {
    if (class_exists('WC_Widget_Cart')) {
        unregister_widget('WC_Widget_Cart');
        include_once( 'widgets/class-wc-widget-cart.php' );
        register_widget('Custom_WC_Widget_Cart');
    }
    if ( class_exists( 'WC_Widget_Price_Filter' ) ) {
        unregister_widget( 'WC_Widget_Price_Filter' );
        include_once( 'widgets/class-wc-widget-price-filter.php' );
        register_widget( 'Custom_WC_Widget_Price_Filter' );
    }

    if ( class_exists( 'WC_Widget_Product_Categories' ) ) {
        unregister_widget( 'WC_Widget_Product_Categories' );
        include_once( 'widgets/class-wc-widget-product-categories.php' );
        register_widget( 'Custom_WC_Widget_Product_Categories' );
    }
}


/* Share Product */
add_action( 'woocommerce_share', 'wooshare' );

function wooshare() {
    global $post, $theme_options_data;

    echo '<div class="social_link style-02">';
        if ( isset ( $theme_options_data['thim_sharing_facebook'] ) && $theme_options_data['thim_sharing_facebook'] == 1 ) {
            echo '<li><a class="face" title="Share on Facebook." href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='. get_the_title().'"><i class="fa fa-facebook-square"></i></a></li>';
        }
        if ( isset ( $theme_options_data['thim_sharing_twitter'] ) && $theme_options_data['thim_sharing_twitter'] == 1 ) {
            echo '<li><a class="twitter" title="Tweet this!" href="http://twitter.com/home/?status='.get_the_title().' - ' .get_the_permalink(). '"><i class="fa fa-twitter"></i></a></li>';
        }
        if ( isset ( $theme_options_data['thim_sharing_pinterest'] ) && $theme_options_data['thim_sharing_pinterest'] == 1 ) {
            $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            echo '<li><a class="pinterest" href="http://pinterest.com/pin/create/button/?url='. get_the_permalink().'&media='. $url .'"><i class="fa fa-pinterest"></i></a></li>';
        }
        if ( isset ( $theme_options_data['thim_sharing_google'] ) && $theme_options_data['thim_sharing_google'] == 1 ) {
            echo '<li><a class="google" href="https://plus.google.com/share?url='. get_the_permalink().'" onclick="javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;"><i class="fa fa-google-plus"></i></a></li>';
        }
    echo '</div>';
    ?>
<?php
}

// Change the breadcrumb separator
add_filter( 'woocommerce_breadcrumb_defaults', 'aloxo_change_breadcrumb_delimiter' );
function aloxo_change_breadcrumb_delimiter( $defaults ) {
    if (is_singular('product')) {
		$defaults['delimiter'] = ' &bull; ';
		return $defaults;
	} else {
        // Change the breadcrumb delimeter from '/' to ' . '
        $defaults['delimiter'] = ' &bull; ';
        return $defaults;
    }
}


// paging number
global $theme_options_data;
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$theme_options_data['thim_woo_product_per_page'].';' ), 20 );

/* Product Search */
function aloxo_product_search_callback() {
    $search_keyword = $_REQUEST['keyword'];
    $cate = $_REQUEST['cate'];

    if ($cate && $cate != "-1") {
        $category = explode( ',', $cate );
    }else $category = "";

    $data = array();
    $data['success'] = true;

    global $woocommerce;

    $ordering_args = $woocommerce->query->get_catalog_ordering_args( 'title', 'asc' );
    $products = array();

    $args = array(
        's'                     => $search_keyword,
        'post_type'             => 'product',
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => 1,
        'orderby'               => $ordering_args['orderby'],
        'order'                 => $ordering_args['order'],
        'posts_per_page'        => -1,
        'meta_query'            => array(
            array(
                'key'           => '_visibility',
                'value'         => array('catalog', 'visible'),
                'compare'       => 'IN'
            )
        )
    );

    if( isset( $category) && $category ){
        $args['tax_query'] = array(
            //'relation' => 'AND',
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category
            ));
    }

    $products_query = new WP_Query( $args );
    if ( $products_query->have_posts() ) {
        while ( $products_query->have_posts() ) {
            $products_query->the_post();

            //display product thumbnail
            if (has_post_thumbnail()) { 
                $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'thumbnail' ); 
                $thumb = '<img src="' . $image_src[0] . '" width="140" alt="" />';
            }
            else {
                $thumb = '<img src="/images/defaul_image.jpg" width="140" alt=" />';
            }
            //add this code bellow, inside loop
            ob_start();
                woocommerce_get_template( 'loop/price.php' );
            $price = ob_get_clean();

            ob_start();
                woocommerce_get_template( 'loop/rating.php' );
            $rate = ob_get_clean();


            $products[] = array(
                'id' => get_the_ID(),
                'value' => get_the_title(),
                'url' => get_permalink(),
                'thumb'=> $thumb,
                'price'=> $price,
                'rate'=> $rate,
            );
        }
    } else {
        $products[] = array(
            'id' => -1,
            'value' => __('No results', 'yit'),
            'url' => ''
        );
    }
    wp_reset_postdata();

    echo json_encode( $products );
    die();
}
add_action( 'wp_ajax_nopriv_product_search', 'aloxo_product_search_callback' );
add_action( 'wp_ajax_product_search', 'aloxo_product_search_callback' );
/* End Product Search */


/* Woo Category Pagging */
add_action('wp_ajax_cate_paging', 'aloxo_ajax_cate_paging');
add_action('wp_ajax_nopriv_cate_paging', 'aloxo_ajax_cate_paging');

function aloxo_ajax_cate_paging() {
    global $theme_options_data;
    if (isset($_POST['off'])) {
        $off = $_POST['off'];
    } else {
        return;
    }
    if (isset($_POST['offset'])) {
        $offset = $_POST['offset'];
    } else {
        return;
    }
    if (isset($_POST['column'])) {
        $column = $_POST['column'];
    } else {
        return;
    }

    $arr = array();
    $arr['data'] = "";
    $taxonomy = "product_cat";
    $total = wp_count_terms( $taxonomy, array( 'hide_empty'=>false) );
    if ($total > $offset+$off)
        $arr['next_post'] = true;
    else
        $arr['next_post'] = false;

    $column = 6;
    $html = "";

    $terms = get_terms($taxonomy , array( 'offset' => $offset, 'hide_empty'=>false, 'number' => $off));
    if ( !empty( $terms ) && !is_wp_error( $terms ) ){
        foreach ( $terms as $term ) {

            $image          = '';
            $thumbnail_id   = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
            if ($thumbnail_id)
                $image = wp_get_attachment_thumb_url( $thumbnail_id );
            else
                $image = wc_placeholder_img_src();

            $html .= '<li class="col-1-'.$column.'"><a href="' . get_term_link( $term ) . '">';
            $html .= '<img src="' . esc_url( $image ) . '" />';

            $html .= $term->name . '</a></li>';
        }
        if ($total > $offset+$off) {
            $html .= '<li class="col-1-'.$column.'" style="text-align: center;"><a class="cate_btn_load_more" href="#" data-column = "'.$column.'" data-ori = "'.$off.'" data-ajax_url="'.admin_url( 'admin-ajax.php' ).'" data-offset="'.$offset+$off.'"><div class="dots" style=""><div class="dot"><span></span></div><div class="dot"><span></span></div><div class="dot"><span></span></div></div>More</a></li>';

        }

    }
    $arr['data'] = $html;
    wp_send_json($arr);
}
/* End Woo Category Pagging */

/* PRODUCT QUICK VIEW */
add_action( 'wp_head', 'lazy_ajax', 0, 0 );
function lazy_ajax() {
    ?>
    <script type="text/javascript">
        /* <![CDATA[ */
        var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
        /* ]]> */
    </script>
<?php
}
add_action( 'wp_ajax_jck_quickview', 'jck_quickview' );
add_action( 'wp_ajax_nopriv_jck_quickview', 'jck_quickview' );
/** The Quickview Ajax Output **/
function jck_quickview() {
    global $post, $product, $woocommerce;
    $prod_id = $_POST["product"];
    $post    = get_post( $prod_id );
    $product = get_product( $prod_id );
    // Get category permalink
    ob_start();
    ?>
    <?php woocommerce_get_template( 'content-single-product-lightbox.php' ); ?>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
    die();
}
/* End PRODUCT QUICK VIEW */

function woo_add_style_yith_compare(){
    $css_file = get_template_directory_uri() .'/css/yith_compare.css';
    echo '<link rel="stylesheet" type="text/css" media="all" href="'.esc_url($css_file).'" />'; 
}
if( isset($_GET['action'],$_GET['iframe']) && $_GET['action'] == 'yith-woocompare-view-table' && $_GET['iframe'] == "true" )
    add_action('wp_head','woo_add_style_yith_compare');
