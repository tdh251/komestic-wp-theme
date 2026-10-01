<?php
// if($product_type === 'wishlist' && class_exists('WPCleverWoosw')) {
//     $wishlist_product_ids = WPCleverWoosw::get_ids();
//     $post_ids = array_keys( $wishlist_product_ids );
//     if(empty($post_ids)) {
//         get_template_part('template-parts/woocommerce/wishlist-empty');
//         return;
//     }
// }

// wc_get_template( 'archive-product.php' );
// woocommerce_content(); 
$html = komestic_get_products_filter_html();
$show_btn_shop_filter = $widget->get_setting('show_btn_shop_filter', '');
?>

<div class="pxl-shop-archive woocommerce">
    <div class="shop-archive">
        <?php do_action('woocommerce_before_shop_loop'); ?>
        <div class="woocommerce-result">
            <p class="woocommerce-result-count">
                <?php pxl_print_html($html['count_result_html']); ?>
            </p>
            <span class="separator"></span>
            <div class="woocommerce-result-key"></div>
        </div>
        <ul class="products">
            <?php pxl_print_html($html['products_html']); ?>
        </ul>
        <?php do_action('woocommerce_after_shop_loop'); ?>
        <div class="woocommerce-pagination">
            <?php  pxl_print_html($html['pagination_html']); ?>
        </div>
    </div>
</div>