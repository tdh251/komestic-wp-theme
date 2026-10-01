<?php
/**
 * Helpers functions for WooCommerce functionalities in the Komestic theme.
 *
 * @package Komestic_Theme
 * @subpackage WooCommerce
 */

/**
 * 
 */
function get_available_free_shipping_for_current_user() {
    $customer = WC()->customer;

    if ( ! $customer ) {
        $customer = new WC_Customer( get_current_user_id(), true );
    }

    $country  = $customer->get_shipping_country();
    $state    = $customer->get_shipping_state();
    $postcode = $customer->get_shipping_postcode();
    $city     = $customer->get_shipping_city();

    if ( empty( $country ) ) {
        $default_location = wc_get_customer_default_location();
        $country  = $default_location['country'];
        $state    = $default_location['state'];
    }

    $zone = WC_Shipping_Zones::get_zone_matching_package( array(
        'destination' => array(
            'country'  => $country,
            'state'    => $state,
            'postcode' => $postcode,
            'city'     => $city,
        ),
    ) );

    if ( ! $zone ) {
        return array();
    }

    $available_free_shipping = array();

    foreach ( $zone->get_shipping_methods( true ) as $method ) {
        if ( $method->id === 'free_shipping' && $method->enabled === 'yes' ) {
            $available_free_shipping = [
                'zone_id'          => $zone->get_id(),
                'zone_name'        => $zone->get_zone_name(),
                'title'            => $method->get_method_title(),
                'requires'         => $method->instance_settings['requires'] ?? '',
                'min_amount'       => $method->instance_settings['min_amount'] ?? 0,
                'ignore_discounts' => $method->instance_settings['ignore_discounts'] ?? 'no',
            ];
        }
    }
    return $available_free_shipping;
}

/**
 * Check Product in Cart
 */
function komestic_is_product_in_cart( $product_id ) {
    if ( ! WC()->cart ) {
        return false;
    }

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        if ( $cart_item['product_id'] == $product_id ) {
            return true; 
        }
    }
    return false;
}

/**
 * Get Gift Package Info
 */
function komestic_get_gift_package() {
    $gift_package = komestic()->get_theme_opt('gift_package', 0);
    $product    = wc_get_product( $gift_package );
    $arr = [
        'id' => 0,
        'price' => 0,
    ];
    if($product) {
        $arr = [
            'id' => $gift_package,
            'price' => (float) $product->get_regular_price() ?: 0,
        ];
    }
    return $arr;
}

/**
 * Get Cart Count
 */
function komestic_get_cart_count() {
    if ( ! WC()->cart ) {
        return 0;
    }
    $gift_package_id = komestic_get_gift_package()['id'];
    if( komestic_is_product_in_cart( $gift_package_id ) ) {
        return WC()->cart->get_cart_contents_count() - 1;
    }
    return WC()->cart->get_cart_contents_count();
}

/**
 * Get Shipping Cost HTML
 */
function komestic_get_shipping_cost_html() {
    WC()->cart->calculate_totals();
    $packages = WC()->shipping()->get_packages();

    // Mặc định chưa có shipping
    $shipping_cost_html = '<span class="pxl-shipping-result shipping-undefined">Shipping not available for your address.</span>';

    if ( ! empty( $packages[0]['rates'] ) ) {
        $first_rate = reset( $packages[0]['rates'] );
        $shipping_cost = $first_rate->cost;

        if ( ( isset( $first_rate->method_id ) && $first_rate->method_id === 'free_shipping' ) || $shipping_cost == 0 ) {
            $shipping_cost_html = '<span class="pxl-shipping-result shipping-cost">Free Shipping</span>';
        } else {
            $shipping_cost_html = '<span class="pxl-shipping-result shipping-cost">Standard at: '.wc_price( $shipping_cost ).' '.get_woocommerce_currency().'</span>';
        }
    }

    return $shipping_cost_html;
}

/**
 * Free Shipping Progress Bar Html
 */
function komestic_shipping_progress_bar_html() {
    $shipping_option = get_available_free_shipping_for_current_user();
    if ( empty( $shipping_option ) ) return '';

    $cart_total = WC()->cart->get_cart_contents_total();
    if ( $shipping_option['ignore_discounts'] == 'yes' ) {
        $cart_total = WC()->cart->get_subtotal();
    }
    $requires   = $shipping_option['requires'];
    $html = '';
    ob_start(); 
    if ( $requires === 'min_amount' || $requires === 'either' || $requires === 'both' ) {
        $min_amount = $shipping_option['min_amount'];
    
        $percent = ((float)$cart_total / (float)$min_amount) * 100;
        $percent = max(0, min(100, $percent)); 
        $bar_class = 'progress-bar__bar';
        if($percent == 0) {
            $bar_class .= ' bar--zero';
        }elseif($percent == 100) {
            $bar_class .= ' bar--full';
        }
        ?>
        <div class="pxl-shipping-progress-bar free-shipping--progress-bar progress-bar progress-bar--round">
            <div class="progress-bar__track">
                <div class="<?php echo esc_attr($bar_class); ?>" style="width: <?php echo esc_attr($percent.'%'); ?>">
                    <div class="progress-bar__icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.8171 10.7491L18.2161 7.22695C18.0834 6.93593 17.8698 6.68915 17.6009 6.51596C17.332 6.34277 17.019 6.25045 16.6991 6.25H13.7538V5C13.7535 4.66859 13.6216 4.35086 13.3873 4.11652C13.153 3.88217 12.8352 3.75036 12.5038 3.75H2.08714C1.75573 3.75036 1.438 3.88217 1.20365 4.11652C0.969312 4.35086 0.837499 4.66859 0.837137 5V10C0.836604 10.0551 0.846988 10.1097 0.867688 10.1607C0.888388 10.2117 0.918994 10.2581 0.957738 10.2972C0.996481 10.3364 1.04259 10.3674 1.09341 10.3886C1.14423 10.4098 1.19874 10.4207 1.2538 10.4207C1.30886 10.4207 1.36337 10.4098 1.41419 10.3886C1.465 10.3674 1.51111 10.3364 1.54986 10.2972C1.5886 10.2581 1.61921 10.2117 1.63991 10.1607C1.66061 10.1097 1.67099 10.0551 1.67046 10V5C1.67058 4.88953 1.71452 4.78362 1.79264 4.7055C1.87075 4.62738 1.97667 4.58344 2.08714 4.58332H12.5038C12.6143 4.58344 12.7202 4.62738 12.7983 4.7055C12.8764 4.78362 12.9204 4.88953 12.9205 5V11.6667C12.9203 11.7771 12.8764 11.883 12.7983 11.9611C12.7202 12.0392 12.6143 12.0832 12.5038 12.0833H7.50382C7.39401 12.0844 7.28906 12.1287 7.21179 12.2068C7.13452 12.2848 7.09117 12.3902 7.09117 12.5C7.09117 12.6098 7.13452 12.7152 7.21179 12.7932C7.28906 12.8712 7.39401 12.9156 7.50382 12.9166H12.5038C12.8352 12.9163 13.153 12.7845 13.3873 12.5501C13.6216 12.3158 13.7535 11.998 13.7538 11.6666V7.08332H16.6991C16.8591 7.08354 17.0156 7.12969 17.1501 7.21629C17.2846 7.30288 17.3914 7.42627 17.4578 7.5718L17.6146 7.91664H15.8372C15.6163 7.91686 15.4044 8.00473 15.2482 8.16096C15.0919 8.3172 15.004 8.52904 15.0038 8.75V10.4167C15.004 10.6376 15.0919 10.8495 15.2481 11.0057C15.4044 11.1619 15.6162 11.2498 15.8371 11.25H19.1106C19.1484 11.3667 19.1686 11.4883 19.1707 11.6109V13.3334C19.1705 13.4438 19.1265 13.5498 19.0484 13.6279C18.9702 13.706 18.8643 13.7499 18.7538 13.75H17.4617C17.3656 13.2795 17.11 12.8567 16.7381 12.553C16.3661 12.2493 15.9007 12.0834 15.4205 12.0834C14.9403 12.0834 14.4749 12.2493 14.1029 12.553C13.731 12.8567 13.4753 13.2795 13.3793 13.75H6.62839C6.53233 13.2795 6.2767 12.8567 5.90475 12.553C5.5328 12.2493 5.06736 12.0834 4.58718 12.0834C4.107 12.0834 3.64156 12.2493 3.2696 12.553C2.89765 12.8567 2.64202 13.2795 2.54597 13.75H2.08714C1.97667 13.7499 1.87077 13.7059 1.79266 13.6278C1.71455 13.5497 1.6706 13.4438 1.67046 13.3333V12.9167C1.78026 12.9156 1.88521 12.8712 1.96248 12.7932C2.03975 12.7152 2.0831 12.6098 2.0831 12.5C2.0831 12.3902 2.03975 12.2848 1.96248 12.2068C1.88521 12.1288 1.78026 12.0844 1.67046 12.0834H0.420458C0.310651 12.0844 0.205704 12.1288 0.128432 12.2068C0.0511606 12.2848 0.0078125 12.3902 0.0078125 12.5C0.0078125 12.6098 0.0511606 12.7152 0.128432 12.7932C0.205704 12.8712 0.310651 12.9156 0.420458 12.9167H0.837137V13.3334C0.837499 13.6648 0.969312 13.9825 1.20365 14.2168C1.438 14.4512 1.75573 14.583 2.08714 14.5834H2.54593C2.64198 15.0538 2.89761 15.4767 3.26956 15.7804C3.64152 16.0841 4.10696 16.2499 4.58714 16.2499C5.06732 16.2499 5.53276 16.0841 5.90471 15.7804C6.27666 15.4767 6.53229 15.0538 6.62835 14.5834H13.3792C13.4753 15.0538 13.7309 15.4767 14.1029 15.7804C14.4748 16.0841 14.9403 16.2499 15.4205 16.2499C15.9006 16.2499 16.3661 16.0841 16.738 15.7804C17.11 15.4767 17.3656 15.0538 17.4617 14.5834H18.7538C19.0852 14.583 19.403 14.4512 19.6373 14.2168C19.8716 13.9825 20.0035 13.6648 20.0038 13.3334V11.6109C20.0043 11.3136 19.9406 11.0196 19.8171 10.7491ZM4.58714 15.4167C4.33991 15.4167 4.09824 15.3434 3.89267 15.206C3.68711 15.0687 3.5269 14.8734 3.43229 14.645C3.33768 14.4166 3.31292 14.1653 3.36116 13.9228C3.40939 13.6803 3.52844 13.4576 3.70325 13.2828C3.87807 13.108 4.1008 12.9889 4.34327 12.9407C4.58575 12.8925 4.83708 12.9172 5.06549 13.0118C5.2939 13.1064 5.48912 13.2667 5.62647 13.4722C5.76383 13.6778 5.83714 13.9195 5.83714 14.1667C5.83677 14.4981 5.70496 14.8158 5.47062 15.0502C5.23628 15.2845 4.91855 15.4163 4.58714 15.4167ZM15.4205 15.4167C15.1732 15.4167 14.9316 15.3434 14.726 15.206C14.5204 15.0687 14.3602 14.8734 14.2656 14.645C14.171 14.4166 14.1462 14.1653 14.1945 13.9228C14.2427 13.6803 14.3618 13.4576 14.5366 13.2828C14.7114 13.108 14.9341 12.9889 15.1766 12.9407C15.4191 12.8925 15.6704 12.9172 15.8988 13.0118C16.1272 13.1064 16.3224 13.2667 16.4598 13.4722C16.5971 13.6778 16.6705 13.9195 16.6705 14.1667C16.6701 14.4981 16.5383 14.8158 16.304 15.0501C16.0696 15.2845 15.7519 15.4163 15.4205 15.4167H15.4205ZM15.8371 8.75H17.9932L18.7507 10.4167H15.8371V8.75Z" fill="white"/>
                            <path d="M7.19795 7.70831C7.19761 7.43214 7.08775 7.16738 6.89247 6.9721C6.69719 6.77682 6.43244 6.66697 6.15627 6.66663H5.32295C5.21244 6.66663 5.10645 6.71053 5.02831 6.78867C4.95017 6.86681 4.90627 6.9728 4.90627 7.08331V9.58331C4.90574 9.63836 4.91612 9.69298 4.93682 9.744C4.95752 9.79502 4.98813 9.84143 5.02687 9.88055C5.06561 9.91967 5.11173 9.95072 5.16254 9.97191C5.21336 9.99311 5.26787 10.004 5.32293 10.004C5.37799 10.004 5.4325 9.99311 5.48332 9.97191C5.53413 9.95072 5.58025 9.91967 5.61899 9.88055C5.65773 9.84143 5.68834 9.79502 5.70904 9.744C5.72974 9.69298 5.74012 9.63836 5.73959 9.58331V9.08506L6.41576 9.85768C6.4516 9.89949 6.49538 9.93378 6.54455 9.95857C6.59373 9.98336 6.64733 9.99815 6.70226 10.0021C6.75719 10.006 6.81235 9.99904 6.86456 9.98152C6.91677 9.96401 6.96499 9.93631 7.00643 9.90005C7.04787 9.86378 7.08171 9.81965 7.10599 9.77022C7.13027 9.72079 7.14451 9.66704 7.14788 9.61208C7.15125 9.55711 7.1437 9.50202 7.12565 9.44999C7.1076 9.39797 7.07941 9.35003 7.04271 9.30897L6.50213 8.691C6.70542 8.61915 6.88147 8.4861 7.00607 8.31013C7.13066 8.13416 7.1977 7.92392 7.19795 7.70831ZM6.15627 7.91663H5.73963V7.49999H6.15631C6.21156 7.49999 6.26456 7.52194 6.30363 7.56101C6.3427 7.60008 6.36465 7.65307 6.36465 7.70833C6.36465 7.76358 6.3427 7.81657 6.30363 7.85564C6.26456 7.89472 6.21156 7.91667 6.15631 7.91667L6.15627 7.91663Z" fill="white"/>
                            <path d="M4.1667 7.49995C4.27651 7.49888 4.38145 7.45452 4.45872 7.37649C4.536 7.29847 4.57934 7.1931 4.57934 7.08329C4.57934 6.97347 4.536 6.8681 4.45872 6.79008C4.38145 6.71206 4.27651 6.66769 4.1667 6.66663H2.9167C2.8062 6.66663 2.70022 6.71052 2.62208 6.78865C2.54393 6.86679 2.50003 6.97276 2.50002 7.08327V9.58327C2.49949 9.63832 2.50987 9.69294 2.53057 9.74396C2.55127 9.79498 2.58188 9.84139 2.62062 9.88051C2.65936 9.91963 2.70548 9.95068 2.75629 9.97188C2.80711 9.99307 2.86162 10.004 2.91668 10.004C2.97174 10.004 3.02625 9.99307 3.07707 9.97188C3.12788 9.95068 3.174 9.91963 3.21274 9.88051C3.25148 9.84139 3.28209 9.79498 3.30279 9.74396C3.32349 9.69294 3.33387 9.63832 3.33334 9.58327V8.74995H3.95834C4.0134 8.75048 4.06801 8.7401 4.11903 8.7194C4.17005 8.6987 4.21646 8.66809 4.25558 8.62935C4.2947 8.5906 4.32576 8.54449 4.34695 8.49367C4.36814 8.44286 4.37905 8.38834 4.37905 8.33329C4.37905 8.27823 4.36814 8.22371 4.34695 8.1729C4.32576 8.12208 4.2947 8.07597 4.25558 8.03723C4.21646 7.99848 4.17005 7.96788 4.11903 7.94718C4.06801 7.92648 4.0134 7.91609 3.95834 7.91663H3.33334V7.49995H4.1667Z" fill="white"/>
                            <path d="M11.6667 7.49995C11.7765 7.49888 11.8814 7.45452 11.9587 7.37649C12.036 7.29847 12.0793 7.1931 12.0793 7.08329C12.0793 6.97347 12.036 6.8681 11.9587 6.79008C11.8814 6.71206 11.7765 6.66769 11.6667 6.66663H10.4167C10.3062 6.66663 10.2002 6.71052 10.1221 6.78865C10.0439 6.86679 10 6.97276 10 7.08327V9.58327C10 9.69378 10.0439 9.79976 10.122 9.8779C10.2002 9.95605 10.3062 9.99995 10.4167 9.99995H11.6667C11.7765 9.99888 11.8814 9.95452 11.9587 9.87649C12.036 9.79847 12.0793 9.6931 12.0793 9.58329C12.0793 9.47347 12.036 9.3681 11.9587 9.29008C11.8814 9.21206 11.7765 9.16769 11.6667 9.16663H10.8333V8.74995H11.4489C11.504 8.75048 11.5586 8.7401 11.6096 8.7194C11.6607 8.6987 11.7071 8.66809 11.7462 8.62935C11.7853 8.5906 11.8164 8.54449 11.8376 8.49367C11.8587 8.44286 11.8697 8.38834 11.8697 8.33329C11.8697 8.27823 11.8587 8.22371 11.8376 8.1729C11.8164 8.12208 11.7853 8.07597 11.7462 8.03723C11.7071 7.99848 11.6607 7.96788 11.6096 7.94718C11.5586 7.92648 11.504 7.91609 11.4489 7.91663H10.8333V7.49995H11.6667Z" fill="white"/>
                            <path d="M9.26824 7.49997C9.3233 7.5005 9.37791 7.49012 9.42893 7.46942C9.47995 7.44872 9.52636 7.41811 9.56548 7.37937C9.6046 7.34062 9.63566 7.29451 9.65685 7.24369C9.67804 7.19288 9.68896 7.13836 9.68896 7.08331C9.68896 7.02825 9.67804 6.97373 9.65685 6.92292C9.63566 6.8721 9.6046 6.82599 9.56548 6.78725C9.52636 6.7485 9.47995 6.7179 9.42893 6.6972C9.37791 6.6765 9.3233 6.66611 9.26824 6.66665H8.01824C7.90773 6.66665 7.80175 6.71055 7.72361 6.78869C7.64546 6.86683 7.60156 6.97281 7.60156 7.08332V9.58333C7.60157 9.69383 7.64548 9.7998 7.72362 9.87794C7.80176 9.95607 7.90774 9.99997 8.01824 9.99997H9.26824C9.3233 10.0005 9.37791 9.99012 9.42893 9.96942C9.47995 9.94872 9.52636 9.91811 9.56548 9.87937C9.6046 9.84062 9.63566 9.79451 9.65685 9.74369C9.67804 9.69288 9.68896 9.63836 9.68896 9.58331C9.68896 9.52825 9.67804 9.47373 9.65685 9.42292C9.63566 9.3721 9.6046 9.32599 9.56548 9.28725C9.52636 9.2485 9.47995 9.2179 9.42893 9.1972C9.37791 9.1765 9.3233 9.16611 9.26824 9.16665H8.43492V8.74997H9.05078C9.10584 8.7505 9.16045 8.74012 9.21147 8.71942C9.26249 8.69872 9.3089 8.66811 9.34802 8.62937C9.38714 8.59062 9.4182 8.54451 9.43939 8.49369C9.46058 8.44288 9.4715 8.38836 9.4715 8.33331C9.4715 8.27825 9.46058 8.22373 9.43939 8.17292C9.4182 8.1221 9.38714 8.07599 9.34802 8.03725C9.3089 7.9985 9.26249 7.9679 9.21147 7.9472C9.16045 7.9265 9.10584 7.91611 9.05078 7.91665H8.43492V7.49997H9.26824Z" fill="white"/>
                            <path d="M0.420458 11.6667H2.50378C2.61358 11.6656 2.71853 11.6213 2.7958 11.5432C2.87308 11.4652 2.91642 11.3598 2.91642 11.25C2.91642 11.1402 2.87308 11.0348 2.7958 10.9568C2.71853 10.8788 2.61358 10.8344 2.50378 10.8334H0.420458C0.310651 10.8344 0.205704 10.8788 0.128432 10.9568C0.0511606 11.0348 0.0078125 11.1402 0.0078125 11.25C0.0078125 11.3598 0.0511606 11.4652 0.128432 11.5432C0.205704 11.6213 0.310651 11.6656 0.420458 11.6667Z" fill="white"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    $html = ob_get_clean();
    return $html;
}

/**
 * Get all product attribute taxonomies as [taxonomy => label]
 *
 * @return array
 */
function komestic_get_product_attributes_option() {
    $results = [];

    $attribute_taxonomies = wc_get_attribute_taxonomies();

    if (!empty($attribute_taxonomies)) {
        foreach ($attribute_taxonomies as $attr) {
            $taxonomy = wc_attribute_taxonomy_name($attr->attribute_name);

            if (taxonomy_exists($taxonomy)) {
                $results[$taxonomy] = $attr->attribute_label;
            }
        }
    }

    return $results;
}

/**
 * Get product title
 */
function komestic_get_product_title($product, $title_tag = 'h2', $is_link = false) {
    echo '<' . esc_attr($title_tag) . ' class="product-title">';
    if($is_link) {
        echo '<a href="'.esc_url(get_permalink($product->get_id())).'">';
            echo esc_html($product->get_name());
        echo '</a>';
    }else {
        echo esc_html($product->get_name());
    }
    echo '</' . esc_attr($title_tag) . '>';
}

/**
 * Get product price
 */
function komestic_get_product_price($product) {
    echo '<div class="product-price">';
        echo '<div class="price">';
            pxl_print_html($product->get_price_html());
        echo '</div>';
        pxl_print_html(komestic_display_sale_percentage_label_html($product, '', '% OFF'));
    echo '</div>';
}

/**
 * Button Quick View Html
 */
function komestic_render_quick_view_button_html($product_id) {
    $quick_view_modal = komestic()->get_theme_opt('quick_view_modal', 0);
    if($quick_view_modal <= 0) return;
    if ( !has_action( 'pxl_anchor_target_template_'.$quick_view_modal ) ) {
        add_action( 'pxl_anchor_target_template_'.$quick_view_modal, 'komestic_hook_anchor_panel' );
    }
    $is_in_compare = komestic_is_product_in_compare($product_id);
    ?>
        <a href="#template-<?php echo esc_attr($quick_view_modal); ?>" class="pxl-button button--shop-action button--quickview" data-product_id="<?php echo esc_attr($product_id); ?>">
            <i class="flaticon flaticon-eye"></i>
        </a>
    <?php
}

/**
 * Render privacy policy text on the register forms.
 *
 */
function komestic_registration_privacy_policy_text() {
    ?>
    <label class="woocommerce-privacy-policy form-checkbox-control">
        <input class="form__field form__field--checkbox woocommerce-form__input woocommerce-form__input-checkbox" name="privacy_policy" type="checkbox" id="privacy_policy" value="forever" /> 
        <span class="checkbox">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9">
                <path d="M4.27183 7.28352L0.81519 3.64176L0 4.5L4.27183 9L12 0.858241L11.1848 0L4.27183 7.28352Z" fill="currentcolor"/>
            </svg>
        </span>
        <span class="label-text"><?php wc_privacy_policy_text( 'registration' ); ?></span>
    </label>
    <?php
}
add_action( 'woocommerce_register_form', 'komestic_registration_privacy_policy_text', 20 );

/**
 * Render form loss password
 */
function komestic_form_loss_password() {
    if(is_user_logged_in() || !class_exists('WC_Shortcode_My_Account')) {
        return '';
    }?>
    <div id="loss-password" class="lost-password pxl-drawer" data-drawer="right">
        <h3><?php echo esc_html__('Reset Password', 'komestic'); ?></h3>
        <button class="pxl-button button--close">
            <div class="icon-close"></div>
        </button>
        <?php echo WC_Shortcode_My_Account::lost_password(); ?>
    </div>

    <?php
}

/**
 * Render Button Buy Now html
 */
function komestic_render_button_buy_now($product) {
    ?>
    <button type="button" class="pxl-button button--buy-now button--primary<?php if($product->is_type('variable')) echo ' disabled'; ?>" data-quantity="1" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-url="<?php echo esc_url(home_url('/checkout')); ?>">
        <span class="button__text"><?php echo esc_html__('Buy It Now', 'komestic'); ?></span>
    </button>
    <?php
}
