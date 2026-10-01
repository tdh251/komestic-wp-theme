<?php
/**
 * WooCommerce product related helper functions.
 *
 * @package Komestic_Theme
 * @subpackage WooCommerce
 */


function get_product_categories_to_product_id($product_id = 0) {
    if (empty($product_id)) {
        return '';
    }

    $product_categories = wc_get_product_terms( $product_id, 'product_cat', array( 'fields' => 'all' ) );

    ob_start();
    ?>
    <div class="product-categories">
        <?php
        if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) {
            $cat_links = array();
            foreach ( $product_categories as $category ) {
                $cat_links[] = '<a href="' . esc_url( get_term_link( $category->term_id, 'product_cat' ) ) . '">' . esc_html( $category->name ) . '</a>';
            }
            echo implode( ', ', $cat_links );
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}

function komestic_display_sale_percentage_label_html($product = null, $prefix = '', $suffix = '') {
    if (is_null($product) || !$product->is_on_sale()) {
        return '';
    }

    $regular_price = $product->get_regular_price(); 
    $sale_price    = $product->get_sale_price();  

    if (!empty($regular_price) && $regular_price > 0 && $sale_price < $regular_price) {
        $discount_amount = $regular_price - $sale_price;
        $percentage = ($discount_amount / $regular_price) * 100;

        return '<span class="product-label product-label--onsale">'
            . esc_html($prefix . round($percentage)) . esc_html($suffix)
            . '</span>';
    } else {
        return '<span class="product-label product-label--onsale">'
            . esc_html__('Sale', 'komestic')
            . '</span>';
    }
}


/**
 * Đếm số lượng đơn hàng của một sản phẩm trong ngày hiện tại.
 *
 * @param int $product_id ID của sản phẩm.
 * @return int Tổng số đơn hàng chứa sản phẩm đó trong ngày hôm nay.
 */
function count_product_orders_for_today( $product_id ) {
    global $wpdb;
    $today = current_time( 'Y-m-d' );
    $start_date = $today . ' 00:00:00';
    $end_date   = $today . ' 23:59:59';

    $order_statuses = array( 'wc-processing', 'wc-completed' );
    $statuses_string = "'" . implode( "','", $order_statuses ) . "'";

    $query = $wpdb->prepare(
        "
        SELECT COUNT(DISTINCT oi.order_id)
        FROM {$wpdb->prefix}woocommerce_order_itemmeta oim
        JOIN {$wpdb->prefix}woocommerce_order_items oi ON oim.order_item_id = oi.order_item_id
        JOIN {$wpdb->prefix}posts p ON oi.order_id = p.ID
        WHERE oim.meta_key = '_product_id'
        AND oim.meta_value = %d
        AND p.post_type = 'shop_order'
        AND p.post_status IN ({$statuses_string})
        AND p.post_date >= %s
        AND p.post_date <= %s
        ",
        $product_id,
        $start_date,
        $end_date
    );

    $order_count = $wpdb->get_var( $query );

    return (int) $order_count;
}

function display_new_product_label($product = 0) {
    if (empty($product)) {
        return;
    }

    $product_created_date = $product->get_date_created();

    try {
        if (!($product_created_date instanceof DateTime)) {
            $product_created_date = new DateTime($product_created_date);
        }
    } catch (Exception $e) {
        return;
    }

    $current_date = new DateTime();

    $interval = $current_date->diff($product_created_date);
    $days_since_creation = $interval->days;

    $new_product_threshold_days = 15;

    if ($days_since_creation <= $new_product_threshold_days) {
        ?>
        <span class="product-label product-label--new">
            <?php echo esc_html__('New', 'komestic'); ?>
        </span>
        <?php
    }
}

function selling_fast_bar_html($percent) {
    $random_id = 'linearGradient-' . uniqid();
    $percent = ( $percent === 0 ) ? 'Sale' : $percent.'% Off';
    ?>
        <div class="pxl-text-marquee">
            <p class="text-marquee-item main">
                <?php echo esc_html__('Selling Fast', 'komestic'); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M14.7479 6.62681C14.6603 6.44449 14.476 6.32813 14.2731 6.32813H10.9071L13.6901 0.763207C13.7714 0.599941 13.7632 0.405809 13.6674 0.250277C13.5706 0.0947461 13.4007 0 13.2184 0H6.89024C6.67087 0 6.47413 0.136477 6.3969 0.341965L3.23283 8.77947C3.17205 8.94168 3.19472 9.12298 3.29256 9.26508C3.39146 9.40722 3.55314 9.49219 3.72618 9.49219H7.26926L5.32365 17.3449C5.26392 17.5854 5.37926 17.8352 5.60173 17.9454C5.82353 18.0547 6.09188 17.996 6.24752 17.8022L14.685 7.18506C14.8118 7.02643 14.8365 6.80963 14.7479 6.62681Z" fill="<?php echo esc_attr('url(#'.$random_id.')'); ?>"/>
                </svg>
                <?php echo esc_html($percent); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M14.7479 6.62681C14.6603 6.44449 14.476 6.32813 14.2731 6.32813H10.9071L13.6901 0.763207C13.7714 0.599941 13.7632 0.405809 13.6674 0.250277C13.5706 0.0947461 13.4007 0 13.2184 0H6.89024C6.67087 0 6.47413 0.136477 6.3969 0.341965L3.23283 8.77947C3.17205 8.94168 3.19472 9.12298 3.29256 9.26508C3.39146 9.40722 3.55314 9.49219 3.72618 9.49219H7.26926L5.32365 17.3449C5.26392 17.5854 5.37926 17.8352 5.60173 17.9454C5.82353 18.0547 6.09188 17.996 6.24752 17.8022L14.685 7.18506C14.8118 7.02643 14.8365 6.80963 14.7479 6.62681Z" fill="<?php echo esc_attr('url(#'.$random_id.')'); ?>"/>
                </svg>
                <?php echo esc_html__('Selling Fast', 'komestic'); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M14.7479 6.62681C14.6603 6.44449 14.476 6.32813 14.2731 6.32813H10.9071L13.6901 0.763207C13.7714 0.599941 13.7632 0.405809 13.6674 0.250277C13.5706 0.0947461 13.4007 0 13.2184 0H6.89024C6.67087 0 6.47413 0.136477 6.3969 0.341965L3.23283 8.77947C3.17205 8.94168 3.19472 9.12298 3.29256 9.26508C3.39146 9.40722 3.55314 9.49219 3.72618 9.49219H7.26926L5.32365 17.3449C5.26392 17.5854 5.37926 17.8352 5.60173 17.9454C5.82353 18.0547 6.09188 17.996 6.24752 17.8022L14.685 7.18506C14.8118 7.02643 14.8365 6.80963 14.7479 6.62681Z" fill="<?php echo esc_attr('url(#'.$random_id.')'); ?>"/>
                </svg>
                <?php echo esc_html($percent); ?>
            </p>
            <p class="text-marquee-item duplicated">
                <?php echo esc_html__('Selling Fast', 'komestic'); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M14.7479 6.62681C14.6603 6.44449 14.476 6.32813 14.2731 6.32813H10.9071L13.6901 0.763207C13.7714 0.599941 13.7632 0.405809 13.6674 0.250277C13.5706 0.0947461 13.4007 0 13.2184 0H6.89024C6.67087 0 6.47413 0.136477 6.3969 0.341965L3.23283 8.77947C3.17205 8.94168 3.19472 9.12298 3.29256 9.26508C3.39146 9.40722 3.55314 9.49219 3.72618 9.49219H7.26926L5.32365 17.3449C5.26392 17.5854 5.37926 17.8352 5.60173 17.9454C5.82353 18.0547 6.09188 17.996 6.24752 17.8022L14.685 7.18506C14.8118 7.02643 14.8365 6.80963 14.7479 6.62681Z" fill="<?php echo esc_attr('url(#'.$random_id.')'); ?>"/>
                </svg>
                <?php echo esc_html($percent); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M14.7479 6.62681C14.6603 6.44449 14.476 6.32813 14.2731 6.32813H10.9071L13.6901 0.763207C13.7714 0.599941 13.7632 0.405809 13.6674 0.250277C13.5706 0.0947461 13.4007 0 13.2184 0H6.89024C6.67087 0 6.47413 0.136477 6.3969 0.341965L3.23283 8.77947C3.17205 8.94168 3.19472 9.12298 3.29256 9.26508C3.39146 9.40722 3.55314 9.49219 3.72618 9.49219H7.26926L5.32365 17.3449C5.26392 17.5854 5.37926 17.8352 5.60173 17.9454C5.82353 18.0547 6.09188 17.996 6.24752 17.8022L14.685 7.18506C14.8118 7.02643 14.8365 6.80963 14.7479 6.62681Z" fill="<?php echo esc_attr('url(#'.$random_id.')'); ?>"/>
                </svg>
                <?php echo esc_html__('Selling Fast', 'komestic'); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M14.7479 6.62681C14.6603 6.44449 14.476 6.32813 14.2731 6.32813H10.9071L13.6901 0.763207C13.7714 0.599941 13.7632 0.405809 13.6674 0.250277C13.5706 0.0947461 13.4007 0 13.2184 0H6.89024C6.67087 0 6.47413 0.136477 6.3969 0.341965L3.23283 8.77947C3.17205 8.94168 3.19472 9.12298 3.29256 9.26508C3.39146 9.40722 3.55314 9.49219 3.72618 9.49219H7.26926L5.32365 17.3449C5.26392 17.5854 5.37926 17.8352 5.60173 17.9454C5.82353 18.0547 6.09188 17.996 6.24752 17.8022L14.685 7.18506C14.8118 7.02643 14.8365 6.80963 14.7479 6.62681Z" fill="<?php echo esc_attr('url(#'.$random_id.')'); ?>"/>
                    <defs>
                        <linearGradient id="<?php echo esc_attr($random_id); ?>" x1="8.99986" y1="18" x2="8.99986" y2="0" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#FD5900"/>
                        <stop offset="1" stop-color="#FFDE00"/>
                        </linearGradient>
                    </defs>
                </svg>
                <?php echo esc_html($percent); ?>
            </p>
        </div>
    <?php
}

/**
 * Count Product in 
 */
function komestic_count_products_by_stock($is_in_stock  = true) {
    $in_stock = ($is_in_stock) ? 'instock' : 'outofstock';
    $args = [
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'meta_query'     => [
            [
                'key'     => '_stock_status',
                'value'   => $in_stock,
                'compare' => '='
            ]
        ]
    ];
    $query = new WP_Query($args);
    return $query->found_posts;
}

/**
 * Create Sidebar Filter on Shop Page
 */
function komestic_add_filter_sidebar_products() {
    if(class_exists('Woocommerce') && function_exists('is_shop') && is_shop()) {
    ?>
        <div class="sidebar sidebar--shop-filter pxl-drawer" data-drawer="left">
            <div class="product-filter">
                <div class="product-filter__inner">
                    <form action="<?php echo wc_get_page_permalink( 'shop' ); ?>" class="product-filter__form">
                        <button type="submit"> Submit</button>
                    <div class="product-filter__section product-filter__section--category">
                        <h6 class="product-filter__section-header">
                            <span>
                                <?php echo esc_html__("Categories", 'komestic'); ?>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <path d="M7.42899 3.82906L0.236257 11.0242C-0.0786644 11.3399 -0.0786644 11.8514 0.236257 12.1679C0.551176 12.4837 1.06269 12.4837 1.37761 12.1679L7.99963 5.54352L14.6217 12.1671C14.9366 12.4829 15.4481 12.4829 15.7638 12.1671C16.0787 11.8514 16.0787 11.3391 15.7638 11.0234L8.57114 3.82827C8.25948 3.5174 7.73993 3.5174 7.42899 3.82906Z" fill="currentcolor"/>
                            </svg>
                        </h6>
                        <div class="product-filter__section-content">
                            <ul class="product-filter__list">
                                <?php 
                                    $categories = get_terms( 'product_cat', ['hide_empty' => false]);
                                    $selected_cats = isset($_GET['product_cat']) ? (array) $_GET['product_cat'] : [];
                                    if(!empty($categories)) {
                                        foreach($categories as $key => $category) { ?>
                                            <li class="product-filter__list-item">
                                                <a href="<?php echo esc_url(get_term_link( $category )); ?>"><?php echo esc_html($category->name.' [ '.$category->count.' ] '); ?></a>
                                            </li>
                                        <?php }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                        $product_count_instock = komestic_count_products_by_stock();
                        $product_count_outofstock = komestic_count_products_by_stock(false);
                    ?>
                    <div class="product-filter__section product-filter__section--availability">
                        <h6 class="product-filter__section-header">
                            <span>
                                <?php echo esc_html__("Availability", 'komestic'); ?>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <path d="M7.42899 3.82906L0.236257 11.0242C-0.0786644 11.3399 -0.0786644 11.8514 0.236257 12.1679C0.551176 12.4837 1.06269 12.4837 1.37761 12.1679L7.99963 5.54352L14.6217 12.1671C14.9366 12.4829 15.4481 12.4829 15.7638 12.1671C16.0787 11.8514 16.0787 11.3391 15.7638 11.0234L8.57114 3.82827C8.25948 3.5174 7.73993 3.5174 7.42899 3.82906Z" fill="currentcolor"/>
                            </svg>
                        </h6>
                        <div class="product-filter__section-content">
                            <ul class="product-filter__list">
                                <li class="product-filter__list-item">
                                    <label for="produc_in_stock" class="product-filter__field product-filter-field--checkbox">
                                        <span class="product-filter__field-group">
                                            <svg class="product-filter__field-tick" xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9">
                                                <path d="M4.27183 7.28352L0.81519 3.64176L0 4.5L4.27183 9L12 0.858241L11.1848 0L4.27183 7.28352Z" fill="currentcolor"/>
                                            </svg>
                                            <input type="radio" class="product-filter__field-input" name="stock_status" value="instock" id="produc_in_stock">
                                        </span>
                                        <span class="product-filter__field-title">
                                            <?php echo esc_html('In Stock'); ?>
                                            <span class="product-filter__count">
                                                <?php echo esc_html('[ '.$product_count_instock.' ]'); ?>
                                            </span>
                                        </span>
                                    </label>
                                </li>
                                <li class="product-filter__list-item">
                                    <label for="produc_out_of_stock" class="product-filter__field product-filter-field--checkbox">
                                        <span class="product-filter__field-group">
                                            <svg class="product-filter__field-tick" xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9">
                                                <path d="M4.27183 7.28352L0.81519 3.64176L0 4.5L4.27183 9L12 0.858241L11.1848 0L4.27183 7.28352Z" fill="currentcolor"/>
                                            </svg>
                                            <input type="radio" class="product-filter__field-input" name="stock_status" value="outofstock" id="produc_out_of_stock">
                                        </span>
                                        <span class="product-filter__field-title">
                                            <?php echo esc_html('Out Of Stock'); ?>
                                            <span class="product-filter__count">
                                                <?php echo esc_html('[ '.$product_count_outofstock.' ]'); ?>
                                            </span>
                                        </span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <?php 
                            $brands = get_terms( 'product_brand', ['hide_empty' => false]);
                        ?>
                    </div>
                    <div class="product-filter__section product-filter__section--brand">
                        <h6 class="product-filter__section-header">
                            <span>
                                <?php echo esc_html__("Brands", 'komestic'); ?>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <path d="M7.42899 3.82906L0.236257 11.0242C-0.0786644 11.3399 -0.0786644 11.8514 0.236257 12.1679C0.551176 12.4837 1.06269 12.4837 1.37761 12.1679L7.99963 5.54352L14.6217 12.1671C14.9366 12.4829 15.4481 12.4829 15.7638 12.1671C16.0787 11.8514 16.0787 11.3391 15.7638 11.0234L8.57114 3.82827C8.25948 3.5174 7.73993 3.5174 7.42899 3.82906Z" fill="currentcolor"/>
                            </svg>
                        </h6>
                        <div class="product-filter__section-content">
                            <ul class="product-filter__list">
                                <?php if(!empty($brands)) : ?>
                                    <?php foreach($brands as $key => $brand) : ?>
                                        <li class="product-filter__list-item">
                                            <label for="<?php echo esc_attr($brand->slug.'-'.$key) ?>" class="product-filter__field product-filter-field--checkbox">
                                                <span class="product-filter__field-group">
                                                    <svg class="product-filter__field-tick" xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9">
                                                        <path d="M4.27183 7.28352L0.81519 3.64176L0 4.5L4.27183 9L12 0.858241L11.1848 0L4.27183 7.28352Z" fill="currentcolor"/>
                                                    </svg>
                                                    <input type="checkbox" class="product-filter__field-input" name="brand[]" value="<?php echo esc_attr($brand->slug); ?>" id="<?php echo esc_attr($brand->slug.'-'.$key); ?>">
                                                </span>
                                                <span class="product-filter__field-title">
                                                    <?php echo esc_html($brand->name); ?>
                                                    <span class="product-filter__count">
                                                        <?php echo esc_html('[ '.$brand->count.' ]'); ?>
                                                    </span>
                                                </span>
                                            </label>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="pxl-notification"><?php echo esc_html__('Brand Not Found!', 'komestic'); ?></div>
                                <?php endif;  ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                        $color_terms = get_terms( array(
                            'taxonomy'   => wc_attribute_taxonomy_name( 'color' ),
                            'hide_empty' => false,
                        ) );
                    ?>
                    <div class="product-filter__section product-filter__section--attr">
                        <h6 class="product-filter__section-header">
                            <span>
                                <?php echo esc_html__("Color", 'komestic'); ?>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <path d="M7.42899 3.82906L0.236257 11.0242C-0.0786644 11.3399 -0.0786644 11.8514 0.236257 12.1679C0.551176 12.4837 1.06269 12.4837 1.37761 12.1679L7.99963 5.54352L14.6217 12.1671C14.9366 12.4829 15.4481 12.4829 15.7638 12.1671C16.0787 11.8514 16.0787 11.3391 15.7638 11.0234L8.57114 3.82827C8.25948 3.5174 7.73993 3.5174 7.42899 3.82906Z" fill="currentcolor"/>
                            </svg>
                        </h6>
                        <div class="product-filter__section-content">
                            <ul class="product-filter__list">
                                <?php foreach($color_terms as $key => $term) : ?>
                                    <li class="product-filter__list-item">
                                        <label for="<?php echo esc_attr($term->slug.'-'.$key) ?>" class="product-filter__field product-filter-field--checkbox">
                                            <span class="product-filter__field-group">
                                                <svg class="product-filter__field-tick" xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9">
                                                    <path d="M4.27183 7.28352L0.81519 3.64176L0 4.5L4.27183 9L12 0.858241L11.1848 0L4.27183 7.28352Z" fill="currentcolor"/>
                                                </svg>
                                                <input type="checkbox" class="product-filter__field-input" name="pa_color" value="pa_color[]" id="<?php echo esc_attr($term->slug.'-'.$key); ?>">
                                            </span>
                                            <span class="product-filter__field-title">
                                                <?php echo esc_html($term->name); ?>
                                                <span class="product-filter__count">
                                                    <?php echo esc_html('[ '.$term->count.' ]'); ?>
                                                </span>
                                            </span>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                        $size_terms = get_terms( array(
                            'taxonomy'   => wc_attribute_taxonomy_name( 'size' ),
                            'hide_empty' => false,
                        ) );
                    ?>
                    <div class="product-filter__section product-filter__section--attr">
                        <h6 class="product-filter__section-header">
                            <span>
                                <?php echo esc_html__("Size", 'komestic'); ?>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <path d="M7.42899 3.82906L0.236257 11.0242C-0.0786644 11.3399 -0.0786644 11.8514 0.236257 12.1679C0.551176 12.4837 1.06269 12.4837 1.37761 12.1679L7.99963 5.54352L14.6217 12.1671C14.9366 12.4829 15.4481 12.4829 15.7638 12.1671C16.0787 11.8514 16.0787 11.3391 15.7638 11.0234L8.57114 3.82827C8.25948 3.5174 7.73993 3.5174 7.42899 3.82906Z" fill="currentcolor"/>
                            </svg>
                        </h6>
                        <div class="product-filter__section-content">
                            <ul class="product-filter__list">
                                <?php foreach($size_terms as $key => $term) : ?>
                                    <li class="product-filter__list-item">
                                        <label for="<?php echo esc_attr($term->slug.'-'.$key) ?>" class="product-filter__field product-filter-field--checkbox">
                                            <span class="product-filter__field-group">
                                                <svg class="product-filter__field-tick" xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9">
                                                    <path d="M4.27183 7.28352L0.81519 3.64176L0 4.5L4.27183 9L12 0.858241L11.1848 0L4.27183 7.28352Z" fill="currentcolor"/>
                                                </svg>
                                                <input type="checkbox" class="product-filter__field-input" name="pa_size" value="pa_size[]" id="<?php echo esc_attr($term->slug.'-'.$key); ?>">
                                            </span>
                                            <span class="product-filter__field-title">
                                                <?php echo esc_html($term->name); ?>
                                                <span class="product-filter__count">
                                                    <?php echo esc_html('[ '.$term->count.' ]'); ?>
                                                </span>
                                            </span>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                            
                    </form>
                </div>
            </div>
        </div>
    <?php
    }
}

/**
 * Get all product categories with pagination
 *
 */
function komestic_get_product_categories($args = []) {
    $parsed_args = array_merge([
        'orderby'        => 'name',
        'order'          => 'ASC',
        'limit'          => 6,
        'hide_cat_empty' => false,
        'include_ids'    => [],
    ], $args);

    $orderby        = $parsed_args['orderby'];
    $order          = $parsed_args['order'];
    $posts_per_page = intval($parsed_args['limit']);
    $hide_cat_empty = (bool) $parsed_args['hide_cat_empty'];
    $include_ids    = array_map('intval', array_filter($parsed_args['include_ids']));

    $paged = max(1, get_query_var('paged', 1));
    $max_num_pages = 1; // default
    $found_terms   = 0;

    // Đếm tổng số category để tính phân trang
    $total_categories_args = [
        'taxonomy'   => 'product_cat',
        'hide_empty' => $hide_cat_empty,
        'fields'     => 'count',
    ];
    if (!empty($include_ids)) {
        $total_categories_args['include'] = $include_ids;
    }

    $total_categories = wp_count_terms($total_categories_args);
    if (!is_wp_error($total_categories)) {
        $found_terms = (int) $total_categories;
    }

    if ($posts_per_page > 0 && $found_terms > 0) {
        $max_num_pages = ceil($found_terms / $posts_per_page);
        $offset        = ($paged - 1) * $posts_per_page;
    } else {
        $offset = 0;
    }

    // Args cho WP_Term_Query
    $term_query_args = [
        'taxonomy'   => 'product_cat',
        'orderby'    => $orderby,
        'order'      => $order,
        'hide_empty' => $hide_cat_empty,
        'number'     => $posts_per_page > 0 ? $posts_per_page : 0,
        'offset'     => $offset,
    ];

    if (!empty($include_ids)) {
        $term_query_args['include'] = $include_ids;
    }

    // Query
    $query = new WP_Term_Query($term_query_args);

    // Thêm property giống WP_Query
    $query->found_terms   = $found_terms;
    $query->max_num_pages = $max_num_pages;
    $query->paged         = $paged;

    if (is_wp_error($query) || empty($query->terms)) {
        return [
            'categories' => [],
            'max_pages'  => 0,
            'paged'      => $paged,
            'query'      => $query,
        ];
    }

    return [
        'categories' => $query->terms, // danh sách term
        'max_pages'  => $max_num_pages,
        'paged'      => $paged,
        'query'      => $query,     
    ];
}


/**
 * Get all product
 */
function komestic_get_products($args = []) {
    $has_filter = false;
    $default_args = [
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => 12,
    ];
    $args = array_merge($default_args, $args);
    $tax_query = [];
    $meta_query = [];
    $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
    $paged = (get_query_var('page')) ? absint(get_query_var('page')) : $paged;


    $sort = isset($_GET['sort']) && !empty($_GET['sort']) ? $_GET['sort'] : null;

    if(!is_null($sort)) {
        $sort_arr = explode('-', $sort);
        if(is_array($sort_arr)) {
            $sort_orderby = $sort_arr[0];
            $sort_order = $sort_arr[1];
            $args['order'] = $sort_order;
            $args['orderby'] = $sort_orderby;
            if($sort_orderby === 'price') {
                $args['meta_key'] = '_price';
                $args['orderby'] = 'meta_value_num';
            }
        } else {
            if($sort === 'featured') {
                $tax_query[] = [
                    'taxonomy' => 'product_visibility',
                    'field'    => 'slug',
                    'terms'    => 'featured', 
                ];
            }
        }
    }
    $query_args = array_merge(
        array(
            'post_type'      => 'product',
            'paged'          => $paged,
            'post_status'    => 'publish',
        ),
        $args
    );

    
    if (isset($_GET['cat']) && !empty($_GET['cat'])) {
        $categories = explode(',', sanitize_text_field($_GET['cat']));
        $tax_query[] = array(
            'taxonomy' => 'product_cat', 
            'field'    => 'slug',
            'terms'    => $categories,
            'operator' => 'IN'
        );
        $has_filter = true;
    }

    if (isset($_GET['brand']) && !empty($_GET['brand'])) {
        $brands = explode(',', sanitize_text_field($_GET['brand']));
        $tax_query[] = array(
            'taxonomy' => 'product_brand', 
            'field'    => 'slug',
            'terms'    => $brands,
            'operator' => 'IN'
        );
        $has_filter = true;
    }
    
    if (isset($_GET['color']) && !empty($_GET['color'])) {
        $colors = explode(',', sanitize_text_field($_GET['color']));
        $tax_query[] = array(
            'taxonomy' => 'pa_color', 
            'field'    => 'slug',
            'terms'    => $colors,
            'operator' => 'IN'
        );
        $has_filter = true;
    }

    if (isset($_GET['size']) && !empty($_GET['size'])) {
        $sizes = explode(',', sanitize_text_field($_GET['size']));
        $tax_query[] = array(
            'taxonomy' => 'pa_size',
            'field'    => 'slug',
            'terms'    => $sizes,
            'operator' => 'IN'
        );
        $has_filter = true;
    }

    if (isset($_GET['availability']) && !empty($_GET['availability'])) {
        $availability = sanitize_text_field($_GET['availability']);
        if ($availability === 'in-stock') {
             $query_args['meta_query'][] = array(
                'key'     => '_stock_status',
                'value'   => 'instock',
            );
        } elseif ($availability === 'out-of-stock') {
            $query_args['meta_query'][] = array(
                'key'     => '_stock_status',
                'value'   => 'outofstock',
            );
        }
        $has_filter = true;
    }

    if (isset($_GET['min_price']) && isset($_GET['max_price'])) {
        $min_price = floatval($_GET['min_price']);
        $max_price = floatval($_GET['max_price']);
        
        if ($min_price >= 0 && $max_price > $min_price) {
            $meta_query[] = array(
                'key'     => '_price',
                'value'   => array($min_price, $max_price),
                'type'    => 'NUMERIC',
                'compare' => 'BETWEEN',
            );
        }
        $has_filter = true;
    }
    
    if (!empty($tax_query)) {
        $query_args['tax_query'] = $tax_query;
        if (count($tax_query) > 1) {
            $query_args['tax_query']['relation'] = 'AND';
        }
    }

    if (!empty($meta_query)) {
        $query_args['meta_query'] = $meta_query;
        if (count($meta_query) > 1) {
            $query_args['meta_query']['relation'] = 'AND';
        }
    }

    $products_query = new WP_Query($query_args);
    $products = $products_query->posts;

    return [
        'products' => $products,
        'query'    => $products_query,
        'has_filter' => $has_filter
    ];
}

/**
 * Get count rating by product
 */
function komestic_get_star_rating_counts( $product_id ) {
    global $wpdb;
    $rating_counts = array(
        '1' => 0,
        '2' => 0,
        '3' => 0,
        '4' => 0,
        '5' => 0,
    );

    $comments = get_comments( array(
        'post_id' => $product_id,
        'status'  => 'approve',
        'type'    => 'review',
    ) );

    foreach ( $comments as $comment ) {
        $rating = get_comment_meta( $comment->comment_ID, 'rating', true );
        
        if ( isset( $rating_counts[ $rating ] ) ) {
            $rating_counts[ $rating ]++;
        }
    }

    return $rating_counts;
}


function komestic_get_all_pa() {
    if(!class_exists('Woocommerce')) return [];

    $attribute_taxonomies = wc_get_attribute_taxonomies();
    $options = [];
    if ( ! empty( $attribute_taxonomies ) ) {
        $options[0] = 'None';
        foreach ( $attribute_taxonomies as $tax ) {
            $options[$tax->attribute_id] = $tax->attribute_label;
        }
    }
    return $options;
}

function komestic_get_pa_term_display_in_box_thumbnail($product, $tax_id) {
    $attrs = $product->get_attributes();
    $attr_ids = [];
    $html = '';
    foreach ( $attrs as $attr ) {
        if ( $attr->is_taxonomy() ) {
            $taxonomy = $attr->get_name(); 
            $attr_obj = wc_get_attribute( wc_attribute_taxonomy_id_by_name( $taxonomy ) );
            if ( $tax_id == $attr_obj->id ) {
                $terms = wp_get_post_terms( $product->get_id(), $taxonomy );
                ob_start();
                ?>
                <ul class="pa_terms" data-pa="<?php echo esc_attr($taxonomy); ?>"> 
                    <?php foreach ( $terms as $term ) { ?>
                        <li class="pa_term"><?php echo esc_html($term->name); ?></li>
                    <?php } ?>
                </ul>
                <?php
                $html = ob_get_clean();
                return $html;
            }
        }
    }
    return $html;
}

/**
 * Get Min - Max Price
 */
function komestic_get_min_max_price() {
    global $wpdb;

    $min_price = $wpdb->get_var("
        SELECT MIN(meta_value+0) 
        FROM {$wpdb->postmeta} 
        WHERE meta_key = '_price'
    ");
    
    $max_price = $wpdb->get_var("
        SELECT MAX(meta_value+0) 
        FROM {$wpdb->postmeta} 
        WHERE meta_key = '_price'
    ");

    return [
        'min' => $min_price,
        'max' => $max_price
    ];
}

/**
 * Get Drawer Sidebar Filter
 */
function komestic_get_template_shop_filter_id() {
    $shop_drawer_filter = (int) komestic()->get_theme_opt( 'shop_drawer_filter', 0 );

    if ( $shop_drawer_filter === 0 ) {
        return '#';
    }

    if ( !has_action( 'pxl_anchor_target_template_' . $shop_drawer_filter ) ) {
        add_action( 'pxl_anchor_target_template_' . $shop_drawer_filter, 'komestic_hook_anchor_panel' );
    }

    return '#template-' . $shop_drawer_filter;
}

/**
 * Get products html with filter
 */
function komestic_get_products_filter_html($args = [], $params = [], $layout = 'grid') {
    // check_ajax_referer( 'komestic_nonce', 'security' );
    $paged      = isset( $_POST['paged'] ) ? intval( $_POST['paged'] ) : 1;
    $posts_per_page = komestic()->get_theme_opt('products_per_page', 12);
    $tax_query  = [];
    $meta_query = [];
    $gift_wrap_id = komestic_get_gift_package()['id'];
    $defaults       = [
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page,
        'orderby'        => [
            'menu_order' => 'ASC',
            'title'      => 'ASC',
        ],
        'order'          => 'ASC',
        'paged'          => $paged,
        'ignore_sticky_posts' => true,
        'post__not_in' => [$gift_wrap_id]
    ];
    $args = wp_parse_args( $args, $defaults );

    $filter_keys = []; 
    if(!empty($params)) {
        /** ---------------- SORT ---------------- */
        $sort = isset($params['sort']) ? sanitize_text_field($params['sort']) : '';
        if ($sort === 'featured') {
            $tax_query[] = [
                'taxonomy' => 'product_visibility',
                'field'    => 'slug',
                'terms'    => 'featured',
            ];
        } elseif($sort === 'best-selling') {
            $args['meta_key'] = 'total_sales';
            $args['orderby']  = 'meta_value_num';
            $args['order']    = 'DESC';
        } elseif (strpos($sort, '-') !== false) {
            $sort_arr     = explode('-', $sort);
            $sort_orderby = $sort_arr[0] ?? '';
            $sort_order   = $sort_arr[1] ?? 'ASC';
            $args['order']   = $sort_order;
            $args['orderby'] = $sort_orderby;
    
            if ($sort_orderby === 'price') {
                $args['meta_key'] = '_price';
                $args['orderby']  = 'meta_value_num';
            }
        }
    
        /** ---------------- CATEGORY ---------------- */
        $product_cat = isset($params['product_cat']) ? sanitize_text_field($params['product_cat']) : '';
        if (!empty($product_cat)) {
            $tax_query[] = [
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $product_cat,
                'operator' => 'IN'
            ];
            $filter_keys['product_cat'] = $product_cat;
        }
    
        /** ---------------- STOCK STATUS ---------------- */
        $stock_status = isset($params['stock_status']) ? sanitize_text_field($params['stock_status']) : '';
        if (!empty($stock_status)) {
            $meta_query[] = [
                'key'   => '_stock_status',
                'value' => $stock_status,
            ];
            $filter_keys['stock_status'] = $stock_status;
        }
    
        /** ---------------- BRAND ---------------- */
        $product_brand = isset($params['product_brand']) ? (array) $params['product_brand'] : [];
        $product_brand = array_map('sanitize_text_field', $product_brand);
        if (!empty($product_brand)) {
            $tax_query[] = [
                'taxonomy' => 'product_brand',
                'field'    => 'slug',
                'terms'    => $product_brand,
                'operator' => 'IN'
            ];
            $filter_keys['brand[]'] = $product_brand;
        }
    
        /** ---------------- PRICE RANGE ---------------- */
        $price_range = isset($params['price_range']) ? (array) $params['price_range'] : [];
        $price_range = array_map('sanitize_text_field', $price_range);
        if (!empty($price_range) && isset($price_range['min'], $price_range['max'])) {
            $min_price     = floatval($price_range['min']);
            $max_price     = floatval($price_range['max']);
            $price_min_max = komestic_get_min_max_price();
            if ($price_min_max['min'] != $min_price || $price_min_max['max'] != $max_price) {
                if ($min_price >= 0 && $max_price > $min_price) {
                    $meta_query[] = [
                        'key'     => '_price',
                        'value'   => [$min_price, $max_price],
                        'type'    => 'NUMERIC',
                        'compare' => 'BETWEEN',
                    ];
                    $filter_keys['price_range'] = [$min_price, $max_price];
                }
            }
        }
    
        /** ---------------- ATTRIBUTES ---------------- */
        $product_attrs = isset($params['product_attrs']) ? (array) $params['product_attrs'] : [];
        if (!empty($product_attrs)) {
            foreach ($product_attrs as $taxonomy => $terms) {
                $terms = array_map('sanitize_text_field', (array) $terms);
                if (!empty($terms)) {
                    $tax_query[] = [
                        'taxonomy' => $taxonomy,
                        'field'    => 'slug',
                        'terms'    => $terms,
                        'operator' => 'IN',
                    ];
                    $filter_keys[$taxonomy.'[]'] = $terms;
                }
            }
        }
    
        /** ---------------- MERGE TAX & META ---------------- */
        if (!empty($tax_query)) {
            if (count($tax_query) > 1) {
                $tax_query['relation'] = 'AND';
            }
            $args['tax_query'] = $tax_query;
        }
        if (!empty($meta_query)) {
            if (count($meta_query) > 1) {
                $meta_query['relation'] = 'AND';
            }
            $args['meta_query'] = $meta_query;
        }
    }

    /** ---------------- QUERY ---------------- */
    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();
            wc_get_template(
                'content-product.php',
                array(
                    'layout' => $layout,
                )
            );
        endwhile;
    }
    $products_html = ob_get_clean();
    wp_reset_postdata();

    /** ---------------- PAGINATION ---------------- */
    if($layout === 'grid') {
        ob_start(); ?>
            <div class="woocommerce-pagination__inner">
                <?php echo paginate_links(
                    apply_filters('woocommerce_pagination_args', [
                        'base'      => esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false)))),
                        'format'    => '',
                        'current'   => max(1, $paged),
                        'total'     => $query->max_num_pages,
                        'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
                        'next_text' => is_rtl() ? '&larr;' : '&rarr;',
                        'type'      => 'plain',
                        'end_size'  => 3,
                        'mid_size'  => 3,
                    ])
                ); ?>
            </div>
        <?php
        $pagination_html = ob_get_clean();
    
        /** ---------------- FILTER KEYS HTML ---------------- */
        $total_products = $query->found_posts ;
        $first_product_on_page = (($paged - 1) * $posts_per_page) + 1;
        $last_product_on_page = min($paged * $posts_per_page, $total_products);
        $count_result_html = sprintf(
            esc_html__('Showing %1$s–%2$s of %3$s results', 'komestic'),
            $first_product_on_page,
            $last_product_on_page,
            $total_products
        ); 
        $keys_result_html = '';
        if (!empty($filter_keys)) {
            ob_start();
            foreach ($filter_keys as $key => $value) {
                if ($key === 'price_range' && is_array($value)) {
                    $label    = wc_price($value[0]) . ' - ' . wc_price($value[1]);
                    $data_val = implode('-', $value);
                    echo '<button class="pxl-button button--filter-key" data-key="'. esc_attr($key) .'" data-value="' . esc_attr($data_val) . '">' . $label . '<span class="icon-close"></span></button>';
                } elseif (is_array($value)) {
                    foreach ($value as $val) {
                        echo '<button class="pxl-button button--filter-key" data-key="' . esc_attr($key) . '" data-value="' . esc_attr($val) . '">' . esc_html(str_replace("-", " ", $val)) . '<span class="icon-close"></span></button>';
                    }
                } else {
                    echo '<button class="pxl-button button--filter-key" data-key="' . esc_attr($key) . '" data-value="' . esc_attr($value) . '">' . esc_html(str_replace("-", " ", $value)) . '<span class="icon-close"></span></button>';
                }
            }
            echo '<button class="pxl-button button--clear-key">' . esc_html__('Remove All', 'komestic') . '<span class="icon-close"></span></button>';
            $keys_result_html = ob_get_clean();        
            $count_result_html = $query->found_posts . ' Products Found';
        }
    
        /** ---------------- RESPONSE ---------------- */
        return [
            'products_html'            => $products_html,
            'pagination_html'      => $pagination_html,
            'keys_result_html'=> $keys_result_html,
            'count_result_html' => $count_result_html,
        ];
    }else {
        return [
            'products_html' => $products_html,
        ];
    }

    wp_die();
}

/**
 * Get products filter via Ajax
 */
function load_products_ajax_callback() {
    $paged  = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $params = isset($_POST['params']) ? $_POST['params'] : [];
    $layout = isset($_POST['layout']) ? $_POST['layout'] : 'grid';

    $result = komestic_get_products_filter_html([
        'paged' => $paged
    ], $params, $layout);

    if($layout === 'grid') {
        wp_send_json_success([
            'products_html'       => $result['products_html'],
            'pagination_html' => $result['pagination_html'],
            'keys_result_html' => $result['keys_result_html'],
            'count_result_html' => $result['count_result_html']
        ]);
    }
    wp_send_json_success([
        'products_html'       => $result['products_html'],
    ]);
}
add_action('wp_ajax_load_products_ajax', 'load_products_ajax_callback');
add_action('wp_ajax_nopriv_load_products_ajax', 'load_products_ajax_callback');


/**
 * Render product attr with checkbox
 *
 * @param string $attr_slug slug của attribute (vd: color, size)
 * @param string $title tiêu đề hiển thị
 * @param bool   $hide_empty có ẩn term trống không
 */
function komestic_render_product_attribute_filter( $attr_slug, $hide_empty = true ) {
    
    if ( ! taxonomy_exists( $attr_slug ) ) {
        return;
    }
    $taxonomy = get_taxonomy( $attr_slug );

    $terms = get_terms( array(
        'taxonomy'   => $attr_slug,
        'hide_empty' => $hide_empty,
    ) );


    if ( empty( $terms ) || is_wp_error( $terms ) ) {
        return;
    }

    ?>
    <div class="product-filter__section product-filter__section--attr">
        <h6 class="product-filter__section-header">
            <span><?php echo esc_html( str_replace('pa_', '', $taxonomy->name) ); ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                <path d="M7.42899 3.82906L0.236257 11.0242C-0.0786644 11.3399 -0.0786644 11.8514 0.236257 12.1679C0.551176 12.4837 1.06269 12.4837 1.37761 12.1679L7.99963 5.54352L14.6217 12.1671C14.9366 12.4829 15.4481 12.4829 15.7638 12.1671C16.0787 11.8514 16.0787 11.3391 15.7638 11.0234L8.57114 3.82827C8.25948 3.5174 7.73993 3.5174 7.42899 3.82906Z" fill="currentcolor"/>
            </svg>
        </h6>
        <div class="product-filter__section-content">
            <ul class="product-filter__list">
                <?php foreach ( $terms as $key => $term ) : ?>
                    <li class="product-filter__list-item">
                        <label for="<?php echo esc_attr( $term->slug . '-' . $key ); ?>" class="product-filter__field form-checkbox-control">
                            <input type="checkbox" class="filter-item filter-item--checkbox"
                                name="<?php echo esc_attr( $attr_slug ); ?>[]"
                                value="<?php echo esc_attr( $term->slug ); ?>"
                                id="<?php echo esc_attr( $term->slug . '-' . $key ); ?>">
                            <span class="checkbox">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9">
                                    <path d="M4.27183 7.28352L0.81519 3.64176L0 4.5L4.27183 9L12 0.858241L11.1848 0L4.27183 7.28352Z" fill="currentcolor"/>
                                </svg>
                            </span>
                            <span class="label-text">
                                <?php echo esc_html( $term->name ); ?>
                                <span class="pxl-count-item">[ <?php echo esc_html( $term->count ); ?> ]</span>
                            </span>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php
}

/**
 * Render Product Quick View Html
 */
function komestic_render_product_quick_view_html($product_id = 0) {
    
    $wc_product = wc_get_product( $product_id );
    if ( ! $wc_product || ! is_a( $wc_product, 'WC_Product' ) ) {
        return '';
    }
    global $post, $product;
    $backup_post    = isset( $post ) ? $post : null;
    $backup_product = isset( $product ) ? $product : null;

    $post    = get_post( $product_id );
    setup_postdata( $post );
    $product = $wc_product;
    $GLOBALS['product'] = $product;

    $classes = wc_get_product_class( '', $product );
    ob_start();
    echo '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';
        echo '<div class="summary">';
            echo '<div class="product-images pxl-carousel">';
                echo '<div class="pxl-carousel__inner">';
                    $thumb_id = $product->get_image_id();
                    if ( $thumb_id ) {
                        echo '<div class="image-thumb pxl-carousel__item is-active">';
                            echo wp_get_attachment_image( $thumb_id, 'large' );
                        echo '</div>';
                    } else {
                        echo '<div class="image-thumb pxl-carousel__item is-active">';
                            echo wc_placeholder_img( 'large' );
                        echo '</div>';
                    }

                    $gallery_ids = $product->get_gallery_image_ids();
                    if ( ! empty( $gallery_ids ) ) {
                        foreach ( $gallery_ids as $aid ) {
                            echo '<div class="image-gallery pxl-carousel__item">';
                                echo wp_get_attachment_image( $aid, 'large' );
                            echo '</div>';
                        }
                    }
                echo '</div>';
                echo '<div class="pxl-carousel__navigation navigation">';
                    echo '<div class="navigation__button navigation-button--prev"><i class="flaticon flaticon-chevron-left"></i></div>';
                    echo '<div class="navigation__button navigation-button--next"><i class="flaticon flaticon-chevron-right"></i></div>';
                echo '</div>';
            echo '</div>'; 

            echo '<div class="product-content">';
                komestic_get_product_title( $product, 'h5' );
                komestic_get_product_price( $product );
                echo '<p class="product-short-desc">'.apply_filters('woocommerce_short_description', $product->get_short_description()).'</p>';
                
                echo '<div class="product-add-to-cart">';
                    woocommerce_template_single_add_to_cart();
                echo '</div>';

                echo '<a href="' . esc_url( get_permalink( $product_id ) ) . '" class="pxl-button button--link-underline link-view">';
                    get_template_part( 'template-parts/button/button', 'link-underline', ['btn_text' => 'View full details'] );
                echo '</a>';
            echo '</div>';
        echo '</div>'; 
    echo '</div>';


    $html = ob_get_clean();

    wp_reset_postdata();
    if ( $backup_post !== null ) {
        $post = $backup_post;
    } else {
        unset( $post );
    }

    if ( $backup_product !== null ) {
        $product = $backup_product;
    } else {
        unset( $product );
    }
    $GLOBALS['product'] = isset( $product ) ? $product : null;
    return $html;
}

/**
 * Product Quick View via Ajax
 */
function komestic_ajax_quick_view() {
    check_ajax_referer('komestic_nonce', 'security');

    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    if ( $product_id <= 0 ) {
        wp_send_json_error([ 'message' => 'Invalid product ID' ]);
    }
    $html = komestic_render_product_quick_view_html($product_id);
    wp_send_json_success([
        'html'    => $html,
    ]);
}
add_action('wp_ajax_komestic_ajax_quick_view', 'komestic_ajax_quick_view');
add_action('wp_ajax_nopriv_komestic_ajax_quick_view', 'komestic_ajax_quick_view');


/**
 * Render Product Quick Add Html
 */
function komestic_render_product_quick_add_html($product_id = 0) {
    $wc_product = wc_get_product($product_id);

    if (!$wc_product || !is_a($wc_product, 'WC_Product')) {
        return '';
    }

    global $post, $product;

    // Backup global
    $backup_post    = $post ?? null;
    $backup_product = $product ?? null;

    $post    = get_post($product_id);
    setup_postdata($post);
    $product = $wc_product;
    $GLOBALS['product'] = $product;

    ob_start();

    $classes = wc_get_product_class('', $product);
    if($product->is_in_stock()) : ?>
        <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
            <div class="summary">
                <div class="product-top">
                    <div class="product-image">
                        <?php
                        $thumb_id = $product->get_image_id();
                        if ($thumb_id) {
                            echo wp_get_attachment_image($thumb_id, 'large');
                        } else {
                            echo wc_placeholder_img('large');
                        }
                        ?>
                    </div>
                    <div class="product-content">
                        <?php
                        komestic_get_product_title($product, 'div');
                        komestic_get_product_price($product);
                        ?>
                    </div>
                </div>
                <div class="product-add-to-cart">
                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>
            </div>
        </div>
    <?php
    else :
        $template_id = komestic()->get_theme_opt('product_out_of_stock_template_id', ''); 
        echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display((int)$template_id);
    endif;
    $html = ob_get_clean();
    // Reset global
    wp_reset_postdata();
    $post    = $backup_post ?? null;
    $product = $backup_product ?? null;
    $GLOBALS['product'] = $product;

    return $html;
}

/**
 * Product Quick Add via Ajax
 */
function komestic_ajax_quick_add() {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

    if ($product_id <= 0) {
        wp_send_json_error([ 'message' => __('Invalid product ID', 'komestic') ]);
    }

    $html = komestic_render_product_quick_add_html($product_id);

    wp_send_json_success([
        'html'    => $html,
    ]);
}
add_action('wp_ajax_komestic_ajax_quick_add', 'komestic_ajax_quick_add');
add_action('wp_ajax_nopriv_komestic_ajax_quick_add', 'komestic_ajax_quick_add');

