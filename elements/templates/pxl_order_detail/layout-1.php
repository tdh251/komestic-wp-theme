<?php
$order_id = isset($_GET['order_id']) ? absint($_GET['order_id']) : 0;
$order    = wc_get_order( $order_id );
$orders = komestic_get_all_order_by_user();
if(!$order) {
    if(!empty($orders)) {
        $order = $orders[0];
    }
}
$currency = get_woocommerce_currency(); 
$gift_wrap = komestic_get_gift_package();
$has_gift_wrap = false;
?>
<div class="order-detail">
    <div class="order-detail__inner">
        <?php if ( $order ) { ?>
            <h5 class="order-detail__title">
                <?php echo esc_html__('Order Detail', 'komestic'); ?>
            </h5>
            <div class="order-detail__products">
                <?php foreach ( $order->get_items() as $item_id => $item ) : 
                    $product = $item->get_product();
                    $qty = $item->get_quantity();
                    $item_total = $order->get_item_total( $item, true );
                    $name = $product->get_name();   
    
                    $product_id = $item->get_variation_id() ? $item->get_variation_id() : $item->get_product_id();

                    if($gift_wrap['id'] == $product_id) {
                        $has_gift_wrap = true;
                        continue;
                    }
    
                    $featured_image_html = komestic_get_image_by_size([
                        'img_dimension' => [
                            'width' => 300,
                            'height' => 300
                        ], 
                    ], $product_id);

                    $attrs = [];
                    foreach ( $item->get_meta_data() as $meta ) {
                        $data = $meta->get_data();
                        $key   = $data['key'];
                        $value = $data['value'];
                        if ( strpos( $key, '_' ) === 0 ) {
                            continue;
                        }
                        $label = wc_attribute_label( $key );
                        $term = get_term_by( 'slug', $value, $key );
                        if ( $term ) {
                            $value = $term->name;
                        }
                        $attrs[] =  $value;
                    }
                ?>
                <div class="order-detail__product product">
                    <div class="product__featured">
                        <?php pxl_print_html($featured_image_html); ?>
                        <span class="product__quantity"><?php echo esc_html($qty); ?></span>
                    </div>
                    <div class="product__content">
                        <div class="product__name"><a href="<?php echo esc_url($product_id); ?>"><?php echo esc_html($name); ?></a></div>
                        <?php if ( !empty($attrs) ) { ?>
                            <div class="product__attributes">
                                <?php 
                                    echo implode( ' / ', $attrs );
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="product__price">
                        <?php pxl_print_html(wc_price($item_total)); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="divider"></div>
            <div class="order-detail__calc">
                <div class="order-detail__calc-item order-detail__gift-wrap">
                    <div class="label"><?php echo esc_html__('Gift Package:', 'komestic'); ?></div>
                    <div class="price"><?php pxl_print_html(($has_gift_wrap) ? wc_price($gift_wrap['price']) : wc_price(0).' '.$currency); ?></div>
                </div>
                <div class="order-detail__calc-item order-detail__subtotal">
                    <div class="label"><?php echo esc_html__('Subtotal:', 'komestic'); ?></div>
                    <div class="price"><?php pxl_print_html(wc_price(komestic_get_order_subtotal($order)).' '.$currency); ?></div>
                </div>
                <div class="order-detail__calc-item order-detail__discount">
                    <div class="label"><?php echo esc_html__('Discount:', 'komestic'); ?></div>
                    <div class="price"><?php pxl_print_html('-'.wc_price( $order->get_total_discount() ).' '.$currency); ?></div>
                </div>
                <div class="order-detail__calc-item order-detail__shipping">
                    <div class="label"><?php echo esc_html__('Shipping:', 'komestic'); ?></div>
                    <div class="price"><?php pxl_print_html(wc_price( $order->get_shipping_total() ).' '.$currency); ?></div>
                </div>
                <div class="order-detail__calc-item order-detail__tax">
                    <div class="label"><?php echo esc_html__('Taxes:', 'komestic'); ?></div>
                    <div class="price"><?php pxl_print_html(wc_price( $order->get_total_tax() ).' '.$currency); ?></div>
                </div>
                <div class="divider"></div>
                <div class="order-detail__calc-item order-detail__total">
                    <div class="label"><?php echo esc_html__('Total:', 'komestic'); ?></div>
                    <div class="price"><?php pxl_print_html($order->get_formatted_order_total().' '.$currency); ?></div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
