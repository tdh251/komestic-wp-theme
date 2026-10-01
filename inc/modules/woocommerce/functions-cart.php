<?php
// add_action( 'init', function() {
//     if ( class_exists( 'WooCommerce' ) ) {
//         if ( WC()->session ) {
//             WC()->session->set_customer_session_cookie( true );
//         }
//     }
// });

function komestic_products_cart_content_html() {
    ob_start(); ?>
    <div class="cart-table-content">
        <?php
            $gift_package = komestic_get_gift_package();
            $is_gift_wrap_in_cart = false;
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                /**
                 * Filter the product name.
                 *
                 * @since 2.1.0
                 * @param string $product_name Name of the product in the cart.
                 * @param array $cart_item The product in the cart.
                 * @param string $cart_item_key Key for the product in the cart.
                 */
                // $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                $product_name = $_product->get_name();
                $attributes = [];
                foreach ( $cart_item['variation'] as $attr_name => $attr_value ) {
                    $taxonomy = str_replace( 'attribute_', '', $attr_name );
                    $term = get_term_by( 'slug', $attr_value, $taxonomy );
                    $attributes[] = $term ? $term->name : $attr_value;
                }
                $attributes_str = implode( ' / ', $attributes ); 
                if($gift_package['id'] == $product_id) {
                    $is_gift_wrap_in_cart = true;
                    continue;
                }
                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    ?>
                    <div class="cart-table-item woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>" data-product_id="<?php echo esc_attr($product_id); ?>">	
                        <div class="product-info" data-title="<?php esc_attr_e( 'Products', 'komestic' ); ?>">
                            <?php
                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('full'), $cart_item, $cart_item_key );
                            if ( ! $product_permalink ) {
                                echo wp_kses_post($thumbnail); // PHPCS: XSS ok.
                            } else {
                                printf( '<a class="product-image" href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                            }

                            if(!empty($attributes_str)) {
                                printf( '<a class="product-name" href="%s"><span>%s</span><span class="product-attributes">%s</span></a>', esc_url( $product_permalink ), $product_name, $attributes_str);
                            }else {
                                printf( '<a class="product-name" href="%s">%s</a>', esc_url( $product_permalink ), $product_name);
                            }

                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                            // Meta data.
                            echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                            // Backorder notification.
                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'komestic' ) . '</p>', $product_id ) );
                            }
                        ?>
                        </div>
                        <div class="product-price" data-title="<?php esc_attr_e( 'Price', 'komestic' ); ?>">
                            <?php
                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                            ?>
                        </div>
                        <div class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'komestic' ); ?>">
                            <?php
                                if ( $_product->is_sold_individually() ) {
                                    $min_quantity = 1;
                                    $max_quantity = 1;
                                } else {
                                    $min_quantity = 0;
                                    $max_quantity = $_product->get_max_purchase_quantity();
                                }
                                $product_quantity = woocommerce_quantity_input(
                                    array(
                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                        'input_value'  => $cart_item['quantity'],
                                        'max_value'    => $max_quantity,
                                        'min_value'    => $min_quantity,
                                        'product_name' => $product_name,
                                    ),
                                    $_product,
                                    false
                                );
                                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                            ?>
                            <?php
                                echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    'woocommerce_cart_item_remove_link',
                                    sprintf(
                                        '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-product_sku="%s" data-cart_item_key="%s">%s</a>',
                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                        esc_attr( sprintf( __( 'Remove %s from cart', 'komestic' ), wp_strip_all_tags( $product_name ) ) ),
                                        esc_attr( $product_id ),
                                        esc_attr( $_product->get_sku() ),
                                        esc_attr($cart_item_key),
                                        __( 'Remove', 'komestic' )
                                    ),
                                    $cart_item_key
                                );
                            ?>
                        </div>

                        <div class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'komestic' ); ?>">
                            <?php
                                echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
            if($gift_package['id'] != 0) { ?>
                <div class="cart-table-item cart-table-item--add-gift-wrap cart__item">
                    <label class="form-checkbox-control" for="gift_package">
                        <input type="checkbox" name="gift_package" id="gift_package" value="<?php echo esc_attr($gift_package['id']); ?>" <?php if($is_gift_wrap_in_cart == true) : ?>checked<?php endif; ?>>
                        <div class="checkbox">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9">
                                <path d="M4.27183 7.28352L0.81519 3.64176L0 4.5L4.27183 9L12 0.858241L11.1848 0L4.27183 7.28352Z" fill="white"></path>
                            </svg>
                        </div>
                        <span class="label-text">
                            <?php pxl_print_html('Add gift packaging ('.wc_price($gift_package['price']).')'); ?>
                        </span>
                    </label>
                </div>
            <?php }
        ?>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Add to Cart Gift Package via Ajax
 */
add_action('wp_ajax_komestic_toggle_cart_gift_package', 'komestic_toggle_cart_gift_package');
add_action('wp_ajax_nopriv_komestic_toggle_cart_gift_package', 'komestic_toggle_cart_gift_package');
function komestic_toggle_cart_gift_package() {
    if ( ! isset($_POST['product_id']) ) {
        wp_send_json_error( ['message' => 'No product ID'] );
    }

    $product_id = intval($_POST['product_id']);
    $cart       = WC()->cart;
    $removed    = false;

    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
        if ( $cart_item['product_id'] == $product_id ) {
            $cart->remove_cart_item( $cart_item_key );
            $removed = true;
        }
    }
    if ( ! $removed ) {
        $added = $cart->add_to_cart( $product_id, 1 );

        if ( ! $added ) {
            wp_send_json_error( ['message' => 'Could not add to cart'] );
        }
    }
    WC_AJAX::get_refreshed_fragments();
}

/**
 * Dot Icon Cart Status
 */
function komestic_render_dot_status_cart() {
    ob_start(); ?>
    <span class="pxl-cart-status">
        <?php if ( function_exists('WC') && WC()->cart && ! WC()->cart->is_empty() ) : ?>
            <span class="dot-status"></span>
        <?php endif; ?>
    </span>
    <?php
    return ob_get_clean();
}

/**
 *  Cart Fragments
 */
add_filter( 'woocommerce_add_to_cart_fragments', function( $fragments ) {
    $fragments['.pxl-cart-products'] = komestic_cart_sidebar_products_html();
    $fragments['.pxl-cart-total'] = '<span class="pxl-cart-total">'.WC()->cart->get_total().'</span>';
    $fragments['.pxl-cart-count'] = '<span class="pxl-cart-count">'.komestic_get_cart_count().'</span>';
    $fragments['.pxl-cart-subtotal'] = '<span class="subtotal pxl-cart-subtotal">'.WC()->cart->get_cart_subtotal().'</span>';
    $fragments['.cart-section--add-gift-wrap'] = komestic_section_add_gift_wrap_html();
    $fragments['.pxl-shipping-progress-bar'] = komestic_shipping_progress_bar_html();
    // $fragments['.pxl-shipping-result'] = komestic_get_shipping_cost_html();
    $fragments['.cart-section--shipping'] = komestic_section_shipping_html();
    $fragments['.cart-table-content'] = komestic_products_cart_content_html();
    $fragments['.pxl-cart-status'] = komestic_render_dot_status_cart();
    return $fragments;
});

/**
 * Product Cart Sidebar Fragment
 */
function komestic_cart_sidebar_products_html() { 
    global $woocommerce;
    $cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
    ob_start();
    ?>
    <ul class="pxl-cart-products">
        <?php if ( !WC()->cart->is_empty() ) : 
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                $gift_package_id = komestic_get_gift_package()['id'];
                $product_name = $_product->get_name();
                $attributes = [];
                foreach ( $cart_item['variation'] as $attr_name => $attr_value ) {
                    $taxonomy = str_replace( 'attribute_', '', $attr_name );
                    $term = get_term_by( 'slug', $attr_value, $taxonomy );
                    $attributes[] = $term ? $term->name : $attr_value;
                }
                $attributes_str = implode( ' / ', $attributes ); 
                if($product_id == $gift_package_id) continue;

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    ?>
                    <li class="product" data-product_id="<?php echo esc_attr( $product_id ); ?>">
                        <div class="product__thumbnail">
                            <?php
                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('full'), $cart_item, $cart_item_key );
                                if ( ! $product_permalink ) {
                                    echo wp_kses_post($thumbnail); // PHPCS: XSS ok.
                                } else {
                                    printf( '<a class="product__thumbnail" href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                }
                            ?>
                        </div>
                        <div class="product__content">
                            <a class="product__name" href="<?php echo esc_url( $product_permalink ); ?>">
                                <?php echo esc_html( $product_name ); ?>
                            </a>
                            <?php if ( ! empty( $attributes_str ) ) { ?>
                                <span class="product__attributes"><?php echo wp_kses_post( $attributes_str ); ?></span>
                            <?php }

                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                            // Meta data.
                            echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                            // Backorder notification.
                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'komestic' ) . '</p>', $product_id ) );
                            } ?>
                            <div class="product__quantity">
                                <?php echo esc_html__('Qty:', 'komestic'); ?>
                                <?php
                                    if ( $_product->is_sold_individually() ) {
                                        $min_quantity = 1;
                                        $max_quantity = 1;
                                    } else {
                                        $min_quantity = 0;
                                        $max_quantity = $_product->get_max_purchase_quantity();
                                    }
                                    $product_quantity = woocommerce_quantity_input(
                                        array(
                                            'input_name'   => "cart[{$cart_item_key}][qty]",
                                            'input_value'  => $cart_item['quantity'],
                                            'max_value'    => $max_quantity,
                                            'min_value'    => $min_quantity,
                                            'product_name' => $product_name,
                                        ),
                                        $_product,
                                        false
                                    );
                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                ?>
                            </div>
                            <?php
                                echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    'woocommerce_cart_item_remove_link',
                                    sprintf(
                                        '<a href="%s" class="remove remove_from_cart_button remove-cart-item-sidebar" aria-label="%s" data-product_id="%s" data-product_sku="%s" data-cart_item_key="%s">%s</a>',
                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                        esc_attr( sprintf( __( 'Remove %s from cart', 'komestic' ), wp_strip_all_tags( $product_name ) ) ),
                                        esc_attr( $product_id ),
                                        esc_attr( $_product->get_sku() ),
                                        esc_attr($cart_item_key),
                                        __( 'Remove', 'komestic' )
                                    ),
                                    $cart_item_key
                                );
                            ?>
                        </div>
                        <div class="product__price">
                            <?php
                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                            ?>
                        </div>
                    </li>
                    <?php
                }
            }
        else : ?>
            <li class="empty">
                <i class="flaticon flaticon-bag"></i>
                <span><?php esc_html_e( 'Your cart is empty!', 'komestic' ); ?></span>
                <a class="pxl-button button--primary button-cart-empty" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">
                    <span class="button__text">
                        <?php echo esc_html__('Browse Shop', 'komestic'); ?>
                    </span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
    <?php
    return ob_get_clean();
}
// add_action( 'wp_footer', function() {
//     if ( class_exists( 'WooCommerce' ) && ! is_admin() ) {
//         echo komestic_cart_sidebar_products_html();
//     }
// });

/**
 * Section Add Gift Wrap HTML
 */
function komestic_section_add_gift_wrap_html() {
    $gift_package = komestic_get_gift_package();
    $is_in_cart = komestic_is_product_in_cart($gift_package['id']);
    $btn_submit_text = $is_in_cart ? 'Remove a Gift Wrap' : 'Add a Gift Wrap';
    $added = $is_in_cart ? ' added' : '';
    $note = $is_in_cart ? 'Do you want remove a gift wrap?' : 'Do you want a gift wrap?';
    ob_start();
    ?>
        <div class="cart-section cart-section--add-gift-wrap">
            <div class="cart-section__content">
                <h6 class="cart-section__title"><?php echo esc_html__('Add Gift Wrap', 'komestic'); ?></h6>
                <p class="cart-section__note">
                    <?php 
                        pxl_print_html('The product will be wrapped carefully. Free is only ' . wc_price($gift_package['price']) . '.<br>' . $note);
                    ?>
                    <input type="hidden" value="<?php echo esc_attr($gift_package['id']); ?>" name="gift_package">
                </p>
            </div>
            <p class="cart-section__buttons">
                <button class="pxl-button button--primary button-submit<?php echo esc_attr($added); ?>">
                    <span class="button__text">
                        <?php echo esc_html($btn_submit_text); ?>
                    </span>
                </button>
                <button class="pxl-button button--primary button-cancel">
                    <span class="button__text">
                        <?php echo esc_html__('Cancel', 'komestic'); ?>
                    </span>
                </button>
            </p>
        </div>
    <?php
    return ob_get_clean();
}
/**
 * Section Note HTML
 */
function komestic_section_note_html() {
    $saved_note = WC()->session->get('komestic_order_note');
    ?>
    <div class="cart-section cart-section--note">
        <div class="cart-section__content">
            <h6 class="cart-section__title"><?php echo esc_html__('Order Note', 'komestic'); ?></h6>
            <p class="cart-section__note">
                <textarea name="note" class="order-note" placeholder="<?php echo esc_attr__('Instruction for seller...', 'komestic'); ?>"><?php echo esc_html($saved_note); ?></textarea>
            </p>
        </div>
        <p class="cart-section__buttons">
            <button class="pxl-button button--primary button-submit">
                <span class="button__text">
                    <?php echo esc_html__('Save', 'komestic'); ?>
                </span>
            </button>
            <button class="pxl-button button--primary button-cancel">
                <span class="button__text">
                    <?php echo esc_html__('Cancel', 'komestic'); ?>
                </span>
            </button>
        </p>
    </div>
    <?php
}

/**
 * Fill in the notes in the "Order notes" field of checkout
 */
add_filter('woocommerce_checkout_get_value', function($input, $key) {
    if ($key === 'order_comments') {
        $note = WC()->session->get('komestic_order_note');
        if (!empty($note)) {
            $input = $note;
        }
    }
    return $input;
}, 10, 2);
/**
 * Delete note in session after place order
 */
add_action('woocommerce_checkout_order_processed', function($order_id, $posted_data, $order) {
    WC()->session->__unset('komestic_order_note');
}, 10, 3);

/**
 * Section Shipping HTML
 */
function komestic_section_shipping_html() {
    ob_start();
    ?>
        <div class="cart-section cart-section--shipping">
            <div class="cart-section__content">
                <h6 class="cart-section__title"><?php echo esc_html__('Shipping Estimates', 'komestic'); ?></h6>
                <div class="cart-section__form">
                    <?php woocommerce_shipping_calculator(); ?>
                </div>
            </div>
            <p class="cart-section__buttons">
                <button class="pxl-button button--primary button-submit">
                    <span class="button__text">
                        <?php echo esc_html__('Estimate', 'komestic'); ?>
                    </span>
                </button>
                <button class="pxl-button button--primary button-cancel">
                    <span class="button__text">
                        <?php echo esc_html__('Close', 'komestic'); ?>
                    </span>
                </button>
            </p>
        </div>
    <?php
    return ob_get_clean();
}
/**
 * Cart Sidebar HTML
 */
if(!function_exists('komestic_cart_sidebar_html')){
    function komestic_cart_sidebar_html(){
        if(class_exists('Woocommerce')) : ?>
            <div id="pxl-cart-sidebar" class="pxl-drawer sidebar sidebar--shopping-cart" data-drawer="right">
                <div class="sidebar__inner">
                    <div class="sidebar__header">
                        <h3 class="sidebar__title">
                            <?php echo esc_html__( 'Shopping Cart', 'komestic' ); ?> 
                        </h3>
                        <?php
                        $free_shipping_opt = get_available_free_shipping_for_current_user();
                        $free_shipping_progess_bar_html = komestic_shipping_progress_bar_html();
                        if(!empty($free_shipping_progess_bar_html)) { ?>
                            <div class="free-shipping">
                                <div class="free-shipping__title">
                                    <?php 
                                        echo wp_kses_post(
                                            'Spend <span class="highlight">$' . $free_shipping_opt['min_amount'] . '</span> more to get <span class="highlight">' . $free_shipping_opt['title'] . '</span>'
                                        );
                                    ?>
                                </div>
                                <?php pxl_print_html($free_shipping_progess_bar_html); ?>
                            </div>
                        <?php } ?>
                        <button class="pxl-button button--close">
                            <span class="icon-close"></span>
                        </button>
                    </div>

                    <div class="sidebar__products">
                        <div class="sidebar__products-header">
                            <div class="cart-count">
                                <span class="pxl-cart-count">
                                    <?php echo komestic_get_cart_count(); ?>
                                </span>
                                <?php echo esc_html__( 'Products', 'komestic' ); ?>
                            </div>
                            <?php if ( WC()->cart ) { ?>
                                <a href="<?php echo esc_url( wc_get_cart_url() . '?empty-cart' ); ?>" class="ajax-cart-empty text-underline"><?php echo esc_html__('Empty cart', 'komestic'); ?></a>
                            <?php } ?>
                        </div>
                        <?php pxl_print_html(komestic_cart_sidebar_products_html()); ?>
                    </div>

                    <div class="sidebar__footer">
                        <div class="cart-actions">
                            <div class="cart-actions__item" data-action="add-gift-wrap">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <path d="M20 6.75055H18.935C19.139 6.3653 19.2471 5.93649 19.25 5.50055C19.2506 4.93324 19.0756 4.37965 18.749 3.91582C18.4223 3.45198 17.9601 3.10065 17.4258 2.91008C16.8914 2.71951 16.3112 2.69905 15.7648 2.85151C15.2183 3.00397 14.7325 3.32187 14.374 3.76155C14.347 3.80055 13.223 5.29055 12.5 6.25255L10.619 3.75255C10.2593 3.31501 9.77317 2.99936 9.22714 2.84881C8.68112 2.69826 8.1019 2.72018 7.56881 2.91156C7.03572 3.10295 6.57482 3.45444 6.24923 3.9179C5.92364 4.38137 5.74927 4.93415 5.75 5.50055C5.75289 5.93649 5.86095 6.3653 6.065 6.75055H5C4.40351 6.75134 3.83167 6.98865 3.40989 7.41043C2.9881 7.83222 2.75079 8.40405 2.75 9.00055V12.5005C2.75 12.6995 2.82902 12.8902 2.96967 13.0309C3.11032 13.1715 3.30109 13.2505 3.5 13.2505H3.75V18.5005C3.69128 19.0072 3.74788 19.5206 3.91557 20.0023C4.08326 20.484 4.3577 20.9215 4.71836 21.2822C5.07902 21.6428 5.51657 21.9173 5.99826 22.085C6.47996 22.2527 6.99334 22.3093 7.5 22.2505H17.5C18.0067 22.3093 18.52 22.2527 19.0017 22.085C19.4834 21.9173 19.921 21.6428 20.2816 21.2822C20.6423 20.9215 20.9167 20.484 21.0844 20.0023C21.2521 19.5206 21.3087 19.0072 21.25 18.5005V13.2505H21.5C21.6989 13.2505 21.8897 13.1715 22.0303 13.0309C22.171 12.8902 22.25 12.6995 22.25 12.5005V9.00055C22.2492 8.40405 22.0119 7.83222 21.5901 7.41043C21.1683 6.98865 20.5965 6.75134 20 6.75055ZM20.75 9.00055V11.7505H13.25V8.25055H20C20.1988 8.25081 20.3894 8.32991 20.53 8.47051C20.6706 8.6111 20.7497 8.80172 20.75 9.00055ZM15.539 4.70755C15.6544 4.5639 15.8008 4.44818 15.9672 4.36905C16.1336 4.28991 16.3157 4.24941 16.5 4.25055C16.8315 4.25055 17.1495 4.38224 17.3839 4.61666C17.6183 4.85108 17.75 5.16903 17.75 5.50055C17.75 5.83207 17.6183 6.15001 17.3839 6.38443C17.1495 6.61885 16.8315 6.75055 16.5 6.75055H14L15.539 4.70755ZM7.25 5.50055C7.25053 5.16919 7.38239 4.85155 7.6167 4.61725C7.85101 4.38294 8.16864 4.25108 8.5 4.25055C8.6809 4.24871 8.85992 4.28736 9.02395 4.36366C9.18799 4.43997 9.33287 4.552 9.448 4.69155C9.5 4.76255 10.321 5.85055 11 6.75055H8.5C8.16864 6.75002 7.85101 6.61815 7.6167 6.38385C7.38239 6.14954 7.25053 5.83191 7.25 5.50055ZM4.25 9.00055C4.25026 8.80172 4.32937 8.6111 4.46996 8.47051C4.61056 8.32991 4.80117 8.25081 5 8.25055H11.75V11.7505H4.25V9.00055ZM5.25 18.5005V13.2505H11.75V20.7505H7.5C5.923 20.7505 5.25 20.0775 5.25 18.5005ZM19.75 18.5005C19.75 20.0775 19.077 20.7505 17.5 20.7505H13.25V13.2505H19.75V18.5005Z" fill="#252525"/>
                                </svg>
                                <?php echo esc_html__('Add gift wrap', 'komestic'); ?>
                            </div>
                            <div class="cart-actions__item" data-action="note">
                                <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.73 11.5938C16.73 11.1623 16.3803 10.8125 15.9488 10.8125H7.90186C7.47037 10.8125 7.12061 11.1623 7.12061 11.5938C7.12061 12.0252 7.47037 12.375 7.90186 12.375H15.9488C16.3803 12.375 16.73 12.0252 16.73 11.5938ZM7.90186 13.9375C7.47037 13.9375 7.12061 14.2873 7.12061 14.7188C7.12061 15.1502 7.47037 15.5 7.90186 15.5H12.789C13.2205 15.5 13.5703 15.1502 13.5703 14.7188C13.5703 14.2873 13.2205 13.9375 12.789 13.9375H7.90186Z" fill="black"/>
                                    <path d="M9.73788 21.4375H7.12501C6.26345 21.4375 5.56251 20.7366 5.56251 19.875V6.125C5.56251 5.26344 6.26345 4.5625 7.12501 4.5625H16.7301C17.5917 4.5625 18.2926 5.26344 18.2926 6.125V10.9297C18.2926 11.3612 18.6424 11.7109 19.0739 11.7109C19.5053 11.7109 19.8551 11.3612 19.8551 10.9297V6.125C19.8551 4.40188 18.4532 3 16.7301 3H7.12501C5.40188 3 4 4.40188 4 6.125V19.875C4 21.5981 5.40188 23 7.12501 23H9.73788C10.1694 23 10.5191 22.6502 10.5191 22.2188C10.5191 21.7873 10.1694 21.4375 9.73788 21.4375Z" fill="black"/>
                                    <path d="M21.2388 14.3114C20.325 13.3976 18.8381 13.3975 17.9249 14.3108L13.6357 18.5905C13.5446 18.6814 13.4774 18.7933 13.44 18.9164L12.5059 21.9916C12.4652 22.1255 12.4612 22.2678 12.4944 22.4037C12.5275 22.5396 12.5965 22.6642 12.6942 22.7643C12.7919 22.8644 12.9147 22.9365 13.0497 22.9729C13.1848 23.0094 13.3271 23.0089 13.462 22.9716L16.6153 22.0981C16.7451 22.0622 16.8634 21.9933 16.9587 21.8982L21.2389 17.626C22.1527 16.7122 22.1527 15.2253 21.2388 14.3114ZM16.0002 20.6472L14.4138 21.0866L14.8781 19.5582L17.7722 16.6705L18.8773 17.7755L16.0002 20.6472ZM20.1346 16.5207L19.9832 16.6718L18.8783 15.5669L19.0292 15.4163C19.3338 15.1117 19.8294 15.1117 20.134 15.4163C20.4386 15.7209 20.4386 16.2166 20.1346 16.5207ZM15.9488 7.6875H7.90186C7.47037 7.6875 7.12061 8.03727 7.12061 8.46875C7.12061 8.90023 7.47037 9.25 7.90186 9.25H15.9488C16.3803 9.25 16.73 8.90023 16.73 8.46875C16.73 8.03727 16.3803 7.6875 15.9488 7.6875Z" fill="black"/>
                                </svg>
                                <?php echo esc_html__('Order note', 'komestic'); ?>
                            </div>
                            <div class="cart-actions__item" data-action="shipping">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="17" viewBox="0 0 23 17" fill="none">
                                    <path d="M22.1538 7.01539L20.3885 4.36154C20.203 4.08488 19.9523 3.85808 19.6586 3.70113C19.3648 3.54418 19.0369 3.4619 18.7038 3.46154H15.5769V2.01923C15.5739 1.48463 15.3602 0.972791 14.9822 0.594766C14.6041 0.216741 14.0923 0.00302896 13.5577 0H2.01923C1.48463 0.00302896 0.972791 0.216741 0.594766 0.594766C0.216741 0.972791 0.00302896 1.48463 0 2.01923V12.4038C0.00302896 12.9384 0.216741 13.4503 0.594766 13.8283C0.972791 14.2063 1.48463 14.42 2.01923 14.4231H2.44615C2.63071 15.0861 3.02731 15.6704 3.57531 16.0867C4.12332 16.503 4.79258 16.7283 5.48077 16.7283C6.16896 16.7283 6.83822 16.503 7.38622 16.0867C7.93423 15.6704 8.33083 15.0861 8.51538 14.4231H13.9846C14.1692 15.0861 14.5658 15.6704 15.1138 16.0867C15.6618 16.503 16.331 16.7283 17.0192 16.7283C17.7074 16.7283 18.3767 16.503 18.9247 16.0867C19.4727 15.6704 19.8693 15.0861 20.0538 14.4231H20.4808C21.0154 14.42 21.5272 14.2063 21.9052 13.8283C22.2833 13.4503 22.497 12.9384 22.5 12.4038V8.13462C22.4971 7.73564 22.3767 7.34636 22.1538 7.01539ZM1.73077 12.4038V2.01923C1.73077 1.94273 1.76116 1.86935 1.81526 1.81526C1.86935 1.76116 1.94273 1.73077 2.01923 1.73077H13.5577C13.6342 1.73077 13.7076 1.76116 13.7617 1.81526C13.8158 1.86935 13.8462 1.94273 13.8462 2.01923V12.6923H8.51538C8.33083 12.0293 7.93423 11.445 7.38622 11.0287C6.83822 10.6124 6.16896 10.3871 5.48077 10.3871C4.79258 10.3871 4.12332 10.6124 3.57531 11.0287C3.02731 11.445 2.63071 12.0293 2.44615 12.6923H2.01923C1.94273 12.6923 1.86935 12.6619 1.81526 12.6078C1.76116 12.5537 1.73077 12.4804 1.73077 12.4038ZM5.48077 15C5.19551 15 4.91665 14.9154 4.67947 14.7569C4.44228 14.5984 4.25742 14.3732 4.14825 14.1096C4.03909 13.8461 4.01052 13.5561 4.06617 13.2763C4.12183 12.9965 4.25919 12.7395 4.4609 12.5378C4.66261 12.3361 4.91961 12.1988 5.19939 12.1431C5.47917 12.0874 5.76917 12.116 6.03272 12.2252C6.29626 12.3343 6.52152 12.5192 6.68 12.7564C6.83849 12.9936 6.92308 13.2724 6.92308 13.5577C6.92308 13.9402 6.77112 14.3071 6.50063 14.5776C6.23015 14.848 5.86329 15 5.48077 15ZM17.0192 15C16.734 15 16.4551 14.9154 16.2179 14.7569C15.9807 14.5984 15.7959 14.3732 15.6867 14.1096C15.5775 13.8461 15.549 13.5561 15.6046 13.2763C15.6603 12.9965 15.7977 12.7395 15.9994 12.5378C16.2011 12.3361 16.4581 12.1988 16.7379 12.1431C17.0176 12.0874 17.3076 12.116 17.5712 12.2252C17.8347 12.3343 18.06 12.5192 18.2185 12.7564C18.3769 12.9936 18.4615 13.2724 18.4615 13.5577C18.4615 13.9402 18.3096 14.3071 18.0391 14.5776C17.7686 14.848 17.4018 15 17.0192 15ZM20.7692 12.4038C20.7692 12.4804 20.7388 12.5537 20.6847 12.6078C20.6306 12.6619 20.5573 12.6923 20.4808 12.6923H20.0538C19.8663 12.0308 19.469 11.4481 18.9217 11.0319C18.3745 10.6157 17.7068 10.3886 17.0192 10.3846C16.5171 10.3893 16.0231 10.5118 15.5769 10.7423V5.19231H18.7038C18.7546 5.19101 18.8048 5.20312 18.8494 5.22744C18.8939 5.25175 18.9313 5.28739 18.9577 5.33077L20.7231 7.98462C20.733 8.03412 20.733 8.08511 20.7231 8.13462L20.7692 12.4038Z" fill="black"/>
                                </svg>
                                <?php echo esc_html__('Shipping', 'komestic'); ?>
                            </div>
                        </div>
                        <div class="cart-total">
                            <span class="label"><?php esc_html_e( 'Total', 'komestic' ); ?></span>
                            <span class="pxl-cart-total"><?php echo WC()->cart->get_total(); ?></span>
                        </div>
                        <div class="cart-buttons">
                            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="pxl-button button--primary button-cart">
                                <span class="button__text">
                                    <?php esc_html_e( 'Go to cart', 'komestic' ); ?>
                                </span>
                            </a>
                            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="pxl-button button--primary button-checkout">
                                <span class="button__text">
                                    <?php esc_html_e( 'Checkout', 'komestic' ); ?>
                                </span>
                            </a>
                        </div>

                        <?php
                            pxl_print_html(komestic_section_add_gift_wrap_html());
                            komestic_section_note_html();
                            pxl_print_html(komestic_section_shipping_html());
                        ?>
                    </div>
                </div>

            </div>
        <?php endif; 
    }
}
