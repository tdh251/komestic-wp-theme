<?php

/**
 * Custom myaccount navigation 
 */
add_filter( 'woocommerce_account_menu_items', 'komestic_custom_account_nav', 9999 );
function komestic_custom_account_nav( $items ) {
    unset($items['downloads']); 
    unset($items['edit-account']); 
    unset($items['compare']); 
    $items = array(
        'dashboard'    => __( 'Dashboard', 'komestic' ),
        'orders'       => __( 'My Orders', 'komestic' ),
        'wishlist'     => __( 'My Wishlist', 'komestic' ),
        'edit-address' => __( 'Addresses', 'komestic' ),
        'customer-logout' => __( 'Log Out', 'komestic' ),
    );
    return $items;
}

/**
 * Redirect page hook custom
 */
add_filter( 'woocommerce_get_endpoint_url', function( $url, $endpoint, $value, $permalink ) {
    if ( $endpoint === 'wishlist' ) {
        $url = home_url( '/wishlist/' ); 
    }
    return $url;
}, 10, 4 );

/**
 * Get all billing info of current user
 */
function komestic_get_user_billing( $user_id = 0 ) {
    $user_id = $user_id ? $user_id : get_current_user_id();
    if ( ! $user_id ) return false;

    $fields = [
        trim( get_user_meta( $user_id, 'billing_first_name', true ) . ' ' . get_user_meta( $user_id, 'billing_last_name', true ) ),
        get_user_meta( $user_id, 'billing_company', true ),
        trim( get_user_meta( $user_id, 'billing_address_1', true ) . ' ' . get_user_meta( $user_id, 'billing_address_2', true ) ),
        trim( get_user_meta( $user_id, 'billing_city', true ) . ' ' . get_user_meta( $user_id, 'billing_state', true ) ),
        get_user_meta( $user_id, 'billing_country', true ),
        get_user_meta( $user_id, 'billing_postcode', true ),
        get_user_meta( $user_id, 'billing_email', true ),
        get_user_meta( $user_id, 'billing_phone', true ),
    ];

    $fields = array_filter( $fields );
    if ( empty( $fields ) ) {
        return 'No information yet!';
    }

    return implode( '<br>', $fields );
}


/**
 * Get all shipping info of current user
 */
function komestic_get_user_shipping( $user_id = 0 ) {
    $user_id = $user_id ? $user_id : get_current_user_id();
    if ( ! $user_id ) return '';

    $fields = [
        trim( get_user_meta( $user_id, 'shipping_first_name', true ) . ' ' . get_user_meta( $user_id, 'shipping_last_name', true ) ),
        get_user_meta( $user_id, 'shipping_company', true ),
        trim( get_user_meta( $user_id, 'shipping_address_1', true ) . ' ' . get_user_meta( $user_id, 'shipping_address_2', true ) ),
        trim( get_user_meta( $user_id, 'shipping_city', true ) . ' ' . get_user_meta( $user_id, 'shipping_state', true ) ),
        get_user_meta( $user_id, 'shipping_country', true ),
        get_user_meta( $user_id, 'shipping_postcode', true ),
        get_user_meta( $user_id, 'shipping_phone', true ),
    ];

    $fields = array_filter( $fields );
    if ( empty( $fields ) ) {
        return 'No information yet!';
    }
    return implode( '<br>', $fields );
}

/**
 * Get template form address
 */
function komestic_edit_address( $load_address = 'billing' ) {
    $current_user = wp_get_current_user();
    $load_address = sanitize_key( $load_address );
    $country      = get_user_meta( get_current_user_id(), $load_address . '_country', true );

    if ( ! $country ) {
        $country = WC()->countries->get_base_country();
    }

    if ( 'billing' === $load_address ) {
        $allowed_countries = WC()->countries->get_allowed_countries();

        if ( ! array_key_exists( $country, $allowed_countries ) ) {
            $country = current( array_keys( $allowed_countries ) );
        }
    }

    if ( 'shipping' === $load_address ) {
        $allowed_countries = WC()->countries->get_shipping_countries();

        if ( ! array_key_exists( $country, $allowed_countries ) ) {
            $country = current( array_keys( $allowed_countries ) );
        }
    }

    $address = WC()->countries->get_address_fields( $country, $load_address . '_' );
    // Enqueue scripts.
    wp_enqueue_script( 'wc-country-select' );
    wp_enqueue_script( 'wc-address-i18n' );

    // Prepare values.
    foreach ( $address as $key => $field ) {

        $value = get_user_meta( get_current_user_id(), $key, true );

        if ( ! $value ) {
            switch ( $key ) {
                case 'billing_email':
                case 'shipping_email':
                    $value = $current_user->user_email;
                    break;
            }
        }

        $address[ $key ]['value'] = apply_filters( 'woocommerce_my_account_edit_address_field_value', $value, $key, $load_address );
    }

    wc_get_template(
        'myaccount/edit-address.php',
        array(
            'load_address' => $load_address,
            'address'      => apply_filters( 'komestic_wc_address_to_edit', $address, $load_address ),
        )
    );
}
