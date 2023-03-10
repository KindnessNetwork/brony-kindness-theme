<?php

define('BKN_THEME_VER', '1.5.10');

add_action('after_setup_theme', 'bkn_setup');
function bkn_setup() {
    load_theme_textdomain('bkn', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form'));
    add_theme_support('woocommerce');
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1920;
    }
    register_nav_menus(array('main-menu' => esc_html__('Main Menu', 'bkn')));
    register_nav_menus(array('footer-menu' => esc_html__('Footer Menu', 'bkn')));
}

add_action('wp_enqueue_scripts', 'bkn_load_scripts');
function bkn_load_scripts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Poppins:ital,wght@0,400;0,700;1,400;1,700&display=swap', [], null);
    //wp_enqueue_style('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', [], null);
    wp_enqueue_style('bkn-style', get_stylesheet_uri(), [], BKN_THEME_VER);

    wp_deregister_script('jquery');
    wp_deregister_script('jquery-core');
//    wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js', [], null);
    wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', [], null);
    wp_register_script('jquery-core', get_template_directory_uri() . '/js/dummy.js', [], null);
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-core');

//    wp_register_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', ['jquery'], null);
//    wp_enqueue_script('slick');

    wp_register_script('fontawesome', 'https://kit.fontawesome.com/fb8754480c.js', ['jquery']);
    wp_enqueue_script('fontawesome');
    wp_deregister_style('vc_font_awesome_5'); // We have our own. Let's replace it.
    wp_register_style('vc_font_awesome_5', get_template_directory_uri() . '/css/dummy.css', [], null);

    wp_register_script('bkn-scripts', get_template_directory_uri() . '/js/global.js', ['jquery'], BKN_THEME_VER);
    wp_enqueue_script('bkn-scripts');
}

add_action('wp_footer', 'bkn_footer_scripts');
function bkn_footer_scripts() {
    ?>
    <script>
        jQuery(document).ready(function ($) {
            let deviceAgent = navigator.userAgent.toLowerCase();
            if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
                $("html").addClass(["ios", "mobile"]);
            }
            if (navigator.userAgent.search("MSIE") >= 0) {
                $("html").addClass("ie");
            } else if (navigator.userAgent.search("Chrome") >= 0) {
                $("html").addClass("chrome");
            } else if (navigator.userAgent.search("Firefox") >= 0) {
                $("html").addClass("firefox");
            } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
                $("html").addClass("safari");
            } else if (navigator.userAgent.search("Opera") >= 0) {
                $("html").addClass("opera");
            }
        });
    </script>
    <?php
}

add_filter('document_title_separator', 'bkn_document_title_separator');
function bkn_document_title_separator($sep) {
    $sep = '|';
    return $sep;
}

add_filter('the_title', 'bkn_title');
function bkn_title($title) {
    if ($title == '') {
        return '...';
    } else {
        return $title;
    }
}

add_filter('the_content_more_link', 'bkn_read_more_link');
function bkn_read_more_link() {
    if (!is_admin()) {
        global $post;
        if($post->post_type != 'event') {
            return '&hellip; <a href="' . esc_url(get_permalink()) . '" class="more-link">Read More <span class="far fa-chevron-right" aria-hidden="true"></span></a>';
        } else {
            return '&hellip;';
        }
    }
}

add_filter('excerpt_more', 'bkn_excerpt_read_more_link');
function bkn_excerpt_read_more_link($more) {
    if (!is_admin()) {
        global $post;
        if($post->post_type != 'event') {
            return '&hellip; <a href="' . esc_url(get_permalink($post->ID)) . '" class="more-link">Read More <span class="far fa-chevron-right" aria-hidden="true"></span></a>';
        } else {
            return '&hellip;';
        }
    }
}

add_filter('intermediate_image_sizes_advanced', 'bkn_image_insert_override');
function bkn_image_insert_override($sizes) {
    unset($sizes['medium_large']);
    return $sizes;
}

add_action('widgets_init', 'bkn_widgets_init');
function bkn_widgets_init() {
    register_sidebar(array(
        'name' => 'Footer Widget Area 1',
        'id' => 'footer-widget-area-1',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Footer Widget Area 2',
        'id' => 'footer-widget-area-2',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Footer Widget Area 3',
        'id' => 'footer-widget-area-3',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('wp_head', 'bkn_pingback_header');
function bkn_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s" />' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('comment_form_before', 'bkn_enqueue_comment_reply_script');
function bkn_enqueue_comment_reply_script() {
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

function bkn_custom_pings($comment) {
    ?><li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?></li><?php
}

add_filter('get_comments_number', 'bkn_comment_count', 0);
function bkn_comment_count($count) {
    if (!is_admin()) {
        global $id;
        $get_comments = get_comments('status=approve&post_id=' . $id);
        $comments_by_type = separate_comments($get_comments);
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}

add_filter('edit_post_link', 'bkn_edit_post_link', 10, 3);
function bkn_edit_post_link($link, $post_id, $text) {
    return '';
//    if (strlen($link) <= 0) return $link;
//    return
//        '<a target="_blank" href="' . get_edit_post_link($post_id) . '">
//            <span class="screen-reader-text">(Edit this post)</span>
//            <span class="fa-stack" aria-hidden="true">
//                <span class="fas fa-circle fa-stack-2x"></span>
//                <span class="fas fa-pencil fa-stack-1x fa-inverse"></span>
//            </span>
//        </a>';
}

add_filter('comments_open', 'bkn_filter_media_comment_status', 10, 2);
function bkn_filter_media_comment_status($open, $post_id) {
    $post = get_post($post_id);
    if ($post->post_type == 'attachment') {
        return false;
    }
    return $open;
}

function bkn_button($button_url = '', $button_text = 'button', $button_class = 'primary') {
    echo bkn_get_button($button_url, $button_text, $button_class);
}

function bkn_get_button($button_url = '', $button_text = 'button', $button_class = 'primary'){
    if (empty($button_text)) return '';
    $button_attr = (!empty($button_url))? 'class="button ' . $button_class . '" href="' . $button_url . '"' : 'class="button disabled"';
    return '<a ' . $button_attr . ((strpos($button_url, 'http') !== false)? ' target="_blank" rel="noopener noreferrer"' : '') . '>' . $button_text . '</a>';
}

function bkn_social_button($button_url = '', $button_text = 'button', $button_type = 'none') {
    echo bkn_get_social_button($button_url, $button_text, $button_type);
}

function bkn_get_social_button($button_url = '', $button_text = 'button', $button_type = 'none'){
    switch($button_type) {
        case 'twitter':
            if ($button_text == null) $button_text = "Twitter";
            $button_text = '<span class="fab fa-twitter" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'facebook':
            if ($button_text == null) $button_text = "Facebook";
            $button_text = '<span class="fab fa-facebook-square" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'discord':
            if ($button_text == null) $button_text = "Discord";
            $button_text = '<span class="fab fa-discord" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'telegram':
            if ($button_text == null) $button_text = "Telegram";
            $button_text = '<span class="fab fa-telegram" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'youtube':
            if ($button_text == null) $button_text = "YouTube";
            $button_text = '<span class="fab fa-youtube" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'soundcloud':
            if ($button_text == null) $button_text = "Soundcloud";
            $button_text = '<span class="fab fa-soundcloud" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'mixcloud':
            if ($button_text == null) $button_text = "Mixcloud";
            $button_text = '<span class="fab fa-mixcloud" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'bandcamp':
            if ($button_text == null) $button_text = "Bandcamp";
            $button_text = '<span class="fab fa-bandcamp" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'website':
            if ($button_text == null) $button_text = "Website";
            $button_text = '<span class="far fa-globe" aria-hidden="true"></span> ' . $button_text;
            break;
    }
    return bkn_get_button($button_url, $button_text, $button_type);
}

function bkn_first_paragraph() {
    $first_paragraph_str = wpautop(get_the_content());
    $first_paragraph_str = substr($first_paragraph_str, 0, strpos($first_paragraph_str, '<!-- /wp:paragraph -->') + 4);
    $first_paragraph_str = strip_tags($first_paragraph_str, '<i><b><strong><em>');
    return '<p>' . $first_paragraph_str . '</p>';
}

function woocommerce_template_loop_product_thumbnail() {
    echo '<div class="product-loop-image-wrapper">' . woocommerce_get_product_thumbnail() . '</div>';
}

// Remove company name from checkout
add_filter('woocommerce_checkout_fields', 'bkn_remove_company_name');
function bkn_remove_company_name($fields) {
    unset($fields['billing']['billing_company']);
    return $fields;
}

add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3);
function wrap_embed_with_div($html, $url, $attr) {
    return '<div class="video-container">' . $html . '</div>';
}

//add_action('woocommerce_before_customer_login_form', 'bkn_login_message');
//function bkn_login_message() {
//    if (get_option('woocommerce_enable_myaccount_registration') == 'yes') {
//
//    }
//}

// set billing phone optional
//add_filter('woocommerce_billing_fields', 'bkn_remove_billing_phone_field', 20, 1);
//function bkn_remove_billing_phone_field($fields) {
//    $fields ['billing_phone']['required'] = false;
//
////    $fields['billing_email']['class'] = array('form-row-wide');
////    unset($fields ['billing_phone']);
//    return $fields;
//}

// Set shipping phone optional
//add_filter('woocommerce_shipping_fields', 'bkn_remove_shipping_phone_field', 20, 1);
//function bkn_remove_shipping_phone_field($fields) {
//    $fields ['shipping_phone']['required'] = false;
//
////    unset($fields ['shipping_phone']);
//    return $fields;
//}

// Check if WooCommerce is activated
if (!function_exists('is_woocommerce_activated')) {
    function is_woocommerce_activated() {
        return class_exists('woocommerce');
    }
}

// Show shipping info
//add_action('woocommerce_admin_order_data_after_order_details', 'bkn_editable_order_meta_general');
//function bkn_editable_order_meta_general($order) {
////    ini_set('display_startup_errors', 1);
////    ini_set('display_errors', 1);
////    error_reporting(-1);
//    $html = '<br><hr><h2>Shipment Info</h2>';
//    try {
//        /** @var WC_Order $order */
//        $shipping_methods = $order->get_shipping_methods();
//	if(count($shipping_methods) <= 0) return;
//        $shipping_metas = array_values($shipping_methods)[0]->get_meta_data();
//        /** @var WC_Meta_Data $shipping_meta */
//        $html .= '<ul>';
//        foreach ($shipping_metas as $shipping_meta) {
//            $data = $shipping_meta->get_data();
//            $html .= "<li>" . $data['key'] . ': ';
//            if (gettype($data['value']) == "array") {
//                $html .= '<pre>' . print_r($data['value'], true) . '</pre>';
//            } else {
//                $html .=  $data['value'];
//            }
//            $html .=  "</li>";
//        }
//        $html .=  '</ul>';
//    } catch (Exception $e) {
//        $html .= 'An exception occurred. Please report this to LinuxPony.';
//    }
//    echo $html;
//}

// Kill redirect
function kill_404_redirect() {
    if (is_404()) {
        add_action('redirect_canonical','__return_false');
    }
}
add_action('template_redirect','kill_404_redirect',1);

function bkn_add_custom_box() {
    $screens = ['post', 'page', 'product'];
    foreach ($screens as $screen) {
        add_meta_box(
            'bkn_theme_options',                 // Unique ID
            'Theme Options',      // Box title
            'bkn_custom_box_html',  // Content callback, must be of type callable
            $screen                            // Post type
        );
    }
}
add_action( 'add_meta_boxes', 'bkn_add_custom_box' );

function bkn_custom_box_html($post) {
    $bkn_header_type = get_post_meta($post->ID, '_bkn_header_type', true) ?? '';
    $bkn_sr = get_post_meta($post->ID, '_bkn_sr', true) ?? '';
    $bkn_image = get_post_meta($post->ID, '_bkn_image', true) ?? '';
    ?>
    <label for="bkn_header_type">Post Header Type:</label>
    <br>
    <select name="bkn_header_type" id="bkn_header_type" class="postbox">
        <option value=""<?php selected($bkn_header_type, '', true); ?>>None</option>
        <?php if(class_exists("RevSlider")){ ?>
        <option value="sr"<?php selected($bkn_header_type, 'sr', true); ?>>Slider Revolution</option>
        <?php } ?>
        <option value="image"<?php selected($bkn_header_type, 'image', true); ?>>Image</option>
    </select>
    <div id="bkn-sr-wrapper">
    <?php
    if(class_exists("RevSlider")){
        $slider = new RevSlider();
        $objSliders = $slider->get_sliders();
        // CREATE OPTIONS FOR SLIDER SELECTBOX
        ?>
        <label for="bkn_sr">Slider Selection:</label>
        <br>
        <select name="bkn_sr" id="bkn_sr" class="postbox">
            <option value=""<?php selected($bkn_sr, '', true); ?>>(None)</option>
        <?php
        foreach($objSliders as $slider){ ?>
            <option value="<?php echo $slider->alias; ?>"
                <?php selected($bkn_sr, $slider->alias, true)?>>
                <?php echo $slider->title; ?>
            </option>
        <?php }
    } ?></select>
    </div>
    <div id="bkn-picture-wrapper">
    <label for="bkn_image">Image Selection:</label>
    <br>
    <input type="text" name="bkn_image" id="bkn_image" class="postbox" readonly="readonly" value="<?php echo $bkn_image ?>">
    <img id="bkn_image_preview" src="" height="25" style="width: auto;">
    <button id="bkn_image_picker">Choose...</button>
    </div>
    <script>
        let file_frame;
        jQuery(function ($){
            function bknMediaPicker(e) {
                e.preventDefault();
                let field = $('#bkn_image');

                // Uploading files
                let wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
                let set_to_post_id = field.val();

                // If the media frame already exists, reopen it.
                if (file_frame) {
                    // Set the post ID to what we want
                    file_frame.uploader.uploader.param('post_id', set_to_post_id);
                    // Open frame
                    file_frame.open();
                    return;
                } else {
                    // Set the wp.media post id so the uploader grabs the ID we want when initialised
                    wp.media.model.settings.post.id = set_to_post_id;
                }

                // Create the media frame.
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: 'Select a image to upload',
                    button: {
                        text: 'Use this image',
                    },
                    multiple: false	// Set to true to allow multiple files to be selected
                });

                // When an image is selected, run a callback.
                file_frame.on('select', function() {
                    // We set multiple to false so only get one image from the uploader
                    let attachment = file_frame.state().get('selection').first().toJSON();

                    // Do something with attachment.id and/or attachment.url here
                    $('#bkn_image_preview').attr('src', attachment.url);
                    field.val( attachment.id );

                    // Restore the main post ID
                    wp.media.model.settings.post.id = wp_media_post_id;
                });

                // Finally, open the modal
                file_frame.open();
            }
            function bknAdjustView(e) {
                if(e) e.preventDefault();
                $('#bkn-sr-wrapper, #bkn-picture-wrapper').hide();
                switch ($('#bkn_header_type').val()) {
                    case "sr":
                        $('#bkn-sr-wrapper').show();
                        break;
                    case "image":
                        $('#bkn-picture-wrapper').show();
                        break;
                    case "":
                    default:
                        break;
                }
            }
            function bknLoadImageAsync(attachment, target){
                if(!attachment || !target) return;
                if (!wp.media.attachment(attachment).get('url')) {
                    wp.media.attachment(attachment).fetch().then(function () {
                        $(target).attr('src', wp.media.attachment(attachment).get('url')).css( 'width', 'auto' );
                    });
                } else {
                    $(target).attr('src', wp.media.attachment(attachment).get('url')).css( 'width', 'auto' );
                }
            }
            $('#bkn_image_picker').on('click', bknMediaPicker);
            $('#bkn_header_type').on('change', bknAdjustView);
            bknLoadImageAsync($("#bkn_image").val(),"#bkn_image_preview");
            bknAdjustView();
        });
    </script>
    <?php
}

function bkn_save_postdata($post_id) {
    if (array_key_exists('bkn_header_type', $_POST)) {
        update_post_meta(
            $post_id,
            '_bkn_header_type',
            $_POST['bkn_header_type']
        );
    } else {
        delete_post_meta($post_id, '_bkn_header_type');
    }
    if (array_key_exists('bkn_sr', $_POST)) {
        update_post_meta(
            $post_id,
            '_bkn_sr',
            $_POST['bkn_sr']
        );
    } else {
        delete_post_meta($post_id, '_bkn_sr');
    }
    if (array_key_exists('bkn_image', $_POST)) {
        update_post_meta(
            $post_id,
            '_bkn_image',
            $_POST['bkn_image']
        );
    } else {
        delete_post_meta($post_id, '_bkn_image');
    }
}
add_action('save_post', 'bkn_save_postdata');

function bkn_do_slider_or_image($id = null) {
    $id = $id ?? get_post()->ID;
    $bkn_header_type = get_post_meta($id, '_bkn_header_type', true) ?? '';

    if($bkn_header_type == 'sr'){
        $bkn_sr = get_post_meta($id, '_bkn_sr', true) ?? '';
        echo do_shortcode('[rev_slider alias="' . $bkn_sr . '"][/rev_slider]');
    } else if ($bkn_header_type == 'image'){
        $bkn_image = get_post_meta($id, '_bkn_image', true) ?? '';
        echo '<img class="cover-image" src="' . wp_get_attachment_image_url($bkn_image, 'full', false) . '">';
        echo '<div class="cover-image-spacer"></div>';
    } else {
        echo '<div class="no-content-spacer"></div>';
    }
}

function bkn_has_webp_support() {
    return strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false;
}

function bkn_maybe_replace_webp($url) {
    if(bkn_has_webp_support()){
        return str_replace(['.jpg', '.jpeg', '.png', '.gif'], '.webp', $url);
    }
    return $url;
}

require_once 'current-post-type-widget.php';