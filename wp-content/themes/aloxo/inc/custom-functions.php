<?php
global $theme_options_data;

function aloxo_hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);
    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = array($r, $g, $b);

    return $rgb; // returns an array with the rgb values
}

function aloxo_getExtraClass($el_class) {
    $output = '';
    if ($el_class != '') {
        $output = " " . str_replace(".", "", $el_class);
    }

    return $output;
}

function aloxo_getCSSAnimation($css_animation) {
    $output = '';
    if ($css_animation != '') {
        wp_enqueue_script('waypoints');
        $output = ' wpb_animate_when_almost_visible wpb_' . $css_animation;
    }
    return $output;
}

function aloxo_getCSSAnimation_woocommerce($css_animation) {
    $output = '';
    if ($css_animation != '') {
        wp_enqueue_script('waypoints');
        $output = ' aloxo_' . $css_animation;
    }

    return $output;
}

function aloxo_buildStyle($bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '') {
    $has_image = false;
    $style = '';
    if ((int) $bg_image > 0 && ( $image_url = wp_get_attachment_url($bg_image, 'large') ) !== false) {
        $has_image = true;
        $style .= "background-image: url(" . $image_url . ");";
    }
    if (!empty($bg_color)) {
        $style .= vc_get_css_color('background-color', $bg_color);
    }
    if (!empty($bg_image_repeat) && $has_image) {
        if ($bg_image_repeat === 'cover') {
            $style .= "background-repeat:no-repeat;background-size: cover;";
        } elseif ($bg_image_repeat === 'contain') {
            $style .= "background-repeat:no-repeat;background-size: contain;";
        } elseif ($bg_image_repeat === 'no-repeat') {
            $style .= 'background-repeat: no-repeat;';
        }
    }
    if (!empty($font_color)) {
        $style .= vc_get_css_color('color', $font_color);
    }
    if ($padding != '') {
        $style .= 'padding: ' . ( preg_match('/(px|em|\%|pt|cm)$/', $padding) ? $padding : $padding . 'px' ) . ';';
    }
    if ($margin_bottom != '') {
        $style .= 'margin-bottom: ' . ( preg_match('/(px|em|\%|pt|cm)$/', $margin_bottom) ? $margin_bottom : $margin_bottom . 'px' ) . ';';
    }

    return empty($style) ? $style : ' style="' . $style . '"';
}

function aloxo_excerpt($limit) {
    $content = get_the_excerpt();
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = explode(' ', $content, $limit);
    array_pop($content);
    $content = implode(" ", $content);
    return $content;
}

/* * ******************************************************************
 * Breadcrumbs
 * ****************************************************************** */
function aloxo_breadcrumbs() {
    global $wp_query, $post;
    // Start the UL
    echo '<div class="woocommerce-breadcrumb breadcrumb" itemprop="breadcrumb"><ul class="ulbreadcrumbs">';
    echo '<li><a href="' . esc_url(home_url()) . '" class="home">' . __("Home", 'aloxo') . '</a></li>';
    if (is_category()) {
        $catTitle = single_cat_title("", false);
        $cat = get_cat_ID($catTitle);
        echo '<li>' . get_category_parents( $cat, true, "</li>" ).'';
    } elseif (is_archive() && !is_category()) {
        if (get_post_type() == "portfolio") {
            echo _e('<li>Portfolio</li>', 'aloxo');
        } elseif (get_post_type() == "download") {
            if ( is_tax( 'download_category' ) ) {
                    $current_term = $wp_query->get_queried_object();
                    $ancestors = array_reverse( get_ancestors( $current_term->term_id, 'download_category' ) );
                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'download_category' );
                        echo  '<li><a href="' . esc_url(get_term_link( $ancestor )) . '">' . esc_html( $ancestor->name ) . '</a></li>' ;
                    }
                    echo  '<li>'. esc_html( $current_term->name ).'</li>';
            }else{
                echo _e('<li>Download</li>', 'aloxo');
            }
        }else {
            echo _e('<li>Archive</li>', 'aloxo');
        }
    } elseif (is_search()) {
        echo _e('<li>Search Result</li>', 'aloxo');
    } elseif (is_404()) {
        echo _e('<li>404 Not Found</li>', 'aloxo');
    } elseif (is_single($post)) {
        if (get_post_type() == 'post') {
            $category = get_the_category();
            $category_id = get_cat_ID($category[0]->cat_name);
            echo '<li>' . get_category_parents($category_id, TRUE, " </li>");
            echo '<li>'.the_title('', '', FALSE).'</li>';
        } else {
            echo '<li> ' . get_post_type().'</li>';
            echo '<li> ' . get_the_title().'</li>';
        }
    } elseif (is_page()) {
        $post = $wp_query->get_queried_object();

        if ($post->post_parent == 0) {

            echo "<li><a href='#'>" . the_title('', '', FALSE) . "</a></li>";
        } else {
            $ancestors = array_reverse(get_post_ancestors($post->ID));
            array_push($ancestors, $post->ID);

            foreach ($ancestors as $ancestor) {
                if ($ancestor != end($ancestors)) {
                    echo '<li><a href="' . get_permalink($ancestor) . '">' . strip_tags(apply_filters('single_post_title', get_the_title($ancestor))) . '</a></li>';
                } else {
                    echo '<li> ' . strip_tags(apply_filters('single_post_title', get_the_title($ancestor))).'</li>';
                }
            }
        }
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        if ($parent->post_type == 'page' || $parent->post_type == 'post') {
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, true, ' ');
        }

        echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
        echo get_the_title();
    }
    // End the UL
    echo "</ul></div>";
}


function aloxo_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class('description_comment') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
        <div id="div-comment-<?php comment_ID() ?>">
    <?php endif; ?>
        <div class="des_blog">
            <div class="avatar"><?php
    if ($args['avatar_size'] != 0) {
        echo get_avatar($comment, $args['avatar_size']);
    }
    ?></div>
            <div class="comment_content">
                <div class="comment-author meta">
                 <?php printf(__('<strong>%s</strong>','aloxo'), get_comment_author_link()) ?>
                    <?php if ($comment->comment_approved == '0') : ?>
                        <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'aloxo') ?></em>
                    <?php endif; ?>
                    <?php
                    printf(get_comment_date(), get_comment_time())
                    ?>
                    <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                    <?php edit_comment_link(__('Edit', 'aloxo'), '', ''); ?>
                </div>
                <div class="comment_text"><?php comment_text() ?></div>
            </div>
        </div>
    <?php if ('div' != $args['style']) : ?>
        </div>
        <?php endif; ?>
    <?php
}

// related
function aloxo_get_related_posts($post_id, $number_posts = -1) {
    $query = new WP_Query();
    $args = '';
    if ($number_posts == 0) {
        return $query;
    }
    $args = wp_parse_args($args, array(
        'posts_per_page' => $number_posts,
        'post__not_in' => array($post_id),
        'ignore_sticky_posts' => 0,
        'meta_key' => '_thumbnail_id',
        'category__in' => wp_get_post_categories($post_id)
    ));
    $query = new WP_Query($args);
    return $query;
}

function aloxo_ob_ajax_url() {
    echo '<script type="text/javascript">
        var aloxo_ob_ajax_url ="' . get_site_url() . '/wp-admin/admin-ajax.php";
        var export_url = "' . get_site_url() . '/wp-admin/options.php?page=export_settings";
        </script>';
}
add_action('wp_print_scripts', 'aloxo_ob_ajax_url');

/* Popup Login */
function aloxo_social_login_callback() {
    $html= '<div id="aloxo-popup-login-wrapper">
                <div class="aloxo-popup-login-bg"></div>
                <div class="aloxo-popup-login-container">
                    <div class="aloxo-popup-login-container-inner">
                        <div class="aloxo-popup-login">
                            <button class="aloxo-popup-login-close" type="button" title="Close (Esc)">&Chi;</button>
                            <div class="col-sm-6 left">
                                <h2>'.__("New Customer","aloxo").'</h2>
                                <div class="aloxo-popup-login-content">
                                    <p><b>'.__("Register Account","aloxo").'</b></p>
                                    <p>'.__("By creating an account you will be able to shop faster, be up to date on an order status, and keep track of the orders you have previously made.","aloxo").'</p>
                                    <a class="sc-btn darkblue" href="'.get_site_url().'/wp-login.php?action=register">'.__("Continue","aloxo").'</a>
                                </div>
    ';

    $html .= '</div>';

    $html .= '<div class="col-sm-6 right">
                <h2>'.__("Returning Customer","aloxo").'</h2>
                <form id="aloxo-popup-login-form">
                    <div class="aloxo-popup-login-content">
                        <p class="login-message">'.__("I am a returning customer","aloxo").'</p>
                        <p>
                        <label for="user_login">Username
                            <input id="user_login" type="text" name="username" required="required">
                        </label>
                        </p>

                        <label for="user_pass">Password
                            <input id="user_pass" type="password" name="password" required="required">
                        </label>


                        <label><input type="checkbox" name="remember"/> '.__("Remember password","aloxo").'</label>
                        <br>
                        <input type="hidden" name="action" value="aloxo_login_ajax"/>
                        <input type="submit" value="Log In" class="sc-btn aloxo-popup-login-button" id="wp-submit" name="submit">
                    </div>
                </form>
    ';
    $html .= '</div>';
    $html .= '<div style="clear: both"></div>';

    $html .= '</div>'; // aloxo-popup-login
    $html .= '</div>'; // aloxo-popup-login-container-inner
    $html .= '</div>'; // aloxo-popup-login-container
    $html .= '</div>'; // aloxo-popup-login-wrapper
    echo $html;
}

add_action( 'wp_ajax_nopriv_aloxo_social_login', 'aloxo_social_login_callback' );
add_action( 'wp_ajax_aloxo_social_login', 'aloxo_social_login_callback' );

function aloxo_login_ajax_callback() {
    ob_start();
    global $wpdb;

    //We shall SQL escape all inputs to avoid sql injection.
    $username = $wpdb->escape( $_REQUEST['username'] );
    $password = $wpdb->escape( $_REQUEST['password'] );
    $remember = $wpdb->escape( $_REQUEST['rememberme'] );

    if ( $remember ) {
        $remember = "true";
    } else {
        $remember = "false";
    }

    $login_data                  = array();
    $login_data['user_login']    = $username;
    $login_data['user_password'] = $password;
    $login_data['remember']      = $remember;
    $user_verify                 = wp_signon( $login_data, false );


    $code    = 1;
    $message = '';

    if ( is_wp_error( $user_verify ) ) {
        $message = $user_verify->get_error_message();
        $code    = - 1;
    } else {
        wp_set_current_user( $user_verify->ID, $username );
        do_action( 'set_current_user' );
        $message = '<script type="text/javascript">window.location=window.location;</script>';
    }

    $response_data = array(
        'code'    => $code,
        'message' => $message
    );

    ob_end_clean();
    echo json_encode( $response_data );
    die(); // this is required to return a proper result
}

add_action( 'wp_ajax_nopriv_aloxo_login_ajax', 'aloxo_login_ajax_callback' );
add_action( 'wp_ajax_aloxo_login_ajax', 'aloxo_login_ajax_callback' );

/* Change Login to Logout */
if ( !class_exists( 'aloxoLoginLogout' ) ) {
    class aloxoLoginLogout {
            public function aloxo_menu($objects) {
            /**
             * If user isn't logged in, we return the link as normal
             */
            if ( !is_user_logged_in() ) {
                return $objects;
            }
            /**
             * If they are logged in, we search through the objects for items with the
             * class wl-login-pop and we change the text and url into a logout link
             */
            foreach ( $objects as $k=>$object ) {
                if ( in_array( 'aloxo-link-login', $object->classes ) ) {
                    $objects[$k]->title = 'Logout';
                    $objects[$k]->url = wp_logout_url();
                    $remove_key = array_search( 'aloxo-link-login', $object->classes );
                    unset($objects[$k]->classes[$remove_key]);
                }
            }
            return $objects;
        }
    }
}
$aloxologinlogout = new aloxoLoginLogout;
add_filter('wp_nav_menu_objects', array($aloxologinlogout, 'aloxo_menu'), 10, 2);

/* Blog btn Paging */
add_action('wp_ajax_button_paging', 'aloxo_ajax_button_paging');
add_action('wp_ajax_nopriv_button_paging', 'aloxo_ajax_button_paging');

function aloxo_ajax_button_paging() {
    global $theme_options_data;
    if (isset($_POST['cat'])) {
        $cat = $_POST['cat'];
    } else {
        return;
    }
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
    } else {
        return;
    }

    if (isset($_POST['size'])) {
        $size = $_POST['size'];
    } else {
        return;
    }

    $default_posts_per_page = get_option('posts_per_page');
    if (isset($_POST['offset'])) {
        $offset = $_POST['offset'];
    } else {
        $offset = get_option('posts_per_page');
    }

    $select_style = $type;

    global $sidebar_thumb_size;
    $sidebar_thumb_size = $size;

    // The Query
    if ($cat == "all")
        query_posts("posts_per_page=$default_posts_per_page&offset=$offset&orderby=date");
    else
        query_posts("cat=$cat&posts_per_page=$default_posts_per_page&offset=$offset&orderby=date");

    $arr = array();
    $arr['data'] = "";
    $arr['offset'] = get_option( 'posts_per_page' );

    if ($cat == "all") {
        $post_count = wp_count_posts()->publish;
    }else {
        $cate = get_category($cat);
        $post_count = $cate->category_count;

    }

    if ($post_count <= ($offset + get_option( 'posts_per_page' )))
        $arr['next_post'] = false;
    else
        $arr['next_post'] = true;

    ob_start();
    // The Loop
    while (have_posts()) : the_post();
        if ( $select_style == 'masonry' ) {
            get_template_part( 'content', 'grid' );
        } else {
            get_template_part( 'content' );
        }
    endwhile;
    $arr['data'] .= ob_get_contents();
    ob_end_clean();

    // Reset Query
    wp_reset_query();

    wp_send_json($arr);
}
/* End Blog btn Paging */

//check if URL exists
function aloxo_url_exists($url){
    if (!$url) {
        return false;
    }else {
        $file_headers = @get_headers($url);
        if($file_headers[0] == 'HTTP/1.0 404 Not Found'){
            return false;
        } else if ($file_headers[0] == 'HTTP/1.0 302 Found' && $file_headers[7] == 'HTTP/1.0 404 Not Found'){
            return false;
        } else {
            return true;
        }
    }
}

/* Using Shortcode in Widget Text */
add_filter('widget_text', 'do_shortcode');

/* Remove placeholder in Search Form */
add_filter('get_search_form', 'aloxo_custom_search_form');
function aloxo_custom_search_form($text) {
     $text = str_replace('placeholder', 'data-placeholder', $text);
     return $text;
}

/* Onepage Menu */
add_filter( 'wp_nav_menu_args', 'aloxo_select_main_menu' );
function aloxo_select_main_menu( $args ) {
    global $post;
    if($post){
        if ( get_post_meta( $post->ID, 'select_menu_one_page', true ) != 'default' && ( $args['theme_location'] == 'primary' ) ) {
            $menu         = get_post_meta( $post->ID, 'select_menu_one_page', true );
            $args['menu'] = $menu;
        }
    }
    return $args;
}
/* End Onepage Menu */

/* EDD */
function aloxo_edd_cart_image( $item, $id ) {
    add_image_size( 'thumbnail_cart', 90, 90, true );
    $image = get_the_post_thumbnail( $id, 'thumbnail_cart' );
    $link  = get_the_permalink( $id );
    $item  = str_replace( '{item_link}', $link, $item );
    $item  = str_replace( '{item_image}', $image, $item );

    return $item;
}
add_filter( 'edd_cart_item', 'aloxo_edd_cart_image', 10, 2 );
/* End Edd */

function aloxo_random_cats($num, $string){
    $temp=get_the_category();
    $count=count($temp);// Getting the total number of categories the post is filed in.

    $cat_string = "";
    for($i=0;$i<$num&&$i<$count;$i++){
        if ($i%2) {
            $n = ($count-1-$i);
        }else $n = $i;

        //Formatting our output.
        $cat_string.='<a href="'.get_category_link( $temp[$n]->cat_ID  ).'">'.$temp[$n]->cat_name.'</a>';
        if($i!=$num-1&&$i+1<$count)
        //Adding a ',' if it's not the last category.
        //You can add your own separator here.
        $cat_string.=$string;
    }
    echo $cat_string;
}


/* Import/Export Customizer Setting */
if( !function_exists( 'thim_cusomizer_upload_settings' ) ) :
    function thim_cusomizer_upload_settings(){
        WP_Filesystem();
        global $wp_filesystem;
        $file_name = $_FILES['thim-customizer-settings-upload']['name'];
        $file_ext  = pathinfo($file_name, PATHINFO_EXTENSION);
        if ( $file_ext == 'json' ) {
            $encode_options = $wp_filesystem->get_contents( $_FILES['thim-customizer-settings-upload']['tmp_name'] );
            if( !empty($encode_options) ) {
                echo $encode_options;
                exit();
            }
        }
        exit('-1');
    }
endif;
add_action( 'wp_ajax_thim_cusomizer_upload_settings', 'thim_cusomizer_upload_settings' );
if( !function_exists( 'thim_ajax_get_attachment_url' ) ) :
    function thim_ajax_get_attachment_url(){
        check_ajax_referer('thim_customize_attachment', 'nonce');

        if ( ! isset( $_POST['attachment_id'] ) ) {
            exit();
        }

        $attachment_id = $_POST['attachment_id'];

        echo wp_get_attachment_url( $attachment_id );
        exit();
    }
endif;
add_action( 'wp_ajax_thim_ajax_get_attachment_url', 'thim_ajax_get_attachment_url' );
add_action( 'wp_ajax_nopriv_thim_ajax_get_attachment_url', 'thim_ajax_get_attachment_url' );
// Add Thim-Customizer Menu
function thim_add_customizer_menu() {
    add_submenu_page( 'options.php', '', '', 'edit_theme_options', 'export_settings', 'thim_customizer_export_theme_settings' );
}
add_action( 'admin_menu', 'thim_add_customizer_menu' );
/* End Import/Export Customizer Setting */

/* Blog Search */
/* The function that handles the AJAX request */
function result_search_callback() {
    ob_start();
    global $wpdb;
    $keyword = $_REQUEST['keyword'];

    if ( $keyword ) {
        $keyword      = strtoupper( $keyword );
        $ids          = $wpdb->get_col( "SELECT ID FROM $wpdb->posts WHERE UCASE(post_title) LIKE '%$keyword%' AND post_type='post' AND post_status='publish'" );
        $search_query = array(
            'post__in' => $ids,
            'order'    => 'DESC',
            'orderby'  => 'date',
        );

        $search = new WP_Query( $search_query );

        $newdata = array();
        foreach ( $search->posts as $post ) {
            $newdata[] = array(
                'id'    => $post->ID,
                'title' => $post->post_title,
                'guid'  => get_permalink( $post->ID ),
                'date'  => mysql2date( 'M d Y', $post->post_date )
            );
        }

        ob_end_clean();

        if ( count( $search->posts ) ) {
            echo json_encode( $newdata );
        } else {
            echo __( 'POST not found', 'aloxo' );
        }
    }
    die(); // this is required to return a proper result
}

add_action( 'wp_ajax_nopriv_result_search', 'result_search_callback' );
add_action( 'wp_ajax_result_search', 'result_search_callback' );
/* End Blog Search */

// bbPress
function use_bbpress() {
    if (function_exists( 'is_bbpress' )) {
        return is_bbpress();
    } else {
        return false;
    }
}