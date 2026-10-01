<?php

/**
 * Hook update order review fragment
 */
// add_filter('woocommerce_update_order_review_fragments', function($fragments) {
//     return $fragments;
// });

function komestic_wc_checkout_hook() {
	remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
}
add_action( 'init', 'komestic_wc_checkout_hook' );

add_filter( 'woocommerce_cart_needs_shipping_address', '__return_true' );

add_filter( 'woocommerce_checkout_fields', function( $fields ) {
    // First name
    $fields['billing']['billing_first_name']['label']       = __( 'First name', 'komestic' );
    $fields['billing']['billing_first_name']['placeholder'] = __( 'First name', 'komestic' );
    $fields['billing']['billing_first_name']['class']       = array( 'flex-w-50' );
    $fields['shipping']['shipping_first_name']['class']       = array( 'flex-w-50' );

    // Last name
    $fields['billing']['billing_last_name']['label']       = __( 'Last name', 'komestic' );
    $fields['billing']['billing_last_name']['placeholder'] = __( 'Last name', 'komestic' );
    $fields['billing']['billing_last_name']['class']       = array( 'flex-w-50' );
    $fields['shipping']['shipping_last_name']['class']       = array( 'flex-w-50' );

    // Country
    $fields['billing']['billing_country']['label']       = __( 'Country', 'komestic' );
    $fields['billing']['billing_country']['placeholder'] = __( 'Country', 'komestic' );
    $fields['billing']['billing_country']['class']       = array( 'flex-w-100' );
    $fields['shipping']['shipping_country']['class']       = array( 'flex-w-100' );

    // Address
    $fields['billing']['billing_address_1']['label']       = __( 'Address', 'komestic' );
    $fields['billing']['billing_address_1']['placeholder'] = __( 'Address', 'komestic' );
    $fields['billing']['billing_address_1']['class']       = array( 'flex-w-100' );
    $fields['shipping']['shipping_address_1']['class']       = array( 'flex-w-100' );

    // Apartment
    $fields['billing']['billing_address_2']['label']       = __( 'Apartment, suite, etc (optional)', 'komestic' );
    $fields['billing']['billing_address_2']['placeholder'] = __( 'Apartment, suite, etc (optional)', 'komestic' );
    $fields['billing']['billing_address_2']['required']    = false;
    $fields['billing']['billing_address_2']['class']       = array( 'flex-w-100' );
    $fields['shipping']['shipping_address_2']['class']       = array( 'flex-w-100' );


    // City
    $fields['billing']['billing_city']['label']       = __( 'City', 'komestic' );
    $fields['billing']['billing_city']['placeholder'] = __( 'City', 'komestic' );
    $fields['billing']['billing_city']['class']       = array( 'flex-w-33' );
    $fields['billing']['billing_city']['priority']    = 70;

    $fields['shipping']['shipping_city']['class']       = array( 'flex-w-33' );
    $fields['shipping']['shipping_city']['priority']    = 70;

    // State
    $fields['billing']['billing_state']['label']       = __( 'State', 'komestic' );
    $fields['billing']['billing_state']['placeholder'] = __( 'State', 'komestic' );
    $fields['billing']['billing_state']['class']       = array( 'flex-w-33' );
    $fields['billing']['billing_city']['priority']    = 71;

    $fields['shipping']['shipping_state']['class']       = array( 'flex-w-33' );
    $fields['shipping']['shipping_city']['priority']    = 71;

    // Postcode
    $fields['billing']['billing_postcode']['label']       = __( 'Zipcode/Postal', 'komestic' );
    $fields['billing']['billing_postcode']['placeholder'] = __( 'Zipcode/Postal', 'komestic' );
    $fields['billing']['billing_postcode']['class']       = array( 'flex-w-33' );
    $fields['billing']['billing_city']['priority']    = 72;

    $fields['shipping']['shipping_postcode']['class']       = array( 'flex-w-33' );
    $fields['shipping']['shipping_city']['priority']    = 72;

    // Phone
    $fields['billing']['billing_phone']['label']       = __( 'Phone', 'komestic' );
    $fields['billing']['billing_phone']['placeholder'] = __( 'Phone', 'komestic' );
    $fields['billing']['billing_phone']['class']       = array( 'flex-w-100' );

    unset($fields['billing']['billing_email']);
    return $fields;
});

/**
 * Covert data shipping to billing
 */
add_filter( 'default_checkout_billing_country', function( $country ) {
    $customer = WC()->customer;
    return $customer->get_shipping_country() ?: $country;
});
add_filter( 'default_checkout_billing_state', function( $state ) {
    $customer = WC()->customer;
    return $customer->get_shipping_state() ?: $state;
});
add_filter( 'default_checkout_billing_city', function( $city ) {
    $customer = WC()->customer;
    return $customer->get_shipping_city() ?: $city;
});
add_filter( 'default_checkout_billing_postcode', function( $postcode ) {
    $customer = WC()->customer;
    return $customer->get_shipping_postcode() ?: $postcode;
});

/**
 * Disable order button and custom order button
 */
add_filter('woocommerce_order_button_html', '__return_false');
add_action('woocommerce_review_order_after_order_total','custom_place_order_button_html');
function custom_place_order_button_html() {
    $custom_button = '<button type="submit" class="pxl-button button--primary alt button--place-order" name="woocommerce_checkout_place_order" id="place_order" value="Place order">
		<span class="button__text">
			'.esc_html__('Place Order', 'komestic').'
		</span>
    </button>';
    pxl_print_html($custom_button);
}

/**
 * Custom display shipping cost
 */
add_filter( 'woocommerce_cart_shipping_method_full_label', 'komestic_custom_shipping_label', 10, 2 );
function komestic_custom_shipping_label( $label, $method ) {
    $cost = '';

    if ( $method->cost > 0 ) {
        $cost = ' ' . wc_price( $method->cost ); 
    } else {
        $cost = ' ' . wc_price( 0 );
    }
    return esc_html( $method->get_label() ) . $cost;
}

/**
 * Set terms and condition default true
 */
add_filter( 'woocommerce_terms_is_checked_default', '__return_true' );




