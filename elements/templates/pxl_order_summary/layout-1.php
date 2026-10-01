<?php 
$current_order_id = isset($_GET['order_id']) ? absint($_GET['order_id']) : 0;

$current_order    = wc_get_order( $current_order_id );
$show_table = (bool)$settings['show_table'];
$show_map = (bool)$settings['show_map'];
$show_tracking = (bool)$settings['show_tracking'];
$show_customer_info = (bool)$settings['show_customer_info'];

$orders = komestic_get_all_order_by_user();
?>
<div class="order-summary">
    <?php if($show_table) : 
        $table_items = $settings['table_items'] ?? [];
    ?>
        <section class="order-table">
            <?php if(!empty($orders)) : 
                $has_action = false;
            ?>
                <ul class="order-table__header">
                    <?php foreach($table_items as $table_item) : ?>
                        <li class="order-<?php echo esc_attr($table_item['table_item_value'].' elementor-repeater-item-'.$table_item['_id']); ?>">
                            <?php echo esc_html( $table_item['table_item_label'] ); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <ul class="order-table__body">
                    <?php foreach($orders as $order) : ?>
                        <li class="order-table__item">
                            <?php foreach($table_items as $table_item) : 
                                $show_item_count = ( isset($table_item['show_item_count']) && (bool)($table_item['show_item_count']) );
                                $table_item_value = komestic_get_order_column_value($order, $table_item['table_item_value'], $show_item_count);
                                if('action' == $table_item['table_item_value']) {
                                    $has_action = true;
                                }
                            ?>
                                <div class="order-table__item-<?php echo esc_attr($table_item['table_item_value']); ?> order-<?php echo esc_attr($table_item['table_item_value'].' elementor-repeater-item-'.$table_item['_id']); ?>" data-title="<?php echo esc_attr($table_item['table_item_label'].':'); ?>">
                                    <?php pxl_print_html($table_item_value); ?>
                                </div>
                            <?php endforeach; ?>
                            <?php if(!$has_action) : ?>
                                <a href="<?php echo esc_url( home_url('/my-order/?order_id='.$order->get_id()) ); ?>" class="pxl-link"></a>
                                <?php endif; ?>
                        </li>
                    <?php  endforeach; ?>
                </ul>
            <?php else: ?>
                <div class="order__table-empty order-empty">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/vector.png' ); ?>" alt="Vector Image">
                    <h4 class="order-empty__title">
                        <?php echo esc_html__('You haven’t placed any order yet', 'komestic'); ?>
                    </h4>
                    <p class="order-empty__note">
                        <?php echo esc_html__('It’s time to make your first order', 'komestic'); ?>
                    </p>
                    <a href="<?php echo esc_url(home_url('/shop')); ?>" class="pxl-button button--primary">
                        <span class="button__text">
                            <?php echo esc_html__('Back to shop', 'komestic'); ?>
                        </span>
                    </a>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; 

        if(!$current_order) {
            if(empty($orders)) {
                return;
            }
            $current_order = $orders[0];
        };

        $current_order_status = $current_order->get_status();
        $status_group = komestic_order_status_group();
    ?>
    <?php if($show_tracking) : ?>
        <section class="order-tracking">
            <ul class="order-tracking__progress">
                <div class="order-tracking__line"></div>
                <?php foreach($status_group as $item) : 
                    $active = '';   
                    $label = $item['label'];
                    if(isset($item['statuses'][$current_order_status])) {
                        $active = ' active';
                        $label = $item['statuses'][$current_order_status];
                    }
                ?>
                    <li class="order-tracking__step<?php echo esc_attr($active); ?>">
                        <span class="order-tracking__icon">
                            <?php pxl_print_html($item['icon']); ?>
                        </span>
                        <div class="order-tracking__info">
                            <span class="order-tracking__label">
                                <?php echo esc_html($label); ?>
                            </span>
                            <span class="order-tracking__date">
                                <?php echo wc_format_datetime($current_order->get_date_created()); ?>
                            </span>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php endif; ?>
    <?php if($show_map) : ?>
        <div class="order-location">
            <?php //pxl_print_html(do_shortcode('[order_shipping_address order_id="'.$current_order_id.'"]')); ?>
        </div>
    <?php endif; ?>
    <?php if($show_customer_info) : ?>
        <div class="order-customer">
            <div class="order-customer__inner">
                <div class="order-customer--shipping">
                    <h6 class="order-customer__title">
                        <?php echo esc_html__('Billing Address', 'komestic'); ?>
                    </h6>
                    <p class="order-customer__info">
                        <?php pxl_print_html( komestic_get_order_billing($current_order) ); ?>
                    </p>
                </div>
                <div class="order-customer--billing">
                    <h6 class="order-customer__title">
                        <?php echo esc_html__('Shipping Address', 'komestic'); ?>
                    </h6>
                    <p class="order-customer__info">
                        <?php pxl_print_html( komestic_get_order_shipping($current_order) ); ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>