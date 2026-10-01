<?php
/**
 * Remove position Button Compare 
 */
add_filter( 'woosc_button_position_archive', '__return_false' );
add_filter( 'woosc_button_position_single', '__return_false' );



/**
 * WPC Smart Wishlist for WooCommerce
 */
add_filter( 'woosw_button_position_archive', '__return_false' );
add_filter( 'woosw_button_position_single', '__return_false' );
add_filter( 'woosw_button_html', 'komestic_custom_woosw_button_class', 10, 3 );
function komestic_custom_woosw_button_class( $output, $product_id, $attrs) {
    $custom_class = 'pxl-button button--shop-action button--wishlist'; 
    $output = preg_replace(
        '/class=["\']([^"\']+)["\']/',
        'class="$1 ' . esc_attr( $custom_class ) . '"',
        $output,
        1 
    );
    return $output;
}

function komestic_get_wishlist_count() {
    $count = 0;
    if ( function_exists( 'woosw_get_items' ) ) {
        $wishlist = woosw_get_items();
        $count = is_array( $wishlist ) ? count( $wishlist ) : 0;
    }
    return $count;
}

/**
 * WPC Smart Quick View for WooCommerce
 */
add_filter( 'woosq_button_position', '__return_false');
// add_filter( 'woosq_button_class', 'komestic_custom_woosq_button_class', 10, 2 );
// function komestic_custom_woosq_button_class( $button_class, $attrs) {
//     $button_class .= ' pxl-button button--shop-action button--quickview';
//     return $button_class;
// }

/**
 * WPC Smart Compare for WooCommerce
 */
add_filter( 'woosc_button_position_archive', '__return_false' );
add_filter( 'woosc_button_position_single', '__return_false' );
add_filter( 'woosc_button_class', 'komestic_custom_woosc_button_class', 10, 2 );
function komestic_custom_woosc_button_class( $button_class, $attrs) {
    $button_class .= ' pxl-button button--shop-action button--compare';
    return $button_class;
}
add_action( 'init', function() {
    if ( class_exists( 'WPCleverWoosc' ) ) {
        $woosc = WPCleverWoosc::instance();
        remove_action( 'wp_footer', [ $woosc, 'footer' ] );
    }
}, 20);

/**
 * WPC Buy Now Button for WooCommerce
 */
add_filter( 'wpcbn_btn_single_class', function( $class, $attrs ) {
    $class .= ' pxl-button button--primary';
    return $class;
}, 10, 2 );


add_filter( 'wpcbn_btn_single_text', 'change_wpcbn_button_text' );
function change_wpcbn_button_text( $btn_text ) {
    return 'Buy It Now';
}

/**
 * WPC Variation Swatches for WooCommerce
 */
add_filter( 'woocommerce_available_variation', 'custom_variation_price_html', 10, 3 );
function custom_variation_price_html( $variation_data, $product, $variation ) {
    $regular_price = wc_get_price_to_display( $variation, array( 'price' => $variation->get_regular_price() ) );
    $sale_price = wc_get_price_to_display( $variation, array( 'price' => $variation->get_sale_price() ) );
    $sale_label_html = komestic_display_sale_percentage_label_html($variation, '', '% OFF');


    if(!is_singular('product')) {
        if ( $variation->is_on_sale() ) {
            $price_html = '<span class="price--old">' . wc_price( $regular_price ) . '</span>'.
                        '<span class="price--sale">' . wc_price( $sale_price ) . '</span>';
        } else {
            $price_html = '<span class="price--normal">' . wc_price( $regular_price ) . '</span>';
        }
    }else {
        if ( $variation->is_on_sale() ) {
            $price_html = '<span class="price--sale">' . wc_price( $sale_price ) . '</span>'.
                            '<span class="price--old">' . wc_price( $regular_price ) . '</span>'.
                            $sale_label_html;
        } else {
            $price_html = '<span class="price--normal">' . wc_price( $regular_price ) . '</span>';
        }
    }
    $variation_data['price_html'] = $price_html;
    return $variation_data;
}

add_filter( 'wpcvs_term_image_id', function( $image_id, $term_id, $attribute, $product ){
    if ( $product && $product->is_type('variable') ) {
        $variations = $product->get_children();
        foreach ( $variations as $variation_id ) {
            $variation = wc_get_product( $variation_id );
            if ( $variation && $variation->get_attribute( $attribute ) == $term_id ) {
                $variation_image_id = $variation->get_image_id();
                if ( $variation_image_id ) {
                    return $variation_image_id;
                }
            }
        }
    }
    return $image_id;
}, 10, 4 );


/**
 * WPC Frequently Bought Together for WooCommerce
 */
add_filter( 'woobt_product_types', function( $types ) {
    $types[] = 'variable';
    return $types;
});

add_filter('woobt_positions', '__return_false');

add_filter('woobt_image_size', function( $size ) {
    $size = 'woobt-thumb';
    return $size;
});

function custom_remove_wpc_bought_together() {
    if(class_exists('WPCleverWoobt')) {
        remove_action( 'woocommerce_before_add_to_cart_form', array( WPCleverWoobt::instance(), 'show_items_before_atc' ), 10 );
        remove_action( 'woocommerce_after_add_to_cart_form', array( WPCleverWoobt::instance(), 'show_items_after_atc' ), 10 );
        remove_action( 'woocommerce_before_add_to_cart_button', array( WPCleverWoobt::instance(), 'show_items_before_atc_button' ), 10 );
        remove_action( 'woocommerce_before_add_to_cart_button', array( WPCleverWoobt::instance(), 'show_items_after_atc_button' ), 10 );
        remove_action( 'woocommerce_single_product_summary', array( WPCleverWoobt::instance(), 'show_items_below_title' ), 6 );
        remove_action( 'woocommerce_single_product_summary', array( WPCleverWoobt::instance(), 'show_items_below_price' ), 11 );
        remove_action( 'woocommerce_single_product_summary', array( WPCleverWoobt::instance(), 'show_items_below_excerpt' ), 21 );
        remove_action( 'woocommerce_single_product_summary', array( WPCleverWoobt::instance(), 'show_items_below_meta' ), 41 );
        remove_action( 'woocommerce_after_single_product_summary', array( WPCleverWoobt::instance(), 'show_items_above_summary' ), 9 );
        remove_action( 'woocommerce_after_single_product_summary', array( WPCleverWoobt::instance(), 'show_items_below_summary' ), 21 );
    }
}
add_action( 'wp_loaded', 'custom_remove_wpc_bought_together', 100 );

/**
 * WPC Variations Radio Buttons
 */
add_action( 'init', function() {
    if(class_exists( 'WPClever_Woovr' )) {
        $woovr = WPClever_Woovr::instance(); 
        remove_action( 'woocommerce_before_variations_form', [ $woovr, 'before_variations_form' ] );
    }
});

