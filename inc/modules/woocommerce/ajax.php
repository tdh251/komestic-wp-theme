<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Update Cart via AJAX
 */
add_action('wp_ajax_komestic_ajax_update_cart', 'komestic_ajax_update_cart');
add_action('wp_ajax_nopriv_komestic_ajax_update_cart', 'komestic_ajax_update_cart');
function komestic_ajax_update_cart() {
    if ( ! isset($_POST['product_id']) ) {
        return;
    }

    $product_id = intval($_POST['product_id']);
    $cart       = WC()->cart;
    $quantity   = intval($_POST['quantity'] ?? 1);

    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
        if ( $cart_item['product_id'] == $product_id ) {
            $cart->set_quantity( $cart_item_key, $quantity );
        }
    }
    WC_AJAX::get_refreshed_fragments();
}

/**
 * Empty Cart via AJAX
 */
add_action('wp_ajax_komestic_ajax_empty_cart', 'komestic_ajax_empty_cart');
add_action('wp_ajax_nopriv_komestic_ajax_empty_cart', 'komestic_ajax_empty_cart');
function komestic_ajax_empty_cart() {
    check_ajax_referer('komestic_nonce', 'security');

    if ( WC()->cart ) {
        WC()->cart->empty_cart();
    } 

    WC_AJAX::get_refreshed_fragments();
}

/**
 * Calc Fee Shipping via AJAX
 */
add_action( 'wp_ajax_komestic_ajax_calc_fee_shipping', 'komestic_ajax_calc_fee_shipping' );
add_action( 'wp_ajax_nopriv_komestic_ajax_calc_fee_shipping', 'komestic_ajax_calc_fee_shipping' );
function komestic_ajax_calc_fee_shipping() {
    check_ajax_referer( 'komestic-nonce', 'security' );

    $country  = sanitize_text_field( $_POST['country'] ?? '' );
    $state    = sanitize_text_field( $_POST['state'] ?? '' );
    $postcode = sanitize_text_field( $_POST['postcode'] ?? '' );
    $city     = sanitize_text_field( $_POST['city'] ?? '' );

    WC()->customer->set_shipping_country( $country );
    WC()->customer->set_shipping_state( $state );
    WC()->customer->set_shipping_postcode( $postcode );
    WC()->customer->set_shipping_city( $city );

    WC()->cart->calculate_totals();

    wp_send_json_success( [
        '.pxl-cart-total' => WC()->cart->get_total(),
        '.pxl-shipping-result' => komestic_get_shipping_cost_html(),
    ]);
}

/**
 * Change Currency via Ajax
 */
add_filter('woocommerce_currency', function($currency) {
    if (!empty($_COOKIE['_currency'])) {
        $currency = sanitize_text_field($_COOKIE['_currency']);
    }
    return $currency;
});
add_action( 'wp_ajax_komestic_ajax_update_currency', 'komestic_ajax_update_currency' );
add_action( 'wp_ajax_nopriv_komestic_ajax_update_currency', 'komestic_ajax_update_currency' );
function komestic_ajax_update_currency() {
    if (!empty($_POST['currency'])) {
        setcookie('_currency', sanitize_text_field($_POST['currency']), time() + 3600, '/');
        wp_send_json_success(['currency' => $_POST['currency']]);
    }
    wp_die();
}

/**
 * Ajax Update Note to Session
 */
add_action('wp_ajax_komestic_update_order_note_to_section', 'komestic_update_order_note_to_section');
add_action('wp_ajax_nopriv_komestic_update_order_note_to_section', 'komestic_update_order_note_to_section');
function komestic_update_order_note_to_section() {
    if (isset($_POST['note'])) {
        $note = sanitize_textarea_field($_POST['note']);
        WC()->session->set('komestic_order_note', $note);
        wp_send_json_success(['note' => $note]);
    }
    wp_die();
}


/**
 * Add multiple product to cart
 */
add_action('wp_ajax_komestic_add_multiple_to_cart', 'komestic_add_multiple_to_cart');
add_action('wp_ajax_nopriv_komestic_add_multiple_to_cart', 'komestic_add_multiple_to_cart');
function komestic_add_multiple_to_cart() {
    // check_ajax_referer('komestic_nonce', 'security');

    if ( empty($_POST['product_ids']) || ! is_array($_POST['product_ids']) ) {
        wp_send_json_error(['message' => 'No products found']);
    }

    $cart        = WC()->cart;
    $product_ids = array_map('intval', $_POST['product_ids']);
    $redirect    = '';

    foreach ($product_ids as $pid) {
        $product = wc_get_product($pid);

        if ( ! $product ) {
            continue;
        }

        if ( $product->is_type('variable') ) {
            $redirect = get_permalink($product_ids[0]);
            break;
        }

        $cart->add_to_cart($pid, 1);
    }

    if ( $redirect ) {
        wp_send_json_success([
            'redirect' => $redirect,
        ]);
    }

    WC_AJAX::get_refreshed_fragments();
}

/**
 * Wistlish empty
 */
function komestic_render_wishlist_empty_html(){
    ob_start();
    get_template_part('template-parts/woocommerce/wishlist-empty');
    return ob_get_clean();
}