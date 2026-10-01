<?php
/**
 * Custom WooCommerce hooks and filters for the Komestic theme.
 *
 * @package Komestic_Theme
 * @subpackage WooCommerce
 */

/** 
* Remove result count & product ordering & item product category
*/
function komestic_woocommerce_remove_function() {
	remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
	remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
	remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
	remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
	remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
    remove_action( 'woocommerce_register_form', 'wc_registration_privacy_policy_text', 20 );
	add_filter('woocommerce_show_page_title', '__return_false');

}
add_action( 'init', 'komestic_woocommerce_remove_function' );

add_action('woocommerce_before_shop_loop', function() {
    $product_columns = komestic()->get_theme_opt('product_columns', 3); 
    $sidebar         = komestic()->get_sidebar_value('shop'); 
    $sort_value      = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : '';
    ?>
    <div class="woocommerce-topbar">
        <?php $template_html_id = komestic_get_template_shop_filter_id(); isset($_GET['sidebar-shop']) && $_GET['sidebar-shop'] === 'disable'?>
            <a href="<?php echo esc_attr($template_html_id); ?>" class="pxl-button button--primary button--toggle button--shop-filter">
                <span class="button__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22">
                        <path d="M1.3166 3.13318H19.6793C20.4053 3.13318 20.9959 3.7238 20.9959 4.44978C20.9959 5.17576 20.4053 5.76638 19.6793 5.76638H1.3166C0.590625 5.77048 0 5.17986 0 4.44978C0 3.7238 0.590625 3.13318 1.3166 3.13318Z" fill="currentcolor"/>
                        <path d="M4.63887 9.68335H16.357C17.083 9.68335 17.6736 10.274 17.6736 11C17.6736 11.7259 17.083 12.3166 16.357 12.3166H4.63887C3.91289 12.3166 3.32227 11.7259 3.32227 11C3.32227 10.274 3.91289 9.68335 4.63887 9.68335Z" fill="currentcolor"/>
                        <path d="M7.96113 16.2295H13.0348C13.7607 16.2295 14.3514 16.8201 14.3514 17.5461C14.3514 18.2721 13.7607 18.8627 13.0348 18.8627H7.96113C7.23516 18.8627 6.64453 18.2721 6.64453 17.5461C6.64453 16.8201 7.23516 16.2295 7.96113 16.2295Z" fill="currentcolor"/>
                    </svg>
                </span>
                <span class="button__text"><?php echo esc_html__( 'Filter', 'komestic' ); ?></span>
            </a>

        <div class="buttons">
            <?php for ($i=2; $i<5; $i++) : ?>
                <button class="pxl-button button--shop-grid <?php echo esc_attr($product_columns == $i ? 'button--active' : ''); ?>" data-columns="<?php echo esc_attr($i); ?>">
                    <?php for ($j=0; $j<$i; $j++) : ?>
                        <span class="stack"></span>
                    <?php endfor; ?>
                </button>
            <?php endfor; ?>
        </div>

        <div class="product-orderby">
            <select id="sort-filter" name="sort" class="form__field sort pxl-nice-select">
                <option value=""><?php echo esc_html__('Default Sorting', 'komestic'); ?></option>
                <option value="featured" <?php selected($sort_value, 'featured'); ?>><?php esc_html_e('Featured', 'komestic'); ?></option>
                <option value="best-selling" <?php selected($sort_value, 'best-selling'); ?>><?php esc_html_e('Best Selling', 'komestic'); ?></option>
                <option value="title-asc" <?php selected($sort_value, 'title-asc'); ?>><?php esc_html_e('Alphabetically, A-Z', 'komestic'); ?></option>
                <option value="title-desc" <?php selected($sort_value, 'title-desc'); ?>><?php esc_html_e('Alphabetically, Z-A', 'komestic'); ?></option>
                <option value="price-asc" <?php selected($sort_value, 'price-asc'); ?>><?php esc_html_e('Price, Low To High', 'komestic'); ?></option>
                <option value="price-desc" <?php selected($sort_value, 'price-desc'); ?>><?php esc_html_e('Price, High To Low', 'komestic'); ?></option>
                <option value="date-asc" <?php selected($sort_value, 'date-asc'); ?>><?php esc_html_e('Date, Old To New', 'komestic'); ?></option>
                <option value="date-desc" <?php selected($sort_value, 'date-desc'); ?>><?php esc_html_e('Date, New To Old', 'komestic'); ?></option>
            </select>
        </div>
    </div>
    <?php
});

/**
 * Remoce all content in single product
 */
function komestic_remove_single_product_summary_actions() {
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
}
add_action( 'wp_loaded', 'komestic_remove_single_product_summary_actions' );

function remove_after_summary_actions() {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
}
add_action( 'wp_loaded', 'remove_after_summary_actions' );

add_action('woocommerce_after_single_product', 'woocommerce_output_related_products', 10);

/**
 * Add the_content() for single product
 */
function display_product_elementor_content() {
	
    the_content();
}
add_action( 'woocommerce_single_product_summary', 'display_product_elementor_content', 1 );

/**
 * Custom Widget Product Categories 
 */
add_filter('wp_list_categories', 'komestic_wc_custom_cat_item_html');
function komestic_wc_custom_cat_item_html($links) {
    $dir = '';
    $links = str_replace('</a> <span class="count">(', '  <span class="cat-item__count '.$dir.'">[ ', $links);
    $links = str_replace(')</span>', ' ] </span></a>', $links);
    return $links;
}

/**
 * Custom HTML price product Simple Product and Variable Product
 */
add_filter( 'woocommerce_get_price_html', 'custom_woocommerce_get_price_html', 10, 2 );
function custom_woocommerce_get_price_html( $price, $product ) {
    if ( $product->is_type('simple') || $product->is_type('external') ) {
        $regular_price = wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) );
        $sale_price = wc_get_price_to_display( $product, array( 'price' => $product->get_sale_price() ) );

        if ( $product->is_on_sale() ) {
            return '<span class="price--old">' . wc_price( $regular_price ) . '</span>' .
                   '<span class="price--sale">' . wc_price( $sale_price ) . '</span>';
        } else {
            return '<span class="price--normal">' . wc_price( $regular_price ) . '</span>';
        }
    }
    return $price;
}

add_filter( 'woocommerce_variable_price_html', 'custom_woocommerce_variable_price_html', 10, 2 );
function custom_woocommerce_variable_price_html( $price, $product ) {
    $prices = $product->get_variation_prices( true );
    if ( empty( $prices['price'] ) ) {
        return wc_price(0);
    }
	$min_price = (float) current( $prices['price'] );
	$max_price = (float )end( $prices['price'] );


	if ( $min_price !== $max_price ) {
        return '<span class="price--normal">' . wc_format_price_range( $min_price, $max_price ) . '</span>';
    } 
	return '<span class="price--normal">' . wc_price( $min_price ) . '</span>';
}

/**
 * Hook replace icon next and prev pagination Woo
 */
add_filter('woocommerce_pagination_args', 'komestic_woocommerce_pagination_args');
function komestic_woocommerce_pagination_args($default){
	$default = array_merge($default, [
		'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <path d="M12.1704 7.42899L4.97532 0.236256C4.65961 -0.0786655 4.14809 -0.0786655 3.83158 0.236256C3.51586 0.551175 3.51586 1.06269 3.83158 1.37761L10.456 7.99963L3.83237 14.6217C3.51666 14.9366 3.51666 15.4481 3.83237 15.7638C4.14809 16.0787 4.6604 16.0787 4.97612 15.7638L12.1712 8.57114C12.4821 8.25948 12.4821 7.73993 12.1704 7.42899Z" fill="currentcolor"/>
                        </svg>
					',
		'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <path d="M12.1704 7.42899L4.97532 0.236256C4.65961 -0.0786655 4.14809 -0.0786655 3.83158 0.236256C3.51586 0.551175 3.51586 1.06269 3.83158 1.37761L10.456 7.99963L3.83237 14.6217C3.51666 14.9366 3.51666 15.4481 3.83237 15.7638C4.14809 16.0787 4.6604 16.0787 4.97612 15.7638L12.1712 8.57114C12.4821 8.25948 12.4821 7.73993 12.1704 7.42899Z" fill="currentcolor"/>
                        </svg>',
		'type'      => 'plain',
	]);
	return $default;
}

/**
 * Custom Rating HTML
 */
add_filter('woocommerce_product_get_rating_html', 'komestic_woocommerce_product_custom_rating_html', 10, 2);
function komestic_woocommerce_product_custom_rating_html($html, $rating) {
	$star_visiable = '<svg class="star-visiable" width="15" height="14" viewBox="0 0 15 14" xmlns="http://www.w3.org/2000/svg">
	<path d="M7.49998 0L9.55801 4.95914L15 5.34753L10.83 8.80085L12.1352 14L7.49998 11.1752L2.86474 14L4.16999 8.80085L0 5.34753L5.44193 4.95914L7.49998 0Z" fill="#F1C900"/>
	</svg>';
	$haft_star = '<svg class="haft-star" width="15" height="14" viewBox="0 0 15 14" xmlns="http://www.w3.org/2000/svg">
	<path class="copy" d="M7.49998 0L9.55801 4.95914L15 5.34753L10.83 8.80085L12.1352 14L7.49998 11.1752L2.86474 14L4.16999 8.80085L0 5.34753L5.44193 4.95914L7.49998 0Z" fill="#F1C900"/>
	<path class="main" d="M7.49998 0L9.55801 4.95914L15 5.34753L10.83 8.80085L12.1352 14L7.49998 11.1752L2.86474 14L4.16999 8.80085L0 5.34753L5.44193 4.95914L7.49998 0Z" fill="#F1C900"/>
	</svg>';
	$star_disable = '<svg class="star-disable" width="15" height="14" viewBox="0 0 15 14" xmlns="http://www.w3.org/2000/svg">
	<path d="M7.49998 0L9.55801 4.95914L15 5.34753L10.83 8.80085L12.1352 14L7.49998 11.1752L2.86474 14L4.16999 8.80085L0 5.34753L5.44193 4.95914L7.49998 0Z" fill="#F1C900"/>
	</svg>';
	$rating_int = floor($rating);
	$decimal = $rating - $rating_int;
	
	if ($decimal >= 0 && $decimal <= 0.24) {
		$decimal_adjusted = 0;
	} elseif ($decimal > 0.24 && $decimal <= 0.74) {
		$decimal_adjusted = 0.5;
	} else {
		$decimal_adjusted = 1;
	}

	$rating = $rating_int + $decimal_adjusted;
	$rating_int = floor($rating);
	$decimal = $rating - $rating_int;

	$has_haft = $decimal === 0.5;
	$round_up = $decimal > 0.5;
	$html = '<div class="rating-star">';
	for($i=1; $i<=5; $i++) {
		if($i <= $rating_int) $html .= $star_visiable;
		else {
			if($has_haft) {
				if($i == ($rating_int + 1)) {
					$html .= $haft_star;
				}else {
					$html .= $star_disable;
				}
			}elseif($round_up){
				if($i == ($rating_int + 1)){
					$html .= $star_visiable;
				}else {
					$html .= $star_disable;
				}
			}
			else {
				$html .= $star_disable;
			}
		}
	}
	$html .= '</div>';
	return $html;
}

/**
 * Custom HTML Button Add to Cart
 */

add_filter('woocommerce_loop_add_to_cart_link', 'komestic_woocommerce_loop_add_to_cart', 10, 3);
function komestic_woocommerce_loop_add_to_cart($button, $product, $args){
    global $woocommerce_loop;

    $args['class'] = 'pxl-button button--shop-action button--cart archive-add-to-cart';

    if(!$product->is_in_stock()) {
        $out_of_stock_modal = komestic()->get_theme_opt('out_of_stock_modal', 0);
        if ( $out_of_stock_modal > 0 ) {
            $args['href'] = '#template-' . $out_of_stock_modal;
        }
        $args['class'] .= 'button--out-of-stock';
    }else {
        if ( $product->is_type( 'variable' ) ) {
            $quick_add_modal = komestic()->get_theme_opt('quick_add_modal', 0);
            if ( $quick_add_modal > 0 ) {
                $args['href'] = '#template-' . $quick_add_modal;
            }
            $args['class'] .= ' product_type_variable button--quickadd';
    
        } else {
            $args['class'] .= ' add_to_cart_button product_type_simple ajax_add_to_cart';
        }
    }
    return sprintf(
        '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
        esc_url( isset($args['href']) ? $args['href'] : $product->add_to_cart_url() ),
        esc_attr( isset($args['quantity']) ? $args['quantity'] : 1 ),
        esc_attr( isset($args['class']) ? $args['class'] : 'button' ),
        isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
        '' 
    );
}

