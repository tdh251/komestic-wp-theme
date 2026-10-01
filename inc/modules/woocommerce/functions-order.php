<?php

/**
 * Get all order by user
 */
function komestic_get_all_order_by_user() {
    $current_user_id = get_current_user_id();
    $orders = wc_get_orders([
        'customer_id' => $current_user_id,
        'limit'       => -1, 
        'orderby'     => 'date',
        'order'       => 'DESC',
    ]);
    return $orders;
}

/**
 * Redirect Custom Order Suscess
 */
add_filter( 'woocommerce_get_return_url', function( $return_url, $order ) {
    $custom_url = home_url( '/my-order/' );

    $custom_url = add_query_arg( array(
        'order_id' => $order->get_id(),
        'order_key' => $order->get_order_key(),
    ), $custom_url );

    return $custom_url;
}, 10, 2 );


/**
 * Register shipped order status
 */
function komestic_register_shipped_order_status() {
    register_post_status( 'wc-shipped', array(
        'label'                     => 'Shipped',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Shipped <span class="count">(%s)</span>', 'Shipped <span class="count">(%s)</span>', 'komestic' )
    ) );
}
add_action( 'init', 'komestic_register_shipped_order_status' );

/**
 * Add shipped order status to dropdown order statuses
 */
function komestic_add_shipped_to_order_statuses( $order_statuses ) {
    $new_order_statuses = array();

    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-shipped'] = 'Shipped';
        }
    }
    return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'komestic_add_shipped_to_order_statuses' );

/**
 * Group order status to progress
 */
function komestic_order_status_group() {
    $status_group = [
        'confirmed' => [
            'statuses' => [
                'processing' => 'Confirmed',
                'pending'    => 'Pending Payment',
                'on-hold'    => 'Hold',
            ],
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none">
                    <path d="M19.1998 10.7584C18.7448 10.3029 18.0052 10.3029 17.5502 10.7584L12.5417 15.7664L10.4498 13.6751C9.99483 13.2195 9.25517 13.2195 8.80017 13.6751C8.34458 14.1307 8.34458 14.8692 8.80017 15.3248L11.7168 18.2414C11.9443 18.4695 12.243 18.5833 12.5417 18.5833C12.8403 18.5833 13.139 18.4695 13.3665 18.2414L19.1998 12.4081C19.6554 11.9525 19.6554 11.214 19.1998 10.7584Z" fill="white"/>
                    <path d="M26.8333 13.3264C26.1893 13.3264 25.6667 13.8522 25.6667 14.5C25.6667 20.9713 20.433 26.2361 14 26.2361C7.567 26.2361 2.33333 20.9713 2.33333 14.5C2.33333 8.02875 7.567 2.76396 14 2.76396C17.1319 2.76396 20.0719 3.99507 22.2792 6.23079C22.7325 6.69143 23.4716 6.69377 23.9289 6.23666C24.3862 5.78012 24.3886 5.03723 23.9347 4.57718C21.2864 1.89432 17.7578 0.416748 14 0.416748C6.28017 0.416748 0 6.73426 0 14.5C0 22.2658 6.28017 28.5833 14 28.5833C21.7198 28.5833 28 22.2658 28 14.5C28 13.8522 27.4773 13.3264 26.8333 13.3264Z" fill="white"/>
                    </svg>',
            'label' => 'Confirmed',
        ],
        'shipped' => [
            'statuses' => [
                'shipped'   => 'Shipped',
                'failed'    => 'Failed',
                'cancelled' => 'Cancelled',
                'refunded'  => 'Refunded',
            ],
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none">
                    <path d="M27.9945 7.40532C27.9618 7.10416 27.7747 6.83761 27.495 6.70707L14.37 0.582072C14.1354 0.472643 13.8645 0.472643 13.6299 0.582072L0.50493 6.70707C0.225258 6.83761 0.0381172 7.1041 0.00535937 7.40532C0.00464844 7.41161 0 7.49539 0 7.49999V22.375C0 22.7328 0.21782 23.0545 0.550047 23.1874L13.675 28.4374C13.7793 28.4791 13.8897 28.5 14 28.5C14.1103 28.5 14.2207 28.4792 14.325 28.4374L27.45 23.1874C27.7822 23.0545 28 22.7328 28 22.375V7.49999C28 7.49539 27.9952 7.41156 27.9945 7.40532ZM14 2.34055L24.9235 7.43819L20.7173 9.12071L9.58819 4.39942L14 2.34055ZM7.45445 5.39517L18.4109 10.0432L14 11.8076L3.0765 7.43819L7.45445 5.39517ZM1.75 8.79236L13.125 13.3424V26.3326L1.75 21.7826V8.79236ZM14.875 26.3326V13.3424L26.25 8.79236V21.7826L14.875 26.3326Z" fill="#FD5900"/>
                    </svg>',
            'label' => 'Shipped',
        ],
        'delivered' => [
            'statuses' => [
                'completed' => 'Delivered',
            ],
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="27" viewBox="0 0 22 27" fill="none">
                    <path d="M20.3658 6.32543C18.642 2.71168 15.0895 0.427929 11.0908 0.375429C7.08327 0.322929 3.53077 2.52793 1.74577 6.15043C-0.109227 9.90418 0.328273 14.2529 2.90077 17.5167L9.54202 25.9517C9.88327 26.3804 10.3908 26.6254 10.9333 26.6254C11.4758 26.6254 11.9833 26.3804 12.3245 25.9517L19.1408 17.2892C21.617 14.1392 22.0808 9.94793 20.3658 6.33418V6.32543ZM17.7758 16.2042L10.9245 24.8667L4.28327 16.4317C2.13952 13.7104 1.77202 10.0617 3.32077 6.92918C4.80827 3.91918 7.65202 2.13418 10.942 2.13418H11.0733C14.4508 2.18668 17.3383 4.03293 18.7908 7.08668C20.2433 10.1404 19.867 13.5442 17.7758 16.2042Z" fill="#FD5900"/>
                    <path d="M10.9333 5.76543C8.29952 5.76543 6.15577 7.90918 6.15577 10.5429C6.15577 13.1767 8.29952 15.3204 10.9333 15.3204C13.567 15.3204 15.7108 13.1767 15.7108 10.5429C15.7108 7.90918 13.567 5.76543 10.9333 5.76543ZM10.9333 13.5617C9.26202 13.5617 7.90577 12.2054 7.90577 10.5342C7.90577 8.86293 9.26202 7.50668 10.9333 7.50668C12.6045 7.50668 13.9608 8.86293 13.9608 10.5342C13.9608 12.2054 12.6045 13.5617 10.9333 13.5617Z" fill="#FD5900"/>
                    </svg>',
            'label' => 'Delivered'
        ],
    ];
    return $status_group;
}

/**
 * Get order shipping address
 */
function komestic_get_order_shipping_address($order) {
    $address_1 = $order->get_shipping_address_1();
    $address_2 = $order->get_shipping_address_2();
    $city      = $order->get_shipping_city();
    $state     = $order->get_shipping_state();
    $postcode  = $order->get_shipping_postcode();
    $country   = $order->get_shipping_country();

    $address_parts = array_filter([
        $address_1,
        $address_2,
        $city,
        $state,
        $postcode,
        $country
    ]);

    $formatted_address = implode(', ', $address_parts);

    return $formatted_address;
}

/**
 * Create short code get order shipping address
 */
function komestic_order_shipping_address_shortcode($atts) {
    $atts = shortcode_atts([
        'order_id' => 0,
    ], $atts, 'order_address');

    $atts['order_id'] = isset($_GET['order_id']) ? absint($_GET['order_id']) : 0;

    if (!$atts['order_id']) return '';

    $order = wc_get_order($atts['order_id']);
    if (!$order) return '';

    return komestic_get_order_shipping_address($order);
}
if(function_exists('pxl_register_shortcode')) {
    pxl_register_shortcode('order_shipping_address', 'komestic_order_shipping_address_shortcode');
}

/**
 * Get all info billing
 */
function komestic_get_order_billing($order) {
    if (!$order) return '';
    $fields = [
        trim($order->get_billing_first_name() . ' ' . $order->get_billing_last_name()),
        $order->get_billing_company(),
        trim($order->get_billing_address_1() . ', ' . $order->get_billing_address_2()),
        trim($order->get_billing_city() . ' ' . $order->get_billing_state()),
        $order->get_billing_country(),
        $order->get_billing_postcode(),
        $order->get_billing_email(),
        $order->get_billing_phone(),
    ];

    $fields = array_filter($fields);
    return implode('<br>', $fields);
}

/**
 * Get all info shipping
 */
function komestic_get_order_shipping($order) {
    if (!$order) return '';

    $fields = [
        trim($order->get_shipping_first_name() . ' ' . $order->get_shipping_last_name()),
        $order->get_shipping_company(),
        trim($order->get_shipping_address_1() . ', ' . $order->get_shipping_address_2()),
        trim($order->get_shipping_city() . ', ' . $order->get_shipping_state()),
        $order->get_shipping_country(),
        $order->get_shipping_postcode(),
        $order->get_shipping_phone(), 
    ];

    $fields = array_filter($fields);

    return implode('<br>', $fields);
}

function komestic_get_order_column_value( $order, $key , $show_item_count = false) {
    if ( ! $order || ! is_a( $order, 'WC_Order' ) ) {
        return '';
    }

    switch ( $key ) {
        case 'id':
            return '#'.$order->get_id();

        case 'status':
            return wc_get_order_status_name( $order->get_status() );

        case 'date':
            $date = $order->get_date_created();
            return $date ? $date->date_i18n( get_option( 'date_format' ) ) : '';

        case 'total':
            $total_ouput = '<div><div class="price">'.$order->get_formatted_order_total().'</div>';
            if($show_item_count) {
                $total_ouput .= ' / '.$order->get_item_count(). ' items';
            }
            return $total_ouput.'</div>';
        case 'payment-method':
            return $order->get_payment_method_title();

        case 'action':
            return sprintf(
                '<a href="%s" class="pxl-button button-view-order">%s</a>',
                esc_url( home_url('/my-order/?order_id='.$order->get_id()) ),
                '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="20" viewBox="0 0 32 20">
                    <path d="M16 0.462402C9.88606 0.462402 4.34162 3.8074 0.250384 9.24056C-0.0834612 9.68568 -0.0834612 10.3076 0.250384 10.7527C4.34162 16.1924 9.88606 19.5374 16 19.5374C22.1139 19.5374 27.6584 16.1924 31.7496 10.7592C32.0835 10.3141 32.0835 9.69223 31.7496 9.2471C27.6584 3.8074 22.1139 0.462402 16 0.462402ZM16.4386 16.7161C12.3801 16.9714 9.02854 13.6264 9.28383 9.56131C9.4933 6.20977 12.2099 3.49319 15.5614 3.28372C19.6199 3.02842 22.9715 6.37342 22.7162 10.4385C22.5002 13.7835 19.7836 16.5 16.4386 16.7161ZM16.2357 13.6133C14.0493 13.7507 12.2426 11.9506 12.3866 9.76423C12.4979 7.95754 13.9642 6.49779 15.7709 6.37996C17.9572 6.2425 19.7639 8.04264 19.6199 10.229C19.5021 12.0422 18.0358 13.502 16.2357 13.6133Z" fill="black"/>
                </svg>'
            );

        default:
            return '';
    }
}

/**
 * Get order subtotal
 */
function komestic_get_order_subtotal($order) {
    $gift_wrap = komestic_get_gift_package();
    if($gift_wrap['id'] !== 0) {
        return $order->get_subtotal() - $gift_wrap['price'];
    }
    return $order->get_subtotal();
}
