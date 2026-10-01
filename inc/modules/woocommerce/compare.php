<?php
add_action('init', function () {
    if (class_exists('WooCommerce') && function_exists('WC')) {
        if (isset(WC()->session) && !WC()->session->has_session()) {
            WC()->session->set_customer_session_cookie(true);
        }
    }
}, 1);

/**
 * Get product to compare
 */
function komestic_get_all_product_ids_compare() {
    if (is_user_logged_in()) {
        $list = get_user_meta(get_current_user_id(), '_my_compare_list', true);
    } else {
        $list = get_transient('compare_' . WC()->session->get_customer_id());
    }
    return is_array($list) ? $list : [];
}

/**
 * Set compare
 */
function komestic_set_compare_list($list) {
    if (is_user_logged_in()) {
        update_user_meta(get_current_user_id(), '_my_compare_list', $list);
    } else {
        set_transient('compare_' . WC()->session->get_customer_id(), $list, DAY_IN_SECONDS);
    }
}

/**
 * Add product to compare
 */
add_action('wp_ajax_komestic_ajax_add_to_compare', 'komestic_ajax_add_to_compare');
add_action('wp_ajax_nopriv_komestic_ajax_add_to_compare', 'komestic_ajax_add_to_compare');
function komestic_ajax_add_to_compare() {
    check_ajax_referer('komestic_nonce', 'security');
    $product_id = intval($_POST['product_id']);
    if (!$product_id || !wc_get_product($product_id)) {
        wp_send_json_error('Invalid product');
    }
    $product_ids = komestic_get_all_product_ids_compare();
    if (!in_array($product_id, $product_ids)) {
        $product_ids[] = $product_id;
        komestic_set_compare_list($product_ids);
    }

    wp_send_json_success([
        '#pxl-compare-list' => komestic_render_compare_list_html(),
        '.pxl-compare-count' => count($product_ids),
    ]);
}

/**
 * Remove product to compare
 */
add_action('wp_ajax_komestic_ajax_remove_from_compare', 'komestic_ajax_remove_from_compare');
add_action('wp_ajax_nopriv_komestic_ajax_remove_from_compare', 'komestic_ajax_remove_from_compare');
function komestic_ajax_remove_from_compare() {
    check_ajax_referer('komestic_nonce', 'security');
    $product_id = intval($_POST['product_id']);
    if (!$product_id || !wc_get_product($product_id)) {
        wp_send_json_error('Invalid product');
    }

    $product_ids = komestic_get_all_product_ids_compare();

    $product_ids = array_diff($product_ids, [$product_id]);
    $product_ids = array_values($product_ids); 

    komestic_set_compare_list($product_ids);

    $compare_list_html = komestic_render_compare_list_html();
    $compare_table_html = komestic_render_compare_table_html();
    if(count($product_ids) <= 0) {
        $compare_list_html = render_compare_empty_html();
        $compare_table_html = render_compare_empty_html();
    }
    wp_send_json_success([
        '#pxl-compare-list' => $compare_list_html,
        '#pxl-compare-table' => $compare_table_html,
        '.pxl-compare-count' => count($product_ids),
    ]);
}

/**
 * Clear product compare in list
 */
add_action('wp_ajax_komestic_ajax_clear_compare', 'komestic_ajax_clear_compare');
add_action('wp_ajax_nopriv_komestic_ajax_clear_compare', 'komestic_ajax_clear_compare');
function komestic_ajax_clear_compare() {
    check_ajax_referer('komestic_nonce', 'security');
    komestic_set_compare_list([]);
    wp_send_json_success([
        '#pxl-compare-list' => render_compare_empty_html(),
        '.pxl-compare-count' => 0,
    ]);
}

/**
 * Get compare list html
 */
function komestic_render_compare_list_html() {
    $product_ids = komestic_get_all_product_ids_compare();
    ob_start();
    if (!empty($product_ids)) {
        foreach ($product_ids as $product_id) {
            $product = wc_get_product($product_id);
            if (!$product || !is_a($product, 'WC_Product')) {
                continue;
            }
            ?>
            <div class="product">
                <a href="<?php echo esc_url(get_permalink($product_id)); ?>" class="product-image">
                    <?php 
                        $thumb_id = $product->get_image_id();
                        if ($thumb_id) {
                            echo wp_get_attachment_image($thumb_id, 'large');
                        }
                    ?>
                    <button class="pxl-button button--close-deactive remove-compare" data-product_id="<?php echo esc_attr($product_id); ?>">
                        <div class="icon-close"></div>
                    </button>
                </a>
                <div class="product-content">
                    <?php komestic_get_product_title($product, 'div', true); ?>
                    <div class="product-price">
                        <?php pxl_print_html($product->get_price_html()); ?>
                    </div>
                </div>
            </div>
            <?php
        }
    } 
    $html = ob_get_clean();
    return $html;
}

/**
 * Render compare table html 
 */
function komestic_render_compare_table_html(){
    $product_ids = komestic_get_all_product_ids_compare();
    $products = array();
    error_log('Current compare list: ' . print_r($product_ids, true));

    // 1. Get all product objects
    if (!empty($product_ids)) {
        foreach ($product_ids as $product_id) {
            $product = wc_get_product($product_id);
            if ($product && is_a($product, 'WC_Product')) {
                $products[] = $product;
            }
        }
    }
    // Fields to display in the comparison table (based on your first image and the second image's structure)
    // Add new compare fields for custom meta
    $compare_fields = array(
        'image'             => esc_html__('Image', 'komestic'),
        'sku'               => esc_html__('SKU', 'komestic'),
        'rating'            => esc_html__('Rating', 'komestic'),
        'price'             => esc_html__('Price', 'komestic'),
        'stock'             => esc_html__('Stock', 'komestic'),
        'availability'      => esc_html__('Availability', 'komestic'),
        'add_to_cart'       => esc_html__('Add to cart', 'komestic'),
        'description'       => esc_html__('Description', 'komestic'),
        'weight'            => esc_html__('Weight', 'komestic'),

        // New custom fields
        'product_tab_2_content' => esc_html__('Ingredients', 'komestic'),
        'product_features'      => esc_html__('Features', 'komestic'),
    );


    // --- Get Product Attributes/Meta Fields (like Vendor, Material, Stone Color, Size) ---
    // This part is crucial for the lower half of your second image.
    $all_attributes_keys = array();
    foreach ($products as $product) {
        $attributes = $product->get_attributes();
        foreach ($attributes as $key => $attribute) {
            if ($attribute->get_terms() || $product->get_meta($key)) {
                // Thay vì str_replace
                $all_attributes_keys[$key] = wc_attribute_label($attribute->get_name());
            }
        }
    }

    // Sort attributes alphabetically for consistent display
    asort($all_attributes_keys);
    $all_fields = array_merge($compare_fields, $all_attributes_keys);
    ob_start();
    if (empty($products)) :
        echo '<p class="woocommerce-info">' . esc_html__('No products selected for comparison.', 'komestic') . '</p>';
        return;
    endif;
    ?>

    <table id="pxl-compare-table" class="product-compare-table table-columns-<?php echo esc_attr(count($product_ids)); ?>">
        <tbody>
            <?php
            // The first row should contain the product header/image/info
            // Instead of putting them in one generic row, we iterate over the main fields (Image, Price, Add to Cart)
            // and then the specific attribute rows (Availability, Vendor, etc.)

            // 1. HEADER ROW (Image, Name, Price, Add to Cart) - Simulating the top part of your second image
            ?>
            <tr class="compare-row-header">
                <th class="compare-header-spacer"></th> 
                <?php foreach ($products as $product) : ?>
                    <td class="compare-product-column product">
                        <button class="pxl-button button--close-deactive remove-compare" data-product_id="<?php echo esc_attr($product->get_id()); ?>">
                            <span class="icon-close"></span>
                        </button>
                        <div class="product-header-content">
                            <?php
                            $image_html = komestic_get_image_by_size([
                                'img_dimension' => ['width' => 767, 'height' => '767'],
                                'attr' => [
                                    'class' => 'product-image',
                                ]
                            ], $product->get_id());
                            pxl_print_html($image_html);
                            ?>
                            <div class="product-title"><a href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($product->get_name()); ?></a></div>
                            <?php
                            echo '<div class="product-price">' . $product->get_price_html() . '</div>';
                            ?>
                            <?php
                            $quick_add_modal = komestic()->get_theme_opt('quick_add_modal', 0);
                            $btn_class = 'pxl-button button--primary add_to_cart_button archive-add-to-cart';
                            $btn_href = $product->add_to_cart_url();
                            if ( $quick_add_modal > 0 && $product->is_type('variable')) {
                                $btn_href = '#template-' . $quick_add_modal;
                                $btn_class .= ' button--quickadd';
                            }elseif($product->is_type('simple')) {
                                if(!$product->is_in_stock()) {
                                    $btn_class .= ' button--quickadd';
                                }else {
                                    $btn_class .= ' ajax_add_to_cart';
                                }
                            }
                            ?>
                            <div class="product-add-to-cart">
                                <a href="<?php echo esc_url( $btn_href ); ?>"
                                class="<?php echo esc_attr($btn_class); ?>"
                                data-product_id="<?php echo esc_attr( $product->get_id() ); ?>">
                                    <span class="button__text"><?php echo esc_html('Add To Cart'); ?></span>
                                </a>
                            </div>
                        </div>
                    </td>
                <?php endforeach; ?>
            </tr>

            <?php
            // 2. MAIN FIELD ROWS (Availability, Stock, Rating, etc.)
            $main_fields_to_row = array('availability', 'sku', 'rating', 'weight', 'description'); // Fields to display as a simple row (you can customize this)

            foreach ($all_fields as $field_key => $field_name) :
                if (in_array($field_key, array('image', 'price', 'add_to_cart'))) {
                    continue;
                }
                
                
                if ( !array_key_exists($field_key, $compare_fields) && !array_key_exists($field_key, $all_attributes_keys) ) {
                    continue; 
                }
            ?>
                <tr class="compare-row compare-row-<?php echo esc_attr($field_key); ?>">
                    <th><?php echo esc_html($field_name); ?></th>
                    <?php foreach ($products as $product) : ?>
                        <td>
                            <?php
                            switch ($field_key) {
                                case 'availability':
                                    $stock_status = $product->get_stock_status();
                                    $in_stock = $stock_status === 'instock';
                                    echo '<span class="' . ($in_stock ? 'in-stock' : 'out-of-stock') . '">';
                                    pxl_print_html($in_stock ? '<i class="dashicons dashicons-yes"></i> ' . esc_html__('In Stock', 'komestic') : '<i class="dashicons dashicons-no-alt"></i> ' . esc_html__('Out of Stock', 'komestic'));
                                    echo '</span>';
                                    break;

                                case 'sku':
                                    echo esc_html($product->get_sku() ?: '—');
                                    break;

                                case 'rating':
                                    echo wc_get_rating_html($product->get_average_rating());
                                    break;

                                case 'weight':
                                    echo esc_html($product->get_weight() ? wc_format_weight($product->get_weight()) : '—');
                                    break;

                                case 'description':
                                    echo wp_kses_post($product->get_short_description());
                                    break;

                                case 'product_tab_2_content':
                                    $tab_content = $product->get_meta('product_tab_2_content');
                                    pxl_print_html($tab_content ? wpautop(wp_kses_post($tab_content)) : '—');
                                    break;

                                case 'product_features':
                                    $features = $product->get_meta('product_features');
                                    if (!empty($features) && is_array($features)) {
                                        echo '<ul class="product-features">';
                                        foreach ($features as $feature) {
                                            echo '<li>' . esc_html($feature) . '</li>';
                                        }
                                        echo '</ul>';
                                    } else {
                                        echo '—';
                                    }
                                    break;

                                default:
                                    // Handle attributes
                                    if (array_key_exists($field_key, $all_attributes_keys)) {
                                        $value = $product->get_attribute($field_key);
                                        echo esc_html($value ?: '—');
                                    } else {
                                        echo '—';
                                    }
                                    break;
                                }
                            ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    return ob_get_clean();
}

/**
 * Count products in compare
 */
function komestic_compare_count() {
    $product_ids = komestic_get_all_product_ids_compare();
    if(empty($product_ids)) {
        return 0;
    }
    return count($product_ids);
}

/**
 * Is product in comapre
 */
function komestic_is_product_in_compare($product_id) {
    $product_ids = komestic_get_all_product_ids_compare();
    if(empty($product_id) || !in_array($product_id, $product_ids)) {
        return false;
    }
    return true;
}

/**
 * Compare Empty
 */
function render_compare_empty_html() {
    return '<p class="compare-empty">'.esc_html__('No product found!', 'komestic').'</p>';
}

/**
 * Button Compare Html
 */
function komestic_render_compare_button_html($product_id) {
    $compare_products_modal = komestic()->get_theme_opt('compare_products_modal', 0);
    if($compare_products_modal <= 0) return;
    if ( !has_action( 'pxl_anchor_target_template_'.$compare_products_modal ) ) {
        add_action( 'pxl_anchor_target_template_'.$compare_products_modal, 'komestic_hook_anchor_panel' );
    }
    $is_in_compare = komestic_is_product_in_compare($product_id);
    ?>
        <a href="#template-<?php echo esc_attr($compare_products_modal); ?>" class="pxl-button button--shop-action button--compare<?php if($is_in_compare){ echo ' added'; } ?>" data-product_id="<?php echo esc_attr($product_id); ?>">
            <i class="flaticon-compare"></i>
        </a>
    <?php
}